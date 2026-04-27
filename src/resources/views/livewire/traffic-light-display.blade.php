<div wire:poll.1000ms="checkStatus" class="min-h-screen bg-slate-950 font-sans flex items-center justify-center py-10 px-4 relative overflow-hidden text-slate-200">
    
    <!-- Professional ambient background glow -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/10 blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-emerald-600/10 blur-[120px] pointer-events-none"></div>

    @if($trafficLight)
        <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-slate-900/60 backdrop-blur-xl border border-slate-700 shadow-2xl p-8 md:p-12 rounded-3xl relative z-10 transition-all duration-300">
            
            <!-- Panel Kiri: Informasi Strategis & Countdown -->
            <div class="flex flex-col flex-1 h-full justify-between gap-8">
                
                <!-- Header -->
                <div class="border-b border-slate-700 pb-6 text-center md:text-left">
                    <p class="text-xs tracking-widest text-blue-400 font-bold uppercase mb-2 flex items-center justify-center md:justify-start gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pos Pemantauan Lalu Lintas
                    </p>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight leading-tight">
                        {{ $trafficLight->nama_persimpangan }}
                    </h1>
                </div>

                <!-- Info Cards -->
                <div class="flex flex-col sm:flex-row gap-4 mb-2">
                    <!-- Status Card -->
                    <div class="flex-1 bg-slate-800/40 rounded-2xl p-5 border border-slate-700/50 flex flex-col justify-center items-center text-center transition-all">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-2">Kondisi Jalan</span>
                        @php
                            $statusInfo = [
                                'merah' => ['color' => 'text-red-500', 'text' => 'BERHENTI'],
                                'kuning' => ['color' => 'text-yellow-400', 'text' => 'HARAP HATI-HATI'],
                                'hijau' => ['color' => 'text-green-500', 'text' => 'JALAN'],
                            ][$currentStatus] ?? ['color' => 'text-slate-500', 'text' => 'OFFLINE'];
                        @endphp
                        <span class="text-xl font-black {{ $statusInfo['color'] }} tracking-wide drop-shadow-sm">
                            {{ $statusInfo['text'] }}
                        </span>
                    </div>

                    <!-- Mode Card -->
                    <div class="flex-1 bg-slate-800/40 rounded-2xl p-5 border border-slate-700/50 flex flex-col justify-center items-center text-center">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-2">Sistem Operasi</span>
                        <div class="flex items-center gap-2">
                            @if($mode === 'otomatis')
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                                </span>
                                <span class="text-lg font-bold text-slate-200">Otomatis</span>
                            @else
                                <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                                <span class="text-lg font-bold text-slate-200">Manual</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Countdown Timer Section -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-950 rounded-2xl p-6 border border-slate-700 shadow-inner overflow-hidden relative">
                    <!-- Subtle background pattern -->
                    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white to-transparent"></div>
                    
                    <div class="relative z-10 flex flex-row justify-between items-center">
                        <div class="flex flex-col text-left mr-4">
                            <span class="text-sm font-semibold uppercase tracking-widest text-slate-400 mb-1">
                                @if($mode === 'otomatis') Sisa Waktu @else Diinterupsi @endif
                            </span>
                            <span class="text-xs text-slate-500">
                                @if($mode === 'otomatis') Waktu transisi fase @else Sistem menahan status (Manual/Admin) @endif
                            </span>
                        </div>
                        
                        <div class="bg-black/40 rounded-2xl border border-white/5 px-6 py-4 flex items-baseline justify-center min-w-[120px]">
                            @if($mode === 'otomatis')
                                <span class="text-6xl font-black font-mono tracking-tighter drop-shadow-md {{ $statusInfo['color'] }}">
                                    {{ str_pad($timeRemaining, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="text-xl text-slate-600 font-mono ml-1">s</span>
                            @else
                                <span class="text-5xl font-black font-mono text-slate-700 tracking-widest">
                                    --
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Kanan: Traffic Light Visual Profesional -->
            <div class="flex justify-center md:justify-end h-full">
                <div class="relative bg-gradient-to-b from-slate-800 to-slate-900 px-8 py-10 rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.6)] border border-slate-700 flex flex-col items-center gap-6 group">
                   
                    <!-- Top mounting pole design -->
                    <div class="absolute -top-4 w-12 h-6 bg-slate-700 rounded-t-lg mx-auto shadow-inner border-t border-slate-500"></div>

                    <!-- Lampu Merah -->
                    <div class="relative w-28 h-28 flex items-center justify-center">
                        <div class="absolute -top-3 w-32 h-16 bg-gradient-to-b from-slate-950 to-transparent rounded-t-full z-20 pointer-events-none opacity-80"></div>
                        <div class="relative z-10 w-24 h-24 rounded-full border-4 transition-all duration-500 flex items-center justify-center {{ 
                            $currentStatus === 'merah' 
                            ? 'bg-red-500 border-red-300 shadow-[0_0_50px_10px_rgba(239,68,68,0.5),inset_0_0_20px_rgba(255,255,255,0.7)] scale-100 ring-4 ring-red-500/20' 
                            : 'bg-gradient-to-tr from-red-950 to-black border-slate-800 opacity-60 shadow-inner scale-95' 
                        }}">
                            <!-- Reflector pattern -->
                            <div class="w-full h-full rounded-full opacity-20 bg-[radial-gradient(circle_at_center,_transparent_20%,_rgba(0,0,0,0.5)_80%)] mix-blend-overlay"></div>
                        </div>
                    </div>

                    <!-- Lampu Kuning -->
                    <div class="relative w-28 h-28 flex items-center justify-center">
                        <div class="absolute -top-3 w-32 h-16 bg-gradient-to-b from-slate-950 to-transparent rounded-t-full z-20 pointer-events-none opacity-80"></div>
                        <div class="relative z-10 w-24 h-24 rounded-full border-4 transition-all duration-500 flex items-center justify-center {{ 
                            $currentStatus === 'kuning' 
                            ? 'bg-yellow-400 border-yellow-200 shadow-[0_0_50px_10px_rgba(250,204,21,0.5),inset_0_0_20px_rgba(255,255,255,0.7)] scale-100 ring-4 ring-yellow-400/20' 
                            : 'bg-gradient-to-tr from-yellow-950 to-black border-slate-800 opacity-60 shadow-inner scale-95' 
                        }}">
                            <div class="w-full h-full rounded-full opacity-20 bg-[radial-gradient(circle_at_center,_transparent_20%,_rgba(0,0,0,0.5)_80%)] mix-blend-overlay"></div>
                        </div>
                    </div>

                    <!-- Lampu Hijau -->
                    <div class="relative w-28 h-28 flex items-center justify-center">
                        <div class="absolute -top-3 w-32 h-16 bg-gradient-to-b from-slate-950 to-transparent rounded-t-full z-20 pointer-events-none opacity-80"></div>
                        <div class="relative z-10 w-24 h-24 rounded-full border-4 transition-all duration-500 flex items-center justify-center {{ 
                            $currentStatus === 'hijau' 
                            ? 'bg-green-500 border-green-300 shadow-[0_0_50px_10px_rgba(34,197,94,0.5),inset_0_0_20px_rgba(255,255,255,0.7)] scale-100 ring-4 ring-green-500/20' 
                            : 'bg-gradient-to-tr from-green-950 to-black border-slate-800 opacity-60 shadow-inner scale-95' 
                        }}">
                            <div class="w-full h-full rounded-full opacity-20 bg-[radial-gradient(circle_at_center,_transparent_20%,_rgba(0,0,0,0.5)_80%)] mix-blend-overlay"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Indikator sinkronisasi -->
            <div class="absolute top-4 right-6 flex items-center gap-2 pointer-events-none">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-[10px] text-slate-400 font-mono">LINK SYNCED</span>
            </div>

        </div>

        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 text-slate-500 text-xs flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Sistem Pemantauan Terpadu 1.0 &copy; {{ date('Y') }}
        </div>
    @else
        <div class="w-full max-w-md mx-auto text-center p-12 bg-white/5 backdrop-blur-md rounded-3xl shadow-2xl border border-white/10">
            <div class="mx-auto w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mb-6">
                <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Menunggu Konfigurasi Awal</h3>
            <p class="text-slate-400 text-sm">Tambahkan data traffic light minimal 1 lokasi melalui Filament Admin Panel atau jalankan seeder untuk memulai operasional.</p>
        </div>
    @endif
</div>
