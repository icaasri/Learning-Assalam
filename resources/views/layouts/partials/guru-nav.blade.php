<ul class="space-y-2">
    <li>
        <a href="{{ route('guru.materials.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('guru.materials.*') ? 'bg-gray-700' : '' }}">
            Kelola Materi
        </a>
    </li>
    <li>
        <a href="{{ route('guru.quizzes.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('guru.quizzes.*') ? 'bg-gray-700' : '' }}">
            Kelola Kuis
        </a>
    </li>
</ul>