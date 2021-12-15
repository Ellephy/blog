@extends('layouts.app')

@section('content')
<div class="container mt-5" style="width: 50%">
    @if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Article</button>
    </form>
</div>
@endsection
