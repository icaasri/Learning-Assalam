<ul class="space-y-2">
    <li>
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
            Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('admin.courses.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.courses.*') ? 'bg-gray-700' : '' }}">
            Kelola Mata Pelajaran
        </a>
    </li>
    <li>
        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : '' }}">
            Kelola Pengguna
        </a>
    </li>
    <li>
        <a href="{{ route('admin.assignments.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.assignments.*') ? 'bg-gray-700' : '' }}">
            Penugasan
        </a>
    </li>
</ul>