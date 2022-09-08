@extends('layouts.master')
@include('navs.error_block')
@section('content')
<div class="form-group">
        <label for="topic">Topic</label>
        <textarea readonly class="form-control" name="topic" form="postForm">{{ $letter->topic}}</textarea>
        @error('topic')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="messageArea">Message</label>
        <textarea readonly class="form-control" rows="3" name="message" form="postForm">{{ $letter->message}}</textarea>
    </div>

    {{-- <div class="mb-3">
        <label for="formFile" class="form-label">Default file input example</label>
        <input readonly class="form-control" name="file" type="file" id="formFile" form="postForm" >
    </div> --}}
    <br><br>
    <h5>Response</h5>
    
    <textarea form="postForm" class="form-control {{ $letter->status == 1 ? 'readonly' : ''}}" 
        name="response" placeholder="{{ $letter->status == 1 ? $letter->response : ''}}"></textarea>
    <form id="postForm" action="{{ route('respondLetter', $letter->id)}}" method="post">
        @csrf
        <input type="submit" value="Submit">
    </form>

@endsection