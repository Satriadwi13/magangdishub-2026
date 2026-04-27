<div x-data="{ 
        cctvModal: false, 
        activeCctv: '', 
        activeTitle: '',
        openCctv(title, id) {
            const img = document.getElementById('cctv-' + id);
            this.activeCctv = img.src;
            this.activeTitle = title;
            this.cctvModal = true;
        }
    }" 
    class="min-h-screen py-8" 
    wire:poll.1000ms>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Monitoring Multi Titik</h1>
                <p class="mt-2 text-sm text-gray-500">Pemantauan real-time status lampu lalu lintas dan CCTV persimpangan kota.</p>
            </div>
            <div class="hidden sm:flex items-center gap-4 text-sm font-medium text-gray-500 bg-gray-50 px-4 py-2 rounded-lg">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
                    <span>System Online</span>
                </div>
            </div>
        </div>
        
        @php
            $fallbacks = [
                'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?auto=format&fit=crop&q=80&w=800',
                'https://images.unsplash.com/photo-1494522855154-9297ac14b55f?auto=format&fit=crop&q=80&w=800',
                'https://images.unsplash.com/photo-1473446059902-60d9ee6ef44b?auto=format&fit=crop&q=80&w=800',
                'https://images.unsplash.com/photo-1544620347-c4fd4a3d597a?auto=format&fit=crop&q=80&w=800',
                'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&q=80&w=800',
                'https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?auto=format&fit=crop&q=80&w=800',
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($trafficLights as $index => $tl)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 flex flex-col transform transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <!-- Header Card -->
                    <div class="p-5 bg-gradient-to-r from-slate-800 to-slate-900 text-white flex justify-between items-center shadow-md z-10">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <h2 class="text-xl font-bold tracking-wide">{{ $tl->nama_persimpangan }}</h2>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold rounded-full shadow-sm {{ $tl->mode === 'otomatis' ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white' }}">
                            {{ strtoupper($tl->mode) }}
                        </span>
                    </div>
                    
                    <!-- Content Card (Traffic Light + Info) -->
                    <div class="p-6 flex-grow flex items-center justify-between bg-zinc-50 relative overflow-hidden">
                        
                        <!-- BG accent element -->
                        <div class="absolute -right-10 -bottom-10 opacity-5">
                            <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        </div>

                        <!-- Status text -->
                        <div class="flex-1 flex flex-col justify-center">
                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Status Saat Ini</p>
                            <div class="mb-4">
                                <span class="text-2xl font-black {{ 
                                    $tl->status === 'merah' ? 'text-red-600' : 
                                    ($tl->status === 'kuning' ? 'text-yellow-500' : 'text-green-500') 
                                }}">
                                    {{ strtoupper($tl->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Traffic Light Visual -->
                        <div class="bg-black p-3.5 rounded-3xl flex flex-col gap-3 shadow-[inset_0_2px_10px_rgba(255,255,255,0.2),0_10px_20px_rgba(0,0,0,0.3)] border border-gray-800 z-10 w-24">
                            <!-- Merah -->
                            <div class="w-14 h-14 rounded-full mx-auto border-2 border-gray-800 transition-all duration-300 {{ $tl->status === 'merah' ? 'bg-red-500 shadow-[0_0_30px_5px_rgba(239,68,68,0.7)]' : 'bg-red-900 opacity-30 shadow-inner' }}"></div>
                            <!-- Kuning -->
                            <div class="w-14 h-14 rounded-full mx-auto border-2 border-gray-800 transition-all duration-300 {{ $tl->status === 'kuning' ? 'bg-yellow-400 shadow-[0_0_30px_5px_rgba(250,204,21,0.7)]' : 'bg-yellow-900 opacity-30 shadow-inner' }}"></div>
                            <!-- Hijau -->
                            <div class="w-14 h-14 rounded-full mx-auto border-2 border-gray-800 transition-all duration-300 {{ $tl->status === 'hijau' ? 'bg-green-500 shadow-[0_0_30px_5px_rgba(34,197,94,0.7)]' : 'bg-green-900 opacity-30 shadow-inner' }}"></div>
                        </div>
                        
                    </div>
                    
                    <!-- CCTV Snapshot Area - Clickable -->
                    <div class="border-t-[3px] border-gray-200 cursor-pointer group/cctv" @click="openCctv('{{ $tl->nama_persimpangan }}', {{ $tl->id }})">
                        <div class="relative w-full h-56 bg-gray-900">
                            @php
                                $imgName = strtolower($tl->nama_persimpangan) . '.jpg';
                                $fallbackUrl = $fallbacks[$index % count($fallbacks)];
                            @endphp
                            
                            <!-- Interactive hover text -->
                            <div class="absolute inset-0 bg-blue-900/30 z-20 flex items-center justify-center opacity-0 group-hover/cctv:opacity-100 transition-opacity backdrop-blur-sm">
                                <div class="bg-black/60 text-white px-4 py-2 rounded-full font-semibold flex items-center gap-2 transform translate-y-4 group-hover/cctv:translate-y-0 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                    Tampilkan Penuh
                                </div>
                            </div>
                            
                            <img 
                                src="http://192.168.1.10/{{ $imgName }}" 
                                id="cctv-{{ $tl->id }}"
                                data-fallback="{{ $fallbackUrl }}"
                                class="w-full h-full object-cover cctv-image opacity-90 transition-all duration-300 group-hover/cctv:opacity-100"
                                alt="CCTV {{ $tl->nama_persimpangan }}"
                                onerror="this.onerror=null; this.src=this.getAttribute('data-fallback'); this.classList.add('is-fallback');"
                            >
                            
                            <!-- Overlays -->
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-4 flex justify-between items-end pointer-events-none">
                                <div class="text-white text-xs font-medium backdrop-blur-sm bg-black/30 px-2 py-1 rounded">
                                    CAM-0{{ $tl->id }}
                                </div>
                                <div class="flex items-center gap-1.5 bg-red-600 shadow-[0_0_10px_rgba(220,38,38,0.5)] text-white px-2 py-0.5 rounded text-[10px] font-bold tracking-wider">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                    REC
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Fullscreen CCTV Modal utilizing Alpine x-show -->
    <div 
        x-show="cctvModal" 
        style="display: none;" 
        class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center bg-black/90 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
    >
        <div class="absolute inset-x-0 top-0 p-6 flex justify-between items-center bg-gradient-to-b from-black/80 to-transparent z-50">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-2 bg-red-600 px-3 py-1.5 rounded text-xs font-bold text-white tracking-widest shadow-[0_0_15px_rgba(220,38,38,0.5)]">
                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                    CCTV LIVE
                </span>
                <h3 class="text-2xl font-bold text-white" x-text="'Persimpangan ' + activeTitle"></h3>
            </div>
            <button @click="cctvModal = false; activeCctv = ''" class="text-white/70 hover:text-white bg-white/10 hover:bg-white/20 p-2 rounded-full transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="relative w-full h-full p-4 md:p-12 lg:p-24 flex items-center justify-center">
            <template x-if="activeCctv">
                <div class="relative w-full max-w-6xl aspect-video rounded-xl overflow-hidden border-2 border-slate-700 shadow-[0_0_50px_rgba(0,0,0,0.8)]">
                    <img :src="activeCctv" class="absolute inset-0 w-full h-full object-cover">
                    <!-- Date overlay info -->
                    <div class="absolute bottom-4 left-4 bg-black/70 backdrop-blur text-white font-mono text-sm px-3 py-1 rounded">
                        <span x-text="new Date().toLocaleString()"></span>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Script for CCTV polling -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            setInterval(() => {
                const images = document.querySelectorAll('.cctv-image');
                const timestamp = new Date().getTime();
                
                images.forEach(img => {
                    if (!img.classList.contains('is-fallback')) {
                        const baseUrl = img.src.split('?')[0];
                        img.src = baseUrl + '?t=' + timestamp;
                    }
                });
                
                const modalWrapper = document.querySelector('[x-data]');
                if(modalWrapper && modalWrapper.__x && modalWrapper.__x.$data && modalWrapper.__x.$data.activeCctv) {
                    let modalUrl = modalWrapper.__x.$data.activeCctv;
                    if(!modalUrl.includes('images.unsplash.com')) {
                        const baseModalUrl = modalUrl.split('?')[0];
                        modalWrapper.__x.$data.activeCctv = baseModalUrl + '?t=' + timestamp;
                    }
                }
            }, 2000);
        });
        
        window.addEventListener('DOMContentLoaded', () => {
             setInterval(() => {
                const images = document.querySelectorAll('.cctv-image');
                const timestamp = new Date().getTime();
                images.forEach(img => {
                    if (!img.classList.contains('is-fallback')) {
                        const baseUrl = img.src.split('?')[0];
                        img.src = baseUrl + '?t=' + timestamp;
                    }
                });
            }, 2000);
        });
    </script>
</div>
