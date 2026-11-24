@extends('layouts.admin')

@section('title', 'Profile & Bio')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white">Edit Profile & Bio</h1>
            <p class="text-slate-400 text-sm mt-1">This information appears directly on the Hero and About sections of your public portfolio.</p>
        </div>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Full Name *</label>
                <input type="text" name="full_name" value="{{ old('full_name', $profile->full_name) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Role (e.g. Flutter Developer) -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Role Title *</label>
                <input type="text" name="role" value="{{ old('role', $profile->role) }}" required placeholder="e.g. Flutter Developer"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Tagline for Typing text -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Hero Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}" placeholder="e.g. Mobile Application Engineer"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Contact Email *</label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <!-- Location -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location', $profile->location) }}" placeholder="e.g. Cairo, Egypt"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Bio -->
        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Bio / About Description *</label>
            <textarea name="bio" rows="4" required
                      class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <!-- Social URLs -->
        <div class="pt-4 border-t border-slate-200 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">Social Media & Repository Links</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">GitHub URL</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $profile->github_url) }}"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">Twitter / X URL</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $profile->twitter_url) }}"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">WhatsApp Number / Link</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-slate-900 dark:text-white text-sm focus:border-blue-500 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- File Uploads -->
        <div class="pt-4 border-t border-slate-200 dark:border-slate-800">
            <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">Profile Avatar & CV Attachment</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Avatar -->
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">Profile Picture (Avatar)</label>
                    @if($profile->avatar)
                        <div class="flex items-center gap-3 mb-3">
                            <img src="{{ $profile->avatar_url }}" class="w-12 h-12 rounded-xl object-cover border border-slate-300 dark:border-slate-700">
                            <span class="text-xs text-slate-600 dark:text-slate-400">Current avatar</span>
                        </div>
                    @endif
                    <input type="file" name="avatar" accept="image/*"
                           class="w-full text-xs text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-semibold hover:file:bg-slate-700">
                </div>

                <!-- CV File -->
                <div>
                    <label class="block text-xs text-slate-600 dark:text-slate-400 mb-1.5">CV File (PDF / DOC)</label>
                    @if($profile->cv_file)
                        <div class="flex items-center gap-2 mb-3 text-xs text-blue-400">
                            <i class="fa-solid fa-file-pdf"></i>
                            <a href="{{ $profile->cv_url }}" target="_blank" class="underline">View current CV</a>
                        </div>
                    @endif
                    <input type="file" name="cv_file" accept=".pdf,.doc,.docx"
                           class="w-full text-xs text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-slate-800 file:text-white file:font-semibold hover:file:bg-slate-700">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-slate-900 dark:text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25">
                Save Profile Changes
            </button>
        </div>
    </form>
</div>
@endsection

