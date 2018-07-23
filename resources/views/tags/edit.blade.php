@extends('main')

@section('title'," Edit $tag->name tag")

@section('content')
<div class="row">
	<div class="col-md-8">
	{!!Form::model($tag,['route'=>['tags.update',$tag->id],'method'=>'PATCH'])!!}
		{{Form::label('name','Title:',['class'=>'top-spacing'])}}
		{{Form::text('name',$tag->name,['class'=>'form-control'])}}
		{{Form::submit('Edit',['class'=>'btn btn-primary btn-sm top-spacing'])}}
	{!!Form::close()!!}
	</div>
</div>
@stop