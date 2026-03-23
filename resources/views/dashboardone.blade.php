<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLMS | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root { --primary-blue: #00c3ff; }
        .text-primary { color: var(--primary-blue); }
        .bg-primary { background-color: var(--primary-blue); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 font-sans" x-data="{ view: 'home', isAdmin: true }"> <header class="bg-white border-b p-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" class="w-8 h-8 object-contain">
            <span class="font-bold text-xl text-slate-800">CLMS</span>
        </div>
        <div class="flex items-center gap-4">
            <button class="text-slate-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button>
            <div class="w-8 h-8 bg-primary rounded-full border-2 border-white shadow-sm overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=00c3ff&color=fff" alt="Profile">
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto p-6 pb-24">
        
        <div x-show="view === 'home'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900">Welcome back, {{ Auth::user()->name ?? 'Lance' }}.</h1>
            <p class="text-slate-500 mb-8">Your workstation is ready for your next project.</p>

            <template x-if="isAdmin">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold">Total PCs</p>
                        <p class="text-2xl font-bold text-slate-800">50</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold text-green-500">Available</p>
                        <p class="text-2xl font-bold text-slate-800">32</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold text-orange-500">In Use</p>
                        <p class="text-2xl font-bold text-slate-800">12</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold text-red-500">Maintenance</p>
                        <p class="text-2xl font-bold text-slate-800">6</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold text-primary">Total Users</p>
                        <p class="text-2xl font-bold text-slate-800">124</p>
                    </div>
                </div>
            </template>

            <div class="bg-[#0081a7] rounded-2xl p-8 text-white relative overflow-hidden shadow-lg mb-8">
                <div class="flex items-center gap-2 mb-4">
                    <span class="h-2 w-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold uppercase tracking-widest opacity-80">Active Session</span>
                </div>
                <h2 class="text-2xl font-bold">Workstation PC-042</h2>
                <p class="opacity-70 text-sm">Main Wing - Lab A</p>
                <div class="flex gap-10 mt-6">
                    <div><p class="text-[10px] uppercase opacity-60">Time Elapsed</p><p class="text-xl font-mono">01:42:15</p></div>
                    <div><p class="text-[10px] uppercase opacity-60">Network Load</p><p class="text-xl font-mono">12.4 Mbps</p></div>
                </div>
                <button class="absolute bottom-8 right-8 bg-white text-[#0081a7] px-6 py-2 rounded-lg font-bold text-sm hover:bg-slate-100 transition shadow-md">End Session</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div class="bg-[#2d333b] rounded-xl p-6 font-mono text-xs text-slate-300 shadow-inner">
                    <div class="flex gap-1.5 mb-4">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                    </div>
                    <p><span class="text-white">user@CLMS:~$</span> session --status</p>
                    <p class="text-slate-500">>> Status: Authenticated</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl border border-slate-200">
                    <h3 class="font-bold mb-4">Lab Availability</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between text-xs font-bold"><span>Main Lab A</span><span class="text-primary">12 Free</span></div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full"><div class="bg-primary h-full w-2/3"></div></div>
                    </div>
                </div>
            </div>
        </div>

        
<div x-show="view === 'pcs'" x-cloak x-data="{ openEdit: false, openHistory: false, selectedPC: '' }">
    
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 mb-2" x-text="isAdmin ? 'Manage PCs' : 'Available PCs'"></h1>
            <p class="text-slate-500" x-text="isAdmin ? 'Edit, delete, or monitor PC statuses.' : 'Select a station to reserve or start a session.'"></p>
        </div>
        
        <template x-if="isAdmin">
            <button class="bg-primary text-white px-4 py-2 rounded-lg font-bold text-sm hover:brightness-95 transition flex items-center gap-2 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add New PC
            </button>
        </template>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @for ($i = 1; $i <= 12; $i++)
        <div 
            @click="isAdmin ? (openHistory = true, selectedPC = 'PC-{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}') : null"
            class="bg-white border-2 border-transparent hover:border-primary p-4 rounded-xl text-center transition cursor-pointer shadow-sm group relative">
            
            <template x-if="isAdmin">
                <button 
                    @click.stop="openEdit = true, selectedPC = 'PC-{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}'"
                    class="absolute top-2 right-2 p-1.5 text-slate-300 hover:text-primary bg-slate-50 rounded-md transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                </button>
            </template>

            <div class="w-12 h-12 bg-slate-50 rounded-full mx-auto mb-3 flex items-center justify-center text-slate-400 group-hover:text-primary transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <p class="font-bold text-slate-700">PC-{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</p>
            
            <p class="text-[10px] text-green-500 font-bold uppercase mt-1">Ready</p>
            
            <template x-if="isAdmin">
                <p class="text-[9px] text-slate-400 mt-2 border-t pt-2 italic">Click to view history</p>
            </template>
        </div>
        @endfor
    </div>

    <div x-show="openEdit" class="fixed inset-0 z-[50] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" x-cloak>
        <div @click.away="openEdit = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
            <h3 class="text-xl font-bold mb-4">Edit <span x-text="selectedPC"></span></h3>
            <div class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase">Unit Status</label>
                    <select class="w-full mt-1 p-2 bg-slate-50 border rounded-lg focus:ring-2 focus:ring-primary outline-none">
                        <option value="ready">Active / Ready</option>
                        <option value="maintenance">Under Maintenance</option>
                        <option value="occupied">Occupied</option>
                    </select>
                </div>
                <button @click="openEdit = false" class="w-full bg-primary text-white py-2 rounded-lg font-bold">Save Changes</button>
                <button @click="openEdit = false" class="w-full text-slate-400 text-sm py-1">Cancel</button>
            </div>
        </div>
    </div>

    <div x-show="openHistory" class="fixed inset-0 z-[50] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" x-cloak>
        <div @click.away="openHistory = false" class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-xl">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-xl font-bold">Usage History</h3>
                    <p class="text-sm text-slate-500" x-text="selectedPC"></p>
                </div>
                <button @click="openHistory = false" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                    <div>
                        <p class="font-bold text-sm text-slate-700">Kevin Cabbaroguis</p>
                        <p class="text-[10px] text-slate-400 font-mono">2026-03-20 10:00 AM</p>
                    </div>
                    <span class="text-xs font-bold text-primary">2h 30m</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                    <div>
                        <p class="font-bold text-sm text-slate-700">Mark Banares</p>
                        <p class="text-[10px] text-slate-400 font-mono">2026-03-19 02:15 PM</p>
                    </div>
                    <span class="text-xs font-bold text-primary">1h 15m</span>
                </div>
            </div>
        </div>
    </div>

</div>

        
        <div x-show="view === 'history'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900 mb-2" x-text="isAdmin ? 'PC Usage History' : 'Session History'"></h1>
            <p class="text-slate-500 mb-8">Detailed log of lab activity.</p>

            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <template x-if="isAdmin"><th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">User</th></template>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Unit</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Lab</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr class="hover:bg-blue-50/50">
                            <template x-if="isAdmin"><td class="px-6 py-4 text-slate-700 font-medium text-primary">Kevs Cabarroguis</td></template>
                            <td class="px-6 py-4 font-bold text-slate-700">PC-012</td>
                            <td class="px-6 py-4 text-slate-500">Coding Suite B</td>
                            <td class="px-6 py-4 text-slate-500">Yesterday, 14:20</td>
                            <td class="px-6 py-4 font-mono">2h 25m</td>
                            <td class="px-6 py-4"><span class="bg-slate-100 text-slate-500 px-2 py-0.5 rounded text-[10px] font-bold">Finalized</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="view === 'users'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Manage Users</h1>
            <p class="text-slate-500 mb-8">Grant system permissions or promote users to Admin.</p>

            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Name / Email</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-center">System Permission</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-center">Admin Commands</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Joined Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 text-base">Kevin Cabbaroguis</div>
                                <div class="text-slate-400 text-xs text-primary">cabarroguis.k.bsinfotech@gmail.com</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <input type="checkbox" checked class="w-4 h-4 text-primary rounded border-slate-300 focus:ring-primary">
                            </td>
                            <td class="px-6 py-4 text-center">
                                <input type="checkbox" class="w-4 h-4 text-primary rounded border-slate-300 focus:ring-primary">
                            </td>
                            <td class="px-6 py-4 text-slate-500 uppercase text-[10px] font-bold">Mar 15, 2026</td>
                        </tr>
                        <tr class="hover:bg-slate-50 bg-blue-50/30">
                            <td class="px-6 py-4 border-l-4 border-primary">
                                <div class="font-bold text-slate-800 text-base italic">CLMS MAIN ADMIN

                                </div>
                                <div class="text-slate-400 text-xs">admin@clms.system</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <input type="checkbox" checked disabled class="w-4 h-4 bg-slate-200 rounded border-slate-300">
                            </td>
                            <td class="px-6 py-4 text-center">
                                <input type="checkbox" checked disabled class="w-4 h-4 bg-slate-200 rounded border-slate-300">
                            </td>
                            <td class="px-6 py-4 text-slate-500 uppercase text-[10px] font-bold">Jan 01, 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t p-2 flex justify-around items-center z-30 shadow-[0_-4px_10px_rgba(0,0,0,0.05)]">
        <button @click="view = 'home'" :class="view === 'home' ? 'text-primary' : 'text-slate-400'" class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"></path></svg>
            <span class="text-[10px] font-bold mt-1">Dashboard</span>
        </button>
        
        <button @click="view = 'pcs'" :class="view === 'pcs' ? 'text-primary' : 'text-slate-400'" class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            <span class="text-[10px] font-bold mt-1">PCs</span>
        </button>
        
        <template x-if="isAdmin">
            <button @click="view = 'users'" :class="view === 'users' ? 'text-primary' : 'text-slate-400'" class="flex flex-col items-center p-2 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span class="text-[10px] font-bold mt-1">Users</span>
            </button>
        </template>
    
        <button @click="view = 'history'" :class="view === 'history' ? 'text-primary' : 'text-slate-400'" class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-[10px] font-bold mt-1">History</span>
        </button>
    
        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex flex-col items-center p-2 text-slate-400 hover:text-red-500 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="text-[10px] font-bold mt-1">Logout</span>
            </button>
        </form>
    </nav>

</body>
</html>