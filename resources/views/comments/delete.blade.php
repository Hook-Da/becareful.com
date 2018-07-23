@extends('main')

@section('title', '| View Post')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Do you really want to delete this comment?</h1>
			{!!Form::open(['route'=>['comments.destroy',$comment->id],'method'=>'DELETE'])!!}

						<!-- makes button -->
			{{Form::submit('Delete',['class'=>'btn btn-danger btn-block '])}}
			{!!Form::close()!!}
		</div>
	</div>

@stop