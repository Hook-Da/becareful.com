@if(Session::has('success') || Session::has('Status'))
	<div class="alert alert-success" role="alert">
		<strong>Success:</strong>{{Session::get('success')}}{{Session::get('Status')}}
	</div>
@endif

@if (count($errors) > 0)

	<div class="alert alert-danger" role="alert">
		<strong>Errors:</strong>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif