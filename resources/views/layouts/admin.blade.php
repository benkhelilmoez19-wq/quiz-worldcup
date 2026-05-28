<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIFA 2026 Admin | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0b0e14;
            color: white;
        }
        .sidebar {
            background: linear-gradient(180deg, #11141a 0%, #07090d 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        .nav-link {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255, 223, 0, 0.05);
            border-left-color: #ffdf00;
            color: #ffdf00;
        }
    </style>
</head>
<body class="antialiased">

    <div class="flex min-h-screen">
        <aside class="w-72 sidebar flex flex-col fixed h-full z-50">
            <div class="p-8 border-b border-white/5">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/FwYWk8RagAE8mIn-1920x1920.jpg') }}" alt="FIFA 2026" class="w-12 h-12 object-contain">
                    <div>
                        <h2 class="text-xs font-black uppercase tracking-tighter">FIFA <span class="text-yellow-500">ADMIN</span></h2>
                        <p class="text-[9px] text-gray-500 font-bold uppercase tracking-widest">World Cup 2026</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <p class="px-4 text-[9px] font-bold text-gray-600 uppercase tracking-[0.2em] mb-4">Navigation</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-xl nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span class="text-sm font-bold tracking-tight">Vue d'ensemble</span>
                </a>

                <a href="{{ route('users.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-xl nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="text-sm font-bold tracking-tight">Gestion Utilisateurs</span>
                </a>

                <a href="{{ route('categories.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-xl nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    <span class="text-sm font-bold tracking-tight">Catégories Quiz</span>
                </a>

                <a href="{{ route('questions.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-xl nav-link {{ request()->routeIs('questions.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-bold tracking-tight">Banque de Questions</span>
                </a>

                <div class="pt-6">
                    <p class="px-4 text-[9px] font-bold text-gray-600 uppercase tracking-[0.2em] mb-4">Sécurité</p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-4 px-4 py-3.5 rounded-xl text-red-500/80 hover:bg-red-500/5 hover:text-red-500 transition-all font-bold text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </nav>

            <div class="p-6 border-t border-white/5 bg-black/20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center text-black font-black">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-bold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-yellow-500 font-bold uppercase tracking-wider">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 ml-72 p-10">
            @yield('content')
        </main>
    </div>

</body>
</html>