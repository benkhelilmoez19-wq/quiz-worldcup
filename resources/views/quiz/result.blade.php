@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0b0e14] text-white p-6 font-sans flex items-center justify-center">
    <div class="max-w-2xl w-full text-center">
        
        <div class="mb-6">
            <span class="px-4 py-1 bg-yellow-500 text-black text-[10px] font-black uppercase tracking-[0.3em] rounded-full">
                Match Terminé
            </span>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-[3rem] p-12 backdrop-blur-md relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-yellow-500/10 blur-[80px] rounded-full"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-green-500/10 blur-[80px] rounded-full"></div>

            <h1 class="text-4xl font-black italic uppercase tracking-tighter mb-2">Votre Score</h1>
            
            <div class="flex flex-col items-center justify-center my-8">
                <div class="relative">
                    <svg class="w-48 h-48 transform -rotate-90">
                        <circle cx="96" cy="96" r="88" stroke="currentColor" stroke-width="12" fill="transparent" class="text-white/5" />
                        <circle cx="96" cy="96" r="88" stroke="currentColor" stroke-width="12" fill="transparent" 
                            stroke-dasharray="{{ (2 * 3.14 * 88) }}" 
                            stroke-dashoffset="{{ (2 * 3.14 * 88) * (1 - ($score / ($total > 0 ? $total : 1))) }}" 
                            class="text-yellow-500 transition-all duration-1000 ease-out" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-6xl font-black italic tracking-tighter">{{ $score }}</span>
                        <span class="text-gray-500 font-bold uppercase text-xs">sur {{ $total }}</span>
                    </div>
                </div>
            </div>

            <div class="mb-10">
                @php
                    $percentage = ($total > 0) ? ($score / $total) * 100 : 0;
                @endphp

                @if($percentage >= 80)
                    <h3 class="text-2xl font-black text-green-500 italic uppercase">Légendaire !</h3>
                    <p class="text-gray-400 mt-2">Vous connaissez le football sur le bout des doigts.</p>
                @elseif($percentage >= 50)
                    <h3 class="text-2xl font-black text-yellow-500 italic uppercase">Bon Match !</h3>
                    <p class="text-gray-400 mt-2">Une performance solide, continuez comme ça.</p>
                @else
                    <h3 class="text-2xl font-black text-red-500 italic uppercase">Contre-Performance</h3>
                    <p class="text-gray-400 mt-2">Entraînez-vous encore pour atteindre le sommet.</p>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('quiz.show', $category_id ?? 1) }}" 
                   class="px-8 py-4 bg-yellow-500 text-black rounded-xl font-black uppercase italic text-sm hover:scale-105 transition-all shadow-lg shadow-yellow-500/20">
                    Rejouer le Quiz
                </a>
                <a href="{{ route('quiz.index') }}" 
                   class="px-8 py-4 bg-white/5 border border-white/10 text-white rounded-xl font-black uppercase italic text-sm hover:bg-white/10 transition-all">
                    Changer de Défi
                </a>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-white text-xs font-black uppercase tracking-widest transition-colors">
                ← Retour au menu principal
            </a>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');
    h1, h3, span, p, a { font-family: 'Archivo', sans-serif; }
    
    /* Animation fluide du cercle au chargement */
    circle {
        transition: stroke-dashoffset 1.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection