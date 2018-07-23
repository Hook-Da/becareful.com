@extends('main')

@section('title','| Register form')

@section('content')

@if(count($errors)>0)
	@foreach($errors as $error)
		<p>{{$error}}</p>
	@endforeach
@endif

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			{!! Form::open()!!}
			
			{{Form::label('name',"Name:")}}
			{{Form::text('name',null,['class'=>'form-control'])}}

			{{Form::label('email','Email:')}}
			{{Form::email('email',null,['class'=>'form-control'])}}

			{{Form::label('password','Password:')}}
			{{Form::password('password',['class'=>'form-control'])}}

			{{Form::label('password_confirmation','Password confirmation:')}}
			{{Form::password('password_confirmation',['class'=>'form-control'])}}
			{{Form::submit('Register',['class'=>'btn btn-primary btn-block top-spacing'])}}

			{!! Form::close()!!}
		</div>
	</div>

@stop