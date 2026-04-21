<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLMS | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary-blue: #00c3ff;
        }

        .text-primary {
            color: var(--primary-blue);
        }

        .bg-primary {
            background-color: var(--primary-blue);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans" x-data="{ view: 'home', isAdmin: @json(in_array(Auth::user()->role_id, [0, 1])), isDeveloper: @json(Auth::user()->role_id === 0) }">
    <header class="bg-white border-b p-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" class="w-8 h-8 object-contain">
            <span class="font-bold text-xl text-slate-800">CLMS</span>
        </div>
        <div class="flex items-center gap-4">
            <button class="text-slate-400"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg></button>
            <div class="w-8 h-8 bg-primary rounded-full border-2 border-white shadow-sm overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=00c3ff&color=fff"
                    alt="Profile">
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto p-6 pb-24">

        <div x-show="view === 'home'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900">Welcome back, {{ Auth::user()->name ?? 'Lance' }}.</h1>
            <p class="text-slate-500 mb-8">Your workstation is ready for your next project.</p>

            <template x-if="isAdmin">
                @php
                    $totalPCs = \App\Models\PC::count();
                    $availablePCs = \App\Models\PC::where('status', 'ready')->count();
                    $inUsePCs = \App\Models\PC::where('status', 'occupied')->count();
                    $maintenancePCs = \App\Models\PC::where('status', 'maintenance')->count();
                    $totalUsers = \App\Models\User::count();
                @endphp
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold">Total PCs</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalPCs }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold text-green-500">Available</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $availablePCs }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold text-orange-500">In Use</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $inUsePCs }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold text-red-500">Maintenance</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $maintenancePCs }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <p class="text-slate-500 text-[10px] uppercase font-bold text-primary">Total Users</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalUsers }}</p>
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
                    <div>
                        <p class="text-[10px] uppercase opacity-60">Time Elapsed</p>
                        <p class="text-xl font-mono">01:42:15</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase opacity-60">Network Load</p>
                        <p class="text-xl font-mono">12.4 Mbps</p>
                    </div>
                </div>
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="absolute bottom-8 right-8 bg-white text-[#0081a7] px-6 py-2 rounded-lg font-bold text-sm hover:bg-slate-100 transition shadow-md">End
                        Session</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#2d333b] rounded-xl p-6 font-mono text-xs text-slate-300 shadow-inner">
                    <div class="flex gap-1.5 mb-4">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-500"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                    </div>
                    <template x-if="isDeveloper">
                        <div>
                            <p><span class="text-white">developer@CLMS:~$</span> logs --admin-activity</p>
                            @php
                                $adminLogs = \App\Models\AdminLog::with('admin')
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            @forelse($adminLogs as $log)
                                <p class="text-slate-500">>> [{{ $log->admin->name ?? 'Unknown Admin' }}]
                                    {{ $log->description ?? $log->action }}
                                    ({{ \Carbon\Carbon::parse($log->created_at)->format('M d, H:i') }})</p>
                            @empty
                                <p class="text-slate-500">>> No recent admin activities</p>
                            @endforelse
                        </div>
                    </template>
                    <template x-if="!isDeveloper">
                        <div>
                            <p><span class="text-white">user@CLMS:~$</span> session --status</p>
                            <p class="text-slate-500">>> Status: Authenticated</p>
                        </div>
                    </template>
                </div>

                <div class="bg-white p-6 rounded-xl border border-slate-200">
                    <h3 class="font-bold mb-4">Lab Availability</h3>
                    <div class="space-y-4">
                        @php
                            $totalPCsLab = \App\Models\PC::count();
                            $freePCsLab = \App\Models\PC::where('status', 'ready')->count();
                            $percentageFree = $totalPCsLab > 0 ? round(($freePCsLab / $totalPCsLab) * 100) : 0;
                        @endphp
                        <div class="flex justify-between text-xs font-bold"><span>Main Lab A</span><span
                                class="text-primary">{{ $freePCsLab }}/{{ $totalPCsLab }} Free</span></div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full">
                            <div class="bg-primary h-full" style="width: {{ $percentageFree }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div x-show="view === 'pcs'" x-cloak x-data="{ openEdit: false, openHistory: false, selectedPC: '', selectedPCId: null, pcStatus: '', openAddPC: false, newPCName: '', confirmRemove: false, removePCId: null }">

            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 mb-2"
                        x-text="isAdmin ? 'Manage PCs' : 'Available PCs'"></h1>
                    <p class="text-slate-500"
                        x-text="isAdmin ? 'Edit, delete, or monitor PC statuses.' : 'Select a station to reserve or start a session.'">
                    </p>
                </div>

                <template x-if="isAdmin">
                    <button @click="openAddPC = true"
                        class="bg-primary text-white px-4 py-2 rounded-lg font-bold text-sm hover:brightness-95 transition flex items-center gap-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New PC
                    </button>
                </template>
            </div>

            @php
                $allPCs = \App\Models\PC::orderBy('pc_name')->get();
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @forelse($allPCs as $pc)
                    <div @click="isAdmin ? (openHistory = true, selectedPC = '{{ $pc->pc_name }}') : null"
                        class="bg-white border-2 border-transparent hover:border-primary p-4 rounded-xl text-center transition cursor-pointer shadow-sm group relative">

                        <template x-if="isAdmin">
                            <div class="absolute top-2 right-2 flex gap-1">
                                <button
                                    @click.stop="openEdit = true, selectedPC = '{{ $pc->pc_name }}', selectedPCId = {{ $pc->id }}, pcStatus = '{{ $pc->status }}'"
                                    class="p-1.5 text-slate-300 hover:text-primary bg-slate-50 rounded-md transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                        </path>
                                    </svg>
                                </button>
                                <button @click.stop="confirmRemove = true, removePCId = {{ $pc->id }}"
                                    class="p-1.5 text-slate-300 hover:text-red-500 bg-slate-50 rounded-md transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </template>

                        <div
                            class="w-12 h-12 bg-slate-50 rounded-full mx-auto mb-3 flex items-center justify-center text-slate-400 group-hover:text-primary transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="font-bold text-slate-700">{{ $pc->pc_name }}</p>

                        <p
                            class="text-[10px] font-bold uppercase mt-1
                            @if ($pc->status === 'ready') text-green-500
                            @elseif($pc->status === 'occupied') text-orange-500
                            @else text-red-500 @endif">
                            @if ($pc->status === 'ready')
                                Ready
                            @elseif($pc->status === 'occupied')
                                Occupied
                            @else
                                Maintenance
                            @endif
                        </p>

                        <template x-if="isAdmin">
                            <p class="text-[9px] text-slate-400 mt-2 border-t pt-2 italic">Click to view history</p>
                        </template>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 text-slate-500">
                        <p>No PCs added yet. Click "Add New PC" to get started.</p>
                    </div>
                @endforelse
            </div>

            <!-- Edit PC Status Modal -->
            <div x-show="openEdit"
                class="fixed inset-0 z-[50] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
                x-cloak>
                <div @click.away="openEdit = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
                    <h3 class="text-xl font-bold mb-4">Edit <span x-text="selectedPC"></span></h3>
                    <form :action="`{{ url('/pcs/update-status') }}`" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="pc_id" :value="selectedPCId">
                        <div>
                            <label class="text-xs font-bold text-slate-500 uppercase">Unit Status</label>
                            <select name="status" x-model="pcStatus"
                                class="w-full mt-1 p-2 bg-slate-50 border rounded-lg focus:ring-2 focus:ring-primary outline-none">
                                <option value="ready">Active / Ready</option>
                                <option value="maintenance">Under Maintenance</option>
                                <option value="occupied">Occupied</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-bold">Save
                            Changes</button>
                        <button type="button" @click="openEdit = false"
                            class="w-full text-slate-400 text-sm py-1">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- Add PC Modal -->
            <div x-show="openAddPC"
                class="fixed inset-0 z-[50] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
                x-cloak>
                <div @click.away="openAddPC = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
                    <h3 class="text-xl font-bold mb-4">Add New PC</h3>
                    <form action="{{ url('/pcs/add') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="text-xs font-bold text-slate-500 uppercase">PC Name</label>
                            <input type="text" name="pc_name" x-model="newPCName" placeholder="e.g., PC-001"
                                class="w-full mt-1 p-2 bg-slate-50 border rounded-lg focus:ring-2 focus:ring-primary outline-none"
                                required>
                        </div>
                        <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-bold">Add
                            PC</button>
                        <button type="button" @click="openAddPC = false"
                            class="w-full text-slate-400 text-sm py-1">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- Remove PC Confirmation Modal -->
            <div x-show="confirmRemove"
                class="fixed inset-0 z-[50] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
                x-cloak>
                <div @click.away="confirmRemove = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
                    <h3 class="text-xl font-bold mb-4 text-red-500">Confirm PC Removal</h3>
                    <p class="text-slate-600 mb-6">Are you sure you want to remove this PC from the system?</p>
                    <div class="flex gap-3">
                        <form :action="`{{ url('/pcs/remove') }}`" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="pc_id" :value="removePCId">
                            <button type="submit"
                                class="w-full bg-red-500 text-white py-2 rounded-lg font-bold hover:bg-red-600 transition">
                                Yes, Remove PC
                            </button>
                        </form>
                        <button @click="confirmRemove = false"
                            class="flex-1 bg-slate-200 text-slate-800 py-2 rounded-lg font-bold hover:bg-slate-300 transition">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Usage History Modal -->
            <div x-show="openHistory"
                class="fixed inset-0 z-[50] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
                x-cloak>
                <div @click.away="openHistory = false" class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-bold">Usage History</h3>
                            <p class="text-sm text-slate-500" x-text="selectedPC"></p>
                        </div>
                        <button @click="openHistory = false" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
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


        <div x-show="view === 'requests'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Account Creation Requests</h1>
            <p class="text-slate-500 mb-8">Review and approve pending account creation requests.</p>

            @php
                $pendingRequests = \App\Models\AccountRequest::orderBy('created_at', 'desc')->get();
            @endphp

            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Requested</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($pendingRequests as $request)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $request->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">{{ $request->email }}</td>
                                <td class="px-6 py-4 text-slate-500 uppercase text-[10px] font-bold">
                                    {{ \Carbon\Carbon::parse($request->created_at)->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 text-center flex gap-2">
                                    <form action="{{ url('/account-requests/approve') }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                                        <button type="submit"
                                            class="bg-green-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-green-600 transition">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="{{ url('/account-requests/reject') }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <input type="hidden" name="request_id" value="{{ $request->id }}">
                                        <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-red-600 transition">
                                            Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                    No pending account requests
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <div x-show="view === 'history'" x-cloak>
            <h1 class="text-3xl font-bold text-slate-900 mb-2"
                x-text="isAdmin ? 'PC Usage History' : 'Session History'"></h1>
            <p class="text-slate-500 mb-8">Detailed log of lab activity.</p>

            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <template x-if="isAdmin">
                                <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">User</th>
                            </template>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Unit</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Lab</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr class="hover:bg-blue-50/50">
                            <template x-if="isAdmin">
                                <td class="px-6 py-4 text-slate-700 font-medium text-primary">Kevs Cabarroguis</td>
                            </template>
                            <td class="px-6 py-4 font-bold text-slate-700">PC-012</td>
                            <td class="px-6 py-4 text-slate-500">Coding Suite B</td>
                            <td class="px-6 py-4 text-slate-500">Yesterday, 14:20</td>
                            <td class="px-6 py-4 font-mono">2h 25m</td>
                            <td class="px-6 py-4"><span
                                    class="bg-slate-100 text-slate-500 px-2 py-0.5 rounded text-[10px] font-bold">Finalized</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="view === 'users'" x-cloak x-data="{ confirmRemove: false, removeUserId: null }">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Manage Users</h1>
            <p class="text-slate-500 mb-8">Developer can assign Developer/Admin/User permissions from here.</p>

            @php
                $allUsers = \App\Models\User::orderBy('id')->get();
            @endphp

            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Name / Email</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-center">
                                Developer</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider text-center">Admin
                            </th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Joined Date</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($allUsers as $managedUser)
                            <tr class="hover:bg-slate-50">
                                <form action="{{ url('/manage-users/update') }}" method="POST" class="w-full">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $managedUser->id }}">
                                    <input type="hidden" name="role" id="role-{{ $managedUser->id }}"
                                        value="{{ $managedUser->role_id }}">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800 text-base">{{ $managedUser->name }}</div>
                                        <div class="text-slate-400 text-xs">{{ $managedUser->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" id="dev-{{ $managedUser->id }}"
                                            class="w-4 h-4 text-primary rounded border-slate-300 focus:ring-primary role-check"
                                            data-user="{{ $managedUser->id }}" data-role="0"
                                            {{ $managedUser->role_id === 0 ? 'checked' : '' }}>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" id="admin-{{ $managedUser->id }}"
                                            class="w-4 h-4 text-primary rounded border-slate-300 focus:ring-primary role-check"
                                            data-user="{{ $managedUser->id }}" data-role="1"
                                            {{ $managedUser->role_id === 1 ? 'checked' : '' }}>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 uppercase text-[10px] font-bold">
                                        {{ $managedUser->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-center flex gap-2">
                                        <button type="submit"
                                            class="bg-primary text-white px-3 py-1 rounded-lg text-xs">Save</button>
                                        <button type="button"
                                            @click="confirmRemove = true; removeUserId = {{ $managedUser->id }}"
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs hover:bg-red-600 transition">Remove</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Remove User Confirmation Modal -->
            <div x-show="confirmRemove"
                class="fixed inset-0 z-[50] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm"
                x-cloak>
                <div @click.away="confirmRemove = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
                    <h3 class="text-xl font-bold mb-4 text-red-500">Confirm User Removal</h3>
                    <p class="text-slate-600 mb-6">Are you really sure you want to permanently remove this user from
                        the system? This action cannot be undone and will delete all their data from the database.</p>
                    <div class="flex gap-3">
                        <form :action="`{{ url('/manage-users/remove') }}`" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="user_id" :value="removeUserId">
                            <button type="submit"
                                class="w-full bg-red-500 text-white py-2 rounded-lg font-bold hover:bg-red-600 transition">
                                Yes, Remove User
                            </button>
                        </form>
                        <button @click="confirmRemove = false"
                            class="flex-1 bg-slate-200 text-slate-800 py-2 rounded-lg font-bold hover:bg-slate-300 transition">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <nav
        class="fixed bottom-0 left-0 right-0 bg-white border-t p-2 flex justify-around items-center z-30 shadow-[0_-4px_10px_rgba(0,0,0,0.05)]">
        <button @click="view = 'home'" :class="view === 'home' ? 'text-primary' : 'text-slate-400'"
            class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"></path>
            </svg>
            <span class="text-[10px] font-bold mt-1">Dashboard</span>
        </button>

        <button @click="view = 'pcs'" :class="view === 'pcs' ? 'text-primary' : 'text-slate-400'"
            class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path
                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                </path>
            </svg>
            <span class="text-[10px] font-bold mt-1">PCs</span>
        </button>

        <template x-if="isDeveloper">
            <button @click="view = 'users'" :class="view === 'users' ? 'text-primary' : 'text-slate-400'"
                class="flex flex-col items-center p-2 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <span class="text-[10px] font-bold mt-1">Users</span>
            </button>
        </template>

        <button @click="view = 'history'" :class="view === 'history' ? 'text-primary' : 'text-slate-400'"
            class="flex flex-col items-center p-2 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-[10px] font-bold mt-1">History</span>
        </button>

        <template x-if="isAdmin">
            <button @click="view = 'requests'" :class="view === 'requests' ? 'text-primary' : 'text-slate-400'"
                class="flex flex-col items-center p-2 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-[10px] font-bold mt-1">Requests</span>
            </button>
        </template>
    </nav>

    <script>
        document.querySelectorAll('.role-check').forEach((checkbox) => {
            checkbox.addEventListener('change', (event) => {
                const userId = event.target.dataset.user;
                const role = parseInt(event.target.dataset.role, 10);
                const devControl = document.getElementById(`dev-${userId}`);
                const adminControl = document.getElementById(`admin-${userId}`);
                const roleInput = document.getElementById(`role-${userId}`);

                if (role === 0) {
                    if (event.target.checked) {
                        adminControl.checked = false;
                        roleInput.value = 0;
                    } else {
                        roleInput.value = 2;
                    }
                }

                if (role === 1) {
                    if (event.target.checked) {
                        devControl.checked = false;
                        roleInput.value = 1;
                    } else {
                        roleInput.value = 2;
                    }
                }
            });
        });
    </script>

</body>

</html>
