@extends('layouts.admin')

@section('title', 'Gestion des Catégories')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-md">
        <div>
            <h1 class="text-4xl font-black italic uppercase tracking-tighter flex items-center gap-3 text-white">
                <span class="w-2 h-10 bg-blue-500 rounded-full"></span>
                Catégories <span class="text-blue-500">Quiz</span>
            </h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Structure des thématiques FIFA 2026
            </p>
        </div>
        
        <button onclick="document.getElementById('add-category-form').classList.toggle('hidden')" class="group relative flex items-center gap-3 bg-blue-500 hover:bg-blue-400 text-white px-8 py-4 rounded-2xl font-black uppercase italic text-sm transition-all shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:scale-105 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Nouvelle Catégorie
        </button>
    </div>

    <div id="add-category-form" class="hidden animate-slide-up">
        <div class="glass-card rounded-[2rem] p-8 border border-white/10 bg-white/5 backdrop-blur-xl shadow-2xl">
            <form action="{{ route('categories.store') }}" method="POST" class="flex flex-col md:flex-row gap-6 items-end">
                @csrf
                <div class="flex-1 space-y-2">
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Nom de la catégorie</label>
                    <input type="text" name="name" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-blue-500 transition-all" placeholder="Ex: Histoire de la Coupe du Monde">
                </div>
                <button type="submit" class="bg-white text-black px-8 py-4 rounded-2xl font-black uppercase italic text-sm hover:bg-gray-200 transition-all">
                    Enregistrer
                </button>
            </form>
        </div>
    </div>

    <div class="relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-blue-500/20 to-transparent rounded-[2rem] blur opacity-25"></div>
        
        <div class="relative glass-card rounded-[2rem] overflow-hidden border border-white/10 bg-[#0f1218]/80 backdrop-blur-xl shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 border-b border-white/10">
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">ID</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Nom de la catégorie</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em]">Nombre de Questions</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-gray-400 tracking-[0.2em] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($categories as $category)
                        <tr class="hover:bg-white/[0.03] transition-all group">
                            <td class="px-8 py-5">
                                <span class="text-gray-500 font-mono text-xs">#{{ $category->id }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <p class="font-black text-sm tracking-tight text-white uppercase italic">{{ $category->name }}</p>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2">
                                    <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-500 text-[10px] font-black border border-blue-500/20">
                                        {{ $category->questions_count ?? 0 }} questions
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex justify-end items-center gap-2">
                                    <form action="{{ route('categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie et toutes ses questions ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 rounded-xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-lg shadow-red-500/5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-gray-500 font-bold uppercase text-xs tracking-widest">
                                Aucune catégorie trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
    }
    @keyframes slide-up {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .animate-slide-up {
        animation: slide-up 0.4s ease-out forwards;
    }
</style>
@endsection