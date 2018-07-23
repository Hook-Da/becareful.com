@extends('main')

@section('title',"| $tag->name")

@section('content')
<div class="row">
	<div class="col-md-8"><h1>
		{{$tag->name}}
	</h1></div>
	<div class="col-md-2">
		<a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary top-spacing2 btn-block">Edit</a>
	</div>
	<div class="col-md-2">
		{!!Form::open(['route'=>['tags.destroy',$tag->id],'method'=>'DELETE'])!!}
		{{Form::submit('Delete',['class'=>'btn btn-danger btn-block top-spacing2'])}}
		{!!Form::close()!!}
	</div>
</div><hr>
<div class="row">
	<div class="col-md-8">
	<table class="table">
		<thead><tr>
			<th>#</th>
			<th>Tag name</th>
			<th>Posts with tag</th>
			<th></th></tr>
		<tbody>
		@foreach($tag->posts as $post)
		<tr>
			<th>{{$post->id}}</th>
			<td>{{$post->title}}</td>
			<td>
				@foreach($post->tags as $tag)
				<span class="label label-default">{{$tag->name}}</span>
				@endforeach
			</td>
			<td><a href="{{route('posts.show',$post->id)}}" class="btn btn-primary btn-xs">View</a></td>
		</tr>
		@endforeach
		</tbody>
		</thead>
	</table>
</div>
</div>

@stop