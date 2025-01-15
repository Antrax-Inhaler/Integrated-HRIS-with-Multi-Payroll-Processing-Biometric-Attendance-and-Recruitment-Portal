<?php

namespace App\Imports;

use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AttendanceImport implements ToCollection
{
    public $errors = [];
    public $processedData = []; // New property to store extracted data

    public function collection(Collection $rows)
    {
        $tables = $this->splitIntoTables($rows);

        foreach ($tables as $table) {
            $memberIdWithText = $table['header']['ID'] ?? '';
            $dateRange = $table['header']['Date'] ?? '';
            $memberId = preg_replace('/[^0-9]/', '', $memberIdWithText);
            $cleanedMemberId = ltrim($memberId, '0');

            if (empty($cleanedMemberId)) {
                $this->errors[] = "Member ID missing in header.";
                continue;
            }

            if (!empty($dateRange) && strpos($dateRange, '~') !== false) {
                list($start, $end) = explode('~', $dateRange);
                try {
                    $startDate = Carbon::createFromFormat('y.m.d', trim($start));
                    $endDate = Carbon::createFromFormat('y.m.d', trim($end));
                } catch (\Exception $e) {
                    $this->errors[] = "Invalid date range format for member {$cleanedMemberId}: {$e->getMessage()}";
                    continue;
                }
            } else {
                $this->errors[] = "Date range missing or invalid for member {$cleanedMemberId}.";
                continue;
            }

            foreach ($table['rows'] as $row) {
                if (empty($row['Date'])) {
                    $this->errors[] = "Date is missing in row for member {$cleanedMemberId}.";
                    continue;
                }

                $dayParts = explode('.', $row['Date']);
                if (count($dayParts) !== 3) {
                    $this->errors[] = "Invalid date format in row for member {$cleanedMemberId}.";
                    continue;
                }

                try {
                    $day = (int) $dayParts[1];
                    $date = Carbon::create($startDate->year, $startDate->month, $day);
                    Log::info("Parsed date: {$date->toDateString()} for member ID: {$cleanedMemberId}");
                } catch (\Exception $e) {
                    $this->errors[] = "Error creating date for member {$cleanedMemberId}: {$e->getMessage()}";
                    continue;
                }

                $this->processedData[] = [
                    'member_id' => $cleanedMemberId,
                    'date' => $date->toDateString(),
                    'AM IN' => $row['Morning']['IN'] ?? '',
                    'AM OUT' => $row['Morning']['OUT'] ?? '',
                    'PM IN' => $row['Afternoon']['IN'] ?? '',
                    'PM OUT' => $row['Afternoon']['OUT'] ?? '',
                ];
            }
        }
    }
    private function attemptToSaveLog($memberId, $logType, $time, $date)
{
    if ($this->saveAttendanceLog($memberId, $logType, $time, $date)) {
        Log::info("Successfully saved log: Member ID: {$memberId}, Log Type: {$logType}, Date: {$date->toDateString()}, Time: {$time}");
    } else {
        $this->errors[] = "Failed to save log for Member ID: {$memberId}, Log Type: {$logType}, Date: {$date->toDateString()}.";
    }
}

    
    private function splitIntoTables(Collection $rows)
    {
        $tables = [];
        $currentTable = null;
        $headerData = null;

        foreach ($rows as $row) {
            Log::info("Row Content: " . json_encode($row->toArray()));

            if ($this->containsIdOrDateInfo($row)) {
                $headerData = $this->extractIdAndDateFromRow($row);
                Log::info("Detected header info - ID: {$headerData['ID']}, Date: {$headerData['Date']}");
            } elseif ($this->isHeaderRow($row)) {
                if ($currentTable) {
                    $tables[] = $currentTable;
                }
                $currentTable = [
                    'header' => $headerData ?? $this->parseHeader($row),
                    'rows' => []
                ];
            } elseif ($currentTable) {
                $currentTable['rows'][] = $this->parseAttendanceRow($row);
            }
        }

        if ($currentTable) {
            $tables[] = $currentTable;
        }

        return $tables;
    }

    private function containsIdOrDateInfo($row)
    {
        return isset($row[0]) && (strpos($row[0], 'ID:') !== false || strpos($row[0], 'Date:') !== false);
    }

    private function extractIdAndDateFromRow($row)
    {
        $id = '';
        $date = '';

        foreach ($row as $cell) {
            if (stripos($cell, 'ID:') !== false) {
                $id = trim($cell);
            } elseif (stripos($cell, 'Date:') !== false) {
                $date = trim($cell);
            }
        }

        Log::info("Extracted Header Info - ID: {$id}, Date: {$date}");

        return [
            'ID' => $id,
            'Date' => $date
        ];
    }

    private function isHeaderRow($row)
    {
        return isset($row[0]) && strpos($row[0], 'ID') !== false;
    }

    private function parseHeader($row)
    {
        return [
            'ID' => $row[0] ?? '',
            'Date' => $row[1] ?? ''
        ];
    }

    private function parseAttendanceRow($row)
    {
        return [
            'Date' => $row[0] ?? '',
            'Morning' => [
                'IN' => $row[1] ?? '',
                'OUT' => $row[2] ?? ''
            ],
            'Afternoon' => [
                'IN' => $row[3] ?? '',
                'OUT' => $row[4] ?? ''
            ]
        ];
    }
    private function saveAttendanceLog($memberId, $logType, $time, $date)
{
    if (!empty($time)) {
        try {
            $datetimeLog = $date->copy()->setTimeFromTimeString($time);

            // Log the data before saving it
            Log::info("Prepared data for insertion: ", [
                'member_id' => $memberId,
                'log_type' => $logType,
                'datetime_log' => $datetimeLog->toDateTimeString(),
            ]);

            // Output to screen (optional for local development)
            echo "Prepared data for insertion: Member ID: {$memberId}, Log Type: {$logType}, Datetime Log: {$datetimeLog->toDateTimeString()}<br>";

            // Save the data to the database
            Attendance::create([
                'member_id' => $memberId,
                'log_type' => $logType,
                'datetime_log' => $datetimeLog,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error("Error saving {$logType} for member {$memberId}: " . $e->getMessage());
            $this->errors[] = "Failed to save {$logType} for member {$memberId} on date: {$date->toDateString()}.";
            return false;
        }
    } else {
        Log::warning("Skipped empty time log: Member ID: {$memberId}, Log Type: {$logType}, Date: {$date->toDateString()}");
    }
    return false;
}

}
