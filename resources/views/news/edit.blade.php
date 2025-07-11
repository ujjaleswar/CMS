@extends('layouts.app')
@section('content')
    <form action="{{ route('News.update', $blogs->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="blog_name">Tittle</label>
            <input type="text" class="form-control" id="name" name="news_title" value="{{ $blogs->title }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">News description</label>
            <textarea class="form-control" id="description" name="news_description" rows="3">{{ $blogs->description }}</textarea>
        </div><br>
        <button type="submit" class="btn btn-primary" name="btn">Submit</button>
    </form>
@endsection
