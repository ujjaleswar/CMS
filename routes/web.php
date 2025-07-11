<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentsAttedanceController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;



// Route::get('/', function () {
//     return view('welcome');
// })->name('landingpage');

Route::get('/', [ContactController::class, 'landingpage'])->name('landingpage');




Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dash',[ProfileController::class,'dash'])->name('my-dashboard');


// Route::group(['middleware'=> ['role:student']],function () {
    Route::get('/subjects',[AdminController::class,'subjects'])->name('create-subjects');
    Route::post('/subjects-store',[AdminController::class,'StoreSubject'])->name('store-subjects');
    Route::get('/index',[AdminController::class,'subindex'])->name('subjects-index');
// });

Route::get('/sub-edit/{id}',[AdminController::class,'edit'])->name('subjects-edit');
Route::put('/sub-edit/{id}/update',[AdminController::class,'update'])->name('subjectupdate');


Route::get('/create-class', [AdminController::class, 'create_class'])->name('create-class');
Route::post('/store-class', [AdminController::class, 'store_class'])->name('store-class');
Route::get('/class-listing', [AdminController::class, 'listing_class'])->name('class-listing');
Route::delete('/sub-delete/{id}', [AdminController::class, 'sub_destroy'])->name('delete-subject');


Route::get('/classes/{id}/edit', [AdminController::class, 'class_edit'])->name('edit-class');
Route::put('/classes/{id}', [AdminController::class, 'class_update'])->name('update-class');
Route::delete('/classes/{id}', [AdminController::class, 'destroy'])->name('delete-class');

// Route::group(['middleware'=> ['role:teacher']],function () {
    Route::get('/create-teachers',[AdminController::class,'create_teacher'])->name('create-teachers');
    Route::post('/store-teachers',[AdminController::class,'Store_teacher'])->name('store-teachers');
    Route::get('/teachers-index',[AdminController::class,'teacher_index'])->name('teachers-index');


    Route::get('/teachers-edit/{id}',[AdminController::class,'teachers_edit'])->name('teachers-edit');
    Route::put('/teachers-edit/{id}/update',[AdminController::class,'teachers_update'])->name('teachers-update');
    Route::delete('/teacher-delete/{id}', [AdminController::class, 'teacher_destroy'])->name('delete-teacher');

// });

Route::get('/create-student',[StudentsController::class,'create_student'])->name('create-students');
Route::post('/store-student',[StudentsController::class,'student_store'])->name('store-students');
Route::get('/students', [StudentsController::class, 'student_list'])->name('student-list');
Route::get('/students/{id}/view', [StudentsController::class, 'student_view'])->name('student-view');
Route::get('/students-edit/{id}', [StudentsController::class, 'student_edit'])->name('student-edit');
Route::put('/students-edit/{id}/update', [StudentsController::class, 'student_update'])->name('student-update');
// Route::get('/std-preview', [StudentsController::class, 'student_preview'])->name('students-preview');
Route::get('/student/{id}', [StudentsController::class, 'show'])->name('student.details');
// Route::get('/download/{id}', [StudentsController::class, 'listDownload'])->name('studentlist.download');
Route::get('/student/{id}/download', [StudentsController::class, 'downloadPDF'])->name('studentlist.download');
Route::delete('/student-delete/{id}', [StudentsController::class, 'std_destroy'])->name('delete-student');



Route::get('/teacher/attendance', [StudentsController::class, 'showAttendanceForm'])->name('teacher-attendance');
Route::post('/teacher/attendance', [StudentsController::class, 'submitShortlisted'])->name('submit-Shortlisted');

Route::get('/attendance-list', [StudentsController::class, 'showAttendanceList'])->name('attendance.list');
Route::get('/shortlisted/{id}/edit', [StudentsController::class, 'shortlistedit'])->name('shortlisted.edit');
Route::put('/shortlisted-update/{id}', [StudentsController::class, 'shortlist_update'])->name('shortlisted.update');
Route::delete('/shortlisted/{id}', [StudentsController::class, 'shortlisted_destroy'])->name('shortlisted.destroy');


// web.php
Route::get('/teachers/{id}/assign-schedule', [ScheduleController::class, 'showAssignSchedule'])->name('schedule.create');
Route::post('/teachers/{id}/assign-schedule', [ScheduleController::class, 'store'])->name('schedule.store');

Route::get('/view/asignsub/{id}', [ScheduleController::class, 'showAsignSub'])->name('asign');


// Route::get('/teacher/{id}/schedules', [ScheduleController::class, 'showTeacherSchedule'])->name('teacher.schedules');

Route::get('/teacher/{id}/schedules', [ScheduleController::class, 'showTeacherSchedule'])->name('teacher.schedules');

Route::get('/teacher/{id}/view-schedules', [ScheduleController::class, 'view_shedules'])->name('teacher.data');

Route::get('/teacher/{teacher_id}/schedules/{date}', [ScheduleController::class, 'getSchedulesByDate']);




// Route::get('/teacher/{teacher}/teacher_schedules/{date}', [ScheduleController::class, 'teachershedule_perdate']);
Route::get('/teacher/{id}/teacher_schedules/{date}', [ScheduleController::class, 'getSchedulesByDate']);

// Route::middleware(['auth', 'role:teacher'])->group(function () {
Route::get('teacher-details/{id}', [ScheduleController::class, 'teachers_details'])->name('teacher-details');

// });
// Route::get('teacher_shedulelist', [ScheduleController::class, 'teachers_shedulelist'])->name('teacher_shedulelist');
// Route::get('/teacher_shedulelist', [ScheduleController::class, 'teachers_shedulelist'])
//     ->name('teacher_shedulelist');


// Route::get('/teacher/{id}/teacher_shedule_perdate/{date}', [ScheduleController::class, 'teachershedule_perdate'])->name('teacher_shedulelist');
Route::get('/teacher/{id}/teacher_shedulelist', [ScheduleController::class, 'teachers_shedulelist'])->name('teacher_shedulelist');

Route::post('/teacher/take-attedance', [ScheduleController::class, 'take_attedance'])->name('take-attedance');

Route::post('/submit-attendance', [StudentsAttedanceController::class, 'submitAttendance'])->name('submit-attendance');

// Route::get('/teacher/attendance-list', [StudentsAttedanceController::class, 'showAttendanceList'])->name('shedule-attendance-list');

Route::get('/student-attendace-cheack', [StudentsAttedanceController::class, 'attendace_check'])->name('student-attendace-cheack');
Route::get('/get-subjects/{yearId}', [StudentsAttedanceController::class, 'getSubjects'])->name('get-subjects');
// Route::get('/get-students/{yearId}/{subjectId}', [StudentsAttedanceController::class, 'getStudents']);
Route::get('/get-students', [StudentsAttedanceController::class, 'getStudents']);
Route::get('/get-attendance', [StudentsAttedanceController::class, 'getAttendance']);
Route::get('/students/information/{id}', [StudentsController::class, 'std_information'])->name('student-information');

Route::get('/check-attendance', [StudentsController::class, 'checkaAttendace'])->name('check-attendance');

Route::get('/teacher/{teacher_id}/attendance/{schedule_id}', [StudentsAttedanceController::class, 'viewAttendance'])->name('teacher.attendance.view');

// Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news-json', [NewsController::class, 'index'])->name('news.index.json'); // for AJAX
Route::get('/contact-us', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/about-us', [ContactController::class, 'aboutus'])->name('about-us');
Route::get('/achivement', [ContactController::class, 'achivement'])->name('achivement');

Route::get('/create',[NewsController::class,'create'])->name('News.create');
 Route::post('/create-sub',[NewsController::class,'store'])->name('News.store');
Route::get('/edit/{id}',[NewsController::class,'edit'])->name('News.edits');
 Route::put('/edit/{id}/update',[NewsController::class,'update'])->name('News.update');

 Route::get('/dlt/{id}/delete',[NewsController::class,'destroy'])->name('News.destroy');
//  Route::get('/news',[NewsController::class,'index'])->name('blogs.index');
Route::get('/news', [NewsController::class, 'showNewsPage'])->name('blogs.index'); // for normal page
Route::get('/news/json', [NewsController::class, 'indexJson'])->name('news.index.json'); // If needed for fetch

// Admin Contact Management
Route::get('/admin/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::get('/admin/contacts/{id}/reply', [ContactController::class, 'reply'])->name('contact.reply'); // Optional, if not using modal
Route::post('/admin/contacts/{id}/reply', [ContactController::class, 'sendReply'])->name('contact.sendReply');
Route::get('/admin/contacts/{id}/conversation', [ContactController::class, 'getConversation'])->name('contact.conversation');

Route::get('/teachers-dashboard', [AdminController::class, 'teachersdash'])->name('teachers-dashboard');

Route::get('/students-dashboard', [AdminController::class, 'studentsdash'])->name('students-dashboard');
