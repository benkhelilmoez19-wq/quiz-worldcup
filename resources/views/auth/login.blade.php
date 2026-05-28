<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIFA 2026 | Se Connecter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 20% 50%, #161a22 0%, #0b0e14 100%);
            color: white;
            overflow-x: hidden;
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .input-field {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-field:focus {
            border-color: #ffdf00;
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 20px rgba(255, 223, 0, 0.15);
            outline: none;
        }

        .btn-yellow {
            background: linear-gradient(135deg, #ffdf00 0%, #e6c900 100%);
            color: #000;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 25px -5px rgba(255, 223, 0, 0.3);
        }

        .btn-yellow:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(255, 223, 0, 0.5);
            filter: brightness(1.1);
        }

        .logo-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 223, 0, 0.05);
            filter: blur(100px);
            border-radius: 50%;
            z-index: -1;
        }

        input[type="checkbox"] {
            accent-color: #ffdf00;
        }
    </style>
</head>
<body class="antialiased">

    <div class="flex min-h-screen">
        
        <div class="w-full lg:w-5/12 flex flex-col justify-center px-8 sm:px-16 lg:px-24 fade-in">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-4">
                    <span class="h-[1px] w-8 bg-yellow-500"></span>
                    <p class="text-yellow-500 text-[11px] font-extrabold uppercase tracking-[0.4em]">Official Platform</p>
                </div>
                <h1 class="text-6xl font-black italic uppercase leading-none tracking-tighter">
                    SE <span class="text-yellow-500">CONNECTER</span>
                </h1>
                <p class="text-gray-400 text-sm mt-6 max-w-sm leading-relaxed">
                    Prêt pour le quiz officiel ? Connectez-vous à votre espace membre de la <span class="text-white font-semibold">Coupe du Monde FIFA 2026</span>.
                </p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                @if ($errors->any())
                    <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-500 text-xs font-bold uppercase tracking-widest">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="group">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2 group-focus-within:text-yellow-500 transition-colors">Fifa ID (Email)</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nom@exemple.com" required
                           class="w-full px-5 py-4 rounded-xl input-field text-sm text-white placeholder-gray-600">
                </div>

                <div class="relative group">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 group-focus-within:text-yellow-500 transition-colors">Mot de passe</label>
                        <a href="#" class="text-[10px] font-bold uppercase text-yellow-500/80 hover:text-yellow-500 transition-colors tracking-tighter">Oublié ?</a>
                    </div>
                    
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                               class="w-full px-5 py-4 rounded-xl input-field text-sm text-white placeholder-gray-600 pr-12">
                        
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-yellow-500 transition-colors focus:outline-none">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-800 bg-gray-900 text-yellow-500 transition-all">
                        <span class="ml-3 text-[10px] font-bold uppercase text-gray-500 group-hover:text-gray-300 transition-colors tracking-widest">Se souvenir de moi</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-5 rounded-xl btn-yellow font-black uppercase text-xs tracking-[0.2em]">
                    Entrer dans l'arène
                </button>

                <p class="text-center text-gray-500 text-[11px] font-bold uppercase tracking-widest pt-6">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}" class="text-yellow-500 hover:text-white transition-colors ml-1 border-b border-yellow-500/30 hover:border-white pb-1">
                        S'inscrire ici
                    </a>
                </p>
            </form>
        </div>

        <div class="hidden lg:flex lg:w-7/12 bg-[#080a0f] items-center justify-center relative overflow-hidden border-l border-white/5">
            <div class="logo-glow"></div>
            
            <div class="relative z-20 flex flex-col items-center">
                <img src="{{ asset('images/FwYWk8RagAE8mIn-1920x1920.jpg') }}" 
                     alt="FIFA 2026 Logo" 
                     class="w-[65%] drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform hover:scale-105 transition-transform duration-1000">
                
                <div class="mt-12 text-center">
                    <p class="text-white/10 text-[10px] font-black uppercase tracking-[1.2em] mr-[-1.2em]">United 2026</p>
                </div>
            </div>

            <div class="absolute bottom-10 flex justify-between w-full px-12 z-20 items-center">
                <p class="text-[9px] text-gray-600 tracking-[0.3em] uppercase">© FIFA 2026 Official Quiz Arena</p>
                <div class="flex gap-2">
                    <div class="w-8 h-[1px] bg-gray-800"></div>
                    <span class="text-[9px] text-gray-700 font-bold uppercase">v1.0</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                `;
            }
        }
    </script>
</body>
</html>