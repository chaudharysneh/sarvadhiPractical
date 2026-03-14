<?php

use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PayoutController as AdminPayoutController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SessionController as AdminSessionController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\SessionController as StudentSessionController;
use App\Http\Controllers\Student\TeacherController as StudentTeacherController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Teacher\PayoutController as TeacherPayoutController;
use App\Http\Controllers\Teacher\SessionController as TeacherSessionController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showMemberLoginForm'])->name('login.member');
    Route::post('/login', [LoginController::class, 'memberLogin'])->name('login.member.post');
    Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('login.admin');
    Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('login.admin.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::resource('teachers', AdminTeacherController::class);
    Route::resource('students', AdminStudentController::class);
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{teacher}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
    Route::put('/assignments/{teacher}', [AssignmentController::class, 'update'])->name('assignments.update');
    Route::get('/sessions', [AdminSessionController::class, 'index'])->name('sessions.index');
    Route::get('/payouts', [AdminPayoutController::class, 'index'])->name('payouts.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/send', [ReportController::class, 'send'])->name('reports.send');
});

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', TeacherDashboard::class)->name('dashboard');
    Route::get('/sessions', [TeacherSessionController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/create', [TeacherSessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [TeacherSessionController::class, 'store'])->name('sessions.store');
    Route::get('/students', [TeacherStudentController::class, 'index'])->name('students.index');
    Route::get('/payouts', [TeacherPayoutController::class, 'index'])->name('payouts.index');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', StudentDashboard::class)->name('dashboard');
    Route::get('/sessions', [StudentSessionController::class, 'index'])->name('sessions.index');
    Route::get('/teachers', [StudentTeacherController::class, 'index'])->name('teachers.index');
});
