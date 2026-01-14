<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sleepy Panda - Insomnia Alert Dashboard</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#FF5A5F",
                        accent: "#00D1FF",
                        "background-light": "#F3F4F6",
                        "background-dark": "#0B1120",
                        "card-dark": "#161B2D",
                        "surface-dark": "#27293d",
                        "input-dark": "#2E2F4F",
                        "text-primary": "#FFFFFF",
                        "text-secondary": "#9CA3AF",
                        "border-dark": "#2d3748",
                    },
                    fontFamily: {
                        sans: ["Poppins", "sans-serif"],
                        display: ["Poppins", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                    boxShadow: {
                        'glow': '0 0 15px rgba(255, 90, 95, 0.4)',
                    }
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #161B2D; 
        }
        ::-webkit-scrollbar-thumb {
            background: #2E2F4F; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #4B5563; 
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .bar-gradient {
            background: linear-gradient(180deg, #FF5A5F 0%, rgba(255, 90, 95, 0.6) 100%);
        }
        .bar-gradient-dim {
            background: linear-gradient(180deg, rgba(255, 90, 95, 0.7) 0%, rgba(255, 90, 95, 0.3) 100%);
        }
        .section { display: none; }
        .section.active { display: block; }
        .bar-grow {
            animation: growUp 0.8s ease-out forwards;
            transform-origin: bottom;
            transform: scaleY(0);
        }
        @keyframes growUp {
            to { transform: scaleY(1); }
        }
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
                <a href="{{ route('jurnal') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border border-white/10 text-base sm:text-lg lg:text-xl font-medium text-gray-300 transition hover:text-white hover:border-white/20">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Jurnal</span>
                </a>
                <a href="{{ route('insomnia') }}" class="sidebar-menu-item active flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border border-white/40 bg-white/10 text-base sm:text-lg lg:text-xl font-medium text-white transition">
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

    <main class="max-w-[1500px] mx-auto p-4 sm:p-6 pt-24 sm:pt-28 space-y-4 sm:space-y-6">
        
        <!-- DAILY SECTION -->
        <div id="dailySection" class="section active space-y-4 sm:space-y-6">
            <!-- Stats Cards - Daily -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Users</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">person_outline</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">5500</span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Insomnia Cases</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-primary font-thin">person_outline</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">700</span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Time to Sleep</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">schedule</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">110 <span class="text-lg font-normal text-gray-500">min</span></span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Average Sleep Time</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">schedule</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">5.5 <span class="text-lg font-normal text-gray-500">h</span></span>
                    </div>
                </div>
            </div>

            <!-- Main Content - Daily -->
            <div class="bg-[#272E49] rounded-2xl sm:rounded-3xl p-3 sm:p-5 shadow-sm border border-transparent">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex justify-center lg:justify-end">
                        <div class="dropdown relative w-full sm:w-auto text-left">
                            <button class="dropdown-btn inline-flex w-full sm:w-48 items-center justify-between rounded-lg border border-[#20223F] shadow-sm px-4 sm:px-6 py-3 sm:py-4 bg-[#20223F] text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] focus:outline-none" type="button">
                                <span class="dropdown-label">Daily</span>
                                <span class="material-icons-round text-base sm:text-xl ml-2">expand_more</span>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 mt-2 w-full sm:w-48 bg-[#20223F] divide-y divide-[#20223F] rounded-lg shadow-lg ring-1 ring-[#20223F] z-30">
                                <div class="py-1">
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="daily">Daily</a>
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="weekly">Weekly</a>
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="monthly">Monthly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Chart - Daily -->
                    <div class="bg-[#3C4567] rounded-2xl p-4 sm:p-6 h-[320px] sm:h-[460px] shadow-sm flex flex-col relative border border-[#3C4567]">
                        <div class="flex justify-between items-start mb-6">
                            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Users</h3>
                            <div class="bg-gray-100 dark:bg-[#232942] px-3 py-1 rounded-md flex items-center gap-2 cursor-pointer shadow-sm border border-gray-200 dark:border-gray-700">
                                <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">13 Agustus 2023</span>
                                <span class="material-icons-round text-sm text-gray-400">arrow_drop_down</span>
                            </div>
                        </div>
                        <div class="flex-1 flex w-full h-full">
                            <div class="flex flex-col justify-between text-xs text-gray-400 dark:text-gray-500 text-right pr-4 pb-8 h-full font-mono">
                                <span>2500</span>
                                <span>2000</span>
                                <span>1000</span>
                                <span>100</span>
                                <span>10</span>
                                <span>0</span>
                            </div>
                            <div class="flex-1 flex items-end justify-between px-2 pb-8 h-full relative">
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[40%] group-hover:brightness-110 transition-all bar-grow"></div>
                                    <span class="text-xs text-gray-400">22:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[20%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.1s;"></div>
                                    <span class="text-xs text-gray-400">23:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[40%] shadow-glow bar-grow" style="animation-delay: 0.2s;"></div>
                                    <span class="text-xs text-gray-400">00:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[65%] shadow-glow bar-grow" style="animation-delay: 0.3s;"></div>
                                    <span class="text-xs text-gray-400">01:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[55%] shadow-glow bar-grow" style="animation-delay: 0.4s;"></div>
                                    <span class="text-xs text-gray-400">02:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[40%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.5s;"></div>
                                    <span class="text-xs text-gray-400">03:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[30%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.6s;"></div>
                                    <span class="text-xs text-gray-400">04:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert Cards - Daily -->
                <div class="lg:col-span-1 space-y-4">
                    <div class="bg-[#20223F] py-3 sm:py-4 px-4 sm:px-6 rounded-lg text-center shadow-sm border border-[#20223F]">
                        <h2 class="text-lg font-bold text-white">Alert Insomnia Terbaru</h2>
                    </div>
                    <div class="bg-transparent rounded-2xl p-2 shadow-none border border-transparent h-[320px] sm:h-[460px] flex flex-col">
                        <div class="flex-1 min-h-0 flex flex-col gap-4 overflow-y-auto pr-2 bg-transparent no-scrollbar">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="bg-[#3C4567] rounded-xl p-4 border border-[#3C4567]">
                            <div class="flex justify-between items-center text-[10px] text-gray-400 mb-2">
                                <span>13 Agustus 2023</span>
                                <span>{{ ($i + 1) * 30 }} menit yang lalu</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-1">
                                    <span class="material-icons-round text-primary text-2xl">notifications_active</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">&#x1F601;</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">User ID #{{ 12145 + $i * 1000 }}</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="flex items-center justify-end gap-1 text-[10px] text-gray-500">
                                                <i class="fa-regular fa-clock text-primary"></i>
                                                <span>Avg Sleep</span>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-200">1 Jam {{ 30 - $i * 5 }} Menit</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-700 dark:text-white bg-[#3C4567] p-2 rounded-md border border-[#3C4567]">
                                        Tidak Tidur selama {{ 29 + $i * 3 }} jam terakhir
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <!-- WEEKLY SECTION -->
        <div id="weeklySection" class="section space-y-4 sm:space-y-6" hidden>
            <!-- Stats Cards - Weekly -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Users</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">person_outline</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">4500</span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Insomnia Cases</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-primary font-thin">person_outline</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">900</span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Time to Sleep</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">schedule</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">90 <span class="text-lg font-normal text-gray-500">min</span></span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Average Sleep Time</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">schedule</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">5.2 <span class="text-lg font-normal text-gray-500">h</span></span>
                    </div>
                </div>
            </div>

            <!-- Main Content - Weekly -->
            <div class="bg-[#272E49] rounded-2xl sm:rounded-3xl p-3 sm:p-5 shadow-sm border border-transparent">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex justify-center lg:justify-end">
                        <div class="dropdown relative w-full sm:w-auto text-left">
                            <button class="dropdown-btn inline-flex w-full sm:w-48 items-center justify-between rounded-lg border border-[#20223F] shadow-sm px-4 sm:px-6 py-3 sm:py-4 bg-[#20223F] text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] focus:outline-none" type="button">
                                <span class="dropdown-label">Weekly</span>
                                <span class="material-icons-round text-base sm:text-xl ml-2">expand_more</span>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 mt-2 w-full sm:w-48 bg-[#20223F] divide-y divide-[#20223F] rounded-lg shadow-lg ring-1 ring-[#20223F] z-30">
                                <div class="py-1">
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="daily">Daily</a>
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="weekly">Weekly</a>
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="monthly">Monthly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Chart - Weekly -->
                    <div class="bg-[#3C4567] rounded-2xl p-4 sm:p-6 h-[320px] sm:h-[460px] shadow-sm flex flex-col relative border border-[#3C4567]">
                        <div class="flex justify-between items-start mb-6">
                            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Users</h3>
                            <div class="bg-gray-100 dark:bg-[#232942] px-3 py-1 rounded-md flex items-center gap-2 cursor-pointer shadow-sm border border-gray-200 dark:border-gray-700">
                                <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">12 Agustus - 18 Agustus 2023</span>
                                <span class="material-icons-round text-sm text-gray-400">arrow_drop_down</span>
                            </div>
                        </div>
                        <div class="flex-1 flex w-full h-full">
                            <div class="flex flex-col justify-between text-xs text-gray-400 dark:text-gray-500 text-right pr-4 pb-8 h-full font-mono">
                                <span>2500</span>
                                <span>2000</span>
                                <span>1000</span>
                                <span>100</span>
                                <span>10</span>
                                <span>0</span>
                            </div>
                            <div class="flex-1 flex items-end justify-between px-2 pb-8 h-full relative">
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[15%] group-hover:brightness-110 transition-all bar-grow"></div>
                                    <span class="text-xs text-gray-400">22:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[8%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.1s;"></div>
                                    <span class="text-xs text-gray-400">23:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[40%] shadow-glow bar-grow" style="animation-delay: 0.2s;"></div>
                                    <span class="text-xs text-gray-400">00:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[55%] shadow-glow bar-grow" style="animation-delay: 0.3s;"></div>
                                    <span class="text-xs text-gray-400">01:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[50%] shadow-glow bar-grow" style="animation-delay: 0.4s;"></div>
                                    <span class="text-xs text-gray-400">02:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[30%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.5s;"></div>
                                    <span class="text-xs text-gray-400">03:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[25%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.6s;"></div>
                                    <span class="text-xs text-gray-400">04:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert Cards - Weekly -->
                <div class="lg:col-span-1 space-y-4">
                    <div class="bg-[#20223F] py-3 sm:py-4 px-4 sm:px-6 rounded-lg text-center shadow-sm border border-[#20223F]">
                        <h2 class="text-lg font-bold text-white">Alert Insomnia Terbaru</h2>
                    </div>
                    <div class="bg-transparent rounded-2xl p-2 shadow-none border border-transparent h-[320px] sm:h-[460px] flex flex-col">
                        <div class="flex-1 min-h-0 flex flex-col gap-4 overflow-y-auto pr-2 bg-transparent no-scrollbar">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="bg-[#3C4567] rounded-xl p-4 border border-[#3C4567]">
                            <div class="flex justify-between items-center text-[10px] text-gray-400 mb-2">
                                <span>{{ 15 - $i }} Agustus 2023</span>
                                <span>{{ $i == 0 ? '15 menit yang lalu' : $i . ' hari yang lalu' }}</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-1">
                                    <span class="material-icons-round text-primary text-2xl">notifications_active</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">&#x1F601;</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">User ID #{{ 12388 + $i * 500 }}</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="flex items-center justify-end gap-1 text-[10px] text-gray-500">
                                                <i class="fa-regular fa-clock text-primary"></i>
                                                <span>Avg Sleep</span>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-200">1 Jam {{ 35 - $i * 10 }} Menit</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-700 dark:text-white bg-[#3C4567] p-2 rounded-md border border-[#3C4567]">
                                        Tidak Tidur selama {{ 36 - $i * 5 }} jam terakhir
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <!-- MONTHLY SECTION -->
        <div id="monthlySection" class="section space-y-4 sm:space-y-6" hidden>
            <!-- Stats Cards - Monthly -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Users</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">person_outline</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">3800</span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Insomnia Cases</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-primary font-thin">person_outline</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">800</span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Time to Sleep</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">schedule</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">140 <span class="text-lg font-normal text-gray-500">min</span></span>
                    </div>
                </div>
                <div class="bg-[#272E49] rounded-xl p-3 sm:p-5 shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col justify-between h-auto sm:h-32 hover:border-gray-300 dark:hover:border-gray-600 transition-colors">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Average Sleep Time</p>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="material-icons-round text-4xl text-gray-400 dark:text-gray-500 font-thin">schedule</span>
                        <span class="text-3xl font-bold dark:text-white text-gray-800">5.0 <span class="text-lg font-normal text-gray-500">h</span></span>
                    </div>
                </div>
            </div>

            <!-- Main Content - Monthly -->
            <div class="bg-[#272E49] rounded-2xl sm:rounded-3xl p-3 sm:p-5 shadow-sm border border-transparent">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex justify-center lg:justify-end">
                        <div class="dropdown relative w-full sm:w-auto text-left">
                            <button class="dropdown-btn inline-flex w-full sm:w-48 items-center justify-between rounded-lg border border-[#20223F] shadow-sm px-4 sm:px-6 py-3 sm:py-4 bg-[#20223F] text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] focus:outline-none" type="button">
                                <span class="dropdown-label">Monthly</span>
                                <span class="material-icons-round text-base sm:text-xl ml-2">expand_more</span>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 mt-2 w-full sm:w-48 bg-[#20223F] divide-y divide-[#20223F] rounded-lg shadow-lg ring-1 ring-[#20223F] z-30">
                                <div class="py-1">
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="daily">Daily</a>
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="weekly">Weekly</a>
                                    <a href="#" class="dropdown-item block px-4 py-2.5 sm:py-3 text-base sm:text-xl font-bold text-white hover:bg-[#1A1C34] transition" data-section="monthly">Monthly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Chart - Monthly -->
                    <div class="bg-[#3C4567] rounded-2xl p-4 sm:p-6 h-[320px] sm:h-[460px] shadow-sm flex flex-col relative border border-[#3C4567]">
                        <div class="flex justify-between items-start mb-6">
                            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Users</h3>
                            <div class="bg-gray-100 dark:bg-[#232942] px-3 py-1 rounded-md flex items-center gap-2 cursor-pointer shadow-sm border border-gray-200 dark:border-gray-700">
                                <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">Agustus 2023</span>
                                <span class="material-icons-round text-sm text-gray-400">arrow_drop_down</span>
                            </div>
                        </div>
                        <div class="flex-1 flex w-full h-full">
                            <div class="flex flex-col justify-between text-xs text-gray-400 dark:text-gray-500 text-right pr-4 pb-8 h-full font-mono">
                                <span>2500</span>
                                <span>2000</span>
                                <span>1000</span>
                                <span>100</span>
                                <span>10</span>
                                <span>0</span>
                            </div>
                            <div class="flex-1 flex items-end justify-between px-2 pb-8 h-full relative">
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[35%] group-hover:brightness-110 transition-all bar-grow"></div>
                                    <span class="text-xs text-gray-400">22:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[15%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.1s;"></div>
                                    <span class="text-xs text-gray-400">23:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[35%] shadow-glow bar-grow" style="animation-delay: 0.2s;"></div>
                                    <span class="text-xs text-gray-400">00:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[55%] shadow-glow bar-grow" style="animation-delay: 0.3s;"></div>
                                    <span class="text-xs text-gray-400">01:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient rounded-t-sm h-[48%] shadow-glow bar-grow" style="animation-delay: 0.4s;"></div>
                                    <span class="text-xs text-gray-400">02:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[35%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.5s;"></div>
                                    <span class="text-xs text-gray-400">03:00</span>
                                </div>
                                <div class="flex flex-col items-center w-1/7 gap-2 h-full justify-end group z-10">
                                    <div class="w-full max-w-[40px] bar-gradient-dim rounded-t-sm h-[28%] group-hover:brightness-110 transition-all bar-grow" style="animation-delay: 0.6s;"></div>
                                    <span class="text-xs text-gray-400">04:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert Cards - Monthly -->
                <div class="lg:col-span-1 space-y-4">
                    <div class="bg-[#20223F] py-3 sm:py-4 px-4 sm:px-6 rounded-lg text-center shadow-sm border border-[#20223F]">
                        <h2 class="text-lg font-bold text-white">Alert Insomnia Terbaru</h2>
                    </div>
                    <div class="bg-transparent rounded-2xl p-2 shadow-none border border-transparent h-[320px] sm:h-[460px] flex flex-col">
                        <div class="flex-1 min-h-0 flex flex-col gap-4 overflow-y-auto pr-2 bg-transparent no-scrollbar">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="bg-[#3C4567] rounded-xl p-4 border border-[#3C4567]">
                            <div class="flex justify-between items-center text-[10px] text-gray-400 mb-2">
                                <span>{{ 10 + $i * 15 }} {{ $i < 2 ? 'September' : ($i < 3 ? 'Agustus' : 'Juli') }} 2023</span>
                                <span>{{ $i == 0 ? '30 menit yang lalu' : ($i * 17) . ' hari yang lalu' }}</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="mt-1">
                                    <span class="material-icons-round text-primary text-2xl {{ $i == 0 ? 'animate-pulse' : '' }}">{{ $i == 0 ? 'notifications_active' : 'notifications_none' }}</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">&#x1F601;</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">User ID #{{ 12145 + $i * 5163 }}</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="flex items-center justify-end gap-1 text-[10px] text-gray-500">
                                                <i class="fa-regular fa-clock text-primary"></i>
                                                <span>Avg Sleep</span>
                                            </div>
                                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-200">1 Jam {{ 30 + $i * 5 }} Menit</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-700 dark:text-white bg-[#3C4567] p-2 rounded-md border border-[#3C4567]">
                                        Tidak Tidur selama {{ 29 + $i * 3 }} jam terakhir
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </main>
        </div>
    </div>

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

            if (toggle) {
                toggle.addEventListener("click", () => {
                    isOpen = !isOpen;
                    applyState();
                });
            }

            if (overlay) {
                overlay.addEventListener("click", () => {
                    isOpen = false;
                    applyState();
                });
            }

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
        function toggleDropdown(button) {
            const dropdown = button.closest('.dropdown');
            if (!dropdown) {
                return;
            }
            const menu = dropdown.querySelector('.dropdown-menu');
            if (!menu) {
                return;
            }
            document.querySelectorAll('.dropdown-menu').forEach(item => {
                if (item !== menu) {
                    item.classList.add('hidden');
                }
            });
            menu.classList.toggle('hidden');
        }

        document.querySelectorAll('.dropdown-btn').forEach(button => {
            button.addEventListener('click', event => {
                event.stopPropagation();
                toggleDropdown(button);
            });
        });

        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                showSection(item.dataset.section);
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        });

        // Show section function
        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(el => {
                el.classList.remove('active');
                el.hidden = true;
            });

            // Show selected section
            const sectionId = section + 'Section';
            const sectionEl = document.getElementById(sectionId);
            sectionEl.classList.add('active');
            sectionEl.hidden = false;

            // Update dropdown label
            const labels = {
                'daily': 'Daily',
                'weekly': 'Weekly',
                'monthly': 'Monthly'
            };
            document.querySelectorAll('.dropdown-label').forEach(label => {
                label.textContent = labels[section];
            });

            // Close dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
            
            // Re-trigger animations
            triggerAnimations(sectionId);
        }

        // Re-trigger animations when switching sections
        function triggerAnimations(sectionId) {
            const section = document.getElementById(sectionId);
            const bars = section.querySelectorAll('.bar-grow');
            
            bars.forEach(bar => {
                bar.style.animation = 'none';
                bar.offsetHeight; // Trigger reflow
                bar.style.animation = null;
            });
        }

        // Dark mode handling - default to dark
        document.documentElement.classList.add('dark');
    </script>
</body>
</html>
