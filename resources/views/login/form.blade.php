@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1>Inloggen</h1>
    
    <form action="{{ route('login.auth') }}" method="POST">
        @csrf
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        <br>
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Log in</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection