<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Premium Task Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif;
        }
        /* Custom Scrollbars */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.05);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.3);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(148, 163, 184, 0.5);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col antialiased selection:bg-violet-500 selection:text-white bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-slate-900 via-slate-950 to-slate-950">

    <div x-data="taskDashboard()" class="flex-grow flex flex-col pb-16" x-cloak>
        
        <!-- Premium Navbar Header -->
        <header class="sticky top-0 z-40 border-b border-slate-800/60 bg-slate-950/80 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-violet-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-violet-500/25">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-white via-slate-100 to-slate-300 bg-clip-text text-transparent">TaskFlow</span>
                        <span class="hidden sm:inline-block text-[10px] uppercase font-semibold tracking-wider text-violet-400 bg-violet-500/10 px-2 py-0.5 rounded-full ml-2 border border-violet-500/20">Dashboard v1.1</span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Current Date Display -->
                    <div class="hidden md:flex items-center gap-2 text-xs text-slate-400 bg-slate-900/60 border border-slate-800/80 px-3 py-1.5 rounded-lg">
                        <svg class="w-3.5 h-3.5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span x-text="new Date().toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' })"></span>
                    </div>
                    
                    <button @click="isCreateModalOpen = true" class="px-4 py-2 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-500 hover:to-indigo-500 shadow-md shadow-violet-600/15 hover:shadow-violet-600/30 transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New Task
                    </button>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 flex-grow w-full flex flex-col gap-8">
            
            <!-- Statistics KPI Cards -->
            <section class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Tasks -->
                <div class="relative overflow-hidden rounded-2xl bg-slate-900/50 border border-slate-800/80 p-5 shadow-sm transition-all duration-300 hover:border-slate-700/60">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-400">Total Tasks</span>
                        <span class="p-2 rounded-xl bg-slate-800/60 text-slate-350">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </span>
                    </div>
                    <div class="mt-3 flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-white tracking-tight" x-text="stats.total">0</span>
                    </div>
                </div>

                <!-- Pending -->
                <div class="relative overflow-hidden rounded-2xl bg-slate-900/50 border border-slate-800/80 p-5 shadow-sm transition-all duration-300 hover:border-slate-700/60">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-400">Pending</span>
                        <span class="p-2 rounded-xl bg-amber-500/10 text-amber-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                    </div>
                    <div class="mt-3 flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-white tracking-tight" x-text="stats.pending">0</span>
                    </div>
                </div>

                <!-- In Progress -->
                <div class="relative overflow-hidden rounded-2xl bg-slate-900/50 border border-slate-800/80 p-5 shadow-sm transition-all duration-300 hover:border-slate-700/60">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-400">In Progress</span>
                        <span class="p-2 rounded-xl bg-blue-500/10 text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                    </div>
                    <div class="mt-3 flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-white tracking-tight" x-text="stats.inProgress">0</span>
                    </div>
                </div>

                <!-- Completed -->
                <div class="relative overflow-hidden rounded-2xl bg-slate-900/50 border border-slate-800/80 p-5 shadow-sm transition-all duration-300 hover:border-slate-700/60">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-400">Completed</span>
                        <span class="p-2 rounded-xl bg-emerald-500/10 text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                    </div>
                    <div class="mt-3 flex items-baseline justify-between w-full">
                        <span class="text-3xl font-bold text-white tracking-tight" x-text="stats.completed">0</span>
                        <div class="text-right">
                            <span class="text-xs font-semibold text-emerald-400" x-text="stats.completionRate + '%'">0%</span>
                            <span class="block text-[10px] text-slate-500">Done</span>
                        </div>
                    </div>
                    <!-- Small progress bar bottom inside completed card -->
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-slate-800">
                        <div class="h-full bg-emerald-500 transition-all duration-500 ease-out" :style="{ width: stats.completionRate + '%' }"></div>
                    </div>
                </div>
            </section>

            <!-- Filters, Search & View Switcher Panel -->
            <section class="bg-slate-900/40 border border-slate-800/70 rounded-2xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                
                <!-- Search and Sorting -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-grow max-w-2xl">
                    <!-- Search Input -->
                    <div class="relative flex-grow">
                        <input x-model="searchQuery" type="text" placeholder="Filter by title or description..." 
                            class="w-full bg-slate-950 border border-slate-800 hover:border-slate-700/80 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 text-slate-100 placeholder-slate-500 text-sm px-4 py-2 pl-10 rounded-xl transition-all outline-none">
                        <span class="absolute left-3.5 top-3 text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <!-- Clear Search Button -->
                        <button x-show="searchQuery" @click="searchQuery = ''" class="absolute right-3.5 top-3 text-slate-500 hover:text-slate-350">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <!-- Sorting Dropdown -->
                    <div class="relative min-w-[150px]">
                        <select x-model="sortBy" class="w-full appearance-none bg-slate-950 border border-slate-800 hover:border-slate-700/80 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 text-slate-300 text-xs px-4 py-2.5 pr-8 rounded-xl transition-all outline-none">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="alphabetical">Alphabetical (A-Z)</option>
                        </select>
                        <span class="absolute right-3 top-3.5 text-slate-500 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </div>
                </div>

                <!-- Tabs & View Switching -->
                <div class="flex items-center justify-between sm:justify-start gap-4">
                    <!-- Status Filter Tabs -->
                    <div class="flex bg-slate-950 p-1 rounded-xl border border-slate-800/80">
                        <button @click="statusFilter = 'All'" :class="statusFilter === 'All' ? 'bg-slate-800 text-white font-medium shadow-sm' : 'text-slate-400 hover:text-slate-200'" class="px-3 py-1.5 rounded-lg text-xs transition-all">
                            All
                        </button>
                        <button @click="statusFilter = 'Pending'" :class="statusFilter === 'Pending' ? 'bg-amber-500/10 text-amber-400 font-medium' : 'text-slate-400 hover:text-slate-200'" class="px-3 py-1.5 rounded-lg text-xs transition-all">
                            Pending
                        </button>
                        <button @click="statusFilter = 'In Progress'" :class="statusFilter === 'In Progress' ? 'bg-blue-500/10 text-blue-400 font-medium' : 'text-slate-400 hover:text-slate-200'" class="px-3 py-1.5 rounded-lg text-xs transition-all">
                            Active
                        </button>
                        <button @click="statusFilter = 'Completed'" :class="statusFilter === 'Completed' ? 'bg-emerald-500/10 text-emerald-400 font-medium' : 'text-slate-400 hover:text-slate-200'" class="px-3 py-1.5 rounded-lg text-xs transition-all">
                            Done
                        </button>
                    </div>

                    <!-- View Switcher -->
                    <div class="flex bg-slate-950 p-1 rounded-xl border border-slate-800/80">
                        <!-- Kanban View Button -->
                        <button @click="currentView = 'kanban'; statusFilter = 'All'" :class="currentView === 'kanban' ? 'bg-slate-800 text-violet-400 shadow-sm' : 'text-slate-400 hover:text-slate-200'" class="p-1.5 rounded-lg transition-all" title="Kanban Board">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
                        </button>
                        <!-- List View Button -->
                        <button @click="currentView = 'list'" :class="currentView === 'list' ? 'bg-slate-800 text-violet-400 shadow-sm' : 'text-slate-400 hover:text-slate-200'" class="p-1.5 rounded-lg transition-all" title="List View">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>
                </div>
            </section>

            <!-- Task Display Section -->
            <section class="flex-grow flex flex-col">
                
                <!-- 1. KANBAN BOARD VIEW -->
                <div x-show="currentView === 'kanban'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start flex-grow">
                    
                    <!-- PENDING COLUMN -->
                    <div class="flex flex-col bg-slate-900/20 border border-slate-800/60 rounded-2xl p-4 min-h-[500px]" x-show="statusFilter === 'All' || statusFilter === 'Pending'">
                        <!-- Header -->
                        <div class="flex items-center justify-between pb-3.5 mb-4 border-b border-slate-800/80">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-sm shadow-amber-500/50"></span>
                                <h3 class="font-bold text-slate-200 tracking-wide text-sm">Pending</h3>
                                <span class="text-xs bg-slate-800 text-slate-400 px-2 py-0.5 rounded-md font-semibold ml-1" x-text="tasks.filter(t => t.status === 'Pending').length">0</span>
                            </div>
                        </div>
                        
                        <!-- Cards List -->
                        <div class="space-y-3 flex-grow overflow-y-auto max-h-[600px] pr-1">
                            <template x-for="task in filteredTasks.filter(t => t.status === 'Pending')" :key="task.id">
                                <div class="bg-slate-900/60 border border-slate-800 hover:border-slate-700/80 hover:bg-slate-900 p-4 rounded-xl transition-all duration-200 shadow-sm group hover:-translate-y-0.5">
                                    <div class="flex items-start justify-between gap-3">
                                        <h4 class="font-semibold text-slate-100 text-sm group-hover:text-violet-400 transition-colors" x-text="task.title"></h4>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-2 line-clamp-3 leading-relaxed" x-text="task.description || 'No description provided.'"></p>
                                    
                                    <div class="mt-4 pt-3.5 border-t border-slate-800 flex items-center justify-between gap-2">
                                        <span class="text-[10px] text-slate-500" x-text="formatDate(task.created_at)"></span>
                                        <div class="flex items-center gap-1.5">
                                            <button @click="openEditModal(task)" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-350 hover:bg-slate-800 transition-all" title="Edit Task">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                            <button @click="confirmDelete(task.id)" class="p-1.5 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-all" title="Delete Task">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                            <!-- Transition Button to In Progress -->
                                            <button @click="updateStatus(task.id, 'In Progress')" class="p-1.5 rounded-lg text-amber-500 hover:text-white hover:bg-amber-500 transition-all ml-1" title="Start Progress">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="filteredTasks.filter(t => t.status === 'Pending').length === 0" class="h-28 border border-dashed border-slate-800 rounded-xl flex items-center justify-center text-xs text-slate-500">
                                No pending tasks
                            </div>
                        </div>
                    </div>

                    <!-- IN PROGRESS COLUMN -->
                    <div class="flex flex-col bg-slate-900/20 border border-slate-800/60 rounded-2xl p-4 min-h-[500px]" x-show="statusFilter === 'All' || statusFilter === 'In Progress'">
                        <!-- Header -->
                        <div class="flex items-center justify-between pb-3.5 mb-4 border-b border-slate-800/80">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-sm shadow-blue-500/50"></span>
                                <h3 class="font-bold text-slate-200 tracking-wide text-sm">In Progress</h3>
                                <span class="text-xs bg-slate-800 text-slate-400 px-2 py-0.5 rounded-md font-semibold ml-1" x-text="tasks.filter(t => t.status === 'In Progress').length">0</span>
                            </div>
                        </div>
                        
                        <!-- Cards List -->
                        <div class="space-y-3 flex-grow overflow-y-auto max-h-[600px] pr-1">
                            <template x-for="task in filteredTasks.filter(t => t.status === 'In Progress')" :key="task.id">
                                <div class="bg-slate-900/60 border border-slate-800 hover:border-slate-700/80 hover:bg-slate-900 p-4 rounded-xl transition-all duration-200 shadow-sm group hover:-translate-y-0.5">
                                    <div class="flex items-start justify-between gap-3">
                                        <h4 class="font-semibold text-slate-100 text-sm group-hover:text-violet-400 transition-colors" x-text="task.title"></h4>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-2 line-clamp-3 leading-relaxed" x-text="task.description || 'No description provided.'"></p>
                                    
                                    <div class="mt-4 pt-3.5 border-t border-slate-800 flex items-center justify-between gap-2">
                                        <span class="text-[10px] text-slate-500" x-text="formatDate(task.created_at)"></span>
                                        <div class="flex items-center gap-1.5">
                                            <!-- Move back to Pending -->
                                            <button @click="updateStatus(task.id, 'Pending')" class="p-1.5 rounded-lg text-slate-500 hover:text-white hover:bg-slate-800 transition-all" title="Move back to Pending">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7M19 19l-7-7 7-7"></path></svg>
                                            </button>
                                            <button @click="openEditModal(task)" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-350 hover:bg-slate-800 transition-all" title="Edit Task">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                            <button @click="confirmDelete(task.id)" class="p-1.5 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-all" title="Delete Task">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                            <!-- Complete task -->
                                            <button @click="updateStatus(task.id, 'Completed')" class="p-1.5 rounded-lg text-emerald-500 hover:text-white hover:bg-emerald-500 transition-all ml-1" title="Mark as Completed">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="filteredTasks.filter(t => t.status === 'In Progress').length === 0" class="h-28 border border-dashed border-slate-800 rounded-xl flex items-center justify-center text-xs text-slate-500">
                                No active tasks
                            </div>
                        </div>
                    </div>

                    <!-- COMPLETED COLUMN -->
                    <div class="flex flex-col bg-slate-900/20 border border-slate-800/60 rounded-2xl p-4 min-h-[500px]" x-show="statusFilter === 'All' || statusFilter === 'Completed'">
                        <!-- Header -->
                        <div class="flex items-center justify-between pb-3.5 mb-4 border-b border-slate-800/80">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span>
                                <h3 class="font-bold text-slate-200 tracking-wide text-sm">Completed</h3>
                                <span class="text-xs bg-slate-800 text-slate-400 px-2 py-0.5 rounded-md font-semibold ml-1" x-text="tasks.filter(t => t.status === 'Completed').length">0</span>
                            </div>
                        </div>
                        
                        <!-- Cards List -->
                        <div class="space-y-3 flex-grow overflow-y-auto max-h-[600px] pr-1">
                            <template x-for="task in filteredTasks.filter(t => t.status === 'Completed')" :key="task.id">
                                <div class="bg-slate-900/60 border border-slate-800 hover:border-slate-700/80 hover:bg-slate-900 p-4 rounded-xl transition-all duration-200 shadow-sm group hover:-translate-y-0.5">
                                    <div class="flex items-start justify-between gap-3">
                                        <h4 class="font-semibold text-slate-350 line-through text-sm group-hover:text-emerald-400 transition-colors" x-text="task.title"></h4>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed" x-text="task.description || 'No description provided.'"></p>
                                    
                                    <div class="mt-4 pt-3.5 border-t border-slate-800 flex items-center justify-between gap-2">
                                        <span class="text-[10px] text-slate-500" x-text="formatDate(task.created_at)"></span>
                                        <div class="flex items-center gap-1.5">
                                            <!-- Move back to Active -->
                                            <button @click="updateStatus(task.id, 'In Progress')" class="p-1.5 rounded-lg text-slate-500 hover:text-white hover:bg-slate-800 transition-all" title="Reopen Task">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8.89M9 11l3-3 3 3m-3-3v12"></path></svg>
                                            </button>
                                            <button @click="openEditModal(task)" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-350 hover:bg-slate-800 transition-all" title="Edit Task">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                            <button @click="confirmDelete(task.id)" class="p-1.5 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-all" title="Delete Task">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="filteredTasks.filter(t => t.status === 'Completed').length === 0" class="h-28 border border-dashed border-slate-800 rounded-xl flex items-center justify-center text-xs text-slate-500">
                                No completed tasks
                            </div>
                        </div>
                    </div>

                </div>

                <!-- 2. DETAILED LIST VIEW -->
                <div x-show="currentView === 'list'" class="bg-slate-900/20 border border-slate-800/60 rounded-2xl overflow-hidden flex-grow shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-800 bg-slate-900/30">
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Task Title</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Description</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Date Created</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400">Status</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-400 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800">
                                <template x-for="task in filteredTasks" :key="task.id">
                                    <tr class="hover:bg-slate-900/20 transition-colors">
                                        <!-- Title -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span :class="task.status === 'Completed' ? 'line-through text-slate-400' : 'text-slate-100'" class="text-sm font-semibold" x-text="task.title"></span>
                                        </td>
                                        <!-- Description -->
                                        <td class="px-6 py-4">
                                            <p class="text-xs text-slate-400 line-clamp-1 max-w-[280px]" x-text="task.description || '-'"></p>
                                        </td>
                                        <!-- Date -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-xs text-slate-500" x-text="formatDate(task.created_at)"></span>
                                        </td>
                                        <!-- Status Badge & Dropdown Selector -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="relative inline-block text-left">
                                                <select @change="updateStatus(task.id, $event.target.value)" 
                                                    class="text-xs font-medium rounded-lg px-2.5 py-1.5 border-0 focus:ring-2 focus:ring-violet-500 outline-none appearance-none cursor-pointer pr-7 transition-colors shadow-sm"
                                                    :class="{
                                                        'bg-amber-500/10 text-amber-400': task.status === 'Pending',
                                                        'bg-blue-500/10 text-blue-400': task.status === 'In Progress',
                                                        'bg-emerald-500/10 text-emerald-400': task.status === 'Completed'
                                                    }">
                                                    <option value="Pending" :selected="task.status === 'Pending'" class="bg-slate-950 text-slate-300">Pending</option>
                                                    <option value="In Progress" :selected="task.status === 'In Progress'" class="bg-slate-950 text-slate-300">In Progress</option>
                                                    <option value="Completed" :selected="task.status === 'Completed'" class="bg-slate-950 text-slate-300">Completed</option>
                                                </select>
                                                <span class="absolute right-2 top-3 pointer-events-none text-xs" :class="{
                                                    'text-amber-400': task.status === 'Pending',
                                                    'text-blue-400': task.status === 'In Progress',
                                                    'text-emerald-400': task.status === 'Completed'
                                                }">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                                </span>
                                            </div>
                                        </td>
                                        <!-- Action Buttons -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="inline-flex items-center gap-1 justify-end w-full">
                                                <button @click="openEditModal(task)" class="p-1.5 rounded-lg text-slate-500 hover:text-slate-300 hover:bg-slate-800 transition-all" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </button>
                                                <button @click="confirmDelete(task.id)" class="p-1.5 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-all" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="filteredTasks.length === 0">
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500">
                                        No matching tasks found. Adjust filters or create a new task!
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>

        </main>

        <!-- CREATE TASK MODAL -->
        <div x-show="isCreateModalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Backdrop with blur -->
                <div x-show="isCreateModalOpen" x-transition.opacity class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" @click="isCreateModalOpen = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal Content -->
                <div x-show="isCreateModalOpen" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative z-10 inline-block align-bottom bg-slate-900 border border-slate-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    
                    <form @submit.prevent="createTask()">
                        <div class="p-6">
                            <div class="flex items-center justify-between pb-3.5 mb-5 border-b border-slate-800/80">
                                <h3 class="text-base font-bold text-white tracking-wide" id="modal-title">Create New Task</h3>
                                <button type="button" @click="isCreateModalOpen = false" class="text-slate-500 hover:text-slate-350 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Task Title <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="newTask.title" required placeholder="What needs to be done?"
                                        class="w-full bg-slate-950 border border-slate-800 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 text-slate-200 text-sm px-4 py-2.5 rounded-xl transition-all outline-none">
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Description</label>
                                    <textarea x-model="newTask.description" rows="3.5" placeholder="Add detailed notes or requirements..."
                                        class="w-full bg-slate-950 border border-slate-800 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 text-slate-200 text-sm px-4 py-2.5 rounded-xl transition-all outline-none resize-none"></textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Initial Status</label>
                                    <div class="relative">
                                        <select x-model="newTask.status" 
                                            class="w-full appearance-none bg-slate-950 border border-slate-800 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 text-slate-350 text-sm px-4 py-2.5 pr-10 rounded-xl transition-all outline-none">
                                            <option value="Pending">Pending</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                        <span class="absolute right-4.5 top-3.5 text-slate-500 pointer-events-none">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-950 px-6 py-4 border-t border-slate-800/80 flex flex-col sm:flex-row-reverse gap-2">
                            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-500 hover:to-indigo-500 transition-all">
                                Save Task
                            </button>
                            <button type="button" @click="isCreateModalOpen = false" class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-400 hover:text-slate-200 hover:bg-slate-900 transition-all border border-slate-800">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- EDIT TASK MODAL -->
        <div x-show="isEditModalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Backdrop with blur -->
                <div x-show="isEditModalOpen" x-transition.opacity class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" @click="isEditModalOpen = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal Content -->
                <div x-show="isEditModalOpen" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative z-10 inline-block align-bottom bg-slate-900 border border-slate-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    
                    <form @submit.prevent="updateTask()">
                        <div class="p-6">
                            <div class="flex items-center justify-between pb-3.5 mb-5 border-b border-slate-800/80">
                                <h3 class="text-base font-bold text-white tracking-wide" id="modal-title">Edit Task Details</h3>
                                <button type="button" @click="isEditModalOpen = false" class="text-slate-500 hover:text-slate-350 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Task Title <span class="text-red-500">*</span></label>
                                    <input type="text" x-model="editingTask.title" required placeholder="What needs to be done?"
                                        class="w-full bg-slate-950 border border-slate-800 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 text-slate-200 text-sm px-4 py-2.5 rounded-xl transition-all outline-none">
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Description</label>
                                    <textarea x-model="editingTask.description" rows="3.5" placeholder="Add detailed notes or requirements..."
                                        class="w-full bg-slate-950 border border-slate-800 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 text-slate-200 text-sm px-4 py-2.5 rounded-xl transition-all outline-none resize-none"></textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Status</label>
                                    <div class="relative">
                                        <select x-model="editingTask.status" 
                                            class="w-full appearance-none bg-slate-950 border border-slate-800 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 text-slate-350 text-sm px-4 py-2.5 pr-10 rounded-xl transition-all outline-none">
                                            <option value="Pending">Pending</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                        <span class="absolute right-4.5 top-3.5 text-slate-500 pointer-events-none">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-950 px-6 py-4 border-t border-slate-800/80 flex flex-col sm:flex-row-reverse gap-2">
                            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-500 hover:to-indigo-500 transition-all">
                                Save Changes
                            </button>
                            <button type="button" @click="isEditModalOpen = false" class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-400 hover:text-slate-200 hover:bg-slate-900 transition-all border border-slate-800">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- DELETE CONFIRMATION DIALOG -->
        <div x-show="isDeleteConfirmOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Backdrop with blur -->
                <div x-show="isDeleteConfirmOpen" x-transition.opacity class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity" @click="isDeleteConfirmOpen = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal Content -->
                <div x-show="isDeleteConfirmOpen" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative z-10 inline-block align-bottom bg-slate-900 border border-slate-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-red-500 mb-4">
                            <div class="p-2 bg-red-500/10 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <h3 class="text-base font-bold text-white tracking-wide">Delete Task</h3>
                        </div>
                        <p class="text-sm text-slate-400">Are you sure you want to delete this task? This action is permanent and cannot be undone.</p>
                    </div>
                    <div class="bg-slate-950 px-6 py-4 border-t border-slate-800/80 flex flex-col sm:flex-row-reverse gap-2">
                        <button @click="deleteTask()" class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-red-650 hover:bg-red-500 transition-all shadow-md shadow-red-600/15">
                            Delete Task
                        </button>
                        <button type="button" @click="isDeleteConfirmOpen = false" class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-400 hover:text-slate-200 hover:bg-slate-900 transition-all border border-slate-800">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOAST NOTIFICATION CONTAINER -->
        <div class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 max-w-sm w-full">
            <template x-for="toast in toasts" :key="toast.id">
                <div x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-x-4"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-4"
                     :class="{
                         'bg-emerald-950 border-emerald-800 text-emerald-300': toast.type === 'success',
                         'bg-red-950 border-red-800 text-red-300': toast.type === 'error'
                     }"
                     class="px-4 py-3 rounded-xl border flex items-center justify-between gap-3 shadow-lg backdrop-blur-md">
                    
                    <div class="flex items-center gap-2">
                        <!-- Success Check icon -->
                        <span x-show="toast.type === 'success'" class="text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        <!-- Error Alert icon -->
                        <span x-show="toast.type === 'error'" class="text-red-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </span>
                        <span class="text-xs font-semibold" x-text="toast.message"></span>
                    </div>
                    
                    <button @click="toasts = toasts.filter(t => t.id !== toast.id)" class="text-slate-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </template>
        </div>

    </div>

    <!-- Alpine.js Store definition -->
    <script>
        function taskDashboard() {
            return {
                tasks: @json($tasks),
                searchQuery: '',
                statusFilter: 'All', // 'All', 'Pending', 'In Progress', 'Completed'
                sortBy: 'newest', // 'newest', 'oldest', 'alphabetical'
                currentView: 'kanban', // 'kanban' or 'list'
                
                // Modals state
                isCreateModalOpen: false,
                isEditModalOpen: false,
                isDeleteConfirmOpen: false,
                
                // Form payloads
                newTask: {
                    title: '',
                    description: '',
                    status: 'Pending'
                },
                editingTask: {
                    id: null,
                    title: '',
                    description: '',
                    status: 'Pending'
                },
                deletingTaskId: null,
                
                // Toast notifications
                toasts: [],
                
                addToast(message, type = 'success') {
                    const id = Date.now();
                    this.toasts.push({ id, message, type });
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 3000);
                },
                
                // Reactive filtered task list based on search query, active status filter tab, and sorting
                get filteredTasks() {
                    let list = this.tasks;
                    
                    // Client-side text filter
                    if (this.searchQuery.trim() !== '') {
                        const query = this.searchQuery.toLowerCase();
                        list = list.filter(t => 
                            t.title.toLowerCase().includes(query) || 
                            (t.description && t.description.toLowerCase().includes(query))
                        );
                    }
                    
                    // Filter by status tab (applies for both List View and general filters)
                    if (this.statusFilter !== 'All') {
                        list = list.filter(t => t.status === this.statusFilter);
                    }
                    
                    // Sort order
                    if (this.sortBy === 'newest') {
                        list = [...list].sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                    } else if (this.sortBy === 'oldest') {
                        list = [...list].sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
                    } else if (this.sortBy === 'alphabetical') {
                        list = [...list].sort((a, b) => a.title.localeCompare(b.title));
                    }
                    
                    return list;
                },
                
                // Real-time Dashboard statistics
                get stats() {
                    const total = this.tasks.length;
                    const pending = this.tasks.filter(t => t.status === 'Pending').length;
                    const inProgress = this.tasks.filter(t => t.status === 'In Progress').length;
                    const completed = this.tasks.filter(t => t.status === 'Completed').length;
                    const completionRate = total > 0 ? Math.round((completed / total) * 100) : 0;
                    
                    return { total, pending, inProgress, completed, completionRate };
                },
                
                // Asynchronous CRUD: Create Task
                async createTask() {
                    if (!this.newTask.title.trim()) return;
                    
                    try {
                        let response = await fetch('/tasks', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(this.newTask)
                        });
                        
                        let data = await response.json();
                        if (data.success) {
                            this.tasks.unshift(data.task); // Add new task instantly at the top
                            this.isCreateModalOpen = false;
                            this.newTask = { title: '', description: '', status: 'Pending' };
                            this.addToast('Task created successfully!', 'success');
                        } else {
                            this.addToast('Failed to create task.', 'error');
                        }
                    } catch (error) {
                        console.error("Error creating task:", error);
                        this.addToast('An error occurred. Please try again.', 'error');
                    }
                },
                
                // Asynchronous CRUD: Open Edit Modal & Populate
                openEditModal(task) {
                    this.editingTask = { 
                        id: task.id, 
                        title: task.title, 
                        description: task.description || '', 
                        status: task.status 
                    };
                    this.isEditModalOpen = true;
                },
                
                // Asynchronous CRUD: Update Task Details
                async updateTask() {
                    if (!this.editingTask.title.trim()) return;
                    
                    try {
                        let response = await fetch(`/tasks/${this.editingTask.id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(this.editingTask)
                        });
                        
                        let data = await response.json();
                        if (data.success) {
                            const idx = this.tasks.findIndex(t => t.id === this.editingTask.id);
                            if (idx !== -1) {
                                this.tasks[idx] = data.task; // Update state directly
                            }
                            this.isEditModalOpen = false;
                            this.addToast('Task details updated!', 'success');
                        } else {
                            this.addToast('Failed to update task.', 'error');
                        }
                    } catch (error) {
                        console.error("Error updating task:", error);
                        this.addToast('An error occurred.', 'error');
                    }
                },
                
                // Asynchronous CRUD: Quick status update (buttons or select)
                async updateStatus(taskId, newStatus) {
                    try {
                        let response = await fetch(`/tasks/${taskId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ status: newStatus })
                        });
                        
                        let data = await response.json();
                        if (data.success) {
                            const idx = this.tasks.findIndex(t => t.id === taskId);
                            if (idx !== -1) {
                                this.tasks[idx].status = newStatus; // Reactive update
                                // Update timestamps locally so sorting reflects change if needed
                                this.tasks[idx].updated_at = new Date().toISOString();
                            }
                            this.addToast(`Status updated to "${newStatus}"!`, 'success');
                        } else {
                            this.addToast('Failed to update status.', 'error');
                        }
                    } catch (error) {
                        console.error("Error updating status:", error);
                        this.addToast('An error occurred.', 'error');
                    }
                },
                
                // Asynchronous CRUD: Confirm Delete
                confirmDelete(taskId) {
                    this.deletingTaskId = taskId;
                    this.isDeleteConfirmOpen = true;
                },
                
                // Asynchronous CRUD: Delete Task
                async deleteTask() {
                    if (!this.deletingTaskId) return;
                    
                    try {
                        let response = await fetch(`/tasks/${this.deletingTaskId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });
                        
                        let data = await response.json();
                        if (data.success) {
                            this.tasks = this.tasks.filter(t => t.id !== this.deletingTaskId); // Remove from list
                            this.isDeleteConfirmOpen = false;
                            this.deletingTaskId = null;
                            this.addToast('Task deleted successfully.', 'success');
                        } else {
                            this.addToast('Failed to delete task.', 'error');
                        }
                    } catch (error) {
                        console.error("Error deleting task:", error);
                        this.addToast('An error occurred.', 'error');
                    }
                },
                
                // Human-readable date helper
                formatDate(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                }
            };
        }
    </script>
</body>
</html>