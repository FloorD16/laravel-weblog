@extends('layouts.app')

@section('title', 'Create')

@section('content')
    <h1>Nieuw Artikel Schrijven</h1>
    
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="body">Tekst:</label>
        <textarea id="body" name="body" required></textarea>
        <br>
        <button type="submit">Opslaan</button>
    </form>
@endsection