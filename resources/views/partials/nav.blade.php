<nav>
    <ul>
        <li><a href="{{ route('posts.index') }}">Overzicht</a></li>
        <li><a href="{{ route('posts.create') }}">Nieuw artikel</a></li>
        
        @auth
            <li>
                <a href="{{ route('user.index', ['user_id' => Auth::id()]) }}">Mijn artikelen</a>
            </li>
            <li>
                <a href="{{ route('category.create') }}">Nieuwe categorie toevoegen</a>
            </li>
            @if(Auth::user()['is_premium'] === 0)
                <li>
                    <form action="{{ route('user.upgrade', ['user_id' => Auth::id()]) }}" method="POST">
                        @csrf
                        <button type="submit">Wordt premium lid</button>
                    </form>
                </li>
            @endif
            @if(Auth::user()['is_premium'] === 1)
                <li>
                    <a href="{{ route('posts.premium') }}">Premium artikelen</a>
                </li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Uitloggen</button>
                </form>
            </li>
        @endauth

        @guest
            <li>
                <a href="{{ route('login') }}">Inloggen</a>
            </li>
        @endguest

    </ul>
</nav>