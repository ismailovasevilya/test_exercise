{{-- @extends('layouts.master')

@section('content')
<br><br><br>
    <form>
        <div class="form-group">
            <label for="topic">Topic</label>
            <textarea class="form-control" id="topic" name="topic" form="postForm"></textarea>
        </div>
        <div class="form-group">
            <label for="messageArea">Message</label>
            <textarea class="form-control" id="messageArea" rows="3" name="message" form="postForm"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox"> Check me out
            </label>
        </div>
        <form id="postForm" action="{{ route('postCreate') }}" method="post">
            @csrf
            <input type="submit" value="Submit" class="btn btn-default">
        </form>
    </form>
@endsection --}}


@extends('layouts.master')

@section('content')
<br><br><br>
    <div class="form-group">
        <label for="topic">Topic</label>
        <textarea class="form-control" name="topic" form="postForm"></textarea>
    </div>
    <div class="form-group">
        <label for="messageArea">Message</label>
        <textarea class="form-control" rows="3" name="message" form="postForm"></textarea>
    </div>

    <form id="postForm" action="{{ route('postCreate') }}" method="post">
        @csrf
        <input type="submit" value="Submit">
    </form>
@endsection
