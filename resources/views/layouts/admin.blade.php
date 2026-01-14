<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleepy Panda - @yield('title', 'Admin')</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined|Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Poppins", "sans-serif"],
                        display: ["Poppins", "sans-serif"],
                    },
                    colors: {
                        primary: "#4f8ef7",
                        secondary: "#f472b6",
                        "background-light": "#f3f4f6",
                        "background-dark": "#1b1f36",
                        "surface-light": "#ffffff",
                        "surface-dark": "#23283f",
                        "input-dark": "#2a304a",
                    },
                    borderRadius: {
                        DEFAULT: "0.75rem",
                    },
                },
            },
        };
    </script>
    <style>
        #adminNavbar {
            position: fixed;
            top: 0;
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
    @stack('head')
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
    @stack('styles')
</head>
@php
    $databaseActive = request()->routeIs('database.user') || request()->routeIs('users.*');
@endphp
<body class="@yield('body_class', 'bg-[#20223F] dark:bg-[#20223F] text-gray-800 dark:text-gray-100 font-sans antialiased min-h-screen transition-colors duration-300')">
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 hidden z-30"></div>
    <div class="flex min-h-screen">
        <aside id="adminSidebar" class="fixed left-0 top-0 h-full w-[280px] sm:w-[300px] lg:w-[320px] bg-[#0f1321] border-r border-gray-800 flex flex-col z-40 transform -translate-x-full transition-transform duration-300">
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
                <a href="{{ route('dashboard') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border text-base sm:text-lg lg:text-xl font-medium transition {{ request()->routeIs('dashboard') ? 'active border-white/40 text-white bg-white/10' : 'border-white/10 text-gray-300 hover:text-white hover:border-white/20' }}">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Dashboard</span>
                </a>
                <a href="{{ route('jurnal') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border text-base sm:text-lg lg:text-xl font-medium transition {{ request()->routeIs('jurnal') ? 'active border-white/40 text-white bg-white/10' : 'border-white/10 text-gray-300 hover:text-white hover:border-white/20' }}">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Jurnal</span>
                </a>
                <a href="{{ route('insomnia') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border text-base sm:text-lg lg:text-xl font-medium transition {{ request()->routeIs('insomnia') ? 'active border-white/40 text-white bg-white/10' : 'border-white/10 text-gray-300 hover:text-white hover:border-white/20' }}">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Report</span>
                </a>
                <a href="{{ route('database.user') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-6 py-3 sm:py-4 rounded-lg border text-base sm:text-lg lg:text-xl font-medium transition {{ $databaseActive ? 'active border-white/40 text-white bg-white/10' : 'border-white/10 text-gray-300 hover:text-white hover:border-white/20' }}">
                    <span class="text-base sm:text-lg lg:text-xl font-medium">Database User</span>
                </a>
                @if ($databaseActive)
                <div class="space-y-2 pt-2">
                    <a href="{{ route('users.update') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-5 py-2.5 sm:py-3 rounded-lg border text-sm sm:text-base lg:text-lg font-medium transition {{ request()->routeIs('users.update') ? 'active border-white/40 text-white bg-white/10' : 'border-white/10 text-gray-300 hover:text-white hover:border-white/20' }}">
                        <span class="text-sm sm:text-base lg:text-lg font-medium">Update Data</span>
                    </a>
                    <a href="{{ route('users.reset-password') }}" class="sidebar-menu-item flex items-center justify-center px-4 sm:px-5 py-2.5 sm:py-3 rounded-lg border text-sm sm:text-base lg:text-lg font-medium transition {{ request()->routeIs('users.reset-password') ? 'active border-white/40 text-white bg-white/10' : 'border-white/10 text-gray-300 hover:text-white hover:border-white/20' }}">
                        <span class="text-sm sm:text-base lg:text-lg font-medium">Reset Password</span>
                    </a>
                </div>
                @endif
            </nav>
        </aside>

        <div id="adminContent" class="flex-1 flex flex-col min-h-screen transition-[margin] duration-300">
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

            <main class="p-4 sm:p-6 pt-24 sm:pt-28">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
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
    </script>
</body>
</html>
