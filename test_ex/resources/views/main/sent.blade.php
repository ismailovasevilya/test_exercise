@extends('layouts.master')

@section('content')

<br><br><br>
<h1>Your letter is sent</h1>
<br><br><br>
    <div class="form-group">
        <label for="topic">Topic</label>
        <textarea readonly class="form-control" name="topic">{{ $letter->topic }}</textarea>
    </div>
    <div class="form-group">
        <label for="messageArea">Message</label>
        <textarea readonly class="form-control" rows="3" name="message" form="postForm">{{ $letter->message }}</textarea>
    </div>

@endsection
