@extends('layouts.app')

@section('title', 'Create')

@section('content')
    <h1>Nieuwe Categorie Aanmaken</h1>
    
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <label for="name">Naam categorie:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <button type="submit">Opslaan</button>
    </form>
@endsection