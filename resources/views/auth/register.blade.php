<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIFA 2026 | Inscription Officielle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 20% 50%, #11141a 0%, #07090d 100%);
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .input-field {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: #ffdf00;
            background: rgba(255, 255, 255, 0.06);
            box-shadow: 0 0 15px rgba(255, 223, 0, 0.1);
            outline: none;
        }
        .error-field { border-color: #ef4444 !important; }
        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #ffdf00; }
        
        .fade-in-right { animation: fadeInRight 1s ease-out; }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body class="antialiased">

    <div class="flex min-h-screen">
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 sm:px-12 lg:px-20 py-10 z-10">
            <div class="mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <span class="h-[1px] w-8 bg-yellow-500"></span>
                    <p class="text-yellow-500 text-[10px] font-bold uppercase tracking-[0.3em]">World Cup 2026 Edition</p>
                </div>
                <h1 class="text-5xl font-black italic uppercase tracking-tighter">
                    CRÉER UN <span class="text-yellow-500">PROFIL</span>
                </h1>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-widest text-gray-500 mb-1.5 ml-1">Nom Complet</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Moez Ben Khelil" required 
                               class="w-full px-4 py-3 rounded-xl input-field text-sm text-white @error('name') error-field @enderror">
                        @error('name') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold italic">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold uppercase tracking-widest text-gray-500 mb-1.5 ml-1">Email Officiel</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nom@exemple.com" required 
                               class="w-full px-4 py-3 rounded-xl input-field text-sm text-white @error('email') error-field @enderror">
                        @error('email') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold italic">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[9px] font-bold uppercase tracking-widest text-gray-500 mb-1.5 ml-1">Adresse de résidence</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Ex: Tunis, Tunisie" required 
                           class="w-full px-4 py-3 rounded-xl input-field text-sm text-white @error('address') error-field @enderror">
                    @error('address') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div class="relative" id="country-container">
                    <label class="block text-[9px] font-bold uppercase tracking-widest text-gray-500 mb-1.5 ml-1">Nationalité</label>
                    <div id="country-trigger" class="w-full px-4 py-3 rounded-xl input-field text-sm text-white cursor-pointer flex justify-between items-center group @error('nationality') error-field @enderror">
                        <span id="selected-label" class="flex items-center gap-3 italic text-gray-500">
                            {{ old('nationality') ? old('nationality') : 'Choisir un pays...' }}
                        </span>
                        <svg class="w-4 h-4 text-yellow-500 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    
                    <input type="hidden" name="nationality" id="nationality-value" value="{{ old('nationality') }}">
                    @error('nationality') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold italic">{{ $message }}</p> @enderror
                    
                    <div id="country-menu" class="hidden absolute z-50 w-full mt-2 bg-[#12151c] border border-white/10 rounded-xl shadow-2xl overflow-hidden backdrop-blur-xl">
                        <div class="p-2 border-b border-white/5 bg-white/5">
                            <input type="text" id="search-country" placeholder="Rechercher un pays..." 
                                   class="w-full px-3 py-2 bg-black/20 border border-white/5 rounded-lg text-xs text-white outline-none focus:border-yellow-500/50">
                        </div>
                        <ul id="country-list" class="max-h-52 overflow-y-auto custom-scroll py-1"></ul>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <label class="block text-[9px] font-bold uppercase tracking-widest text-gray-500 mb-1.5 ml-1">Mot de passe</label>
                        <input type="password" id="password" name="password" required 
                               class="w-full px-4 py-3 rounded-xl input-field text-sm text-white pr-10 @error('password') error-field @enderror">
                        <button type="button" onclick="togglePass('password', 'eye-1')" class="absolute right-3 top-8 text-gray-500 hover:text-yellow-500">
                            <svg id="eye-1" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        </button>
                    </div>
                    <div class="relative">
                        <label class="block text-[9px] font-bold uppercase tracking-widest text-gray-500 mb-1.5 ml-1">Confirmation</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required 
                               class="w-full px-4 py-3 rounded-xl input-field text-sm text-white pr-10">
                        <button type="button" onclick="togglePass('password_confirmation', 'eye-2')" class="absolute right-3 top-8 text-gray-500 hover:text-yellow-500">
                            <svg id="eye-2" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 rounded-xl bg-yellow-500 text-black font-black uppercase text-xs tracking-[0.2em] mt-4 hover:bg-yellow-400 transition-all transform hover:-translate-y-1 shadow-lg shadow-yellow-500/20">
                    Rejoindre l'élite
                </button>
                
                <p class="text-center text-gray-500 text-[10px] font-bold uppercase tracking-widest pt-2">
                    Déjà membre ? <a href="{{ route('login') }}" class="text-yellow-500 hover:text-white transition-colors">Se connecter</a>
                </p>
            </form>
        </div>

        <div class="hidden lg:flex lg:w-1/2 bg-[#050608] items-center justify-center relative border-l border-white/5 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/10 to-transparent pointer-events-none"></div>
            <img src="{{ asset('images/FwYWk8RagAE8mIn-1920x1920.jpg') }}" 
                 alt="FIFA World Cup 2026" 
                 class="w-[70%] h-auto object-contain drop-shadow-[0_0_50px_rgba(255,223,0,0.2)] fade-in-right relative z-10">
        </div>
    </div>

    <script>
        const countries = [
            { name: "Algérie", code: "dz" }, { name: "Allemagne", code: "de" }, { name: "Argentine", code: "ar" }, 
            { name: "Belgique", code: "be" }, { name: "Brésil", code: "br" }, { name: "Canada", code: "ca" }, 
            { name: "Espagne", code: "es" }, { name: "États-Unis", code: "us" }, { name: "France", code: "fr" }, 
            { name: "Italie", code: "it" }, { name: "Maroc", code: "ma" }, { name: "Mexique", code: "mx" }, 
            { name: "Portugal", code: "pt" }, { name: "Sénégal", code: "sn" }, { name: "Tunisie", code: "tn" }
        ].sort((a, b) => a.name.localeCompare(b.name));

        const trigger = document.getElementById('country-trigger');
        const menu = document.getElementById('country-menu');
        const list = document.getElementById('country-list');
        const search = document.getElementById('search-country');
        const label = document.getElementById('selected-label');
        const hiddenInput = document.getElementById('nationality-value');

        function render(filter = "") {
            list.innerHTML = "";
            const filtered = countries.filter(c => c.name.toLowerCase().includes(filter.toLowerCase()));
            filtered.forEach(c => {
                const li = document.createElement('li');
                li.className = "px-4 py-2.5 hover:bg-yellow-500 hover:text-black cursor-pointer flex items-center gap-3 transition-colors text-xs font-semibold";
                li.innerHTML = `<span class="fi fi-${c.code}"></span> ${c.name}`;
                li.onclick = () => {
                    label.innerHTML = `<span class="fi fi-${c.code}"></span> ${c.name}`;
                    label.classList.remove('italic', 'text-gray-500');
                    label.classList.add('text-white');
                    hiddenInput.value = c.name;
                    menu.classList.add('hidden');
                };
                list.appendChild(li);
            });
        }

        trigger.onclick = () => {
            menu.classList.toggle('hidden');
            if (!menu.classList.contains('hidden')) search.focus();
        };

        search.oninput = (e) => render(e.target.value);

        window.onclick = (e) => {
            if (!document.getElementById('country-container').contains(e.target)) menu.classList.add('hidden');
        };

        function togglePass(id, eyeId) {
            const input = document.getElementById(id);
            const eye = document.getElementById(eyeId);
            if (input.type === "password") {
                input.type = "text";
                eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                input.type = "password";
                eye.innerHTML = '<path d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />';
            }
        }
        render();
    </script>
</body>
</html>