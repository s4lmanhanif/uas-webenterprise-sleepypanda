<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sleepy Panda - Jurnal Tidur Report</title>
    <script>
        (function () {
            document.documentElement.classList.add("sidebar-preload");
            try {
                const stored = localStorage.getItem("adminSidebarOpen");
                if (stored === "true") {
                    document.documentElement.classList.add("sidebar-open");
                    return;
                }
            } catch (error) {
                // ignore storage errors
            }
            const cookieMatch = document.cookie.match(/(?:^|; )adminSidebarOpen=true/);
            if (cookieMatch) {
                document.documentElement.classList.add("sidebar-open");
            }
        })();
    </script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined|Material+Icons+Round" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: "#C86B74",
                        secondary: "#ec4899",
                        "background-light": "#f3f4f6",
                        "background-dark": "#161b2e",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1f243a",
                        "input-dark": "#2a304a",
                        "card-inner": "#232942",
                        "card-item": "#2C344E",
                        "card-dark": "#2D3055",
                        "navy-header": "#1A1D2D",
                        "chart-muted": "#A8555E",
                        "chart-active": "#EF5363",
                        "text-main-light": "#1F2937",
                        "text-main-dark": "#E2E2E7",
                        "text-muted-light": "#6B7280",
                        "text-muted-dark": "#9CA3AF",
                    },
                    borderRadius: {
                        DEFAULT: "0.75rem",
                        'xl': '1rem',
                        '2xl': '1.5rem',
                    },
                },
            },
        };
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #161b2e; 
        }
        ::-webkit-scrollbar-thumb {
            background: #2a304a; 
            border-radius: 4px;
        }
        .bar-grow {
            animation: growUp 1s ease-out forwards;
            transform-origin: bottom;
            transform: scaleY(0);
        }
        @keyframes growUp {
            to { transform: scaleY(1); }
        }
        .graph-point {
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }
        .graph-line {
            stroke-dasharray: 2000;
            stroke-dashoffset: 2000;
            animation: drawLine 2s ease-out forwards;
        }
        @keyframes drawLine {
            to { stroke-dashoffset: 0; }
        }
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        .section { display: none; }
        .section.active { display: block; }
        .sidebar-menu-item {
            transition: all 0.2s ease;
        }
        .sidebar-menu-item:hover {
            background: transparent;
            border-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }
        .sidebar-menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
            color: #ffffff;
        }
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .submenu.open {
            max-height: 200px;
        }
        :root {
            --admin-sidebar-width: 280px;
        }
        @media (min-width: 640px) {
            :root {
                --admin-sidebar-width: 300px;
            }
        }
        @media (min-width: 1024px) {
            :root {
                --admin-sidebar-width: 320px;
            }
        }
        .sidebar-preload #adminSidebar,
        .sidebar-preload #adminNavbar,
        .sidebar-preload #adminContent {
            transition: none !important;
        }
        .sidebar-open #adminSidebar {
            transform: translateX(0) !important;
        }
        @media (max-width: 1023.98px) {
            .sidebar-open #sidebarOverlay {
                display: block !important;
            }
            .sidebar-open body {
                overflow: hidden;
            }
        }
        @media (min-width: 1024px) {
            .sidebar-open #adminContent {
                margin-left: var(--admin-sidebar-width);
            }
            .sidebar-open #adminNavbar {
                left: var(--admin-sidebar-width);
                width: calc(100% - var(--admin-sidebar-width));
            }
        }
    </style>
</head>
<body class="bg-[#20223F] dark:bg-[#20223F] text-gray-800 dark:text-gray-100 font-sans antialiased min-h-screen transition-colors duration-300">
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 hidden z-30"></div>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="adminSidebar" class="w-[280px] sm:w-[300px] lg:w-[320px] bg-[#0f1321] fixed left-0 top-0 h-full z-40 flex flex-col border-r border-gray-800 transform -translate-x-full transition-transform duration-300">
            <div class="px-6 py-6 sm:px-7 sm:py-7">
                <h2 class="text-white text-xl sm:text-2xl font-semibold">Admin Site</h2>
            </div>
            <div class="px-4 pb-3 md:hidden">
                <div class="flex items-center bg-[#1F243A] rounded-xl px-4 py-2 border border-gray-700/70 focus-within:border-[#FF5A5F] transition-colors">
                    <span class="material-icons-round text-gray-400">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-sm w-full text-gray-200 placeholder-gray-500 ml-2" placeholder="Search" type="text"/>
                </div>
            </div>
            <nav class="flex-1 px-4 space-y-2 sm:space-y-3">
                <a href="{{ route('dashboard') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border border-white/10 text-base sm:text-lg lg:text-xl font-medium text-gray-300 transition hover:text-white hover:border-white/20">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Dashboard</span>
                </a>
                <a href="{{ route('jurnal') }}" class="sidebar-menu-item active flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border border-white/40 bg-white/10 text-base sm:text-lg lg:text-xl font-medium text-white transition">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Jurnal</span>
                </a>
                <a href="{{ route('insomnia') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border border-white/10 text-base sm:text-lg lg:text-xl font-medium text-gray-300 transition hover:text-white hover:border-white/20">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Report</span>
                </a>
                <a href="{{ route('database.user') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border border-white/10 text-base sm:text-lg lg:text-xl font-medium text-gray-300 transition hover:text-white hover:border-white/20">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Database User</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div id="adminContent" class="flex-1 flex flex-col min-h-screen transition-[margin] duration-300">
            <!-- Navbar -->
            <nav id="adminNavbar" class="fixed top-0 left-0 z-50 w-full px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between bg-[#20223F] transition-[left,width] duration-300 ease-in-out">
                <div class="flex items-center gap-2 flex-1 min-w-0">
                    <button id="sidebarToggle" class="text-gray-500 dark:text-gray-300 hover:text-white transition" type="button" aria-label="Toggle sidebar">
                        <span class="material-icons-outlined text-[30px] sm:text-[36px]">menu</span>
                    </button>
                    <div class="w-12 h-10 sm:w-16 sm:h-12 lg:w-20 lg:h-16 flex items-center justify-center">
                        <img src="{{ asset('images/sleepy_panda.png') }}" alt="Sleepy Panda" class="w-12 h-10 sm:w-16 sm:h-12 lg:w-20 lg:h-16 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <i class="fa-solid fa-paw text-3xl sm:text-4xl text-white hidden"></i>
                    </div>
                    <h1 class="text-xl sm:text-2xl lg:text-[30px] font-bold tracking-tight dark:text-white text-gray-900 truncate max-w-[140px] sm:max-w-none">Sleepy Panda</h1>
                    <div class="hidden lg:flex lg:ml-8 items-center bg-gray-100 dark:bg-[#1F243A] rounded-xl px-4 py-2 lg:w-96 border border-transparent focus-within:border-transparent transition-colors">
                        <span class="material-icons-round text-gray-400">search</span>
                        <input class="bg-transparent border-none focus:ring-0 text-sm w-full text-gray-800 dark:text-gray-200 placeholder-gray-500 ml-2" placeholder="Search" type="text"/>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <button id="profileMenuButton" class="w-12 h-12 rounded-full bg-gray-300 dark:bg-gray-700 overflow-hidden flex items-center justify-center border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary/50" type="button" aria-expanded="false" aria-haspopup="true">
                            <img alt="User Profile" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}&background=6366f1&color=fff"/>
                        </button>
                        <div id="profileMenu" class="absolute right-0 mt-2 w-44 bg-white dark:bg-[#1F243A] border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg hidden">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-[#2A304A] transition" title="Logout">
                                    <span class="material-icons-outlined text-lg">logout</span>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    <span class="hidden sm:block text-base sm:text-xl font-normal text-gray-700 dark:text-gray-300">Halo, {{ Auth::user()->name ?? 'User' }}</span>
                </div>
            </nav>

    <main class="p-4 sm:p-6 pt-24 sm:pt-28 max-w-[1500px] mx-auto min-h-[calc(100vh-100px)] flex flex-col items-center">
        <h1 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 dark:text-white mb-5 sm:mb-6 mt-4">Jurnal Tidur Report</h1>
        
        <div class="w-full bg-[#272E49] dark:bg-[#272E49] rounded-2xl sm:rounded-3xl p-3 sm:p-5 lg:p-8 relative shadow-2xl border border-gray-200 dark:border-gray-800">
            
            <!-- Dropdown Menu -->
            <div class="static lg:absolute lg:top-8 lg:right-10 z-20 w-full sm:w-auto flex justify-end mb-5 md:mb-6 lg:mb-0">
                <div class="relative w-full sm:w-auto text-left">
                    <button id="dropdownBtn" onclick="toggleDropdown()" class="inline-flex w-full sm:w-48 items-center justify-between rounded-lg border border-[#20223F] shadow-sm px-4 sm:px-6 py-3 sm:py-4 bg-[#20223F] text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] focus:outline-none" type="button">
                        <span id="dropdownLabel">Daily</span>
                        <span class="material-icons-round text-base sm:text-xl ml-2">expand_more</span>
                    </button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-full sm:w-48 bg-[#20223F] divide-y divide-[#20223F] rounded-lg shadow-lg ring-1 ring-[#20223F] z-30">
                        <div class="py-1">
                            <a href="#" onclick="showSection('daily'); return false;" class="block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition">Daily</a>
                            <a href="#" onclick="showSection('weekly'); return false;" class="block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition">Weekly</a>
                            <a href="#" onclick="showSection('monthly'); return false;" class="block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition">Monthly</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DAILY SECTION -->
            <div id="dailySection" class="section active mt-10 sm:mt-16">
                <div class="flex flex-col xl:flex-row gap-6 sm:gap-8 xl:items-stretch">
                    <!-- Left Cards -->
                    <div class="w-full xl:w-[400px] grid gap-4 sm:gap-5 xl:gap-4 xl:grid-rows-3 xl:min-h-[450px] shrink-0">
                        <div class="bg-[#3C4567] dark:bg-[#3C4567] rounded-xl p-4 sm:p-5 border border-gray-100 dark:border-[#363e5b] shadow-md hover:border-primary/50 transition duration-300">
                            <div class="text-center text-xs text-gray-500 dark:text-gray-300 mb-6 font-medium">12 Agustus 2023</div>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-yellow-400 text-xl">sentiment_satisfied_alt</span>
                                        <span class="text-[10px] text-gray-500 dark:text-gray-400 font-medium">User</span>
                                    </div>
                                    <div class="text-sm font-bold text-gray-800 dark:text-white">1000</div>
                                </div>
                                <div class="flex flex-col items-center gap-2 border-l border-r border-gray-200 dark:border-gray-600 px-1">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-red-400 text-xl">alarm</span>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Average</span>
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Durasi tidur</span>
                                        </div>
                                    </div>
                                    <div class="text-[11px] font-bold text-gray-800 dark:text-white text-center">7 jam 2 menit</div>
                                </div>
                                <div class="flex flex-col items-center gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-yellow-500 text-xl">star</span>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Average</span>
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Waktu tidur</span>
                                        </div>
                                    </div>
                                    <div class="text-[11px] font-bold text-gray-800 dark:text-white">21:30 - 06:10</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-[#3C4567] dark:bg-[#3C4567] rounded-xl p-4 sm:p-5 border border-gray-100 dark:border-[#363e5b] shadow-md hover:border-primary/50 transition duration-300 opacity-90">
                            <div class="text-center text-xs text-gray-500 dark:text-gray-300 mb-6 font-medium">11 Agustus 2023</div>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-yellow-400 text-xl">sentiment_satisfied_alt</span>
                                        <span class="text-[10px] text-gray-500 dark:text-gray-400 font-medium">User</span>
                                    </div>
                                    <div class="text-sm font-bold text-gray-800 dark:text-white">950</div>
                                </div>
                                <div class="flex flex-col items-center gap-2 border-l border-r border-gray-200 dark:border-gray-600 px-1">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-red-400 text-xl">alarm</span>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Average</span>
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Durasi tidur</span>
                                        </div>
                                    </div>
                                    <div class="text-[11px] font-bold text-gray-800 dark:text-white text-center">6 jam 45 menit</div>
                                </div>
                                <div class="flex flex-col items-center gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-yellow-500 text-xl">star</span>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Average</span>
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Waktu tidur</span>
                                        </div>
                                    </div>
                                    <div class="text-[11px] font-bold text-gray-800 dark:text-white">22:00 - 06:45</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-[#3C4567] dark:bg-[#3C4567] rounded-xl p-4 sm:p-5 border border-gray-100 dark:border-[#363e5b] shadow-md hover:border-primary/50 transition duration-300 opacity-80">
                            <div class="text-center text-xs text-gray-500 dark:text-gray-300 mb-6 font-medium">10 Agustus 2023</div>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-yellow-400 text-xl">sentiment_satisfied_alt</span>
                                        <span class="text-[10px] text-gray-500 dark:text-gray-400 font-medium">User</span>
                                    </div>
                                    <div class="text-sm font-bold text-gray-800 dark:text-white">920</div>
                                </div>
                                <div class="flex flex-col items-center gap-2 border-l border-r border-gray-200 dark:border-gray-600 px-1">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-red-400 text-xl">alarm</span>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Average</span>
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Durasi tidur</span>
                                        </div>
                                    </div>
                                    <div class="text-[11px] font-bold text-gray-800 dark:text-white text-center">7 jam 15 menit</div>
                                </div>
                                <div class="flex flex-col items-center gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-icons-outlined text-yellow-500 text-xl">star</span>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Average</span>
                                            <span class="text-[9px] text-gray-500 dark:text-gray-400 leading-none">Waktu tidur</span>
                                        </div>
                                    </div>
                                    <div class="text-[11px] font-bold text-gray-800 dark:text-white">21:45 - 05:00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Chart -->
                    <div class="flex-1 bg-[#3C4567] dark:bg-[#3C4567] rounded-xl p-4 sm:p-6 lg:p-8 border border-gray-100 dark:border-[#2e3552] flex flex-col relative min-h-[360px] sm:min-h-[450px] shadow-lg">
                        <div class="flex justify-between items-center mb-4 sm:mb-6">
                            <h3 class="text-lg sm:text-2xl text-gray-800 dark:text-gray-200 font-normal">Users</h3>
                            <button class="flex items-center text-xs font-medium text-gray-500 dark:text-gray-300 bg-white dark:bg-[#2A2E45] px-3 py-1.5 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-[#3E4460] transition">
                                12 Agustus 2023
                                <span class="material-icons-outlined text-sm ml-1">arrow_drop_down</span>
                            </button>
                        </div>
                        <div class="flex-1 flex gap-4 sm:gap-6">
                            <div class="flex flex-col justify-between text-base sm:text-xl lg:text-2xl text-gray-400 dark:text-gray-300 font-light py-6 sm:py-8 h-[300px] sm:h-[380px] select-none">
                                <span>2500</span>
                                <span>2000</span>
                                <span>1000</span>
                                <span>100</span>
                                <span>10</span>
                                <span>0</span>
                            </div>
                            <div class="flex-1 relative h-[300px] sm:h-[380px]">
                                <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 800 380">
                                    <filter height="140%" id="shadow" width="140%" x="-20%" y="-20%">
                                        <feDropShadow dx="0" dy="4" flood-color="#000" flood-opacity="0.3" stdDeviation="4"></feDropShadow>
                                    </filter>
                                    <polyline class="graph-line" fill="none" filter="url(#shadow)" points="20,380 120,170 200,228 350,228 480,310 600,228 780,50" stroke="#FACC15" stroke-width="2.5"></polyline>
                                    <circle class="graph-point" cx="20" cy="380" fill="white" r="5" style="animation-delay: 0.1s"></circle>
                                    <circle class="graph-point" cx="120" cy="170" fill="white" r="5" style="animation-delay: 0.3s"></circle>
                                    <circle class="graph-point" cx="200" cy="228" fill="white" r="5" style="animation-delay: 0.5s"></circle>
                                    <circle class="graph-point" cx="350" cy="228" fill="white" r="5" style="animation-delay: 0.7s"></circle>
                                    <circle class="graph-point" cx="480" cy="310" fill="white" r="5" style="animation-delay: 0.9s"></circle>
                                    <circle class="graph-point" cx="600" cy="228" fill="white" r="5" style="animation-delay: 1.1s"></circle>
                                    <circle class="graph-point" cx="780" cy="50" fill="white" r="5" style="animation-delay: 1.3s"></circle>
                                </svg>
                                <div class="absolute bottom-[-25px] left-0 w-full flex justify-between text-xs text-gray-500 dark:text-gray-400 pl-4 pr-0 font-medium select-none">
                                    <span>0j</span>
                                    <span class="pl-12">2j</span>
                                    <span class="pl-8">4j</span>
                                    <span class="pl-4">6j</span>
                                    <span>8j</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WEEKLY SECTION -->
            <div id="weeklySection" class="section mt-10 sm:mt-16">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
                    <!-- Left Stats Card -->
                    <div class="lg:col-span-4 bg-[#3C4567] dark:bg-[#3C4567] rounded-xl px-4 sm:px-6 py-6 sm:py-8 flex flex-col relative overflow-hidden shadow-inner">
                        <div class="text-center w-full mb-12">
                            <h3 class="text-lg font-medium dark:text-white text-gray-800">1 Juni - 7 Juni 2023</h3>
                        </div>
                        <div class="flex flex-row items-center justify-between h-full w-full">
                            <div class="flex flex-row items-center gap-3">
                                <span class="text-4xl drop-shadow-md">😁</span>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-300">User</span>
                                    <span class="text-2xl font-bold dark:text-white text-gray-800">4000</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-x-6 gap-y-10 pl-4">
                                <div class="flex flex-row items-start gap-2">
                                    <span class="text-2xl mt-0.5">⏰</span>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-gray-500 dark:text-gray-300 leading-tight">Average<br/>Durasi tidur</span>
                                        <span class="text-xs font-semibold dark:text-white text-gray-800 mt-0.5">8 jam 2 menit</span>
                                    </div>
                                </div>
                                <div class="flex flex-row items-start gap-2">
                                    <span class="text-2xl mt-0.5">🌟</span>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-gray-500 dark:text-gray-300 leading-tight">Total<br/>Durasi tidur</span>
                                        <span class="text-xs font-semibold dark:text-white text-gray-800 mt-0.5">60 jam 51 menit</span>
                                    </div>
                                </div>
                                <div class="flex flex-row items-start gap-2">
                                    <span class="text-2xl mt-0.5">🛌</span>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-gray-500 dark:text-gray-300 leading-tight">Average<br/>Mulai tidur</span>
                                        <span class="text-xs font-semibold dark:text-white text-gray-800 mt-0.5">21:08</span>
                                    </div>
                                </div>
                                <div class="flex flex-row items-start gap-2">
                                    <span class="text-2xl mt-0.5">🌞</span>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-gray-500 dark:text-gray-300 leading-tight">Average<br/>Bangun tidur</span>
                                        <span class="text-xs font-semibold dark:text-white text-gray-800 mt-0.5">06:30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Bar Chart -->
                    <div class="lg:col-span-8 bg-[#3C4567] dark:bg-[#3C4567] rounded-xl p-4 sm:p-6 relative shadow-inner">
                        <div class="absolute top-4 right-4">
                            <button class="flex items-center text-xs font-medium text-gray-500 dark:text-gray-300 bg-white dark:bg-[#2A2E45] px-3 py-1.5 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-[#3E4460]">
                                1 Juni - 7 Juni 2023
                                <span class="material-icons-outlined text-sm ml-1">arrow_drop_down</span>
                            </button>
                        </div>
                        <div class="h-64 sm:h-80 w-full mt-10 flex items-end justify-between px-2 md:px-8 pb-2 relative">
                            <div class="absolute left-0 top-0 bottom-8 w-8 flex flex-col justify-between text-right text-xs text-gray-400 dark:text-gray-400 py-2">
                                <span>10j</span>
                                <span>8j</span>
                                <span>6j</span>
                                <span>4j</span>
                                <span>2j</span>
                                <span>0j</span>
                            </div>
                            <div class="flex-1 ml-10 h-full flex items-end justify-between gap-2 md:gap-4 relative">
                                <div class="group flex flex-col items-center flex-1 h-full justify-end">
                                    <div class="w-full max-w-[40px] bg-chart-muted rounded-t-md relative group-hover:opacity-80 transition-all duration-300 bar-grow" style="height: 45%;">
                                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">4.5h</div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-3">Sun</span>
                                </div>
                                <div class="group flex flex-col items-center flex-1 h-full justify-end">
                                    <div class="w-full max-w-[40px] bg-chart-muted rounded-t-md relative group-hover:opacity-80 transition-all duration-300 bar-grow" style="height: 60%; animation-delay: 0.1s;">
                                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">6h</div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-3">Mon</span>
                                </div>
                                <div class="group flex flex-col items-center flex-1 h-full justify-end">
                                    <div class="w-full max-w-[40px] bg-chart-muted rounded-t-md relative group-hover:opacity-80 transition-all duration-300 bar-grow" style="height: 38%; animation-delay: 0.2s;">
                                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">3.8h</div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-3">Tue</span>
                                </div>
                                <div class="group flex flex-col items-center flex-1 h-full justify-end">
                                    <div class="w-full max-w-[40px] bg-chart-active shadow-[0_0_15px_rgba(239,83,99,0.4)] rounded-t-md relative group-hover:scale-105 transition-all duration-300 bar-grow" style="height: 75%; animation-delay: 0.3s;">
                                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white text-primary text-[10px] px-2 py-1 rounded shadow-sm opacity-0 group-hover:opacity-100 transition-opacity font-bold whitespace-nowrap">7.5h</div>
                                    </div>
                                    <span class="text-xs font-bold text-gray-800 dark:text-white mt-3">Wed</span>
                                </div>
                                <div class="group flex flex-col items-center flex-1 h-full justify-end">
                                    <div class="w-full max-w-[40px] bg-chart-muted rounded-t-md relative group-hover:opacity-80 transition-all duration-300 bar-grow" style="height: 60%; animation-delay: 0.4s;">
                                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">6h</div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-3">Thu</span>
                                </div>
                                <div class="group flex flex-col items-center flex-1 h-full justify-end">
                                    <div class="w-full max-w-[40px] bg-chart-muted rounded-t-md relative group-hover:opacity-80 transition-all duration-300 bar-grow" style="height: 60%; animation-delay: 0.5s;">
                                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">6h</div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-3">Fri</span>
                                </div>
                                <div class="group flex flex-col items-center flex-1 h-full justify-end">
                                    <div class="w-full max-w-[40px] bg-chart-muted rounded-t-md relative group-hover:opacity-80 transition-all duration-300 bar-grow" style="height: 33%; animation-delay: 0.6s;">
                                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">3.3h</div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-3">Sat</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MONTHLY SECTION -->
            <div id="monthlySection" class="section mt-10 sm:mt-16">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
                    <!-- Left Monthly Cards -->
                    <div class="lg:col-span-5 flex flex-col gap-4 sm:gap-6">
                        <div class="bg-[#3C4567] dark:bg-[#3C4567] rounded-xl p-4 sm:p-6 shadow-sm">
                            <div class="text-center mb-6">
                                <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Juni 2023</h3>
                            </div>
                            <div class="flex items-center">
                                <div class="w-1/3 flex flex-col items-center justify-center border-r border-gray-300 dark:border-gray-600 pr-4">
                                    <div class="text-4xl mb-1">😄</div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">User</span>
                                    <span class="text-lg font-bold dark:text-white text-gray-800">5000</span>
                                </div>
                                <div class="w-2/3 pl-6 grid grid-cols-2 gap-y-6 gap-x-2">
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-rounded text-red-400 text-lg mt-0.5">schedule</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] leading-tight text-gray-500 dark:text-gray-400">Average<br/>Durasi tidur</span>
                                            <span class="text-xs font-bold mt-1 dark:text-white text-gray-800">8 jam 2 menit</span>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-rounded text-yellow-400 text-lg mt-0.5">star</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] leading-tight text-gray-500 dark:text-gray-400">Total<br/>Durasi tidur</span>
                                            <span class="text-xs font-bold mt-1 dark:text-white text-gray-800">60 jam 51 menit</span>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-rounded text-blue-400 text-lg mt-0.5">bed</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] leading-tight text-gray-500 dark:text-gray-400">Average<br/>Mulai tidur</span>
                                            <span class="text-xs font-bold mt-1 dark:text-white text-gray-800">21:58</span>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-rounded text-orange-400 text-lg mt-0.5">wb_sunny</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] leading-tight text-gray-500 dark:text-gray-400">Average<br/>Bangun tidur</span>
                                            <span class="text-xs font-bold mt-1 dark:text-white text-gray-800">07:10</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-[#3C4567] dark:bg-[#3C4567] rounded-xl p-4 sm:p-6 shadow-sm">
                            <div class="text-center mb-6">
                                <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Mei 2023</h3>
                            </div>
                            <div class="flex items-center">
                                <div class="w-1/3 flex flex-col items-center justify-center border-r border-gray-300 dark:border-gray-600 pr-4">
                                    <div class="text-4xl mb-1">😁</div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">User</span>
                                    <span class="text-lg font-bold dark:text-white text-gray-800">8000</span>
                                </div>
                                <div class="w-2/3 pl-6 grid grid-cols-2 gap-y-6 gap-x-2">
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-rounded text-red-400 text-lg mt-0.5">schedule</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] leading-tight text-gray-500 dark:text-gray-400">Average<br/>Durasi tidur</span>
                                            <span class="text-xs font-bold mt-1 dark:text-white text-gray-800">7 jam 35 menit</span>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-rounded text-yellow-400 text-lg mt-0.5">star</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] leading-tight text-gray-500 dark:text-gray-400">Total<br/>Durasi tidur</span>
                                            <span class="text-xs font-bold mt-1 dark:text-white text-gray-800">63 jam 18 menit</span>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-rounded text-blue-400 text-lg mt-0.5">bed</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] leading-tight text-gray-500 dark:text-gray-400">Average<br/>Mulai tidur</span>
                                            <span class="text-xs font-bold mt-1 dark:text-white text-gray-800">22:48</span>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <span class="material-symbols-rounded text-orange-400 text-lg mt-0.5">wb_sunny</span>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] leading-tight text-gray-500 dark:text-gray-400">Average<br/>Bangun tidur</span>
                                            <span class="text-xs font-bold mt-1 dark:text-white text-gray-800">06:40</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Bar Chart -->
                    <div class="lg:col-span-7 bg-[#3C4567] dark:bg-[#3C4567] rounded-xl flex flex-col h-full mt-8 lg:mt-0 relative p-4 sm:p-6">
                        <div class="absolute top-4 right-4 z-10">
                            <div class="relative inline-block text-left">
                                <button class="flex items-center text-xs font-medium text-gray-500 dark:text-gray-300 bg-white dark:bg-[#2A2E45] px-3 py-1.5 rounded-md shadow-sm hover:bg-gray-50 dark:hover:bg-[#3E4460]">
                                    Juni 2023
                                    <span class="material-icons-outlined text-sm ml-1">arrow_drop_down</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex-grow flex items-end pt-12 pb-2 pl-2">
                            <div class="flex flex-col justify-between h-full text-xs text-gray-500 dark:text-gray-400 pr-4 pb-8" style="height: 300px;">
                                <span>10j</span>
                                <span>8j</span>
                                <span>6j</span>
                                <span>4j</span>
                                <span>2j</span>
                                <span>0j</span>
                            </div>
                            <div class="flex-grow flex items-end justify-around relative" style="height: 300px;">
                                <div class="flex flex-col items-center gap-2 group w-12 sm:w-16">
                                    <div class="w-full bg-primary rounded-t-sm transition-all duration-500 hover:opacity-80 relative bar-grow" style="height: 150px;">
                                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-black text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition shadow-md whitespace-nowrap pointer-events-none">
                                            5.2 Jam
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Week 1</span>
                                </div>
                                <div class="flex flex-col items-center gap-2 group w-12 sm:w-16">
                                    <div class="w-full bg-primary rounded-t-sm transition-all duration-500 hover:opacity-80 relative bar-grow" style="height: 120px; animation-delay: 0.15s;">
                                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-black text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition shadow-md whitespace-nowrap pointer-events-none">
                                            4.1 Jam
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Week 2</span>
                                </div>
                                <div class="flex flex-col items-center gap-2 group w-12 sm:w-16">
                                    <div class="w-full bg-primary rounded-t-sm transition-all duration-500 hover:opacity-80 relative bar-grow" style="height: 200px; animation-delay: 0.3s;">
                                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-black text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition shadow-md whitespace-nowrap pointer-events-none">
                                            7.8 Jam
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Week 3</span>
                                </div>
                                <div class="flex flex-col items-center gap-2 group w-12 sm:w-16">
                                    <div class="w-full bg-primary rounded-t-sm transition-all duration-500 hover:opacity-80 relative bar-grow" style="height: 200px; animation-delay: 0.45s;">
                                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-white text-black text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition shadow-md whitespace-nowrap pointer-events-none">
                                            7.9 Jam
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Week 4</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

    <script>
        (function () {
            const sidebar = document.getElementById("adminSidebar");
            const overlay = document.getElementById("sidebarOverlay");
            const toggle = document.getElementById("sidebarToggle");
            const content = document.getElementById("adminContent");
            const navbar = document.getElementById("adminNavbar");
            const mediaQuery = window.matchMedia("(min-width: 1024px)");
            const storageKey = "adminSidebarOpen";
            const readStoredState = () => {
                try {
                    const value = localStorage.getItem(storageKey);
                    if (value !== null) {
                        return value === "true";
                    }
                } catch (error) {
                    // ignore storage errors
                }
                const cookieMatch = document.cookie.match(/(?:^|; )adminSidebarOpen=(true|false)/);
                if (cookieMatch) {
                    return cookieMatch[1] === "true";
                }
                return null;
            };
            const writeStoredState = (value) => {
                try {
                    localStorage.setItem(storageKey, value ? "true" : "false");
                } catch (error) {
                    // ignore storage errors
                }
                document.cookie = `${storageKey}=${value ? "true" : "false"}; path=/; max-age=31536000`;
            };
            const initialOpen = document.documentElement.classList.contains("sidebar-open");
            const storedState = readStoredState();
            let isOpen = storedState !== null ? storedState : initialOpen;
            if (storedState === null) {
                writeStoredState(initialOpen);
            }

            const getSidebarWidth = () => (sidebar ? sidebar.getBoundingClientRect().width : 320);

            const applyState = () => {
                const isDesktop = mediaQuery.matches;
                const sidebarWidth = getSidebarWidth();
                const openOffset = isDesktop && isOpen ? `${sidebarWidth}px` : "0";

                if (sidebar) {
                    sidebar.classList.toggle("-translate-x-full", !isOpen);
                    sidebar.classList.toggle("translate-x-0", isOpen);
                }
                if (overlay) {
                    overlay.classList.toggle("hidden", isDesktop || !isOpen);
                }
                if (content) {
                    content.style.marginLeft = openOffset;
                }
                if (navbar) {
                    navbar.style.left = openOffset;
                    navbar.style.width = isDesktop && isOpen ? `calc(100% - ${sidebarWidth}px)` : "100%";
                }

                document.documentElement.classList.toggle("sidebar-open", isOpen);
                document.body.classList.toggle("overflow-hidden", !isDesktop && isOpen);
                writeStoredState(isOpen);

                if (document.documentElement.classList.contains("sidebar-preload")) {
                    requestAnimationFrame(() => {
                        document.documentElement.classList.remove("sidebar-preload");
                    });
                }
            };

            toggle?.addEventListener("click", () => {
                isOpen = !isOpen;
                applyState();
            });

            overlay?.addEventListener("click", () => {
                isOpen = false;
                applyState();
            });

            mediaQuery.addEventListener("change", () => {
                applyState();
            });

            applyState();
        })();

        (function () {
            const button = document.getElementById("profileMenuButton");
            const menu = document.getElementById("profileMenu");

            if (!button || !menu) {
                return;
            }

            const closeMenu = () => {
                menu.classList.add("hidden");
                button.setAttribute("aria-expanded", "false");
            };

            const toggleMenu = () => {
                menu.classList.toggle("hidden");
                button.setAttribute("aria-expanded", menu.classList.contains("hidden") ? "false" : "true");
            };

            button.addEventListener("click", (event) => {
                event.stopPropagation();
                toggleMenu();
            });

            document.addEventListener("click", () => {
                closeMenu();
            });

            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape") {
                    closeMenu();
                }
            });
        })();

        // Dropdown toggle
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('dropdownBtn');
            const menu = document.getElementById('dropdownMenu');
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        // Show section function
        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(el => {
                el.classList.remove('active');
            });

            // Show selected section
            const sectionId = section + 'Section';
            document.getElementById(sectionId).classList.add('active');

            // Update dropdown label
            const labels = {
                'daily': 'Daily',
                'weekly': 'Weekly',
                'monthly': 'Monthly'
            };
            document.getElementById('dropdownLabel').textContent = labels[section];

            // Close dropdown
            document.getElementById('dropdownMenu').classList.add('hidden');
            
            // Re-trigger animations for the newly shown section
            triggerAnimations(sectionId);
        }

        // Re-trigger animations when switching sections
        function triggerAnimations(sectionId) {
            const section = document.getElementById(sectionId);
            const bars = section.querySelectorAll('.bar-grow');
            const points = section.querySelectorAll('.graph-point');
            const lines = section.querySelectorAll('.graph-line');
            
            bars.forEach(bar => {
                bar.style.animation = 'none';
                bar.offsetHeight; // Trigger reflow
                bar.style.animation = null;
            });
            
            points.forEach(point => {
                point.style.animation = 'none';
                point.offsetHeight;
                point.style.animation = null;
            });
            
            lines.forEach(line => {
                line.style.animation = 'none';
                line.offsetHeight;
                line.style.animation = null;
            });
        }

        // Dark mode handling
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.add('dark'); // Default to dark mode
        }
    </script>
        </div>
    </div>
</body>
</html>
