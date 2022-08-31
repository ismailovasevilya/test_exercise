@if ($message = Session::get('msg'))
<div class="alert alert-info alert-block text-danger">
	{{-- <button type="button" class="close" data-dismiss="alert">×</button>	 --}}
	<strong>{{ $message }}</strong>
</div>
@endif