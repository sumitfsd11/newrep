<nav class="navbar z-10 shadow w-full justify-end bg-base-100">
    <div class="flex-1">
        <a href="{{ route('index') }}" class="btn btn-ghost normal-case text-xl">Sacoda Serv</a>
        @auth
        <a href="{{ route('filament.resources.surveys.index') }}" class="btn btn-ghost normal-case text-lg">Surveys</a>
        <a href="{{ route('filament.resources.answers.index') }}" class="btn btn-ghost normal-case text-lg">Answers</a>
        @endauth
    </div>
    @auth
        <div class="self-end">
            <a href="{{ route('logout') }}" class="btn btn-ghost normal-case">Logout</a>
        </div>
    @else
        <div class="self-end">
            <a href="{{ route('login') }}" class="btn btn-ghost normal-case">Login</a>
        </div>
    @endauth
    <div>
        <x-theme-change with-label />
    </div>
</nav>

