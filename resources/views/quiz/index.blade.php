@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0b0e14] text-white p-6 font-sans">
    
    <div class="max-w-7xl mx-auto mb-12">
        <div class="flex items-center gap-4 mb-2">
            <a href="{{ route('dashboard') }}" class="p-2 bg-white/5 rounded-xl border border-white/10 hover:bg-yellow-500 hover:text-black transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-4xl font-black italic uppercase tracking-tighter">Choisir une <span class="text-yellow-500">Catégorie</span></h1>
        </div>
        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest ml-14">Sélectionnez votre terrain de jeu pour accumuler des points.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($categories as $category)
        <div class="group relative bg-white/5 border border-white/10 rounded-[2.5rem] p-8 overflow-hidden transition-all hover:border-yellow-500/50 hover:bg-white/[0.07]">
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
            </div>

            <div class="relative z-10">
                <div class="flex justify-between items-start mb-6">
                    <span class="px-4 py-1 bg-yellow-500/10 border border-yellow-500/20 rounded-full text-[10px] font-black text-yellow-500 uppercase tracking-widest">
                        {{ $category->questions_count }} Questions
                    </span>
                </div>

                <h3 class="text-2xl font-black italic uppercase tracking-tighter mb-4 leading-tight">
                    {{ $category->name }}
                </h3>

                <p class="text-gray-400 text-xs font-medium mb-8 line-clamp-2">
                    Testez vos connaissances sur {{ strtolower($category->name) }} et devenez une légende de 2026.
                </p>

                <a href="{{ route('quiz.play', $category->id) }}" class="inline-flex items-center gap-3 bg-white text-black px-6 py-3 rounded-xl font-black uppercase italic text-[10px] tracking-widest hover:bg-yellow-500 transition-all group-hover:scale-105">
                    Commencer
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');
    h1, h3, a { font-family: 'Archivo', sans-serif; }
</style>
@endsection