<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttendanceImportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testImportFunctionSavesData()
{
    // Simulate file upload
    $file = new \Illuminate\Http\UploadedFile(
        storage_path('path/to/your/test/excel/file.xls'),
        'test.xlsx',
        'application/vnd.ms-excel',
        null,
        true
    );

    $response = $this->post(route('admin.fingerprint.import'), ['file' => $file]);

    // Check if the data is in the database
    $this->assertDatabaseHas('attendance', [
        'member_id' => 'your_test_member_id',
        'log_type' => 'AM IN', // Check for one log type
    ]);
}

}
