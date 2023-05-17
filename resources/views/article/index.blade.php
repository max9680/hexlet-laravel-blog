@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2><a href="/articles/{{$article->id}}">{{$article->name}}</a>
            <p><small><a href="/articles/{{$article->id}}/edit">edit</a></small><small>
            <a href="/articles/{{$article->id}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">remove</a></small></p></h2>
        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
@endsection