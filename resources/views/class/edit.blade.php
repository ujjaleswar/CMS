@extends('layouts.app')

@section('content')
    <div class="container mt-4">


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('update-class', $class->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="class" class="form-label">Class Name</label>
                <input type="text" name="class" id="class" class="form-control"
                    value="{{ old('class', $class->class) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('class-listing') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
