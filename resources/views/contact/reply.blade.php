@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Reply to: {{ $contact->name }}</h2>

        <form method="POST" action="{{ route('contact.sendReply', $contact->id) }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">To Email</label>
                <input type="email" class="form-control" value="{{ $contact->email }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Reply Message</label>
                <textarea name="reply_message" rows="5" class="form-control" required></textarea>
                @error('reply_message')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Send Reply</button>
        </form>
    </div>
@endsection
