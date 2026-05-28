<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIFA 2026 | Quiz World Cup</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0b0e14;
            overflow-x: hidden;
        }

        /* Effet de lueur sur le titre jaune */
        .text-glow {
            color: #ffdf00;
            text-shadow: 0 0 20px rgba(255, 223, 0, 0.5),
                         0 0 40px rgba(255, 223, 0, 0.2);
        }

        /* Navbar foncée */
        .bg-dark-nav {
            background-color: #0f1219;
        }

        /* Animation au survol du logo */
        .logo-hover {
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .logo-hover:hover {
            transform: scale(1.05) rotate(-1deg);
        }

        /* Dégradé de fond subtil */
        .bg-gradient-overlay {
            position: fixed;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: radial-gradient(circle at 70% 30%, rgba(29, 78, 216, 0.05), transparent 70%);
            z-index: -1;
        }

        /* Style de la Modal (Glassmorphism) */
        .glass-modal {
            background: rgba(15, 18, 25, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 223, 0, 0.2);
        }
    </style>
</head>
<body class="text-white antialiased" x-data="{ openAbout: false }">

    <div class="bg-gradient-overlay"></div>

    <nav class="bg-dark-nav px-6 md:px-12 py-4 flex items-center justify-between border-b border-gray-800/50 sticky top-0 z-50">
        <div class="flex items-center gap-12">
            <div class="flex items-center gap-2">
                <span class="font-black text-2xl tracking-tighter uppercase italic">FIFA <span class="text-gray-500">2026</span></span>
            </div>
            
            <div class="hidden lg:flex gap-8 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                <a href="{{ route('quiz.index') }}" class="hover:text-white transition-colors">Stades</a>
                <button @click="openAbout = true" class="hover:text-white transition-colors uppercase cursor-pointer">À Propos</button>
            </div>
        </div>

        <div class="flex items-center gap-8">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[10px] font-bold uppercase tracking-widest text-yellow-500">Mon Profil</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-white">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-white transition-colors">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-white text-black px-8 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-yellow-500 transition-all transform hover:scale-105">
                        S'inscrire
                    </a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="container mx-auto px-6 md:px-12 min-h-[calc(100vh-80px)] flex flex-col lg:flex-row items-center justify-center gap-12 py-12">
        
        <div class="w-full lg:w-1/2 flex justify-center lg:justify-start">
            <div class="relative group">
                <img src="{{ asset('images/FwYWk8RagAE8mIn-1920x1920.jpg') }}" 
                     alt="FIFA World Cup 2026" 
                     class="w-72 md:w-[480px] logo-hover drop-shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col space-y-6">
            <div class="flex items-center gap-3">
                <div class="h-[1px] w-12 bg-yellow-500/50"></div>
                <span class="text-yellow-500 text-[10px] font-bold uppercase tracking-[0.4em]">The Ultimate Challenge</span>
            </div>

            <h1 class="text-6xl md:text-8xl font-black italic uppercase leading-[0.9] flex flex-col">
                <span class="text-white">Quiz</span>
                <span class="text-glow">World Cup</span>
            </h1>

            <p class="text-gray-400 text-sm md:text-base max-w-md leading-relaxed font-medium">
                Entrez dans l'arène. Testez vos connaissances face à des milliers de supporters et tentez de soulever le trophée virtuel de la FIFA 2026.
            </p>

            <div class="pt-4 flex flex-col space-y-4">
                <div class="flex items-center gap-4">
                     <a href="{{ route('register') }}" class="inline-block bg-yellow-500 text-black px-10 py-4 rounded-sm font-black uppercase text-xs tracking-widest hover:bg-white transition-colors shadow-lg shadow-yellow-500/20">
                        Commencer le Quiz
                    </a>
                </div>
                <p class="text-[10px] text-gray-600 italic tracking-widest uppercase">FIFA 2026 ™ — All Rights Reserved</p>
            </div>
        </div>
    </main>

    <div x-show="openAbout" 
         x-cloak 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/90 transition-opacity"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="openAbout = false" 
             class="glass-modal w-full max-w-md p-8 rounded-2xl relative text-center">
            
            <button @click="openAbout = false" class="absolute top-4 right-4 text-gray-500 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-2xl font-black italic uppercase text-yellow-500 mb-4">À Propos</h2>
            <p class="text-gray-300 text-sm leading-relaxed mb-6">
                FIFA 2026 Quiz est une plateforme immersive pour tester vos connaissances sur la plus grande compétition de football au monde. Découvrez les stades, les joueurs et l'histoire du mondial.
            </p>
            
            <div class="border-t border-gray-800 pt-6">
                <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Développé par</p>
                <p class="text-lg font-bold text-white italic">Moez Ben Khelil</p>
                <p class="text-yellow-500 text-[10px] uppercase font-bold mt-1">Web Developer & UI Expert</p>
            </div>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hidden md:block opacity-20">
        <div class="w-[1px] h-12 bg-gradient-to-b from-yellow-500 to-transparent"></div>
    </div>

</body>
</html>