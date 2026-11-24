@extends('layouts.admin')

@section('title', 'Message from ' . $contactMessage->name)

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">← Back to Inbox</a>
        <div class="flex items-center gap-2">
            <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ urlencode($contactMessage->subject ?? 'Portfolio Inquiry') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-slate-900 dark:text-white text-xs font-bold rounded-xl transition flex items-center gap-2 shadow-lg shadow-blue-500/20">
                <i class="fa-solid fa-reply"></i> Reply via Email
            </a>
            <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" onsubmit="return confirm('Delete message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 text-slate-600 dark:text-slate-400 hover:text-red-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900">
                    <i class="fa-solid fa-trash text-sm"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white">{{ $contactMessage->subject ?? 'No Subject Provided' }}</h1>
                <div class="flex items-center gap-2 mt-1 text-xs text-slate-600 dark:text-slate-400">
                    <span>From: <strong class="text-white">{{ $contactMessage->name }}</strong></span>
                    <span>&lt;{{ $contactMessage->email }}&gt;</span>
                </div>
            </div>
            <span class="text-xs text-slate-500 font-mono">{{ $contactMessage->created_at->format('M d, Y - h:i A') }}</span>
        </div>

        <div class="text-sm text-slate-800 dark:text-slate-200 leading-relaxed whitespace-pre-line py-2">
            {{ $contactMessage->message }}
        </div>
    </div>
</div>
@endsection

