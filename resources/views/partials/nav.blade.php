<nav>
    <ul>
        <li><a href="{{ route('posts.index') }}">Overzicht</a></li>
        <li><a href="{{ route('posts.create') }}">Nieuw artikel</a></li>
        
        @auth
            <li>
                <a href="{{ route('user.index', ['user_id' => Auth::id()]) }}">Mijn artikelen</a>
            </li>
        @endauth

        @guest
            <li>
                <a href="{{ route('login') }}">Inloggen</a>
            </li>
        @endguest

        @auth
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Uitloggen</button>
                </form>
            </li>
        @endauth

    </ul>
</nav>