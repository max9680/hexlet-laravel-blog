@extends('layouts.app')

@section('content')
        <h1>{{$article->name}}</h1>
        <div>{{$article->body, 200}}</div>
@endsection