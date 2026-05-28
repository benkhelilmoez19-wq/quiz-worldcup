@extends('layouts.app')

@section('title', 'Classement Mondial')

@section('content')
<div class="min-h-screen text-white">
    <div class="max-w-5xl mx-auto space-y-10">
        
        <!-- HEADER CLASSEMENT -->
        <div class="text-center space-y-4">
            <h1 class="text-6xl font-black italic uppercase tracking-tighter font-archivo">
                LEADER<span class="text-yellow-500">BOARD</span>
            </h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-[0.4em]">Le Panthéon des Joueurs Élite - FIFA 2026</p>
        </div>

        <!-- TABLEAU DE CLASSEMENT -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden backdrop-blur-md">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/10 bg-white/5">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Rang</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Joueur</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400">Matchs</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Score Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 font-archivo">
                    @forelse($users as $index => $user)
                        <tr class="group hover:bg-white/5 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    @if($index == 0)
                                        <span class="w-8 h-8 rounded-lg bg-yellow-500 flex items-center justify-center text-black font-black italic text-sm shadow-[0_0_20px_rgba(234,179,8,0.4)]">1</span>
                                    @elseif($index == 1)
                                        <span class="w-8 h-8 rounded-lg bg-gray-300 flex items-center justify-center text-black font-black italic text-sm">2</span>
                                    @elseif($index == 2)
                                        <span class="w-8 h-8 rounded-lg bg-orange-600 flex items-center justify-center text-white font-black italic text-sm">3</span>
                                    @else
                                        <span class="text-gray-500 font-bold ml-3 text-sm">#{{ $index + 1 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-yellow-500 to-yellow-200 p-[2px]">
                                        <div class="w-full h-full rounded-full bg-[#080a0f] flex items-center justify-center">
                                            <span class="text-xs font-black uppercase">{{ substr($user->name, 0, 2) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black uppercase italic {{ Auth::id() == $user->id ? 'text-yellow-500' : 'text-white' }}">
                                            {{ $user->name }}
                                            @if(Auth::id() == $user->id)
                                                <span class="ml-2 text-[8px] bg-yellow-500/10 text-yellow-500 px-2 py-0.5 rounded border border-yellow-500/20 italic">VOUS</span>
                                            @endif
                                        </p>
                                        <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest">Niveau {{ floor($user->results_sum_score / 100) + 1 }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-xs font-bold text-gray-400">{{ $user->results_count }} Matchs</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <span class="text-xl font-black italic text-white tracking-tighter">{{ number_format($user->results_sum_score ?? 0) }} <span class="text-[10px] text-yellow-500 not-italic ml-1">PTS</span></span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center text-gray-600 uppercase font-black italic text-xs tracking-widest">
                                Aucun joueur n'est encore entré dans l'arène...
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ACTIONS -->
        <div class="flex justify-center mt-10">
            <a href="{{ route('dashboard') }}" class="bg-white/5 border border-white/10 hover:bg-white/10 text-white px-10 py-4 rounded-2xl font-black uppercase italic text-xs transition-all tracking-widest">
                Retour au Centre d'Entraînement
            </a>
        </div>
    </div>
</div>
@endsection