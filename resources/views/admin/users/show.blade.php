@extends('layouts.admin')

@section('title', 'Détails de l\'Utilisateur')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    {{-- Header avec actions --}}
    <div class="flex items-center justify-between bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-md">
        <div class="flex items-center gap-4">
            <a href="{{ route('users.index') }}" class="p-3 rounded-xl bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white transition-all border border-white/10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-black italic uppercase tracking-tighter text-white">
                    Fiche <span class="text-yellow-500">Utilisateur</span>
                </h1>
                <p class="text-gray-500 text-[10px] font-bold uppercase tracking-[0.2em] mt-1">
                    ID Membre : #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                </p>
            </div>
        </div>
        
        <div class="flex gap-3">
            <a href="{{ route('users.edit', $user->id) }}" class="px-6 py-3 rounded-xl bg-yellow-500 text-black font-black uppercase italic text-xs hover:bg-yellow-400 transition-all">
                Modifier le profil
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Colonne Gauche : Avatar et Identité --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="glass-card rounded-[2.5rem] p-8 border border-white/10 bg-[#0f1218]/90 backdrop-blur-xl text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-yellow-500/10 to-transparent"></div>
                
                <div class="relative">
                    <div class="w-32 h-32 mx-auto rounded-3xl bg-gradient-to-br from-yellow-500 to-yellow-700 flex items-center justify-center text-black font-black text-4xl shadow-2xl rotate-3 mb-6">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="absolute bottom-6 right-1/3 w-6 h-6 bg-green-500 border-4 border-[#0f1218] rounded-full"></div>
                </div>

                <h2 class="text-2xl font-black text-white uppercase italic tracking-tight">{{ $user->name }}</h2>
                <p class="text-yellow-500 text-[10px] font-black uppercase tracking-[0.3em] mt-2">{{ strtoupper($user->role) }}</p>
                
                <div class="mt-8 pt-8 border-t border-white/5 grid grid-cols-2 gap-4">
                    <div class="text-left">
                        <p class="text-gray-500 text-[8px] font-black uppercase tracking-widest">Nationalité</p>
                        <p class="text-white text-sm font-bold italic">{{ $user->nationality ?? 'Non définie' }}</p>
                    </div>
                    <div class="text-left">
                        <p class="text-gray-500 text-[8px] font-black uppercase tracking-widest">Inscrit le</p>
                        <p class="text-white text-sm font-bold italic">{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Colonne Droite : Infos et Statistiques --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Informations de compte --}}
            <div class="glass-card rounded-[2rem] p-8 border border-white/10 bg-[#0f1218]/90 backdrop-blur-xl shadow-2xl">
                <h3 class="text-lg font-black uppercase italic text-white mb-6 flex items-center gap-3">
                    <span class="w-1 h-5 bg-yellow-500 rounded-full"></span>
                    Informations de compte
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-gray-500 tracking-[0.2em]">Nom complet</label>
                        <p class="text-white font-bold bg-white/5 p-4 rounded-2xl border border-white/5">{{ $user->name }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-gray-500 tracking-[0.2em]">Adresse Email</label>
                        <p class="text-white font-bold bg-white/5 p-4 rounded-2xl border border-white/5">{{ $user->email }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-gray-500 tracking-[0.2em]">Adresse Physique</label>
                        <p class="text-white font-bold bg-white/5 p-4 rounded-2xl border border-white/5">{{ $user->address ?? 'Non renseignée' }}</p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-gray-500 tracking-[0.2em]">Dernière mise à jour</label>
                        <p class="text-white font-bold bg-white/5 p-4 rounded-2xl border border-white/5">{{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            {{-- Statistiques de jeu (DONNÉES DYNAMIQUES) --}}
            <div class="glass-card rounded-[2rem] p-8 border border-white/10 bg-[#0f1218]/90 backdrop-blur-xl shadow-2xl">
                <h3 class="text-lg font-black uppercase italic text-white mb-6 flex items-center gap-3">
                    <span class="w-1 h-5 bg-blue-500 rounded-full"></span>
                    Statistiques de jeu
                </h3>
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div class="p-6 rounded-2xl bg-white/5 border border-white/5">
                        <p class="text-2xl font-black text-white">{{ $quizCount }}</p>
                        <p class="text-[8px] font-black uppercase text-gray-500 tracking-widest mt-1">Quiz joués</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white/5 border border-white/5">
                        <p class="text-2xl font-black text-yellow-500">{{ $precision }}%</p>
                        <p class="text-[8px] font-black uppercase text-gray-500 tracking-widest mt-1">Précision</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-white/5 border border-white/5">
                        <p class="text-2xl font-black text-blue-500">#{{ $rank }}</p>
                        <p class="text-[8px] font-black uppercase text-gray-500 tracking-widest mt-1">Rang Global</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(15, 18, 24, 0.85);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
    }
</style>
@endsection