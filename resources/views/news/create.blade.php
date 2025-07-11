@extends('layouts.app')

@section('content')
    <form id="subform" action="{{ route('News.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="blog_name">Title</label>
            <input type="text" class="form-control" id="name" name="news_title">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">News description</label>
            <textarea class="form-control" id="description" name="news_description" rows="3"></textarea>
        </div><br>
        <button type="submit" class="btn btn-primary" id="subbtn" name="submit">Submit</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#subform').submit(function(e) {
                var name = $("#name").val();
                var description = $("#description").val();

                // Clear any existing error messages
                $('.error').remove();

                // Check if name is empty
                if (name == "") {
                    e.preventDefault();
                    if ($('#name').next('.error').length === 0) {
                        $('#name').after('<span class="error" style="color:red">enter your name</span>');
                    }
                }

                // Check if description is empty
                if (description == "") {
                    e.preventDefault();
                    if ($('#description').next('.error').length === 0) {
                        $('#description').after(
                            '<span class="error" style="color:red">fill the description filed</span>');
                    }
                }
            });
        });
    </script>
@endsection
