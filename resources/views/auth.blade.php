@php($page = $page ?? 'landing')
@if ($page === 'password-reset-otp')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f8fb; margin: 0; padding: 24px;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; padding: 24px;">
        <tr>
            <td style="font-size: 18px; font-weight: 700; color: #0f172a; padding-bottom: 12px;">
                Sleepy Panda
            </td>
        </tr>
        <tr>
            <td style="font-size: 14px; color: #334155; line-height: 1.6;">
                Gunakan kode OTP berikut untuk melanjutkan reset password akun Anda.
            </td>
        </tr>
        <tr>
            <td style="padding: 16px 0;">
                <div style="font-size: 28px; font-weight: 700; letter-spacing: 6px; color: #0f172a; background: #f1f5f9; padding: 12px 16px; border-radius: 10px; display: inline-block;">
                    {{ $otp }}
                </div>
            </td>
        </tr>
        <tr>
            <td style="font-size: 13px; color: #64748b; line-height: 1.6;">
                Kode ini berlaku selama {{ $minutes }} menit. Jika Anda tidak meminta reset password, abaikan email ini.
            </td>
        </tr>
    </table>
</body>
</html>
@else
<!DOCTYPE html>
<html class="dark" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Sleepy Panda - Analisa Tidur Anda</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@800;900&amp;family=Quicksand:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#008080",
                        "background-light": "#f0f4f8",
                        "background-dark": "#1a1c2e",
                        "input-dark": "#2a2d45",
                    },
                    fontFamily: {
                        outfit: ["Outfit", "sans-serif"],
                        display: ["Inter", "sans-serif"],
                        body: ["Quicksand", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "12px",
                    },
                },
            },
        };
    </script>
<style type="text/tailwindcss">
        .panda-illustration {
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.1));
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .panda-z {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); opacity: 0.3; }
            50% { transform: translateY(-10px); opacity: 1; }
        }
    </style>
</head>
<body class="min-h-screen">
@if ($page === 'landing')
<section class="relative bg-background-light dark:bg-background-dark transition-colors duration-300 min-h-screen flex flex-col items-center justify-center p-4 font-outfit" id="landing">
<main class="w-full max-w-lg text-center flex flex-col items-center gap-12 py-12">
<div class="flex flex-col items-center space-y-4">
<div class="relative panda-illustration mb-2">
<img alt="Sleepy Panda" class="mx-auto" height="120" src="{{ asset('images/sleepy_panda.png') }}" width="180"/>
</div>
<h1 class="text-5xl font-bold tracking-tight text-slate-900 dark:text-white">
                Sleepy Panda
            </h1>
</div>
<p class="text-lg text-slate-600 dark:text-white max-w-sm leading-relaxed px-4 opacity-100 font-normal">
            Mulai dengan masuk atau mendaftar untuk melihat analisa tidur mu.
        </p>
<div class="flex flex-col w-full max-w-xs space-y-4 px-4">
<a class="bg-primary hover:bg-primary/90 text-white font-semibold py-4 px-8 rounded-2xl shadow-lg shadow-primary/20 transition-all active:scale-[0.98] text-center" href="{{ route('auth', ['page' => 'masuk']) }}">
                Masuk
            </a>
<a class="bg-white dark:bg-white text-primary dark:text-primary font-semibold py-4 px-8 rounded-2xl border border-slate-200 dark:border-transparent shadow-sm hover:bg-slate-50 transition-all active:scale-[0.98] text-center" href="{{ route('auth', ['page' => 'daftar']) }}">
                Daftar
            </a>
</div>
</main>
<div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary/20 to-transparent"></div>
</section>
@elseif ($page === 'masuk')
<section class="bg-background-dark min-h-screen flex items-center justify-center p-4 font-body" id="masuk">
<div class="w-full max-w-md bg-transparent">
<div class="flex flex-col items-center mb-10">
<div class="relative mb-4 flex flex-col items-center">
<div class="w-32 h-32 flex items-center justify-center relative">
<img alt="Sleepy Panda" class="w-full h-full object-contain" src="{{ asset('images/sleepy_panda.png') }}"/>
</div>
<h1 class="text-4xl font-black text-white mt-2 tracking-tight text-center font-outfit">Sleepy Panda</h1>
</div>
<p class="text-[#FFFFFF] text-center text-sm md:text-base px-4 font-medium">
                Masuk menggunakan akun yang sudah kamu daftarkan
            </p>
</div>
@if (session('status'))
<div class="rounded-xl border border-emerald-500/40 bg-emerald-500/10 text-emerald-200 text-sm font-semibold px-4 py-3 mb-4" role="alert">
                {{ session('status') }}
            </div>
@endif
@error('login')
<div class="rounded-xl border border-rose-500/40 bg-rose-500/10 text-rose-200 text-sm font-semibold px-4 py-3 mb-4" role="alert">
                {{ $message }}
            </div>
@enderror
<form action="{{ route('login.store') }}" class="space-y-4" id="login-form" method="POST" novalidate>
@csrf
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-white text-xl">mail</span>
</div>
<input autocomplete="username" class="block w-full pl-12 pr-4 py-4 bg-input-dark border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-2xl text-white placeholder-slate-400 transition-all" id="email" name="email" placeholder="Email" required="" type="email" value="{{ old('email') }}"/>
</div>
<p class="hidden text-sm text-rose-500" id="login-email-error">Email incorrect</p>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-white text-xl">lock</span>
</div>
<input autocomplete="current-password" class="block w-full pl-12 pr-4 py-4 bg-input-dark border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-2xl text-white placeholder-slate-400 transition-all" id="password" name="password" placeholder="Password" required="" type="password"/>
</div>
<p class="hidden text-sm text-rose-500" id="login-password-error">Password incorrect</p>
<div class="flex justify-end">
<a class="text-primary text-sm font-semibold hover:underline" href="{{ route('auth', ['page' => 'reset']) }}" id="forgot-link">Lupa Password?</a>
</div>
<button class="w-full py-4 px-6 bg-primary hover:bg-teal-700 text-white font-bold rounded-2xl shadow-lg shadow-primary/20 transition-all transform hover:scale-[1.01] active:scale-95 mt-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:shadow-none disabled:hover:bg-primary" id="login-submit" type="submit">
                Masuk
            </button>
</form>
<div class="mt-10 text-center">
<p class="text-slate-400 text-sm">
                Belum memiliki akun?
                <a class="text-primary font-bold hover:underline ml-1" href="{{ route('auth', ['page' => 'daftar']) }}">
                    Daftar sekarang
                </a>
</p>
</div>
</div>
</section>
@elseif ($page === 'daftar')
<section class="bg-background-dark min-h-screen flex items-center justify-center p-4 font-body" id="daftar">
<div class="w-full max-w-md bg-transparent">
<div class="flex flex-col items-center mb-10 text-center">
<div class="relative mb-2 flex flex-col items-center">
<div class="w-32 h-32 flex items-center justify-center relative">
<img alt="Sleepy Panda" class="w-full h-full object-contain" src="{{ asset('images/sleepy_panda.png') }}"/>
</div>
<h1 class="text-4xl font-black text-white mt-2 tracking-tight font-outfit">Sleepy Panda</h1>
</div>
<p class="text-white text-sm md:text-base px-4 font-semibold max-w-xs mx-auto">
                Daftar menggunakan email yang valid
            </p>
</div>
@error('email')
<div class="rounded-xl border border-rose-500/40 bg-rose-500/10 text-rose-200 text-sm font-semibold px-4 py-3 mb-4" role="alert">
                {{ $message }}
            </div>
@enderror
@error('password')
<div class="rounded-xl border border-rose-500/40 bg-rose-500/10 text-rose-200 text-sm font-semibold px-4 py-3 mb-4" role="alert">
                {{ $message }}
            </div>
@enderror
<form action="{{ route('register.store') }}" class="space-y-4" method="POST">
@csrf
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-white text-xl">mail</span>
</div>
<input autocomplete="username" class="block w-full pl-12 pr-4 py-4 bg-input-dark border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-2xl text-white placeholder-slate-400 transition-all" id="register-email" name="email" placeholder="Email" required="" type="email" value="{{ old('email') }}"/>
</div>
<p class="hidden text-sm text-rose-500" id="register-email-error">Email incorrect</p>
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-white text-xl">lock</span>
</div>
<input autocomplete="new-password" class="block w-full pl-12 pr-4 py-4 bg-input-dark border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-2xl text-white placeholder-slate-400 transition-all" id="register-password" name="password" placeholder="Password" required="" type="password"/>
</div>
<p class="hidden text-sm text-rose-500" id="register-password-error">Password incorrect</p>
<div class="flex justify-end">
<a class="text-primary text-sm font-semibold hover:underline" href="{{ route('auth', ['page' => 'reset']) }}">Lupa Password?</a>
</div>
<button class="w-full py-4 px-6 bg-primary hover:bg-teal-700 text-white font-bold rounded-2xl shadow-lg shadow-primary/20 transition-all transform hover:scale-[1.01] active:scale-95 mt-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:shadow-none disabled:hover:bg-primary" id="register-submit" type="submit">
                Daftar
            </button>
</form>
</div>
</section>
@elseif ($page === 'reset')
<section class="bg-background-dark min-h-screen flex items-center justify-center p-4 font-body" id="reset">
<div class="w-full max-w-md bg-transparent">
<div class="flex flex-col items-center mb-10 text-center">
<div class="relative mb-2 flex flex-col items-center">
<div class="w-32 h-32 flex items-center justify-center relative">
<img alt="Sleepy Panda" class="w-full h-full object-contain" src="{{ asset('images/sleepy_panda.png') }}"/>
</div>
<h1 class="text-4xl font-black text-white mt-2 tracking-tight font-outfit">Sleepy Panda</h1>
</div>
<p class="text-white text-sm md:text-base px-4 font-semibold max-w-xs mx-auto">
                Instruksi untuk melakukan reset password akan dikirim melalui email yang kamu gunakan untuk mendaftar
            </p>
</div>
@if (session('status'))
<div class="rounded-xl border border-emerald-500/40 bg-emerald-500/10 text-emerald-200 text-sm font-semibold px-4 py-3 mb-4" role="alert">
                {{ session('status') }}
            </div>
@endif
@error('email')
<div class="rounded-xl border border-rose-500/40 bg-rose-500/10 text-rose-200 text-sm font-semibold px-4 py-3 mb-4" role="alert">
                {{ $message }}
            </div>
@enderror
<form action="{{ route('password.otp.send') }}" class="space-y-4" method="POST">
@csrf
<div class="relative">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-white text-xl">mail</span>
</div>
<input class="block w-full pl-12 pr-4 py-4 bg-input-dark border-transparent focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-2xl text-white placeholder-slate-400 transition-all" id="email" name="email" placeholder="Email" required="" type="email" value="{{ old('email') }}"/>
</div>
<div class="hidden rounded-xl border border-rose-500/40 bg-rose-500/10 text-rose-200 text-sm font-semibold px-4 py-3" id="reset-error" role="alert">
<span class="hidden" data-error="empty">email tidak boleh kosong</span>
<span class="hidden" data-error="invalid">Email Anda Salah.</span>
</div>
<button class="w-full py-4 px-6 bg-primary hover:bg-teal-700 text-white font-bold rounded-2xl shadow-lg shadow-primary/20 transition-all transform hover:scale-[1.01] active:scale-95 mt-2" type="submit">
                Reset Password
            </button>
</form>
</div>
</section>
@endif
<script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("login-form");
            if (!form) {
                return;
            }

            const emailInput = document.getElementById("email");
            const passwordInput = document.getElementById("password");
            const submitButton = document.getElementById("login-submit");
            const emailError = document.getElementById("login-email-error");
            const passwordError = document.getElementById("login-password-error");
            const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

            const isEmailValid = () => {
                const email = emailInput.value.trim();
                if (!email || !emailPattern.test(email)) {
                    return false;
                }

                const atIndex = email.indexOf("@");
                if (atIndex === -1) {
                    return false;
                }

                const domain = email.slice(atIndex + 1).toLowerCase();
                if (domain === "ganteng.com") {
                    return false;
                }

                return true;
            };

            const isPasswordValid = () => passwordInput.value.length > 8;

            const setFieldError = (field, errorEl, hasError) => {
                if (!errorEl) {
                    return;
                }
                errorEl.classList.toggle("hidden", !hasError);
                if (hasError) {
                    field.setAttribute("aria-invalid", "true");
                } else {
                    field.removeAttribute("aria-invalid");
                }
            };

            const updateState = (forceError = false) => {
                const emailValue = emailInput.value.trim();
                const passwordValue = passwordInput.value;
                const emailValid = isEmailValid();
                const passwordValid = isPasswordValid();
                submitButton.disabled = !(emailValid && passwordValid);

                const showEmailError = !emailValid && (forceError || emailValue !== "");
                const showPasswordError = !passwordValid && (forceError || passwordValue !== "");
                setFieldError(emailInput, emailError, showEmailError);
                setFieldError(passwordInput, passwordError, showPasswordError);
            };

            form.addEventListener("submit", (event) => {
                updateState(true);
                if (submitButton.disabled) {
                    event.preventDefault();
                }
            });

            emailInput.addEventListener("input", () => updateState(false));
            passwordInput.addEventListener("input", () => updateState(false));
            updateState(false);
        });
    </script>
<script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector('section#daftar form');
            if (!form) {
                return;
            }

            const usernameInput = document.getElementById("register-email");
            const passwordInput = document.getElementById("register-password");
            const submitButton = document.getElementById("register-submit");
            const emailError = document.getElementById("register-email-error");
            const passwordError = document.getElementById("register-password-error");
            const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

            const isEmailValid = () => {
                const username = usernameInput.value.trim();
                if (!username || !emailPattern.test(username)) {
                    return false;
                }

                const atIndex = username.indexOf("@");
                if (atIndex === -1) {
                    return false;
                }

                const domain = username.slice(atIndex + 1).toLowerCase();
                if (domain === "ganteng.com") {
                    return false;
                }

                return true;
            };

            const isPasswordValid = () => passwordInput.value.length > 8;

            const setFieldError = (field, errorEl, hasError) => {
                if (!errorEl) {
                    return;
                }
                errorEl.classList.toggle("hidden", !hasError);
                if (hasError) {
                    field.setAttribute("aria-invalid", "true");
                } else {
                    field.removeAttribute("aria-invalid");
                }
            };

            const updateState = (forceError = false) => {
                const emailValue = usernameInput.value.trim();
                const passwordValue = passwordInput.value;
                const emailValid = isEmailValid();
                const passwordValid = isPasswordValid();
                submitButton.disabled = !(emailValid && passwordValid);

                const showEmailError = !emailValid && (forceError || emailValue !== "");
                const showPasswordError = !passwordValid && (forceError || passwordValue !== "");
                setFieldError(usernameInput, emailError, showEmailError);
                setFieldError(passwordInput, passwordError, showPasswordError);
            };

            form.addEventListener("submit", (event) => {
                updateState(true);
                if (submitButton.disabled) {
                    event.preventDefault();
                }
            });

            usernameInput.addEventListener("input", () => updateState(false));
            passwordInput.addEventListener("input", () => updateState(false));
            updateState(false);
        });
    </script>
<script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector("section#reset form");
            if (!form) {
                return;
            }

            const emailInput = form.querySelector("input[name='email']");
            const errorEl = document.getElementById("reset-error");
            const emptyMsg = errorEl?.querySelector("[data-error='empty']");
            const invalidMsg = errorEl?.querySelector("[data-error='invalid']");
            const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

            const setError = (type) => {
                if (!errorEl || !emptyMsg || !invalidMsg) {
                    return;
                }
                errorEl.classList.remove("hidden");
                emptyMsg.classList.toggle("hidden", type !== "empty");
                invalidMsg.classList.toggle("hidden", type !== "invalid");
                emailInput.setAttribute("aria-invalid", "true");
            };

            const clearError = () => {
                if (!errorEl) {
                    return;
                }
                errorEl.classList.add("hidden");
                emptyMsg.classList.add("hidden");
                invalidMsg.classList.add("hidden");
                emailInput.removeAttribute("aria-invalid");
            };

            const validate = () => {
                const email = emailInput.value.trim();
                if (!email) {
                    setError("empty");
                    return false;
                }
                if (!emailPattern.test(email)) {
                    setError("invalid");
                    return false;
                }
                clearError();
                return true;
            };

            form.addEventListener("submit", (event) => {
                if (!validate()) {
                    event.preventDefault();
                }
            });

            emailInput.addEventListener("input", () => {
                if (!errorEl.classList.contains("hidden")) {
                    validate();
                }
            });
        });
    </script>
</body></html>
@endif
