@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    .bar-grow {
        animation: growUp 1s ease-out forwards;
        transform-origin: bottom;
        transform: scaleY(1);
    }
    @keyframes growUp {
        from { transform: scaleY(0); }
        to { transform: scaleY(1); }
    }
    .line-draw {
        stroke-dasharray: 1200;
        stroke-dashoffset: 1200;
        animation: drawLine 1.6s ease-out forwards;
    }
    .line-draw.delay-1 {
        animation-delay: 0.2s;
    }
    @keyframes drawLine {
        to { stroke-dashoffset: 0; }
    }
    .bg-primary {
        background-color: #4f8ef7;
    }
    .bg-secondary {
        background-color: #f472b6;
    }
</style>
@endpush

@section('content')
<div class="space-y-3 max-w-[1500px] mx-auto w-full">
    <!-- Report Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
        <!-- Daily Report -->
        <div class="bg-[#373B6E]/[0.15] p-3 sm:p-5 rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 flex flex-col min-h-[240px] sm:h-[280px]">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-lg font-medium">Daily Report</h3>
                <div class="flex flex-col gap-1 text-[10px] text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-secondary"></span> Female</div>
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-primary"></span> Male</div>
                </div>
            </div>
            <div class="flex-1 flex items-end justify-between gap-2 px-2 pb-2">
                <div class="flex flex-col justify-between h-full text-[10px] text-gray-400 pb-6 pr-2">
                    <span>2500</span><span>2000</span><span>1000</span><span>100</span><span>10</span><span>0</span>
                </div>
                @php $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']; @endphp
                @php $femaleHeights = [60, 50, 45, 70, 62, 30, 35]; @endphp
                @php $maleHeights = [40, 65, 55, 75, 25, 50, 38]; @endphp
                @foreach($days as $index => $day)
                <div class="flex flex-col items-center justify-end h-full w-full gap-2">
                    <div class="flex gap-1 items-end h-full">
                        <div class="w-1.5 md:w-2 bg-secondary rounded-t-sm bar-grow" style="height: {{ $femaleHeights[$index] }}%"></div>
                        <div class="w-1.5 md:w-2 bg-primary rounded-t-sm bar-grow" style="height: {{ $maleHeights[$index] }}%; animation-delay: {{ $index * 0.05 }}s"></div>
                    </div>
                    <span class="text-[10px] text-gray-400">{{ $day }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Weekly Report -->
        <div class="bg-[#373B6E]/[0.15] p-3 sm:p-5 rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 flex flex-col min-h-[240px] sm:h-[280px]">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-lg font-medium">Weekly Report</h3>
                <div class="flex flex-col gap-1 text-[10px] text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-secondary"></span> Female</div>
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-primary"></span> Male</div>
                </div>
            </div>
            <div class="flex-1 flex items-end justify-between gap-4 sm:gap-6 px-2 sm:px-4 pb-2">
                <div class="flex flex-col justify-between h-full text-[10px] text-gray-400 pb-6 pr-2">
                    <span>2500</span><span>2000</span><span>1000</span><span>100</span><span>10</span><span>0</span>
                </div>
                @php $weeklyFemale = [60, 55, 50, 75]; @endphp
                @php $weeklyMale = [45, 58, 62, 80]; @endphp
                @for($i = 1; $i <= 4; $i++)
                <div class="flex flex-col items-center justify-end h-full w-full gap-2">
                    <div class="flex gap-2 items-end h-full">
                        <div class="w-2 bg-secondary rounded-t-sm bar-grow" style="height: {{ $weeklyFemale[$i-1] }}%"></div>
                        <div class="w-2 bg-primary rounded-t-sm bar-grow" style="height: {{ $weeklyMale[$i-1] }}%"></div>
                    </div>
                    <span class="text-[10px] text-gray-400 {{ $i == 4 ? 'font-bold dark:text-gray-200' : '' }}">Week {{ $i }}</span>
                </div>
                @endfor
            </div>
        </div>

        <!-- Monthly Report -->
        <div class="bg-[#373B6E]/[0.15] p-3 sm:p-5 rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 flex flex-col min-h-[240px] sm:h-[280px]">
            <div class="flex justify-between items-start mb-6">
                <h3 class="text-lg font-medium">Monthly Report</h3>
                <div class="flex flex-col gap-1 text-[10px] text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-secondary"></span> Female</div>
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-primary"></span> Male</div>
                </div>
            </div>
            <div class="flex-1 flex items-end justify-between gap-1 px-1 pb-2">
                <div class="flex flex-col justify-between h-full text-[9px] text-gray-400 pb-6 pr-1">
                    <span>2.5k</span><span>2k</span><span>1k</span><span>100</span><span>10</span><span>0</span>
                </div>
                @php $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt']; @endphp
                @php $monthlyFemale = [60, 55, 45, 70, 50, 65, 40, 55, 50, 55]; @endphp
                @php $monthlyMale = [40, 65, 55, 75, 30, 20, 50, 54, 35, 52]; @endphp
                @foreach($months as $index => $month)
                <div class="flex flex-col items-center justify-end h-full w-full gap-2">
                    <div class="flex gap-0.5 items-end h-full">
                        <div class="w-1 bg-secondary bar-grow" style="height: {{ $monthlyFemale[$index] }}%"></div>
                        <div class="w-1 bg-primary bar-grow" style="height: {{ $monthlyMale[$index] }}%; animation-delay: {{ $index * 0.04 }}s"></div>
                    </div>
                    <span class="text-[9px] text-gray-400">{{ $month }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        <div class="bg-[#272E49] p-3 sm:p-5 rounded-xl shadow-lg border border-[#272E49]/[0.2] flex flex-col gap-3">
            <span class="text-sm text-gray-200">Total Users</span>
            <div class="flex items-center gap-4">
                <span class="material-icons-outlined text-4xl text-white/80">person_outline</span>
                <span class="text-2xl sm:text-3xl font-semibold text-white">4500</span>
            </div>
        </div>
        <div class="bg-[#272E49] p-3 sm:p-5 rounded-xl shadow-lg border border-[#272E49]/[0.2] flex flex-col gap-3">
            <span class="text-sm text-gray-200">Female Users</span>
            <div class="flex items-center gap-4">
                <span class="material-icons-outlined text-4xl text-white/80">person_outline</span>
                <span class="text-2xl sm:text-3xl font-semibold text-white">2000</span>
            </div>
        </div>
        <div class="bg-[#272E49] p-3 sm:p-5 rounded-xl shadow-lg border border-[#272E49]/[0.2] flex flex-col gap-3">
            <span class="text-sm text-gray-200">Male Users</span>
            <div class="flex items-center gap-4">
                <span class="material-icons-outlined text-4xl text-white/80">person_outline</span>
                <span class="text-2xl sm:text-3xl font-semibold text-white">2500</span>
            </div>
        </div>
        <div class="bg-[#272E49] p-3 sm:p-5 rounded-xl shadow-lg border border-[#272E49]/[0.2] flex flex-col gap-3">
            <span class="text-sm text-gray-200">Average Time</span>
            <div class="flex items-center gap-4">
                <span class="material-icons-outlined text-4xl text-white/80">schedule</span>
                <span class="text-2xl sm:text-3xl font-semibold text-white">154.25</span>
            </div>
        </div>
    </div>

    <!-- Average Sleep Time Chart -->
    <div class="bg-[#272E49] p-3 sm:p-5 rounded-xl shadow-lg border border-[#272E49]/[0.2]">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4 mb-3">
            <h3 class="text-lg font-medium">Average Users Sleep Time</h3>
            <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-secondary"></span> Female</div>
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-primary"></span> Male</div>
            </div>
        </div>
        <div class="grid grid-cols-[28px_1fr] gap-2">
            <div class="flex flex-col justify-between text-[9px] sm:text-[10px] text-gray-500 py-2">
                <span>10j</span>
                <span>8j</span>
                <span>6j</span>
                <span>4j</span>
                <span>2j</span>
            </div>
        <div class="flex flex-col">
            <div class="relative w-full h-[180px] sm:h-[220px] overflow-hidden">
                    <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 1000 300">
                        <polyline class="drop-shadow-md line-draw" fill="none" points="0,260 150,250 200,240 250,140 350,160 500,190 600,140 700,200 800,100 900,150 1000,100" stroke="#ec4899" stroke-width="2"></polyline>
                        <polyline class="drop-shadow-md line-draw delay-1" fill="none" points="0,190 180,210 250,220 350,190 450,220 550,140 650,200 750,130 850,180 950,150 1000,140" stroke="#3b82f6" stroke-width="2"></polyline>
                    </svg>
                </div>
                <div class="flex justify-between text-[9px] sm:text-[10px] text-gray-400 px-1 sm:px-4 pt-2">
                    <span>Jan 01</span>
                    <span>Jan 02</span>
                    <span>Jan 03</span>
                    <span>Jan 04</span>
                    <span>Jan 05</span>
                    <span>Jan 06</span>
                </div>
            </div>
        </div>
        <div class="text-[8px] sm:text-[9px] text-gray-400 mt-2 pl-8">Time (h)</div>
    </div>
</div>
@endsection
