@extends('layouts.master')
@include('navs.error_block')
@section('content')
    <br><br>
    <a href="{{ route('readAllLetters', Auth::id()) }}">All letters</a>
    <br>
    <div class="form-group">
        <label for="topic">Topic</label>
        <textarea class="form-control" name="topic" form="postForm"></textarea>
        @error('topic')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="messageArea">Message</label>
        <textarea class="form-control" rows="3" name="message" form="postForm"></textarea>
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Default file input example</label>
        <input class="form-control" name="file" type="file" id="formFile" form="postForm" >
    </div>
    <form enctype="multipart/form-data" id="postForm" action="{{ route('postCreate') }}" method="post">
        @csrf
        <input type="submit" value="Submit">
    </form>
@endsection
