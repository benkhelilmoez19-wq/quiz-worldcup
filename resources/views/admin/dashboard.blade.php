@extends('layouts.admin')

@section('title', 'Tableau de Bord Arena')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-5xl font-black italic uppercase tracking-tighter">
                ARENA <span class="text-yellow-500">DASHBOARD</span>
            </h1>
            <p class="text-gray-500 text-sm font-bold uppercase tracking-[0.2em] mt-2">
                Bienvenue, Capitaine <span class="text-white">{{ Auth::user()->name }}</span>
            </p>
        </div>
        <div class="flex items-center gap-3 bg-white/5 p-2 rounded-2xl border border-white/10">
            <div class="px-4 py-2 bg-yellow-500 rounded-xl text-black font-black text-xs uppercase tracking-widest">
                Session Active
            </div>
            <span class="text-xs font-mono text-gray-400 px-2">ID: #{{ Auth::id() }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass-card p-8 rounded-3xl relative overflow-hidden group hover:border-yellow-500/50 transition-all">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-yellow-500/10 rounded-full blur-2xl group-hover:bg-yellow-500/20"></div>
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Inscrits</p>
            <h3 class="text-4xl font-black text-white italic">01</h3> 
            <p class="text-[9px] text-green-500 font-bold mt-2 uppercase tracking-tighter">● Système Opérationnel</p>
        </div>

        <div class="glass-card p-8 rounded-3xl group hover:border-yellow-500/50 transition-all">
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Quiz Créés</p>
            <h3 class="text-4xl font-black text-yellow-500 italic">00</h3>
            <p class="text-[9px] text-gray-600 font-bold mt-2 uppercase tracking-tighter italic underline decoration-yellow-500/30">Gérer les catégories</p>
        </div>

        <div class="glass-card p-8 rounded-3xl bg-gradient-to-br from-yellow-500/5 to-transparent border-l-4 border-l-yellow-500">
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Accès Niveau</p>
            <h3 class="text-4xl font-black text-white italic uppercase">{{ Auth::user()->role }}</h3>
            <p class="text-[9px] text-yellow-600 font-bold mt-2 uppercase tracking-tighter italic">Privilèges Illimités</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 glass-card rounded-3xl p-8">
            <div class="flex items-center justify-between mb-8">
                <h4 class="text-xl font-black italic uppercase tracking-tighter">Stades <span class="text-yellow-500">Configurés</span></h4>
                <a href="{{ route('quiz.index') }}" class="text-[10px] font-bold text-yellow-500 border-b border-yellow-500/30 pb-1 hover:text-white transition-colors uppercase tracking-widest">Voir tout</a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @php
                    $stades = ['azteca', 'metlife', 'sofi', 'marcedec', 'host'];
                @endphp
                @foreach($stades as $stade)
                <div class="relative group rounded-2xl overflow-hidden aspect-video border border-white/10 hover:border-yellow-500/50 transition-all">
                    <img src="{{ asset('images/'.$stade.'.jpg') }}" alt="{{ $stade }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 scale-110 group-hover:scale-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-3">
                        <span class="text-[10px] font-black uppercase italic tracking-wider text-yellow-500">{{ $stade }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="glass-card rounded-3xl p-8 bg-[#0d1017]">
            <h4 class="text-xl font-black italic uppercase tracking-tighter mb-6">Actions <span class="text-yellow-500">Admin</span></h4>
            <div class="space-y-4">
                <button class="w-full py-4 rounded-2xl bg-white/5 border border-white/10 text-left px-6 hover:bg-yellow-500 hover:text-black transition-all group">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest group-hover:text-black/60">Ajouter</p>
                    <span class="text-sm font-black uppercase italic">Nouveau Quiz</span>
                </button>
                <button class="w-full py-4 rounded-2xl bg-white/5 border border-white/10 text-left px-6 hover:bg-white hover:text-black transition-all group">
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest group-hover:text-black/60">Exporter</p>
                    <span class="text-sm font-black uppercase italic">Résultats SQL</span>
                </button>
                <div class="p-6 rounded-2xl border border-dashed border-white/10 text-center mt-6">
                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest leading-relaxed">
                        Interface optimisée pour <br> <span class="text-yellow-500">FIFA WORLD CUP 2026</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection