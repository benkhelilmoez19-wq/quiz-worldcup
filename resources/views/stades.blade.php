<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIFA 2026 | Les Stades</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0b0e14;
            color: white;
        }
        .bg-dark-nav { background-color: #0f1219; }
        .stadium-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        .stadium-card:hover {
            border-color: #ffdf00;
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.05);
        }
        .text-glow {
            color: #ffdf00;
            text-shadow: 0 0 15px rgba(255, 223, 0, 0.3);
        }
    </style>
</head>
<body class="antialiased">

    <nav class="bg-dark-nav px-6 md:px-12 py-4 flex items-center justify-between border-b border-gray-800/50 sticky top-0 z-50">
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="font-black text-xl tracking-tighter uppercase italic">
                FIFA <span class="text-gray-500">2026</span>
            </a>
        </div>
        <div class="flex gap-8 text-[10px] font-bold uppercase tracking-widest text-gray-400">
            <a href="{{ url('/') }}" class="hover:text-white transition">Accueil</a>
            <a href="{{ route('quiz.categories') }}" class="hover:text-white transition">Le Quiz</a>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-12">
        <div class="mb-12">
            <h1 class="text-5xl font-black italic uppercase tracking-tighter mb-2">Les <span class="text-glow">Arènes</span> de 2026</h1>
            <p class="text-gray-500 uppercase text-[10px] font-bold tracking-[0.3em]">Découvrez les lieux où l'histoire sera écrite</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="stadium-card rounded-xl overflow-hidden">
                <img src="{{ asset('images/azteca.jpg') }}" alt="Estadio Azteca" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-black uppercase italic text-white mb-2">Estadio Azteca</h3>
                    <p class="text-yellow-500 text-[10px] font-bold uppercase mb-4 tracking-widest">Mexico City, Mexique</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Le premier stade à accueillir trois Coupes du Monde. Un temple légendaire du football mondial.</p>
                    <div class="mt-4 pt-4 border-t border-gray-800 flex justify-between items-center text-[10px] font-bold uppercase text-gray-500">
                        <span>Capacité: 87,523</span>
                        <span>Ouverture: 1966</span>
                    </div>
                </div>
            </div>

            <div class="stadium-card rounded-xl overflow-hidden">
                <img src="{{ asset('images/sofi.jpg') }}" alt="SoFi Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-black uppercase italic text-white mb-2">SoFi Stadium</h3>
                    <p class="text-yellow-500 text-[10px] font-bold uppercase mb-4 tracking-widest">Los Angeles, USA</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Le stade le plus cher au monde. Une merveille technologique dotée d'un écran circulaire géant.</p>
                    <div class="mt-4 pt-4 border-t border-gray-800 flex justify-between items-center text-[10px] font-bold uppercase text-gray-500">
                        <span>Capacité: 70,240</span>
                        <span>Ouverture: 2020</span>
                    </div>
                </div>
            </div>

            <div class="stadium-card rounded-xl overflow-hidden">
                <img src="{{ asset('images/metlife.jpg') }}" alt="MetLife Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-black uppercase italic text-white mb-2">MetLife Stadium</h3>
                    <p class="text-yellow-500 text-[10px] font-bold uppercase mb-4 tracking-widest">New York/New Jersey, USA</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Le théâtre de la grande Finale de 2026. Un stade massif situé aux portes de New York.</p>
                    <div class="mt-4 pt-4 border-t border-gray-800 flex justify-between items-center text-[10px] font-bold uppercase text-gray-500">
                        <span>Capacité: 82,500</span>
                        <span>Ouverture: 2010</span>
                    </div>
                </div>
            </div>

            <div class="stadium-card rounded-xl overflow-hidden">
                <img src="{{ asset('images/marcedec.jpg') }}" alt="Mercedes-Benz Stadium" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-black uppercase italic text-white mb-2">Mercedes-Benz</h3>
                    <p class="text-yellow-500 text-[10px] font-bold uppercase mb-4 tracking-widest">Atlanta, USA</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Célèbre pour son toit rétractable en forme d'objectif de caméra et son architecture futuriste.</p>
                    <div class="mt-4 pt-4 border-t border-gray-800 flex justify-between items-center text-[10px] font-bold uppercase text-gray-500">
                        <span>Capacité: 71,000</span>
                        <span>Ouverture: 2017</span>
                    </div>
                </div>
            </div>

            <div class="stadium-card rounded-xl overflow-hidden">
                <img src="{{ asset('images/guides.jpg') }}" alt="BC Place" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-black uppercase italic text-white mb-2">BC Place</h3>
                    <p class="text-yellow-500 text-[10px] font-bold uppercase mb-4 tracking-widest">Vancouver, Canada</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Le fleuron du Canada pour 2026. Situé au cœur de la ville avec une vue imprenable.</p>
                    <div class="mt-4 pt-4 border-t border-gray-800 flex justify-between items-center text-[10px] font-bold uppercase text-gray-500">
                        <span>Capacité: 54,500</span>
                        <span>Rénové: 2011</span>
                    </div>
                </div>
            </div>

            <div class="stadium-card rounded-xl overflow-hidden">
                <img src="{{ asset('images/host.jpg') }}" alt="Stade Hôte" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-black uppercase italic text-white mb-2">Lumen Field</h3>
                    <p class="text-yellow-500 text-[10px] font-bold uppercase mb-4 tracking-widest">Seattle, USA</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Réputé pour être l'un des stades les plus bruyants et intimidants au monde pour les visiteurs.</p>
                    <div class="mt-4 pt-4 border-t border-gray-800 flex justify-between items-center text-[10px] font-bold uppercase text-gray-500">
                        <span>Capacité: 69,000</span>
                        <span>Ouverture: 2002</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="text-center py-8 border-t border-gray-800 opacity-30 text-[8px] tracking-[0.5em] uppercase">
        FIFA 2026 ™ — Developed by Moez Ben Khelil
    </footer>

</body>
</html>