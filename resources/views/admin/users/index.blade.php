@extends('layouts.admin')

@section('title', 'Gestion des Utilisateurs')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-md">
        <div>
            <h1 class="text-4xl font-black italic uppercase tracking-tighter flex items-center gap-3">
                <span class="w-2 h-10 bg-yellow-500 rounded-full"></span>
                Gestion <span class="text-yellow-500">Utilisateurs</span>
            </h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                {{ $users->count() }} membres enregistrés
            </p>
        </div>
        
        <a href="{{ route('users.create') }}" class="group relative flex items-center gap-3 bg-yellow-500 hover:bg-yellow-400 text-black px-8 py-4 rounded-2xl font-black uppercase italic text-sm transition-all shadow-[0_0_20px_rgba(234,179,8,0.3)] hover:scale-105 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Ajouter un membre
        </a>
    </div>

    <div class="relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-yellow-500/20 to-transparent rounded-[2rem] blur opacity-25"></div>
        
        <div class="relative glass-card rounded-[2rem] overflow-hidden border border-white/10 bg-[#0f1218]/80 backdrop-blur-xl shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 border-b border-white/10">
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Profil</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Identifiants</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Rôle & Statut</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($users as $user)
                        <tr class="hover:bg-white/[0.03] transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center text-black font-black text-lg shadow-lg rotate-3 group-hover:rotate-0 transition-transform">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-[#0f1218] rounded-full"></div>
                                    </div>
                                    <div>
                                        <p class="font-black text-sm tracking-tight text-white">{{ $user->name }}</p>
                                        <p class="text-[10px] font-bold text-gray-500 uppercase italic">{{ $user->nationality ?? 'Joueur FIFA' }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-8 py-5">
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-300 font-semibold tracking-tight">{{ $user->email }}</span>
                                    <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">Inscrit en {{ $user->created_at->format('M Y') }}</span>
                                </div>
                            </td>

                            <td class="px-8 py-5">
                                <span class="inline-flex items-center px-4 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $user->role == 'admin' ? 'border-yellow-500/50 bg-yellow-500/10 text-yellow-500' : 'border-white/10 bg-white/5 text-gray-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full mr-2 {{ $user->role == 'admin' ? 'bg-yellow-500' : 'bg-gray-500' }}"></span>
                                    {{ $user->role }}
                                </span>
                            </td>

                            <td class="px-8 py-5">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('users.show', $user->id) }}" class="p-2.5 rounded-xl bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all shadow-lg shadow-blue-500/5" title="Détails">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>

                                    <a href="{{ route('users.edit', $user->id) }}" class="p-2.5 rounded-xl bg-yellow-500/10 text-yellow-500 hover:bg-yellow-500 hover:text-black transition-all shadow-lg shadow-yellow-500/5" title="Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>

                                    @if($user->id !== Auth::id())
                                    <form action="{{ route('users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce membre ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 rounded-xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-lg shadow-red-500/5" title="Supprimer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    @else
                                    <div class="px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Vous</span>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div id="toast" class="fixed bottom-10 right-10 flex items-center gap-4 bg-yellow-500 text-black px-8 py-4 rounded-2xl font-black uppercase italic text-sm shadow-[0_20px_50px_rgba(234,179,8,0.4)] animate-slide-up z-[100]">
    <div class="w-6 h-6 rounded-full bg-black/10 flex items-center justify-center">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
    </div>
    {{ session('success') }}
</div>

<script>
    setTimeout(() => {
        const toast = document.getElementById('toast');
        if(toast) toast.style.display = 'none';
    }, 4000);
</script>
@endif

<style>
    @keyframes slide-up {
        from { transform: translateY(100px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .animate-slide-up {
        animation: slide-up 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
    }
</style>
@endsection