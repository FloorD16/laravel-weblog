@extends('layouts.app')

@section('title', 'Posts')

@section('content')

    <h1>Posts</h1>

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