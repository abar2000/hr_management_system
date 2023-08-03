<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryTypeController;
use App\Http\Controllers\QualificationsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\SalarayAdvanceController;
use App\Http\Controllers\ShortLeavesController; 
use App\Http\Controllers\AllowedLeaveController;
use App\Http\Controllers\LeaveRequestController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/positions',[PositionController::class, 'getAllPositions']);
Route::get('/positions/{id}',[PositionController::class, 'getPositionInfo']);
Route::post('/positions',[PositionController::class, 'savePosition']);
Route::put('/positions/{id}',[PositionController::class, 'updatePosition']);
Route::delete('/positions/{id}',[PositionController::class, 'destory']);

Route::get('/salarytypes',[SalaryTypeController::class, 'getAllSalaryType']);
Route::get('/salarytypes/{id}',[SalaryTypeController::class, 'getSalaryTypeInfo']);
Route::post('/salarytypes',[SalaryTypeController::class, 'saveSalaryType']);
Route::put('/salarytypes/{id}',[SalaryTypeController::class, 'updateSalaryType']);
Route::delete('/salarytypes/{id}',[SalaryTypeController::class, 'destory']);

Route::get('/qualifications',[QualificationsController::class, 'getAllQualification']);
Route::get('/qualifications/{id}',[QualificationsController::class, 'getQualificationInfo']);
Route::post('/qualifications',[QualificationsController::class, 'saveQualification']);
Route::put('/qualifications/{id}',[QualificationsController::class, 'updateQualification']);
Route::delete('/qualifications/{id}',[QualificationsController::class, 'destory']);

Route::get ('/departments', [DepartmentsController::class, 'getAllDepartment']);
Route::get ('/departments/{id}', [DepartmentsController::class, 'getDepartmentInfo']);
Route::POST('/departments', [DepartmentsController::class, 'saveDepartment']);
Route::put ('/departments/{id}', [DepartmentsController::class, 'updateDepartment']);
Route::delete ('/departments/{id}', [DepartmentsController::class, 'destroy']);

Route::get ('/companies', [CompanyController::class, 'getAllCompany']);
Route::get ('/companies/{id}', [CompanyController::class, 'getCompanyInfo']);
Route::POST('/companies', [CompanyController::class, 'saveCompany']);
Route::put ('/companies/{id}', [CompanyController::class, 'updateCompany']);
Route::delete ('/companies/{id}', [CompanyController::class, 'destroy']);

Route::get ('/employees', [EmployeesController::class, 'getAllEmployees']);
Route::get ('/employees/{id}', [EmployeesController::class, 'getEmployeeInfo']);
Route::POST('/employees', [EmployeesController::class, 'saveEmployee']);
Route::put ('/employees/{id}', [EmployeesController::class, 'updateEmployee']);
Route::delete ('/employees/{id}', [EmployeesController::class, 'destroy']);

Route::get ('/announcements', [AnnouncementController::class, 'getAllAnnouncement']);
Route::get ('/announcements/{id}', [AnnouncementController::class, 'getAnnouncementInfo']);
Route::POST('/announcements', [AnnouncementController::class, 'saveAnnouncement']);
Route::put ('/announcements/{id}', [AnnouncementController::class, 'updateAnnouncement']);
Route::delete ('/announcements/{id}', [AnnouncementController::class, 'destroy']);

Route::get ('/leavetypes', [LeaveTypeController::class, 'getAllLeaveType']);
Route::get ('/leavetypes/{id}', [LeaveTypeController::class, 'getLeaveTypeInfo']);
Route::POST('/leavetypes', [LeaveTypeController::class, 'saveLeaveType']);
Route::put ('/leavetypes/{id}', [LeaveTypeController::class, 'updateLeaveType']);
Route::delete ('/leavetypes/{id}', [LeaveTypeController::class, 'destroy']);

Route::get ('/salaryadvance', [SalarayAdvanceController::class, 'getAllSalaryAdvance']);
Route::get ('/salaryadvance/{id}', [SalarayAdvanceController::class, 'getSalaryAdvance']);
Route::POST('/salaryadvance', [SalarayAdvanceController::class, 'saveSalaryAdvance']);
Route::put ('/salaryadvance/{id}', [SalarayAdvanceController::class, 'updateSalaryAdvance']);
Route::delete ('/salaryadvance/{id}', [SalarayAdvanceController::class, 'destroy']);

Route::get ('/shortleaves', [ShortLeavesController::class, 'getAllShortleaves']);
Route::get ('/shortleaves/{id}', [ShortLeavesController::class, 'getShortleaves']);
Route::POST('/shortleaves', [ShortLeavesController::class, 'saveShortleaves']);
Route::put ('/shortleaves/{id}', [ShortLeavesController::class, 'updateShortleaves']);
Route::delete ('/shortleaves/{id}', [ShortLeavesController::class, 'destroy']);

Route::get ('/allowedleaves', [AllowedLeaveController::class, 'getAllAllowedleaves']);
Route::get ('/allowedleaves/{id}', [AllowedLeaveController::class, 'getAllowedleaves']);
Route::POST('/allowedleaves', [AllowedLeaveController::class, 'saveAllowedleaves']);
Route::put ('/allowedleaves/{id}', [AllowedLeaveController::class, 'updateAllowedleaves']);
Route::delete ('/allowedleaves/{id}', [AllowedLeaveController::class, 'destroy']);

Route::get ('/leaverequests', [LeaveRequestController::class, 'getAllLeaverequest']);
Route::get ('/leaverequests/{id}', [LeaveRequestController::class, 'getLeaverequest']);
Route::POST('/leaverequests', [LeaveRequestController::class, 'saveLeaverequest']);
Route::put ('/leaverequests/{id}', [LeaveRequestController::class, 'updateLeaverequest']);
Route::delete ('/leaverequests/{id}', [LeaveRequestController::class, 'destroy']);