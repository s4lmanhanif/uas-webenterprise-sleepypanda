@extends('layouts.admin')

@section('title', 'Database User')

@section('content')
<div class="space-y-4 max-w-[1500px] mx-auto w-full">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-[#272E49] p-3 sm:p-5 rounded-2xl shadow-sm border border-[#272E49]/[0.2] flex flex-col justify-between h-auto sm:h-32">
            <h3 class="text-xs font-medium text-gray-200 uppercase tracking-wider">Total Users</h3>
            <div class="flex items-end gap-3 mt-2">
                <span class="material-icons-outlined text-4xl text-white/80 font-light">perm_identity</span>
                <span class="text-3xl font-bold text-white">4500</span>
            </div>
        </div>
        <div class="bg-[#272E49] p-3 sm:p-5 rounded-2xl shadow-sm border border-[#272E49]/[0.2] flex flex-col justify-between h-auto sm:h-32">
            <h3 class="text-xs font-medium text-gray-200 uppercase tracking-wider">Active Users</h3>
            <div class="flex items-end gap-3 mt-2">
                <span class="material-icons-outlined text-4xl text-white/80 font-light">person</span>
                <span class="text-3xl font-bold text-white">3500</span>
            </div>
        </div>
        <div class="bg-[#272E49] p-3 sm:p-5 rounded-2xl shadow-sm border border-[#272E49]/[0.2] flex flex-col justify-between h-auto sm:h-32">
            <h3 class="text-xs font-medium text-gray-200 uppercase tracking-wider">New Users</h3>
            <div class="flex items-end gap-3 mt-2">
                <span class="material-icons-outlined text-4xl text-white/80 font-light">person_add</span>
                <span class="text-3xl font-bold text-white">500</span>
            </div>
        </div>
        <div class="bg-[#272E49] p-3 sm:p-5 rounded-2xl shadow-sm border border-[#272E49]/[0.2] flex flex-col justify-between h-auto sm:h-32">
            <h3 class="text-xs font-medium text-gray-200 uppercase tracking-wider">Inactive Users</h3>
            <div class="flex items-end gap-3 mt-2">
                <span class="material-icons-outlined text-4xl text-white/80 font-light">person_off</span>
                <span class="text-3xl font-bold text-white">500</span>
            </div>
        </div>
    </div>

    <!-- User Table -->
    <div class="bg-surface-light dark:bg-surface-dark rounded-2xl shadow-sm border border-transparent overflow-hidden flex flex-col min-h-[500px]">
        <!-- Table Header -->
        <div class="p-3 sm:p-5 flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="w-full md:w-1/2 lg:w-1/3">
                <div class="flex items-center bg-gray-50 dark:bg-[#242B46] rounded-xl px-4 py-2 border border-transparent focus-within:border-[#FF5A5F] transition-colors">
                    <span class="material-icons-outlined text-gray-400">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-sm w-full text-gray-800 dark:text-gray-200 placeholder-gray-500 ml-2" placeholder="Search by name, email, or ID" type="text"/>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <button class="flex-1 md:flex-none flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-transparent bg-gray-50 dark:bg-[#242B46] text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-[#2A3250] transition-colors text-sm font-medium">
                    <span class="material-icons-outlined text-lg">filter_list</span>
                    Sort by
                </button>
                <button class="flex-1 md:flex-none flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-transparent bg-gray-50 dark:bg-[#242B46] text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-[#2A3250] transition-colors text-sm font-medium">
                    <span class="material-icons-outlined text-lg">refresh</span>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-[#242B46] border-b border-transparent text-base capitalize tracking-wider text-white font-semibold">
                        <th class="px-6 py-4 text-center">User</th>
                        <th class="px-6 py-4 text-center">Contact</th>
                        <th class="px-6 py-4 text-center">Sleep Status</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Last Active</th>
                        
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-base font-semibold text-white">
                    @php
                    $users = [
                        ['name' => 'Alfonso de', 'id' => '418230', 'email' => 'Alfonso.de@gmail.com', 'phone' => '+62123456789', 'avgSleep' => '7.2h', 'quality' => '85%', 'status' => 'Active', 'date' => '2024-02-01', 'time' => '14:30'],
                        ['name' => 'Alfonso de', 'id' => '418230', 'email' => 'Alfonso.de@gmail.com', 'phone' => '+62123456789', 'avgSleep' => '1.2h', 'quality' => '20%', 'status' => 'Not Active', 'date' => '2024-02-01', 'time' => '14:30'],
                    ];
                    @endphp
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="p-2 rounded-full bg-transparent text-white">
                                    <span class="material-icons-outlined text-3xl">account_circle</span>
                                </div>
                                <div>
                                    <div class="font-medium text-white">{{ $user['name'] }}</div>
                                    <div class="text-white">ID #{{ $user['id'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2 text-white">
                                    <span class="material-icons-outlined">email</span>
                                    {{ $user['email'] }}
                                </div>
                                <div class="flex items-center gap-2 text-white">
                                    <span class="material-icons-outlined">phone</span>
                                    {{ $user['phone'] }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-white">Avg. Sleep: <span class="font-semibold">{{ $user['avgSleep'] }}</span></div>
                                <div class="text-white">Quality: {{ $user['quality'] }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($user['status'] == 'Active')
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-blue-500 text-white border border-blue-500">
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-red-600 text-white border border-red-600">
                                Not Active
                            </span>
                        @endif
                        </td>
                        <td class="px-6 py-4 text-white">
                            <div>{{ $user['date'] }}</div>
                            <div class="mt-0.5">{{ $user['time'] }}</div>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
