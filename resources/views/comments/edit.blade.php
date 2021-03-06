@extends('main')

@section('title','| Edit Comment')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
	<h1>Edit Comment:</h1>

	{!!Form::model($comment,['route'=>['comments.update',$comment->id],'method'=>'PUT'])!!}
	{{Form::label('name','Name:')}}
	{{Form::text('name',null,['class'=>'form-control','disabled'=>'disabled'])}}
	{{Form::label('email','Email:')}}
	{{Form::email('email',null,['class'=>'form-control'])}}
	{{Form::label('comment','Comment:')}}
	{{Form::textarea('comment',null,['class'=>'form-control'])}}
	{{Form::submit('Save!',['class'=>'btn btn-primary btn-lg btn-block top-spacing'])}}
	{!!Form::close()!!}
</div>
	</div>
@endsection