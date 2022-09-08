@extends('layouts.master')

@section('content')
    <br><br><br>
    <br><br><br>
    @foreach ($letters as $letter)
        <div></div>
        <div class="form-group">
            <label for="topic">Topic</label>
            <textarea readonly class="form-control" name="topic">{{ $letter->topic }}</textarea>
        </div>
        <div class="form-group">
            <label for="messageArea">Message</label>
            <textarea readonly class="form-control" rows="3" name="message" form="postForm">{{ $letter->message }}</textarea>
        </div>
        <div>
            <label for="messageArea">Response</label>
            <textarea readonly class="form-control" rows="3" name="message" form="postForm">{{ $letter->response }}</textarea>
        </div>
    @endforeach
@endsection
