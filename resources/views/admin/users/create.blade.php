@extends('layouts.admin')

@section('title', 'Ajouter un Utilisateur')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center justify-between bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-md">
        <div>
            <h1 class="text-3xl font-black italic uppercase tracking-tighter text-white">
                Nouveau <span class="text-yellow-500">Membre</span>
            </h1>
            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-[0.2em] mt-1">Enregistrement d'un nouvel utilisateur FIFA</p>
        </div>
        <a href="{{ route('users.index') }}" class="p-3 rounded-xl bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white transition-all border border-white/10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
    </div>

    <div class="relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-yellow-500/20 to-transparent rounded-[2rem] blur opacity-25"></div>
        
        <div class="relative glass-card rounded-[2rem] p-8 border border-white/10 bg-[#0f1218]/90 backdrop-blur-xl shadow-2xl">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Nom Complet</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 transition-all"
                            placeholder="Ex: Moez Ben Khelil">
                        @error('name') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Adresse Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 transition-all"
                            placeholder="nom@exemple.com">
                        @error('email') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Nationalité</label>
                        <input type="text" name="nationality" value="{{ old('nationality') }}"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 transition-all"
                            placeholder="Ex: Tunisia">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Rôle Système</label>
                        <select name="role" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-yellow-500/50 appearance-none cursor-pointer">
                            <option value="player" class="bg-[#0f1218]">Joueur (Player)</option>
                            <option value="admin" class="bg-[#0f1218]">Administrateur</option>
                        </select>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Mot de passe</label>
                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 transition-all"
                                placeholder="••••••••">
                            <svg class="w-5 h-5 text-gray-500 absolute right-5 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        @error('password') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4 pt-6">
                    <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-400 text-black font-black uppercase italic py-4 rounded-2xl transition-all shadow-[0_10px_30px_rgba(234,179,8,0.2)] active:scale-95">
                        Confirmer l'inscription
                    </button>
                    <a href="{{ route('users.index') }}" class="flex-1 bg-white/5 hover:bg-white/10 text-white font-black uppercase italic py-4 rounded-2xl transition-all border border-white/10 text-center">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(15, 18, 24, 0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23eab308'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1.25rem center;
        background-size: 1rem;
    }
</style>
@endsection