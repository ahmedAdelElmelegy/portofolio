@extends('layouts.admin')

@section('title', __('Profile & Bio'))

@section('content')
<div class="w-full space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('Profile Info') }}</h1>
            <p class="text-slate-400 text-sm mt-1">{{ __('This information appears directly on the Hero and About sections of your public portfolio in both English and Arabic.') }}</p>
        </div>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name (EN & AR) -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Full Name (English) *') }}</label>
                <input type="text" name="full_name" value="{{ old('full_name', $profile->getRawOriginal('full_name')) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">الاسم بالكامل (عربي)</label>
                <input type="text" name="full_name_ar" dir="rtl" value="{{ old('full_name_ar', $profile->full_name_ar) }}" placeholder="مثال: أحمد عادل"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Role (EN & AR) -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Role Title (English) *') }}</label>
                <input type="text" name="role" value="{{ old('role', $profile->getRawOriginal('role')) }}" required placeholder="e.g. Flutter Developer"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">المسمى الوظيفي (عربي)</label>
                <input type="text" name="role_ar" dir="rtl" value="{{ old('role_ar', $profile->role_ar) }}" placeholder="مثال: مطور تطبيقات فلاتر"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Tagline (EN & AR) -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Hero Tagline (English)') }}</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->getRawOriginal('tagline')) }}" placeholder="e.g. Mobile Application Engineer"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">الوصف السريع للـ Hero (عربي)</label>
                <input type="text" name="tagline_ar" dir="rtl" value="{{ old('tagline_ar', $profile->tagline_ar) }}" placeholder="مثال: مهندس تطبيقات الموبايل"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Email & Phone -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Contact Email *') }}</label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}" required dir="ltr"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Phone') }}</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" dir="ltr"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Location (EN & AR) -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Location (English)') }}</label>
                <input type="text" name="location" value="{{ old('location', $profile->getRawOriginal('location')) }}" placeholder="e.g. Cairo, Egypt"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">الموقع (عربي)</label>
                <input type="text" name="location_ar" dir="rtl" value="{{ old('location_ar', $profile->location_ar) }}" placeholder="مثال: شبين الكوم، المنوفية، مصر"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Bio (EN & AR) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">{{ __('Bio / About Description (English) *') }}</label>
                <textarea name="bio" rows="5" required
                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('bio', $profile->getRawOriginal('bio')) }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">النبذة والتعريف الشخصي (عربي)</label>
                <textarea name="bio_ar" dir="rtl" rows="5" placeholder="اكتب نبذتك المهنية بالعربية..."
                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('bio_ar', $profile->bio_ar) }}</textarea>
            </div>
        </div>

        <!-- Social URLs -->
        <div class="pt-4 border-t border-slate-200 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">{{ __('Social Media & Repository Links') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">{{ __('GitHub URL') }}</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $profile->github_url) }}" dir="ltr"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">{{ __('LinkedIn URL') }}</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}" dir="ltr"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">{{ __('Twitter / X URL') }}</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $profile->twitter_url) }}" dir="ltr"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">{{ __('WhatsApp Number / Link') }}</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}" dir="ltr"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- File Uploads -->
        <div class="pt-4 border-t border-slate-200 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">{{ __('Profile Avatar & CV Attachment') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Avatar -->
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">{{ __('Profile Picture (Avatar)') }}</label>
                    @if($profile->avatar)
                        <div class="flex items-center gap-3 mb-3">
                            <img src="{{ $profile->avatar_url }}" class="w-12 h-12 rounded-xl object-cover border border-slate-300 dark:border-slate-700">
                            <span class="text-xs text-slate-600 dark:text-slate-400">{{ __('Current avatar') }}</span>
                        </div>
                    @endif
                    <input type="file" name="avatar" accept="image/*"
                           class="w-full text-xs text-slate-600 dark:text-slate-400 file:me-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-semibold hover:file:bg-slate-700">
                </div>

                <!-- CV File -->
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">{{ __('CV File (PDF / DOC)') }}</label>
                    @if($profile->cv_file)
                        <div class="flex items-center gap-2 mb-3 text-xs text-blue-400">
                            <i class="fa-solid fa-file-pdf"></i>
                            <a href="{{ $profile->cv_url }}" target="_blank" class="underline">{{ __('View current CV') }}</a>
                        </div>
                    @endif
                    <input type="file" name="cv_file" accept=".pdf,.doc,.docx"
                           class="w-full text-xs text-slate-600 dark:text-slate-400 file:me-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-semibold hover:file:bg-slate-700">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                {{ __('Save Profile Changes') }}
            </button>
        </div>
    </form>
</div>
@endsection
