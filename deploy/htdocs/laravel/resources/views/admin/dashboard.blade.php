@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
<div class="space-y-8">
    <!-- Header banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-white">Welcome back, {{ Auth::user()->name }} 👋</h1>
            <p class="text-slate-400 text-sm mt-1">Here is the current overview of your portfolio content and incoming messages.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.projects.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg shadow-blue-500/25 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Add Project</span>
            </a>
            <a href="{{ route('admin.skills.create') }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-sm rounded-xl transition border border-slate-700 flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Add Skill</span>
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Projects -->
        <div class="p-6 bg-slate-950 border border-slate-800/80 rounded-2xl relative overflow-hidden group hover:border-blue-500/50 transition">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Projects</span>
                    <p class="text-3xl font-extrabold text-white mt-1.5">{{ $stats['projects'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-800/60 flex items-center justify-between text-xs">
                <a href="{{ route('admin.projects.index') }}" class="text-blue-400 hover:underline font-semibold">Manage projects →</a>
            </div>
        </div>

        <!-- Skills -->
        <div class="p-6 bg-slate-950 border border-slate-800/80 rounded-2xl relative overflow-hidden group hover:border-amber-500/50 transition">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Technical Skills</span>
                    <p class="text-3xl font-extrabold text-white mt-1.5">{{ $stats['skills'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-bolt"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-800/60 flex items-center justify-between text-xs">
                <a href="{{ route('admin.skills.index') }}" class="text-amber-400 hover:underline font-semibold">Manage skills →</a>
            </div>
        </div>

        <!-- Total Messages -->
        <div class="p-6 bg-slate-950 border border-slate-800/80 rounded-2xl relative overflow-hidden group hover:border-emerald-500/50 transition">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Contact Messages</span>
                    <p class="text-3xl font-extrabold text-white mt-1.5">{{ $stats['messages'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-800/60 flex items-center justify-between text-xs">
                <a href="{{ route('admin.contact-messages.index') }}" class="text-emerald-400 hover:underline font-semibold">View all messages →</a>
            </div>
        </div>

        <!-- Unread Messages -->
        <div class="p-6 bg-slate-950 border border-slate-800/80 rounded-2xl relative overflow-hidden group hover:border-rose-500/50 transition">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Unread Messages</span>
                    <p class="text-3xl font-extrabold text-white mt-1.5">{{ $stats['unread_messages'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 text-rose-400 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-bell"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-800/60 flex items-center justify-between text-xs">
                <span class="text-slate-400">Requires attention</span>
            </div>
        </div>
    </div>

    <!-- Recent Messages Table & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Messages list -->
        <div class="lg:col-span-2 bg-slate-950 border border-slate-800/80 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-inbox text-blue-400"></i>
                    <span>Recent Contact Messages</span>
                </h2>
                <a href="{{ route('admin.contact-messages.index') }}" class="text-xs text-blue-400 hover:underline font-semibold">See all</a>
            </div>

            @if($recentMessages->isEmpty())
                <div class="text-center py-12 text-slate-500">
                    <i class="fa-regular fa-envelope-open text-3xl mb-2 block"></i>
                    <p class="text-sm">No messages received yet.</p>
                </div>
            @else
                <div class="divide-y divide-slate-800/80">
                    @foreach($recentMessages as $msg)
                        <div class="py-3.5 flex items-center justify-between gap-4">
                            <div class="min-w-0 flex items-center gap-3">
                                <div class="w-2.5 h-2.5 rounded-full {{ $msg->isRead() ? 'bg-slate-700' : 'bg-amber-400 ring-4 ring-amber-400/20' }}"></div>
                                <div class="truncate">
                                    <p class="text-sm font-semibold text-white truncate">{{ $msg->name }}</p>
                                    <p class="text-xs text-slate-400 truncate">{{ $msg->subject ?? 'No subject' }} — {{ Str::limit($msg->message, 50) }}</p>
                                </div>
                            </div>
                            <div class="text-right flex items-center gap-3">
                                <span class="text-xs text-slate-500 whitespace-nowrap">{{ $msg->created_at->diffForHumans() }}</span>
                                <a href="{{ route('admin.contact-messages.show', $msg) }}" class="p-1.5 text-slate-400 hover:text-white rounded-lg hover:bg-slate-900">
                                    <i class="fa-solid fa-chevron-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Quick Links / Modules -->
        <div class="bg-slate-950 border border-slate-800/80 rounded-2xl p-6 space-y-4">
            <h2 class="text-lg font-bold text-white">Quick Shortcuts</h2>
            
            <a href="{{ route('admin.profile.edit') }}" class="p-3.5 rounded-xl bg-slate-900 hover:bg-slate-850 border border-slate-800 flex items-center justify-between group transition">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Profile & Bio</p>
                        <p class="text-xs text-slate-400">Update photo, CV & socials</p>
                    </div>
                </div>
                <i class="fa-solid fa-arrow-right text-xs text-slate-500 group-hover:text-blue-400 transition"></i>
            </a>

            <a href="{{ route('admin.work-processes.index') }}" class="p-3.5 rounded-xl bg-slate-900 hover:bg-slate-850 border border-slate-800 flex items-center justify-between group transition">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Work Process (6 Steps)</p>
                        <p class="text-xs text-slate-400">Manage methodology cards</p>
                    </div>
                </div>
                <i class="fa-solid fa-arrow-right text-xs text-slate-500 group-hover:text-purple-400 transition"></i>
            </a>

            <a href="{{ route('admin.settings.edit') }}" class="p-3.5 rounded-xl bg-slate-900 hover:bg-slate-850 border border-slate-800 flex items-center justify-between group transition">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">Site Settings</p>
                        <p class="text-xs text-slate-400">SEO tags and colors</p>
                    </div>
                </div>
                <i class="fa-solid fa-arrow-right text-xs text-slate-500 group-hover:text-emerald-400 transition"></i>
            </a>
        </div>
    </div>
</div>
@endsection

