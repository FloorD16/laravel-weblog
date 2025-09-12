@extends('layouts.app')

@section('title', 'Posts')

@section('content')

    <h1>Posts</h1>

    <h3>Filter op categorie</h3>

    <form action="{{ route('posts.filter') }}" method="GET">
        <label for="categories">Kies categorieën:</label>
        <select id="categories" name="categories[]" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br><br>
        <button type="submit">Pas filter toe</button>
    </form>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th></th>
                <th>Plaatsingsdatum</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr onclick="window.location='{{ route('posts.show', $post->id) }}'" class="hover:bg-gray-100 cursor-pointer"
                    style="cursor: pointer;" onmouseover="this.style.color='#1b74bdff';" onmouseout="this.style.color='#000000ff';">
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection