<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ContactMessageAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceAdminController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\ProjectAdminController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\Admin\SkillAdminController;
use App\Http\Controllers\Admin\VideoSectionAdminController;
use App\Http\Controllers\Admin\WorkProcessAdminController;
use App\Http\Controllers\Web\ContactWebController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProjectWebController;
use Illuminate\Support\Facades\Route;

// ─── Public Portfolio ──────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects/{slug}', [ProjectWebController::class, 'show'])->name('projects.show');
Route::post('/contact', [ContactWebController::class, 'store'])->name('contact.store')->middleware('throttle:5,1');

// ─── Locale Switcher ─────────────────────────────────────────────────────
Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');

// ─── Login Alias ───────────────────────────────────────────────────────────
Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');

// ─── Admin Auth ────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // ─── Protected Admin Routes ───────────────────────────────────────────
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile', [ProfileAdminController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileAdminController::class, 'update'])->name('profile.update');

        // Skills
        Route::resource('skills', SkillAdminController::class);

        // Experiences
        Route::resource('experiences', ExperienceAdminController::class);

        // Work Processes
        Route::resource('work-processes', WorkProcessAdminController::class)->parameters(['work-processes' => 'workProcess']);

        // Projects + nested images
        Route::resource('projects', ProjectAdminController::class);
        Route::delete('/projects/{project}/images/{image}', [ProjectAdminController::class, 'destroyImage'])->name('projects.images.destroy');

        // Video Showcase
        Route::get('/video-section', [VideoSectionAdminController::class, 'edit'])->name('video-section.edit');
        Route::put('/video-section', [VideoSectionAdminController::class, 'update'])->name('video-section.update');

        // Contact Messages
        Route::resource('contact-messages', ContactMessageAdminController::class)->only(['index', 'show', 'destroy']);
        Route::patch('/contact-messages/{contactMessage}/read', [ContactMessageAdminController::class, 'markRead'])->name('contact-messages.read');

        // Settings
        Route::get('/settings', [SettingAdminController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingAdminController::class, 'update'])->name('settings.update');
    });
});
