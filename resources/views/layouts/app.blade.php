<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIFA 2026 - @yield('title')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Montserrat:ital,wght@1,900&family=Archivo:ital,wght@0,900;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #080a0f; 
            color: #ffffff;
            overflow-x: hidden;
        }
        .font-fifa { font-family: 'Montserrat', sans-serif; }
        .font-archivo { font-family: 'Archivo', sans-serif; }
        
        /* Effet Glassmorphism pour la Navbar */
        .glass-nav {
            background: rgba(15, 18, 24, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Scrollbar personnalisée Cyberpunk */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #080a0f; }
        ::-webkit-scrollbar-thumb { 
            background: #facc15; 
            border-radius: 10px;
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-link.active { color: #facc15; }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -25px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #facc15;
            box-shadow: 0 0 15px #facc15;
        }
    </style>
</head>
<body class="antialiased">

    <nav class="glass-nav sticky top-0 z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <a href="{{ route('home') }}" class="font-fifa text-2xl font-black italic uppercase tracking-tighter">
                FIFA<span class="text-yellow-400">2026</span>
            </a>

            <div class="hidden md:flex items-center gap-10 text-[11px] font-black uppercase tracking-[0.2em] text-gray-400 font-archivo">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} hover:text-yellow-400">Dashboard</a>
                
                <a href="{{ route('quiz.index') }}" class="nav-link {{ request()->routeIs('quiz.index') ? 'active' : '' }} hover:text-yellow-400">Compétitions</a>
                
                <a href="{{ route('quiz.leaderboard') }}" class="nav-link {{ request()->routeIs('quiz.leaderboard') ? 'active' : '' }} hover:text-yellow-400">Classement</a>
                
                <a href="{{ route('stades') }}" class="nav-link {{ request()->routeIs('stades') ? 'active' : '' }} hover:text-yellow-400">Stades</a>
            </div>

            <div class="flex items-center gap-6">
                @auth
                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-[10px] font-black text-white uppercase leading-none font-archivo">{{ auth()->user()->name }}</p>
                            <p class="text-[8px] font-bold text-yellow-500 uppercase tracking-widest mt-1 font-archivo">
                                {{ auth()->user()->role == 'admin' ? 'Administrateur' : 'Joueur Élite' }}
                            </p>
                        </div>
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2.5 rounded-xl bg-white/5 hover:bg-red-500/20 hover:text-red-500 transition-all border border-white/5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-[11px] font-black uppercase tracking-widest hover:text-yellow-400 transition-colors font-archivo">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-yellow-400 hover:bg-yellow-300 text-black px-6 py-2.5 rounded-xl text-[11px] font-black uppercase italic transition-all font-archivo">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="relative min-h-screen">
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-yellow-500/5 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-blue-600/5 blur-[120px] pointer-events-none"></div>
        
        <div class="container mx-auto px-6 py-10 relative z-10">
            @yield('content')
        </div>
    </main>

    <footer class="mt-20 border-t border-white/5 py-12 bg-black/20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-center md:text-left">
                <p class="font-fifa text-lg font-black italic uppercase text-white/20">FIFA 2026</p>
                <p class="text-[10px] font-bold text-gray-600 uppercase tracking-widest mt-2 font-archivo">
                    &copy; 2026 OFFICIAL QUIZ ARENA - PROJET FIFA WORLD CUP
                </p>
            </div>
            
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full border border-white/5 flex items-center justify-center text-gray-500 hover:text-yellow-400 transition-colors cursor-pointer italic font-black font-archivo text-xs">FB</div>
                <div class="w-10 h-10 rounded-full border border-white/5 flex items-center justify-center text-gray-500 hover:text-yellow-400 transition-colors cursor-pointer italic font-black font-archivo text-xs">IG</div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>