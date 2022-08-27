@extends('layouts.master')

@section('adminContent')
    

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Topic</th>
      <th scope="col">Message</th>
      <th scope="col">First name</th>
      <th scope="col">Last name</th>
      <th scope="col">Email</th>
      <th scope="col">File link</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($letters as $letter)
      <tr>
        <th scope="row">{{ $letter->id }}</th>
        <td>{{ $letter->topic }}</td>
        <td>{{ $letter->message }}</td>
        <td>name</td>
        <td>surname</td>
        <td>mark@gmail.com</td>
        <td>https://testlink.com</td>
        <td>{{ $letter->status }}</td>
    </tr>
    @endforeach
    
  </tbody>
</table>

@endsection
