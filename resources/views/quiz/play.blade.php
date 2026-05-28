@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<div class="min-h-screen bg-[#0b0e14] text-white p-6 font-sans">
    
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-end mb-8">
            <div>
                <span class="text-yellow-500 text-[10px] font-black uppercase tracking-[0.3em]">Mode Compétition</span>
                <h1 class="text-3xl font-black italic uppercase tracking-tighter">{{ $category->name }}</h1>
            </div>
            <div class="text-right">
                <span class="text-gray-500 text-[10px] font-black uppercase tracking-widest">Progression</span>
                <p class="text-xl font-black italic"><span class="text-yellow-500" id="current-step">1</span> / {{ count($questions) }}</p>
            </div>
        </div>

        <form action="{{ route('quiz.submit') }}" method="POST" id="quiz-form">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">

            <div class="relative">
                @foreach($questions as $index => $question)
                <div class="quiz-question {{ $index === 0 ? 'block' : 'hidden' }}" data-step="{{ $index + 1 }}">
                    
                    <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden backdrop-blur-md">
                        
                        {{-- Conteneur d'image --}}
                        @if($question->image_path)
                        <div id="image-container-{{ $question->id }}" class="max-h-0 overflow-hidden transition-all duration-700 ease-in-out bg-black/40 border-b border-white/5">
                            <div class="p-2 bg-green-500/10 text-center border-b border-green-500/20">
                                <span class="text-green-500 text-[10px] font-black uppercase tracking-widest">✓ Analyse visuelle débloquée</span>
                            </div>
                            <img src="{{ asset('storage/' . $question->image_path) }}" 
                                 class="w-full object-contain max-h-[400px] mx-auto block shadow-2xl" 
                                 alt="Question Illustration">
                        </div>
                        @endif

                        <div class="p-10">
                            <h2 class="text-2xl font-black italic leading-tight mb-10 text-gray-100">
                                <span class="text-yellow-500 mr-2">#{{ $index + 1 }}</span> {{ $question->question_text }}
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 answers-grid">
                                @foreach($question->answers as $answer)
                                <label class="group relative cursor-pointer">
                                    <input type="radio" 
                                           name="answers[{{ $question->id }}]" 
                                           value="{{ $answer->id }}" 
                                           class="peer hidden answer-input" 
                                           onclick="handleSelection(this, {{ $question->id }}, {{ $answer->is_correct ? 'true' : 'false' }})"
                                           required>
                                    
                                    <div id="box-{{ $answer->id }}" class="answer-card p-6 bg-white/5 border border-white/10 rounded-2xl transition-all duration-300 group-hover:bg-white/10 peer-checked:ring-2 peer-checked:ring-yellow-500/50">
                                        <div class="flex items-center justify-between">
                                            <span class="font-bold uppercase italic text-sm tracking-wide">{{ $answer->answer_text }}</span>
                                            <div class="status-icon w-7 h-7 rounded-full border-2 border-white/10 flex items-center justify-center font-black">
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between items-center px-2">
                        @if($index > 0)
                        <button type="button" onclick="changeQuestion({{ $index }})" class="px-8 py-4 bg-white/5 border border-white/10 rounded-xl font-black uppercase italic text-xs hover:bg-white/10 transition-all text-gray-400">
                            Précédent
                        </button>
                        @else
                        <div></div>
                        @endif

                        @if($index < count($questions) - 1)
                        <button type="button" onclick="changeQuestion({{ $index + 2 }})" class="px-10 py-4 bg-yellow-500 text-black rounded-xl font-black uppercase italic text-sm shadow-lg shadow-yellow-500/20 hover:scale-105 active:scale-95 transition-all">
                            Suivant
                        </button>
                        @else
                        <button type="submit" class="px-10 py-4 bg-green-500 text-white rounded-xl font-black uppercase italic text-sm shadow-lg shadow-green-600/20 hover:scale-105 active:scale-95 transition-all">
                            Valider le Quiz
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </form>
    </div>
</div>

<script>
    function handleSelection(input, questionId, isCorrect) {
        const currentGrid = input.closest('.answers-grid');
        const allInputs = currentGrid.querySelectorAll('.answer-input');
        const container = document.getElementById(`image-container-${questionId}`);
        const selectedCard = input.nextElementSibling;
        const icon = selectedCard.querySelector('.status-icon');

        // Bloquer d'autres clics pour cette question
        allInputs.forEach(inp => {
            inp.parentElement.style.pointerEvents = 'none'; 
        });

        if (isCorrect) {
            // EFFET SUCCÈS
            selectedCard.classList.replace('bg-white/5', 'bg-green-600');
            selectedCard.classList.add('text-white', 'border-transparent');
            icon.innerHTML = '✓';

            // LOGIQUE CORRIGÉE : L'image s'affiche UNIQUEMENT si la réponse est BONNE
            if (container) {
                container.style.maxHeight = "500px";
            }

            confetti({
                particleCount: 150,
                spread: 60,
                origin: { y: 0.7 },
                colors: ['#fbbf24', '#22c55e', '#ffffff']
            });

        } else {
            // EFFET ERREUR
            selectedCard.classList.replace('bg-white/5', 'bg-red-600');
            selectedCard.classList.add('text-white', 'border-transparent', 'scale-[0.98]');
            icon.innerHTML = '✕';
            selectedCard.classList.add('animate-shake');
            
            // LOGIQUE CORRIGÉE : L'image reste cachée (max-height reste à 0) si la réponse est fausse
        }
    }

    function changeQuestion(step) {
        document.querySelectorAll('.quiz-question').forEach(q => {
            q.classList.add('hidden');
            q.classList.remove('block');
        });
        const target = document.querySelector(`.quiz-question[data-step="${step}"]`);
        if (target) {
            target.classList.remove('hidden');
            target.classList.add('block');
            document.getElementById('current-step').innerText = step;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');
    h1, h2, span, p, button, label { font-family: 'Archivo', sans-serif; }

    [id^="image-container-"] {
        transition: max-height 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .animate-shake {
        animation: shake 0.4s cubic-bezier(.36,.07,.19,.97) both;
    }

    @keyframes shake {
        10%, 90% { transform: translate3d(-1px, 0, 0); }
        20%, 80% { transform: translate3d(2px, 0, 0); }
        30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
        40%, 60% { transform: translate3d(4px, 0, 0); }
    }
</style>
@endsection