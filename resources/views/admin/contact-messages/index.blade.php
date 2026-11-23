@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Contact Messages Inbox</h1>
            <p class="text-slate-400 text-sm mt-1">Messages sent through your public portfolio contact form or Flutter app API.</p>
        </div>
    </div>

    <div class="bg-slate-950 border border-slate-800 rounded-2xl overflow-hidden">
        @if($messages->isEmpty())
            <div class="text-center py-16 text-slate-500">
                <i class="fa-regular fa-envelope-open text-4xl mb-3 block"></i>
                <p class="text-base font-semibold text-slate-400">Inbox is empty</p>
                <p class="text-xs text-slate-500 mt-1">New submissions will show up here.</p>
            </div>
        @else
            <div class="divide-y divide-slate-800">
                @foreach($messages as $msg)
                    <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition hover:bg-slate-900/50 {{ $msg->isRead() ? '' : 'bg-slate-900/30' }}">
                        <div class="flex items-start sm:items-center gap-3.5 min-w-0">
                            <span class="w-2.5 h-2.5 rounded-full mt-1.5 sm:mt-0 flex-shrink-0 {{ $msg->isRead() ? 'bg-slate-700' : 'bg-amber-400 ring-4 ring-amber-400/20' }}"></span>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-sm text-white truncate">{{ $msg->name }}</span>
                                    <span class="text-xs text-slate-500 font-normal">({{ $msg->email }})</span>
                                </div>
                                <p class="text-xs font-semibold text-slate-300 mt-0.5 truncate">{{ $msg->subject ?? 'No Subject' }}</p>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-1">{{ $msg->message }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 self-end sm:self-center flex-shrink-0">
                            <span class="text-xs text-slate-500 font-mono">{{ $msg->created_at->diffForHumans() }}</span>
                            <a href="{{ route('admin.contact-messages.show', $msg) }}" class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 text-xs font-semibold text-white rounded-lg transition">
                                View
                            </a>
                            <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-500 hover:text-red-400 rounded-lg">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-4 border-t border-slate-800">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

