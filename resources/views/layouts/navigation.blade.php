<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    @if(auth()->user()->role === 'admin')
        <x-nav-link :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.*')">
            {{ __('Mata Pelajaran') }}
        </x-nav-link>
        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
            {{ __('Pengguna') }}
        </x-nav-link>
    @endif
    </div>