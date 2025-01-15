<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Leave;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LeaveOutputController extends Controller
{

public function generateLeavePdf($id)
{
    // Fetch the authenticated user's personal information

    // Fetch the specific leave based on the provided id
    $leave = Leave::findOrFail($id); // Fetch leave by ID, ensure it exists
    $personalInformation = Member::find($leave->member_id);
    // Prepare data to be passed to the PDF view
    $data = [
        'title' => 'Leave Application Details',
        'date' => date('m/d/Y'),
        'image1' => public_path('images/p1i9tsabuipt3auf1ob37sk15uk4-0.png'),
        'personalInformation' => $personalInformation,
        'leave' => $leave
    ];

    $pdf = PDF::loadView('leavePDF', $data)
        ->setPaper([0, 0, 612, 936])
        ->setOption('isRemoteEnabled', 'true');

    // Stream the generated PDF to the browser
    return $pdf->stream('leave.pdf');
}
}
