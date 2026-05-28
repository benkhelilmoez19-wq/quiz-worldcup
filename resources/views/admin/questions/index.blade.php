@extends('layouts.admin')

@section('title', 'Banque de Questions')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-md">
        <div>
            <h1 class="text-4xl font-black italic uppercase tracking-tighter flex items-center gap-3 text-white">
                <span class="w-2 h-10 bg-purple-500 rounded-full"></span>
                Banque de <span class="text-purple-500">Questions</span>
            </h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Configurez les défis du Quiz FIFA 2026
            </p>
        </div>
        
        <button onclick="toggleModal('add-question-modal')" class="group relative flex items-center gap-3 bg-purple-600 hover:bg-purple-500 text-white px-8 py-4 rounded-2xl font-black uppercase italic text-sm transition-all shadow-[0_0_20px_rgba(168,85,247,0.3)] hover:scale-105 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Ajouter une Question
        </button>
    </div>

    <div id="add-question-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="glass-card rounded-[2.5rem] p-8 border border-white/10 bg-[#0f1218] w-full max-w-4xl max-h-[90vh] overflow-y-auto animate-slide-up">
            <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Catégorie</label>
                            <select name="category_id" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-purple-500 appearance-none cursor-pointer">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" class="bg-[#0f1218]">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-purple-400 tracking-widest ml-1">Illustration</label>
                            <div class="relative group">
                                <input type="file" name="image" onchange="previewImage(event, 'preview-add')" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                <div class="w-full h-32 border-2 border-dashed border-white/10 rounded-2xl flex items-center justify-center overflow-hidden">
                                    <img id="preview-add" class="hidden w-full h-full object-cover">
                                    <div id="placeholder-add" class="text-center">
                                        <svg class="w-8 h-8 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-[8px] text-gray-500 font-bold uppercase mt-2 block">Cliquer pour uploader</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Énoncé de la question</label>
                        <textarea name="question_text" required rows="5" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-purple-500 resize-none" placeholder="Tapez votre question ici..."></textarea>
                    </div>

                    @for($i = 0; $i < 4; $i++)
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1 flex justify-between">
                            Réponse {{ $i + 1 }}
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="correct_answer" value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }} class="hidden peer">
                                <div class="w-3 h-3 rounded-full border border-white/20 peer-checked:bg-purple-500 peer-checked:border-transparent transition-all"></div>
                                <span class="text-[8px] text-gray-500 peer-checked:text-purple-400 font-black uppercase">Correcte</span>
                            </label>
                        </label>
                        <input type="text" name="answers[]" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm focus:outline-none focus:border-purple-500" placeholder="Option {{ $i + 1 }}">
                    </div>
                    @endfor
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-500 text-white font-black uppercase italic py-4 rounded-2xl transition-all shadow-lg">Enregistrer</button>
                    <button type="button" onclick="toggleModal('add-question-modal')" class="px-8 py-4 rounded-2xl bg-white/5 text-gray-400 font-black uppercase italic text-xs border border-white/10">Fermer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($questions as $question)
        <div class="glass-card rounded-[2rem] p-6 border border-white/10 bg-white/5 hover:bg-white/[0.07] transition-all group relative">
            <div class="flex flex-col md:flex-row gap-6 items-start">
                @if($question->image_path)
                <div class="w-full md:w-48 h-32 rounded-2xl overflow-hidden border border-white/10 flex-shrink-0 shadow-2xl relative">
                    <img src="{{ asset('storage/' . $question->image_path) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                @else
                <div class="w-full md:w-48 h-32 rounded-2xl bg-white/5 border border-dashed border-white/10 flex items-center justify-center text-gray-700">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                @endif

                <div class="flex-1 space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-lg bg-purple-500/10 text-purple-500 text-[9px] font-black uppercase tracking-tighter border border-purple-500/20">
                            {{ $question->category->name }}
                        </span>
                        <span class="text-gray-600 text-[10px] font-bold italic tracking-widest">#{{ str_pad($question->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    
                    <h3 class="text-white font-bold text-xl leading-tight tracking-tight max-w-2xl">{{ $question->question_text }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($question->answers as $answer)
                        <div class="flex items-center gap-3 px-4 py-3 rounded-2xl border {{ $answer->is_correct ? 'border-green-500/30 bg-green-500/5 text-green-400' : 'border-white/5 bg-black/20 text-gray-500' }}">
                            <div class="w-2 h-2 rounded-full {{ $answer->is_correct ? 'bg-green-500 animate-pulse' : 'bg-gray-800' }}"></div>
                            <span class="text-xs font-medium">{{ $answer->answer_text }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex md:flex-col gap-2">
                    <button onclick="toggleModal('edit-modal-{{ $question->id }}')" class="p-4 rounded-2xl bg-blue-500/10 text-blue-500 hover:bg-blue-500 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <form action="{{ route('questions.delete', $question->id) }}" method="POST" onsubmit="return confirm('Supprimer définitivement ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-4 rounded-2xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="edit-modal-{{ $question->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
            <div class="glass-card rounded-[2.5rem] p-8 border border-white/10 bg-[#0f1218] w-full max-w-4xl max-h-[90vh] overflow-y-auto shadow-2xl">
                <form action="{{ route('questions.update', $question->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Catégorie</label>
                            <select name="category_id" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $question->category_id ? 'selected' : '' }} class="bg-[#0f1218]">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-purple-400 tracking-widest ml-1">Changer l'image</label>
                            <input type="file" name="image" onchange="previewImage(event, 'preview-edit-{{ $question->id }}')" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3 text-white text-xs">
                        </div>
                        <div class="space-y-2 md:col-span-2 text-center">
                             <img id="preview-edit-{{ $question->id }}" src="{{ $question->image_path ? asset('storage/'.$question->image_path) : '' }}" class="{{ $question->image_path ? '' : 'hidden' }} mx-auto h-32 rounded-xl border border-white/10">
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Énoncé</label>
                            <input type="text" name="question_text" value="{{ $question->question_text }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-white text-sm">
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white font-black uppercase italic py-4 rounded-2xl transition-all">Mettre à jour</button>
                        <button type="button" onclick="toggleModal('edit-modal-{{ $question->id }}')" class="px-8 py-4 rounded-2xl bg-white/5 text-gray-400 font-black uppercase italic text-xs border border-white/10">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center py-20 bg-white/5 rounded-[3rem] border border-dashed border-white/10">
            <p class="text-gray-500 font-black uppercase tracking-[0.2em] text-xs">Aucune question trouvée.</p>
        </div>
        @endforelse
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.classList.toggle('hidden');
    }

    function previewImage(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);
        const placeholderId = 'placeholder-' + previewId.split('-')[1];
        const placeholder = document.getElementById(placeholderId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if(placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    .glass-card { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
    @keyframes slide-up { from { transform: translateY(50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    .animate-slide-up { animation: slide-up 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    .overflow-y-auto::-webkit-scrollbar { width: 6px; }
    .overflow-y-auto::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
    .overflow-y-auto::-webkit-scrollbar-thumb { background: #a855f7; border-radius: 10px; }
</style>
@endsection