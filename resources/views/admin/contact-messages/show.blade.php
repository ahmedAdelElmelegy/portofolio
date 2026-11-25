@extends('layouts.admin')

@section('title', __('Message from') . ' ' . $contactMessage->name)

@section('content')
<div class="w-full space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white inline-flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left rtl:rotate-180 text-xs"></i>
            <span>{{ __('Back to Inbox') }}</span>
        </a>
        <div class="flex items-center gap-2">
            <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ urlencode($contactMessage->subject ?? 'Portfolio Inquiry') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-xl transition flex items-center gap-2 shadow-lg shadow-blue-500/20">
                <i class="fa-solid fa-reply"></i> {{ __('Reply via Email') }}
            </a>
            <form id="delete-msg-{{ $contactMessage->id }}" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" @click="$dispatch('confirm-action', { formId: 'delete-msg-{{ $contactMessage->id }}', title: @js(__('Delete Message?')), message: @js(__('Are you sure you want to delete this message?')) })" title="{{ __('Delete') }}" class="p-2 text-slate-600 dark:text-slate-400 hover:text-red-400 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-900">
                    <i class="fa-solid fa-trash text-sm"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-6 md:p-8 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
            <div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white">{{ $contactMessage->subject ?? __('No Subject Provided') }}</h1>
                <div class="flex items-center gap-2 mt-1 text-xs text-slate-600 dark:text-slate-400">
                    <span>{{ __('From:') }} <strong class="text-slate-900 dark:text-white">{{ $contactMessage->name }}</strong></span>
                    <span dir="ltr">&lt;{{ $contactMessage->email }}&gt;</span>
                </div>
            </div>
            <span class="text-xs text-slate-500 font-mono" dir="ltr">{{ $contactMessage->created_at->format('M d, Y - h:i A') }}</span>
        </div>

        <div class="text-sm text-slate-800 dark:text-slate-200 leading-relaxed whitespace-pre-line py-2">
            {{ $contactMessage->message }}
        </div>
    </div>
</div>
@endsection
