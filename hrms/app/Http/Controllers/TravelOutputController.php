<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Travel;
use App\Models\Member;

use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class TravelOutputController extends Controller
{
    public function generateTravelPdf($id)
{
    // Fetch the authenticated user's personal information
    // $travelInformation = Travel::where('applicant_id', Auth::id())->first();
    $travel = Travel::findOrFail($id); // Fetch leave by ID, ensure it exists

    $personalInformation = Member::find($travel->member_id);


    // Prepare data to be passed to the PDF view
    $data = [
        'title' => 'Personal Data Sheet',
        'date' => date('m/d/Y'),
        'image1' => public_path('images/travel-image.jpg'),
        'travel' => $travel,
        'personalInformation' => $personalInformation

        
    ];

    $pdf = PDF::loadView('travelPDF', $data)
        ->setPaper([0, 0, 612, 936])
        ->setOption('isRemoteEnabled', 'true');

    // Stream the generated PDF to the browser
    return $pdf->stream('travel.pdf');
}


}
