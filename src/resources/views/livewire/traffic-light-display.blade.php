<div wire:poll.1000ms="checkStatus" class="min-h-screen bg-slate-950 font-sans relative overflow-hidden text-slate-200">
    
    <!-- Professional ambient background glow -->
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/10 blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-emerald-600/10 blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-4 py-8 md:py-12 relative z-10">
        
        <!-- Header Section -->
        <div class="mb-10 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <p class="text-sm tracking-widest text-blue-400 font-bold uppercase mb-2 flex items-center justify-center md:justify-start gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    Pusat Komando Lalu Lintas
                </p>
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight leading-tight drop-shadow-sm">
                    Dashboard Pemantauan Terpadu
                </h1>
            </div>
            
            <div class="flex items-center gap-3 bg-slate-900/80 backdrop-blur-md border border-slate-700/50 px-6 py-3 rounded-full shadow-lg">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-sm font-bold text-slate-300 tracking-wider">SYSTEM ONLINE</span>
            </div>
        </div>

        @if($trafficLights && $trafficLights->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($trafficLights as $tl)
                    @php
                        $statusInfo = [
                            'merah' => ['color' => 'text-red-500', 'glow' => 'shadow-[0_0_20px_rgba(239,68,68,0.6)]', 'text' => 'BERHENTI'],
                            'kuning' => ['color' => 'text-yellow-400', 'glow' => 'shadow-[0_0_20px_rgba(250,204,21,0.6)]', 'text' => 'HATI-HATI'],
                            'hijau' => ['color' => 'text-green-500', 'glow' => 'shadow-[0_0_20px_rgba(34,197,94,0.6)]', 'text' => 'JALAN'],
                        ][$tl->status] ?? ['color' => 'text-slate-500', 'glow' => '', 'text' => 'OFFLINE'];
                    @endphp

                    <!-- Traffic Light Card -->
                    <div wire:click="selectNode({{ $tl->id }})" class="bg-slate-900/60 backdrop-blur-xl border border-slate-700/60 hover:border-slate-500 transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1 rounded-3xl overflow-hidden group flex flex-col cursor-pointer">
                        
                        <!-- Card Header -->
                        <div class="p-5 border-b border-slate-800 flex justify-between items-start bg-slate-800/30">
                            <div>
                                <h2 class="text-xl font-bold text-white mb-1 group-hover:text-blue-400 transition-colors">{{ $tl->nama_persimpangan }}</h2>
                                <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-400 tracking-wider uppercase">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    ID Node: #{{ str_pad($tl->id, 3, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                            <div class="px-2 py-1 rounded-md text-[9px] font-bold uppercase tracking-widest border {{ $tl->mode === 'otomatis' ? 'bg-blue-500/10 text-blue-400 border-blue-500/20' : 'bg-purple-500/10 text-purple-400 border-purple-500/20' }}">
                                {{ $tl->mode }}
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-1 flex flex-col items-center justify-center gap-6 relative">
                            
                            <!-- Large Status Text -->
                            <div class="text-center w-full">
                                <span class="text-[10px] text-slate-500 font-bold tracking-widest uppercase mb-1 block">Status Terkini</span>
                                <span class="text-2xl font-black {{ $statusInfo['color'] }} tracking-widest drop-shadow-md block">
                                    {{ $statusInfo['text'] }}
                                </span>
                            </div>

                            <div class="flex items-center justify-center w-full gap-8">
                                <!-- Minimalist Traffic Light Visual -->
                                <div class="bg-gradient-to-b from-slate-800 to-slate-900 rounded-2xl p-3 shadow-inner border border-slate-700 flex flex-col gap-3 relative shrink-0">
                                    <!-- Red -->
                                    <div class="w-10 h-10 rounded-full border-2 transition-all duration-500 {{ $tl->status === 'merah' ? 'bg-red-500 border-red-300 scale-110 ' . $statusInfo['glow'] : 'bg-red-950 border-slate-800 opacity-30 scale-95' }}"></div>
                                    <!-- Yellow -->
                                    <div class="w-10 h-10 rounded-full border-2 transition-all duration-500 {{ $tl->status === 'kuning' ? 'bg-yellow-400 border-yellow-200 scale-110 ' . $statusInfo['glow'] : 'bg-yellow-950 border-slate-800 opacity-30 scale-95' }}"></div>
                                    <!-- Green -->
                                    <div class="w-10 h-10 rounded-full border-2 transition-all duration-500 {{ $tl->status === 'hijau' ? 'bg-green-500 border-green-300 scale-110 ' . $statusInfo['glow'] : 'bg-green-950 border-slate-800 opacity-30 scale-95' }}"></div>
                                </div>

                                <!-- Timer Display -->
                                <div class="flex flex-col items-center">
                                    <div class="bg-black/40 rounded-2xl border border-white/5 p-4 flex flex-col items-center justify-center min-w-[90px] shadow-inner">
                                        <span class="text-[9px] text-slate-500 uppercase font-bold tracking-widest mb-1">
                                            @if($tl->mode === 'otomatis') Timer @else Hold @endif
                                        </span>
                                        <div class="flex items-baseline gap-1">
                                            @if($tl->mode === 'otomatis')
                                                <span class="text-4xl font-mono font-black {{ $statusInfo['color'] }} drop-shadow-lg leading-none">
                                                    {{ str_pad($tl->timeRemaining, 2, '0', STR_PAD_LEFT) }}
                                                </span>
                                            @else
                                                <span class="text-3xl font-mono font-black text-slate-600 leading-none">
                                                    --
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12 text-center text-slate-500 text-xs flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Sistem Pemantauan Terpadu 1.0 &copy; {{ date('Y') }}
            </div>

            <!-- Livewire Modal Pop-up -->
            @if($selectedNode)
                @php
                    $tl = $trafficLights->firstWhere('id', $selectedNode);
                    $statusInfo = [
                        'merah' => ['bg' => 'bg-red-500', 'text' => 'BERHENTI'],
                        'kuning' => ['bg' => 'bg-yellow-400', 'text' => 'HATI-HATI'],
                        'hijau' => ['bg' => 'bg-green-500', 'text' => 'JALAN'],
                    ][$tl->status] ?? ['bg' => 'bg-slate-500', 'text' => 'OFFLINE'];
                @endphp
                <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-8 bg-black/80 backdrop-blur-sm" wire:click="closeNode">
                    <div class="bg-slate-900 border border-slate-700 rounded-3xl overflow-hidden w-full max-w-6xl shadow-2xl flex flex-col md:flex-row h-[90vh] md:h-[80vh] relative" wire:click.stop>
                        
                        <!-- Close Button -->
                        <button wire:click="closeNode" class="absolute top-4 right-4 z-50 bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white rounded-full p-2 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>

                        <!-- Left Side: CCTV & Info -->
                        <div class="w-full md:w-1/2 border-r border-slate-800 flex flex-col">
                            <div class="p-6 border-b border-slate-800 flex items-center gap-4">
                                <div class="flex-1">
                                    <h2 class="text-2xl font-black text-white">{{ $tl->nama_persimpangan }}</h2>
                                    <p class="text-xs text-slate-400 tracking-widest uppercase">ID Node: #{{ str_pad($tl->id, 3, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <div class="flex flex-col items-center gap-1">
                                    <span class="text-[10px] font-bold text-slate-500 uppercase">Status</span>
                                    <span class="px-3 py-1 rounded text-xs font-bold {{ $statusInfo['bg'] }} text-white shadow-md">{{ $statusInfo['text'] }}</span>
                                </div>
                                <div class="flex flex-col items-center gap-1">
                                    <span class="text-[10px] font-bold text-slate-500 uppercase">Timer</span>
                                    <span class="px-3 py-1 rounded text-xs font-mono font-bold bg-slate-800 text-white shadow-md">{{ str_pad($tl->timeRemaining, 2, '0', STR_PAD_LEFT) }}s</span>
                                </div>
                            </div>
                            <div class="flex-1 bg-black relative min-h-[250px]">
                                @if($tl->cctv_url)
                                    <iframe class="absolute inset-0 w-full h-full object-cover" src="{{ $tl->cctv_url }}" title="CCTV Camera" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @else
                                    <div class="flex items-center justify-center h-full text-slate-600">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                            <p>CCTV Offline</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4 flex items-center gap-2 bg-black/60 backdrop-blur px-3 py-1 rounded-full border border-white/10">
                                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                    <span class="text-[10px] font-bold text-white tracking-widest">LIVE FEED</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Google Maps -->
                        <div class="w-full md:w-1/2 flex flex-col bg-slate-800/50">
                            <div class="p-4 border-b border-slate-800 bg-slate-900">
                                <h3 class="text-sm font-bold text-slate-300 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Peta Lokasi Persimpangan
                                </h3>
                            </div>
                            <div class="flex-1 w-full h-full relative min-h-[300px]">
                                @if($tl->latitude && $tl->longitude)
                                    <iframe 
                                        class="absolute inset-0 w-full h-full" 
                                        frameborder="0" 
                                        style="border:0" 
                                        src="https://maps.google.com/maps?q={{ $tl->latitude }},{{ $tl->longitude }}&hl=id&z=17&amp;output=embed" 
                                        allowfullscreen>
                                    </iframe>
                                @else
                                    <div class="flex items-center justify-center h-full text-slate-600 bg-slate-800">
                                        <p>Koordinat peta tidak tersedia.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            @endif

        @else
            <div class="w-full max-w-md mx-auto text-center p-12 bg-slate-900/60 backdrop-blur-md rounded-3xl shadow-2xl border border-slate-700 mt-20">
                <div class="mx-auto w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Belum Ada Data</h3>
                <p class="text-slate-400 text-sm">Tambahkan data traffic light minimal 1 lokasi melalui Filament Admin Panel atau jalankan seeder untuk memulai operasional.</p>
            </div>
        @endif
    </div>
</div>
