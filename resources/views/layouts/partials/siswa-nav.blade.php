<ul class="space-y-2">
    <li>
        <a href="{{ route('siswa.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('siswa.dashboard') ? 'bg-gray-700' : '' }}">
            Dashboard
        </a>
    </li>
    </ul>