@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
<div class="min-h-screen text-white">
    
    <div class="max-w-7xl mx-auto space-y-8">
        
        <!-- HEADER : PROFIL JOUEUR -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 flex flex-col md:flex-row justify-between items-center backdrop-blur-md">
            <div class="flex items-center gap-6">
                @php 
                    $totalScore = Auth::user()->results->sum('score');
                    $level = floor($totalScore / 100) + 1;
                @endphp
                
                <div class="w-16 h-16 bg-yellow-500 rounded-2xl flex items-center justify-center text-black font-black text-2xl shadow-[0_0_30px_rgba(234,179,8,0.3)]">
                    LV{{ $level }}
                </div>
                <div>
                    <h2 class="text-4xl font-black italic uppercase tracking-tighter">Salut, <span class="text-yellow-500">{{ Auth::user()->name }}</span></h2>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Prêt pour l'arène mondiale ?</p>
                </div>
            </div>
            
            <div class="flex gap-12 mt-6 md:mt-0 text-center">
                <div>
                    <p class="text-3xl font-black italic">{{ $totalScore }}</p>
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-[0.2em]">Points Totaux</p>
                </div>
                <div>
                    <p class="text-3xl font-black italic">{{ Auth::user()->results->count() }}</p>
                    <p class="text-[9px] font-black text-gray-500 uppercase tracking-[0.2em]">Matchs Joués</p>
                </div>
            </div>
        </div>

        <!-- GRILLE PRINCIPALE -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- BANNIÈRE ACTION PRINCIPALE -->
            <div class="lg:col-span-3 relative group overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-[#1a1c2e] to-[#0f1218] border border-white/10 p-10">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <h3 class="text-8xl font-black italic">2026</h3>
                </div>
                <div class="relative z-10">
                    <p class="text-yellow-500 text-xs font-black uppercase tracking-[0.3em] mb-2">Saison 1 : Qualifications</p>
                    <h3 class="text-5xl font-black italic uppercase tracking-tighter leading-none mb-8">Testez vos<br>Connaissances</h3>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('quiz.playAll') }}" class="inline-flex items-center gap-3 bg-yellow-500 hover:bg-yellow-400 text-black px-10 py-5 rounded-2xl font-black uppercase italic text-sm transition-all shadow-[0_15px_40px_rgba(234,179,8,0.3)] hover:scale-105 active:scale-95">
                            Jouer toutes les questions
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </a>

                        <a href="{{ route('quiz.categories') }}" class="inline-flex items-center gap-3 bg-white/5 hover:bg-white/10 text-white px-8 py-5 rounded-2xl font-black uppercase italic text-sm transition-all border border-white/10">
                            Par Catégorie
                        </a>
                    </div>
                </div>
            </div>

            <!-- ACTIVITÉ RÉCENTE -->
            <div class="lg:col-span-2 rounded-[2.5rem] bg-white/5 border border-white/10 p-8 backdrop-blur-sm">
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-1.5 h-6 bg-yellow-500 rounded-full"></span>
                    <h4 class="text-xl font-black italic uppercase tracking-tighter">Activité Récente</h4>
                </div>
                
                @php 
                    $recentResults = Auth::user()->results()->with('category')->latest()->take(4)->get(); 
                @endphp

                @if($recentResults->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentResults as $res)
                        <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/5 hover:border-white/10 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-black uppercase italic tracking-tight">{{ $res->category->name ?? 'Défi Mondial' }}</p>
                                    <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">{{ $res->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black text-yellow-500 tracking-tighter">+{{ $res->score }} PTS</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-10 text-gray-600">
                        <p class="text-xs font-bold uppercase italic tracking-widest">Aucune partie jouée pour le moment.</p>
                    </div>
                @endif
            </div>

            <!-- STATUS & CITATION -->
            <div class="rounded-[2.5rem] bg-[#0f1218] border border-white/10 p-8 flex flex-col justify-between">
                <div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-6">État des Systèmes</h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/5">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-[10px] font-bold uppercase text-gray-300">Serveur Global : Stable</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 p-6 bg-yellow-500/5 border border-yellow-500/20 rounded-2xl">
                    <p class="text-yellow-500 text-[10px] font-black italic text-center uppercase tracking-widest leading-loose">
                        "Le trophée ne s'attend pas,<br>il se gagne."
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .min-h-screen {
        font-family: 'Archivo', sans-serif;
    }
</style>
@endsection