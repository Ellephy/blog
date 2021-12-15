@extends('layouts.app')

@section('content')
<div class="container mt-5" style="width: 60%;">

    @if (session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
    @endif

    {{ $articles->links() }}
    @foreach ($articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                {{ $article->title }}
            </h5>
            <div class="card-subtitle mb-2 text-muted small">
                {{ $article->created_at->diffForHumans() }}
            </div>
            <p class="card-text">
                {{ $article->body }}
            </p>
            <a href="{{ url("articles/detail/$article->id") }}" class="card-link text-decoration-none">
                View Detail &raquo;
            </a>
        </div>
    </div>
    @endforeach
    {{ $articles->links() }}
</div>
@endsection
