<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobApplicationListController;
use App\Http\Controllers\ApplicantAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberManagerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\IssueBonusController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\MemberDeductionController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\VerifyMemberController;
use App\Http\Controllers\MemberAttendanceController;
use App\Http\Controllers\MemberLeaveController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ApplicantPersonalInformationController;
use App\Http\Controllers\EducationalBackgroundController;
use App\Http\Controllers\CivilServiceEligibilityController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\VoluntaryWorkController;
use App\Http\Controllers\LearningDevelopmentController;
use App\Http\Controllers\OtherInformationController;
use App\Http\Controllers\LegalQuestionnaireController;
use App\Http\Controllers\PdsReferenceController;
use App\Http\Controllers\ReferencesController;
use App\Http\Controllers\GovernmentIdDetailController;
use App\Http\Controllers\AdjustmentController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\LeaveOutputController;
use App\Http\Controllers\MemberProfileController;
use App\Http\Controllers\LateDeductionController;
use App\Http\Controllers\TravelOutputController;
use App\Http\Controllers\ContractualPayrollController;
use App\Http\Controllers\SemiContractualPayrollController;
use App\Http\Controllers\JobOrderPayrollController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RequirementsController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PeraAcaController;
use App\Http\Controllers\AddComController;
use App\Http\Controllers\MemberBonusController;

use App\Http\Controllers\PDFController;
use App\Http\Controllers\MailController;

use App\Http\Controllers\EmailController;

Route::get('/send-test-email', [EmailController::class, 'sendTestEmail']);
Route::get('send-mail', [MailController::class, 'index']);


Route::get('/', function () { return view('login'); });
Route::get('/applicant/login', [ApplicantAuthController::class, 'showLoginForm'])->name('applicant.login');





Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/applicant/login', function () { return view('applicant.login'); });

Route::prefix('applicant')->group(function () {
    Route::get('login', [ApplicantAuthController::class, 'showLoginForm'])->name('applicant.login');
    Route::post('login', [ApplicantAuthController::class, 'login']);
    Route::get('register', [ApplicantAuthController::class, 'showRegisterForm'])->name('applicant.register');
    Route::post('register', [ApplicantAuthController::class, 'register']);
    Route::post('logout', [ApplicantAuthController::class, 'logout'])->name('applicant.logout');
});

Route::middleware('auth:admin')->group(function () {

    // Route for uploading attendance file
Route::get('admin/upload', [AttendanceController::class, 'showUploadForm'])->name('admin.upload');
Route::post('admin/upload', [AttendanceController::class, 'import'])->name('admin.upload.import');

    Route::prefix('admin')->group(function () {
        Route::get('add_com', [AddComController::class, 'index'])->name('admin.add_com.index');
        Route::post('add_com', [AddComController::class, 'store'])->name('admin.add_com.store');
        Route::put('add_com/{id}', [AddComController::class, 'update'])->name('admin.add_com.update');
        Route::delete('add_com/{id}', [AddComController::class, 'destroy'])->name('admin.add_com.destroy');
    });
    
    Route::prefix('admin')->group(function () {
        Route::get('pera_aca', [PeraAcaController::class, 'index'])->name('admin.pera_aca.index');
        Route::post('pera_aca', [PeraAcaController::class, 'store'])->name('admin.pera_aca.store');
        Route::put('pera_aca/{id}', [PeraAcaController::class, 'update'])->name('admin.pera_aca.update');
        Route::delete('pera_aca/{id}', [PeraAcaController::class, 'destroy'])->name('admin.pera_aca.destroy');
    });    

Route::prefix('admin')->group(function () {
    Route::get('holidays', [HolidayController::class, 'index'])->name('admin.holidays.index');
    Route::post('holidays', [HolidayController::class, 'store'])->name('admin.holidays.store');
    Route::put('holidays/{id}', [HolidayController::class, 'update'])->name('admin.holidays.update');
    Route::delete('holidays/{id}', [HolidayController::class, 'destroy'])->name('admin.holidays.destroy');
});



    Route::prefix('admin')->group(function () {
        Route::get('/requirements', [RequirementsController::class, 'index'])->name('admin.requirements.index');
        Route::post('/requirements', [RequirementsController::class, 'store'])->name('admin.requirements.store');
        Route::delete('/requirements/{id}', [RequirementsController::class, 'destroy'])->name('admin.requirements.destroy');
    });
    
    Route::get('/admin/job-list', [JobApplicationListController::class, 'index'])->name('admin.job_list');
    Route::post('/admin/job_list', [JobApplicationListController::class, 'store'])->name('admin.job_list.store');
    Route::put('/admim/job_list/{id}', [JobApplicationListController::class, 'update'])->name('admin.job_list.update');
    Route::delete('/admin/job_list/{id}', [JobApplicationListController::class, 'destroy'])->name('admin.job_list.destroy');

    Route::get('/admin/notifications', [NotificationController::class, 'getAdminNotifications']);
Route::post('/admin/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
Route::get('/admin/notifications', [NotificationController::class, 'getAdminNotifications']);
Route::post('/admin/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->middleware('auth');


    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.index');
    Route::get('/admin/pds/{id}', [JobApplicationController::class, 'generateNarrowMarginPDF'])->name('applicant.pds');
    Route::get('/admin/job-applications', [JobApplicationController::class, 'index'])->name('admin.job-applications');
    Route::patch('/admin/job-applications/{id}', [JobApplicationController::class, 'update'])->name('admin.job-applications.update');
    
    Route::post('/admin/payroll/update-status/{id}', [PayrollController::class, 'updateStatus'])->name('admin.payroll.updateStatus');
    Route::get('/admin/payroll/{id}/print', [PayrollController::class, 'printPayroll'])->name('admin.payroll.print');
    Route::get('/admin/payslip/{payrollId}', [PayrollController::class, 'printPayrollPayslip'])->name('admin.payslip.printAll');
    
    
    Route::resource('deductions', DeductionController::class);
    Route::post('admin/deductions/', [DeductionController::class, 'storeLateDeduction'])->name('admin.deductions.storeLateDeduction');
    Route::put('admin/deductions/{id}', [DeductionController::class, 'updateLateDeduction'])->name('admin.deductions.updateLateDeduction');
    Route::delete('admin/deductions/{id}', [DeductionController::class, 'destroyLateDeduction'])->name('admin.deductions.destroyLateDeduction');
    
    Route::get('/leaves/pdf/{id}', [LeaveOutputController::class, 'generateLeavePdf'])->name('leaves.pdf');
    Route::get('/travel/pdf/{id}', [TravelOutputController::class, 'generateTravelPdf'])->name('travel.pdf');
    Route::get('/payroll/{id}', [PayrollController::class, 'show'])->name('payroll.show');
    
    // Route::get('/generate-narrow-margin-pdf', [PDFController::class, 'generateNarrowMarginPDF']);
    Route::get('/admin/payroll', [PayrollController::class, 'showPayroll'])->name('payroll.show');
    // Route for computing payroll based on the selected month
    Route::post('admin/payroll', [PayrollController::class, 'store'])->name('admin.payroll.store');
    
    // Route for displaying detailed payroll of a specific month
    Route::get('admin/payroll/{id}', [PayrollController::class, 'show'])->name('admin.payroll.show');
    // Route for recalculating payroll
    Route::post('admin/payroll/{id}/recalculate', [PayrollController::class, 'recalculate'])->name('admin.payroll.recalculate');
    Route::delete('admin/payroll/{id}', [PayrollController::class, 'destroy'])->name('admin.payroll.destroy');
    Route::get('/payroll/payslip-details/{payrollItemId}', [PayrollController::class, 'showPayslipDetails'])->name('payroll.payslip-details');
    Route::get('/admin/payroll/{id}/details', [PayrollController::class, 'showPayrollDetails'])->name('admin.payroll.details');
    
    
    Route::get('/admin/payroll', [PayrollController::class, 'showPayroll'])->name('admin.payroll');
    
    
    
    
    
    
    
    Route::post('/admin/payrollCM/update-status/{id}', [ContractualPayrollController::class, 'updateStatus'])->name('admin.payrollCM.updateStatus');
    Route::get('/admin/payrollCM/{id}/print', [ContractualPayrollController::class, 'printPayroll'])->name('admin.payrollCM.print');
    Route::get('/admin/payslipCM/{payrollId}', [ContractualPayrollController::class, 'printPayrollPayslip'])->name('admin.payslipCM.printAll');
    // Route::get('/generate-narrow-margin-pdf', [PDFController::class, 'generateNarrowMarginPDF']);
    Route::get('/admin/payrollCM', [ContractualPayrollController::class, 'showPayroll'])->name('payrollCM.show');
    // Route for computing payroll based on the selected month
    Route::post('admin/payrollCM', [ContractualPayrollController::class, 'store'])->name('admin.payrollCM.store');
    
    // Route for displaying detailed payroll of a specific month
    Route::get('admin/payrollCM/{id}', [ContractualPayrollController::class, 'show'])->name('admin.payrollCM.show');
    // Route for recalculating payroll
    Route::post('admin/payrollCM/{id}/recalculate', [ContractualPayrollController::class, 'recalculate'])->name('admin.payrollCM.recalculate');
    Route::delete('admin/payrollCM/{id}', [ContractualPayrollController::class, 'destroy'])->name('admin.payrollCM.destroy');
    Route::get('/payrollCM/payslip-details/{payrollItemId}', action: [ContractualPayrollController::class, 'showPayslipDetails'])->name('payrollCM.payslip-details');
    Route::get('/admin/payrollCM/{id}/details', [ContractualPayrollController::class, 'showPayrollDetails'])->name('admin.payrollCM.details');
    Route::get('/admin/payrollCM', [ContractualPayrollController::class, 'showPayroll'])->name('admin.payroll_contractual_monthly');
    Route::get('/payrollCM/{id}', [ContractualPayrollController::class, 'show'])->name('payrollCM.show');
    
    
    
    
    
    Route::post('/admin/payrollCS/update-status/{id}', [SemiContractualPayrollController::class, 'updateStatus'])->name('admin.payrollCS.updateStatus');
    Route::get('/admin/payrollCS/{id}/print', [SemiContractualPayrollController::class, 'printPayroll'])->name('admin.payrollCS.print');
    Route::get('/admin/payslipCS/{payrollId}', [SemiContractualPayrollController::class, 'printPayrollPayslip'])->name('admin.payslipCS.printAll');
    // Route::get('/generate-narrow-margin-pdf', [PDFController::class, 'generateNarrowMarginPDF']);
    Route::get('/admin/payrollCS', [SemiContractualPayrollController::class, 'showPayroll'])->name('payrollCS.show');
    // Route for computing payroll based on the selected month
    Route::post('admin/payrollCS', [SemiContractualPayrollController::class, 'store'])->name('admin.payrollCS.store');
    
    // Route for displaying detailed payroll of a specific month
    Route::get('admin/payrollCS/{id}', [SemiContractualPayrollController::class, 'show'])->name('admin.payrollCS.show');
    // Route for recalculating payroll
    Route::post('admin/payrollCS/{id}/recalculate', [SemiContractualPayrollController::class, 'recalculate'])->name('admin.payrollCS.recalculate');
    Route::delete('admin/payrollCS/{id}', [SemiContractualPayrollController::class, 'destroy'])->name('admin.payrollCS.destroy');
    Route::get('/payrollCS/payslip-details/{payrollItemId}', [SemiContractualPayrollController::class, 'showPayslipDetails'])->name('payrollCS.payslip-details');
    Route::get('/admin/payrollCS/{id}/details', [SemiContractualPayrollController::class, 'showPayrollDetails'])->name('admin.payrollCS.details');
    Route::get('/admin/payrollCS', [SemiContractualPayrollController::class, 'showPayroll'])->name('admin.payroll_semi_contractual_monthly');
    Route::get('/payrollCS/{id}', [SemiContractualPayrollController::class, 'show'])->name('payrollCS.show');
    
    
    Route::post('/admin/payrollJO/update-status/{id}', [JobOrderPayrollController::class, 'updateStatus'])->name('admin.payrollJO.updateStatus');
    Route::get('/admin/payrollJO/{id}/print', [JobOrderPayrollController::class, 'printPayroll'])->name('admin.payrollJO.print');
    Route::get('/admin/payslipJO/{payrollId}', [JobOrderPayrollController::class, 'printPayrollPayslip'])->name('admin.payslipJO.printAll');
    // Route::get('/generate-narrow-margin-pdf', [PDFController::class, 'generateNarrowMarginPDF']);
    Route::get('/admin/payrollJO', [JobOrderPayrollController::class, 'showPayroll'])->name('payrollJO.show');
    // Route for computing payroll based on the selected month
    Route::post('admin/payrollJO', [JobOrderPayrollController::class, 'store'])->name('admin.payrollJO.store');
    
    // Route for displaying detailed payroll of a specific month
    Route::get('admin/payrollJO/{id}', [JobOrderPayrollController::class, 'show'])->name('admin.payrollJO.show');
    // Route for recalculating payroll
    Route::post('admin/payrollJO/{id}/recalculate', [JobOrderPayrollController::class, 'recalculate'])->name('admin.payrollJO.recalculate');
    Route::delete('admin/payrollJO/{id}', [JobOrderPayrollController::class, 'destroy'])->name('admin.payrollJO.destroy');
    Route::get('/payrollJO/payslip-details/{payrollItemId}', [JobOrderPayrollController::class, 'showPayslipDetails'])->name('payrollJO.payslip-details');
    Route::get('/admin/payrollJO/{id}/details', [JobOrderPayrollController::class, 'showPayrollDetails'])->name('admin.payrollJO.details');
    Route::get('/admin/payrollJO', [JobOrderPayrollController::class, 'showPayroll'])->name('admin.payroll_job_order_monthly');
    Route::get('/payrollJO/{id}', [JobOrderPayrollController::class, 'show'])->name('payrollJO.show');
    
    
    
    
    
    Route::get('/admin/adjustment', [AdjustmentController::class, 'index'])->name('adjustment.index');
    Route::post('/admin/adjustment/store', [AdjustmentController::class, 'store'])->name('adjustment.store');
    Route::put('/admin/adjustment/update/{id}', [AdjustmentController::class, 'update'])->name('adjustment.update');
    Route::delete('/admin/adjustment/delete/{id}', [AdjustmentController::class, 'destroy'])->name('adjustment.destroy');
    
    
    Route::get('/admin/settings', [GeneralSettingsController::class, 'index'])->name('admin.settings.index');
    Route::put('/admin/settings', [GeneralSettingsController::class, 'update'])->name('admin.settings.update');
    Route::get('/admin/style', [GeneralSettingsController::class, 'viewer'])->name('settings');
    
    Route::prefix('admin')->group(function () {
        Route::get('/member-deductions', [MemberDeductionController::class, 'index'])->name('admin.member-deductions.index');
        Route::post('/member-deductions/store', [MemberDeductionController::class, 'store'])->name('admin.member-deductions.store');
        Route::put('/member-deductions/update/{id}', [MemberDeductionController::class, 'update'])->name('admin.member-deductions.update');
        Route::delete('/member-deductions/delete/{id}', [MemberDeductionController::class, 'destroy'])->name('admin.member-deductions.destroy');
    });
    
    Route::prefix('admin')->group(function () {
        Route::get('/verify-member', [VerifyMemberController::class, 'index'])->name('admin.verify-member.index');
        Route::put('/verify-member/verify/{id}', [VerifyMemberController::class, 'verifyMember'])->name('admin.verify-member.verify');
        Route::delete('/verify-member/reject/{id}', [VerifyMemberController::class, 'rejectMember'])->name('admin.verify-member.reject');
        Route::get('/verify-member/view/{id}', [VerifyMemberController::class, 'viewMember'])->name('admin.verify-member.view');
       
    });
    
    
    Route::prefix('admin')->group(function () {
        Route::get('/deductions', [DeductionController::class, 'index'])->name('admin.deductions');
        Route::post('/deductions/store', [DeductionController::class, 'store'])->name('admin.deductions.store');
        Route::put('/deductions/update/{id}', [DeductionController::class, 'update'])->name('admin.deductions.update');
        Route::delete('/deductions/delete/{id}', [DeductionController::class, 'destroy'])->name('admin.deductions.destroy');
    });
    
    Route::prefix('admin')->group(function () {
        Route::get('/travel', [TravelController::class, 'index'])->name('admin.travel.index');
        Route::post('/travel/store', [TravelController::class, 'store'])->name('admin.travel.store');
        Route::put('/travel/update/{id}', [TravelController::class, 'update'])->name('admin.travel.update');
        Route::delete('/travel/delete/{id}', [TravelController::class, 'destroy'])->name('admin.travel.destroy');
    });
    Route::prefix('admin')->group(function () {
        Route::get('/member-deductions', [MemberDeductionController::class, 'index'])->name('admin.member-deductions.index');
        Route::post('/member-deductions/store', [MemberDeductionController::class, 'store'])->name('admin.member-deductions.store');
        Route::put('/member-deductions/update/{id}', [MemberDeductionController::class, 'update'])->name('admin.member-deductions.update');
        Route::delete('/member-deductions/delete/{id}', [MemberDeductionController::class, 'destroy'])->name('admin.member-deductions.destroy');
    });
    Route::patch('admin/attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
    
    // Route::get('admin/fingerprint', [AttendanceController::class, 'showFingerprintForm'])->name('fingerprint.form');
    // Route::post('admin/fingerprint/process', [AttendanceController::class, 'processFingerprint'])->name('fingerprint.process');
    Route::prefix('member')->group(function () {

        // Routes for managing leaves
        Route::get('/leaves', [LeaveController::class, 'index'])->name('member.leaves.index');
        Route::post('/leaves/store', [LeaveController::class, 'store'])->name('member.leaves.store');
        Route::put('/leaves/update/{leave}', [LeaveController::class, 'update'])->name('member.leaves.update');
        Route::delete('/leaves/delete/{leave}', [LeaveController::class, 'destroy'])->name('member.leaves.destroy');
    });
    Route::prefix('admin')->group(function () {
        // Routes for managing leaves
        Route::get('/leaves', [LeaveController::class, 'admin'])->name('admin.leaves.index');
        Route::post('/leaves/store', [LeaveController::class, 'store_admin'])->name('admin.leaves.store');
        Route::put('/leaves/update/{leave}', [LeaveController::class, 'update_admin'])->name('admin.leaves.update');
        Route::delete('/leaves/delete/{leave}', [LeaveController::class, 'destroy_admin'])->name('admin.leaves.destroy');
    });
    
    Route::get('/admin/payroll/issue-bonus', [IssueBonusController::class, 'create'])->name('bonus.create');
    Route::post('/admin/payroll/issue-bonus', [IssueBonusController::class, 'store'])->name('bonus.store');
    // Bonus Routes
    Route::get('/admin/issue-bonus', [IssueBonusController::class, 'create'])->name('bonus.create');
    Route::post('/admin/issue-bonus', [IssueBonusController::class, 'store'])->name('bonus.store');
    Route::get('/admin/issue-bonus/{id}/edit', [IssueBonusController::class, 'edit'])->name('bonus.edit');
    Route::put('/admin/issue-bonus/{id}', [IssueBonusController::class, 'update'])->name('bonus.update');
    Route::delete('/admin/issue-bonus/{id}', [IssueBonusController::class, 'destroy'])->name('bonus.destroy');
    
    
    Route::resource('admin/attendance', AttendanceController::class);
    Route::post('attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('admin/attendance', [AttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::prefix('admin')->group(function () {
        // Routes for managing bonuses
        Route::get('/bonuses', [BonusController::class, 'index'])->name('admin.bonuses.index');
        Route::post('/bonuses/store', [BonusController::class, 'store'])->name('admin.bonuses.store');
        Route::put('/bonuses/update/{id}', [BonusController::class, 'update'])->name('admin.bonuses.update');
        Route::delete('/bonuses/delete/{id}', [BonusController::class, 'destroy'])->name('admin.bonuses.destroy');
    });
    
    Route::prefix('admin')->group(function () {
        Route::get('/positions', [PositionController::class, 'index'])->name('admin.positions.index');
        Route::post('/positions/store', [PositionController::class, 'store'])->name('admin.positions.store');
        Route::put('/positions/update/{id}', [PositionController::class, 'update'])->name('admin.positions.update');
        Route::delete('/positions/delete/{id}', [PositionController::class, 'destroy'])->name('admin.positions.destroy');
    });
    // Departments routes
    Route::prefix('admin')->group(function () {
        Route::resource('departments', DepartmentController::class);
    });

    Route::prefix('admin')->group(function () {
        Route::get('/fingerprint', [AttendanceController::class, 'showFingerprintImport'])->name('admin.fingerprint');
        Route::post('/fingerprint/import', [AttendanceController::class, 'importFingerprintAttendance'])->name('admin.fingerprint.import');
    });
    Route::get('/admin/members', [MemberManagerController::class, 'index'])->name('admin.members');
    Route::post('/admin/members/store', [MemberManagerController::class, 'store'])->name('members.store');
    Route::put('/admin/members/update/{id}', [MemberManagerController::class, 'update'])->name('members.update');
    Route::delete('/admin/members/delete/{id}', [MemberManagerController::class, 'destroy'])->name('members.destroy');
    Route::get('admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
    Route::post('admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/admin/fingerprint/{memberId}', [AttendanceController::class, 'testImportedData']);

    });

// Route::get('/admin', function () { return view('admin.index'); });
// Route::get('/admin/notification', function () {return view('admin.notification');});
// Route::get('/admin/clients', function () {return view('admin.clients');});
// Route::get('/calendar3', function () {return view('admin.calendar3');});
// Route::get('/admin/appointment', function () {return view('admin.appointment');});
// Route::get('/admin/reservation', function () {return view('admin.reservation');});
// Route::get('/admin/analytics', function () {return view('admin.analytics');});
// Route::get('/admin/google', function () {return view('admin.google');});
// Route::get('/admin/vmaps', function () {return view('admin.vmaps');});
// Route::get('/admin/plot', function () {return view('admin.plot');});
// Route::get('/admin/setting', function () {return view('admin.setting');});




// Route::get('/user', function () { return view('user.index'); });
// Route::get('/user/appointment', function () {return view('user.appointment');});
// Route::get('/user/reservation', function () {return view('user.reservation');});
// Route::get('/user/pricing', function () {return view('member.pricing');});
// Route::get('/user/gmaps', function () {return view('user.gmaps');});
// Route::get('/user/rules', function () {return view('user.rules');});
// Route::get('/user/vmaps', function () {return view('user.vmaps');});
// Route::get('calendar2', function () {return view('user.calendar2'); });
// Route::get('/user/calendar', function () {return view('user.calendar'); });
// // Route::get('/user/calendar',[AppointmentController::class,'Calendar'])->name('user.calendar');
// Route::get('/user/analytics', function () {return view('user.analytics');});
// Route::get('/user/notification', function () {return view('user.notification');});
// Route::get('/user/profile', function () {return view('user.profile');});
// Route::get('/user/billing', function () {return view('user.billing');});

Route::post('applicant/logout', [ApplicantAuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth:member'])->group(function () {
    Route::get('/leave-pdf-format', [LeaveOutputController::class, 'generateLeavePdf']);

    Route::get('/member/index', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/attendance', [MemberAttendanceController::class, 'showMemberAttendance'])->name('member.attendance');
    Route::get('/member/leave', [MemberLeaveController::class, 'index'])->name('member.leave.index');
    Route::post('/member/leave', [MemberLeaveController::class, 'store'])->name('member.leave.store');
    Route::put('/member/leave/{leave}', [MemberLeaveController::class, 'update'])->name('member.leave.update');
    Route::delete('/member/leave/{leave}', [MemberLeaveController::class, 'destroy'])->name('member.leave.destroy');
    Route::get('/travel-pdf-format', [TravelOutputController::class, 'generateTravelPdf']);

    Route::get('/member/profile-info', [MemberProfileController::class, 'showProfile'])->name('member.profile');
    Route::post('/member/profile-info', [MemberProfileController::class, 'updateProfile'])->name('member.profile.update');

    Route::get('member/travel', [TravelController::class, 'index2'])->name('member.travel.index');
    Route::post('member/travel/store', [TravelController::class, 'store2'])->name('member.travel.store');
    Route::put('member/travel/update/{id}', [TravelController::class, 'update2'])->name('member.travel.update');
    Route::delete('member/travel/delete/{id}', [TravelController::class, 'destroy2'])->name('member.travel.destroy');

    Route::get('/member/bonuses', [MemberBonusController::class, 'index'])->name('member.bonuses');
    Route::get('/member/deductions', [MemberDeductionController::class, 'show'])->name('member.deductions');
    Route::get('/member/pera-aca', [PeraAcaController::class, 'display'])->name('member.pera_aca');
    Route::get('/member/add-com', [AddComController::class, 'display'])->name('member.add_com');

    Route::get('/member/notifications', [NotificationController::class, 'getMemberNotifications']);
    Route::post('/member/notifications/{id}/read', [NotificationController::class, 'markMemberNotificationAsRead']);
    Route::get('/settings', [GeneralSettingsController::class, 'viewer'])->name('settings.viewer');
    Route::get('/member/logs', [MemberController::class, 'getLogNotifications'])->name('member.logs');

});










Route::middleware('auth:applicant')->group(function () {

Route::get('applicant/', [JobListingController::class, 'index'])->name('applicant.index');






    Route::get('/applicant/notifications', [NotificationController::class, 'getApplicantNotifications']);

// Route to mark an applicant notification as read
Route::post('/applicant/notifications/{id}/read', [NotificationController::class, 'markApplicantNotificationAsRead']);
    Route::get('/applicant/applications', [JobApplicationController::class, 'applicationList'])
    ->name('applicant.application_list');

Route::patch('/job-applications/{id}/cancel', [JobApplicationController::class, 'cancel'])
    ->name('job-applications.cancel');
    // Route::get('/generate-narrow-margin-pdf', [PDFController::class, 'generateNarrowMarginPDF']);
Route::get('/apply/pdf', [PDFController::class, 'generateNarrowMarginPDF'])->name('apply.pdf');

Route::get('/apply/{id}', [JobApplicationController::class, 'apply'])->name('job.apply');
Route::get('/applicant/personal-information', [ApplicantPersonalInformationController::class, 'showForm'])->name('applicant.showPersonalInformation');
Route::post('/applicant/personal-information', [ApplicantPersonalInformationController::class, 'savePersonalInformation'])->name('applicant.savePersonalInformation');
Route::post('/apply', [JobApplicationController::class, 'store'])->name('job-applications.store');
Route::get('/applicant/educational-background', [EducationalBackgroundController::class, 'index']);
Route::post('/applicant/educational-background', [EducationalBackgroundController::class, 'store']);

Route::get('/applicant/civilserviceeligibility', [CivilServiceEligibilityController::class, 'index'])->name('civilserviceeligibility.index');
    Route::post('/applicant/civilserviceeligibility/save', [CivilServiceEligibilityController::class, 'save'])->name('civilserviceeligibility.save');
    Route::delete('/applicant/civilserviceeligibility/{id}', [CivilServiceEligibilityController::class, 'destroy'])->name('civilserviceeligibility.destroy');
    Route::get('applicant/work-experience', [WorkExperienceController::class, 'index'])->name('applicant.work-experience');
Route::post('applicant/work-experience', [WorkExperienceController::class, 'store'])->name('applicant.work-experience.store');
Route::put('applicant/work-experience/{id}', [WorkExperienceController::class, 'update'])->name('applicant.work-experience.update');
Route::delete('applicant/work-experience/{id}', [WorkExperienceController::class, 'destroy'])->name('applicant.work-experience.destroy');

Route::get('/applicant/voluntary-work', [VoluntaryWorkController::class, 'index'])->name('applicant.voluntarywork');
    Route::post('/applicant/voluntary-work', [VoluntaryWorkController::class, 'store'])->name('applicant.voluntarywork.store');
    Route::put('/applicant/voluntary-work/{id}', [VoluntaryWorkController::class, 'update'])->name('applicant.voluntarywork.update');
    Route::delete('/applicant/voluntary-work/{id}', [VoluntaryWorkController::class, 'destroy'])->name('applicant.voluntarywork.delete');

    Route::get('/applicant/learning-development', [LearningDevelopmentController::class, 'index'])->name('applicant.learning_development');
    Route::post('/applicant/learning-development', [LearningDevelopmentController::class, 'store'])->name('applicant.learning_development.store');
    Route::put('/applicant/learning-development/{id}', [LearningDevelopmentController::class, 'update'])->name('applicant.learning_development.update');
    Route::delete('/applicant/learning-development/{id}', [LearningDevelopmentController::class, 'destroy'])->name('applicant.learning_development.delete');

    Route::get('/applicant/other-information', [OtherInformationController::class, 'index'])->name('applicant.other_information');
    Route::post('/applicant/other-information', [OtherInformationController::class, 'store'])->name('applicant.other_information.store');
    Route::put('/applicant/other-information/{id}', [OtherInformationController::class, 'update'])->name('applicant.other_information.update');
    Route::delete('/applicant/other-information/{id}', [OtherInformationController::class, 'destroy'])->name('applicant.other_information.delete');

    Route::get('/applicant/legal-questionnaire', [LegalQuestionnaireController::class, 'index'])->name('applicant.legal-questionnaire');
    Route::post('/applicant/legal-questionnaire', [LegalQuestionnaireController::class, 'store']);
    Route::put('/applicant/legal-questionnaire/{id}', [LegalQuestionnaireController::class, 'update']);
    Route::delete('/applicant/legal-questionnaire/{id}', [LegalQuestionnaireController::class, 'destroy']);


    Route::get('applicant/referencespds', [ReferencesController::class, 'index'])->name('applicant.references2');
Route::post('applicant/referencespds/family-background', [ReferencesController::class, 'storeFamilyBackground']);
Route::post('applicant/referencespds/child', [ReferencesController::class, 'storeChild']);
Route::put('applicant/referencespds/child/{id}', [ReferencesController::class, 'updateChild']);
Route::delete('applicant/referencespds/child/{id}', [ReferencesController::class, 'deleteChild']);

Route::get('/applicant/references', [PdsReferenceController::class, 'index'])->name('applicant.references');
Route::post('/applicant/references', [PdsReferenceController::class, 'store'])->name('applicant.references.store');
Route::put('/applicant/references/{id}', [PdsReferenceController::class, 'update'])->name('applicant.references.update');
Route::delete('/applicant/references/{id}', [PdsReferenceController::class, 'destroy'])->name('applicant.references.delete');

Route::post('/applicant/government-id-details', [GovernmentIdDetailController::class, 'storeOrUpdate'])->name('applicant.government-id-details.storeOrUpdate');

Route::get('/applicant/profile', [ApplicantAuthController::class, 'showProfile'])->name('applicant.profile');
Route::post('/applicant/profile/update', [ApplicantAuthController::class, 'updateProfile'])->name('applicant.profile.update');
Route::post('/applicant/password/update', [ApplicantAuthController::class, 'updatePassword'])->name('applicant.password.update');
});
Route::get('/settings', [GeneralSettingsController::class, 'viewer'])->name('settings.viewer');
