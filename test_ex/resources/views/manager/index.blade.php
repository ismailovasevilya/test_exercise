@extends('layouts.master')

@section('adminContent')
    

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Topic</th>
      <th scope="col">Message</th>
      <th scope="col">First name</th>
      <th scope="col">Email</th>
      <th scope="col">File link</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($letters as $letter)
    <form id="postForm" action="{{ route('managerPostLetters', $letter->id)}}" method="post">
      @csrf
      
    
      <tr>
        <th scope="row">{{ $letter->id }}</th>
        <td>{{ $letter->topic }}</td>
        <td>{{ $letter->message }}</td>
        
        <td>{{ $users->find($letter->user_id)->name }} </td>
        <td>{{ $users->find($letter->user_id)->email }}</td>
        <td>{{ $letter->file }}</td>
        <td><input class="respond {{$letter->status == 1 ?'yes':'no'}}" 
          type="submit" name="status" {{$letter->status == 1 ?'checked':''}} 
          value="Respond"></td>
      </form>
    </tr>
    @endforeach

    
    
  </tbody>
</table>

</script>

@endsection

