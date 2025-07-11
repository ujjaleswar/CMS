@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form method="POST" action="{{ route('store-class') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Class</label>
                <input type="text" name="class" id="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
