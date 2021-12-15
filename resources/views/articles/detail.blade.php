@extends('layouts.app')

@section('content')
<div class="container mt-5" style="width: 50%;">

    @if (session('error'))
    <div id="unauthorized-delete" class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">
                {{ $article->title }}
            </h5>
            <div class="card-subtitle mb-2 text-muted small">
                {{ $article->created_at->diffForHumans() }},
                {{ $article->category->name }}
            </div>
            <p class="card-text">
                {{ $article->body }}
            </p>
            <a href="{{ url("articles/delete/$article->id") }}" class="btn btn-warning">
                Delete
            </a>
        </div>
    </div>
    <ul class="list-group mb-3">
        <div class="list-group-item active">
            <b>Comment ( {{ count($article->comments) }} )</b>
        </div>
        @foreach ($article->comments as $comment)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="me-auto">
                {{ $comment->content }}
                <div class="small mt-2">
                    By <b>{{ $comment->user->name }}</b>,
                    {{ $article->created_at->diffForHumans() }}
                </div>
            </div>
            <a href="{{ url("comments/delete/$comment->id") }}" class="text-decoration-none text-danger float-end">
                &#215
            </a>
        </li>
        @endforeach
    </ul>

    @auth
    <form action="{{ url('comments/add') }}" method="post">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <textarea name="content" class="form-control mb-2" rows="3" placeholder="New Comment"></textarea>
        <button type="submit" class="btn btn-secondary">Add Comment</button>
    </form>
    @endauth
</div>

@endsection
