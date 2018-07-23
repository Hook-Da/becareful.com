@extends('main')

@section('title', '| View Post')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>

			<p class="lead">{!! $post->body !!}</p><hr>
		
		<div class="tags">
			@foreach($post->tags as $tag)
				<span class="label label-default">{{$tag->name}}</span>
			@endforeach
		</div>
		<div id="backend-commends">
			<h3>Comments<small>{{$post->comments->count()}}</small></h3>
			<table class="table">
				<thead>
					<tr>
						<th>Name:</th>
						<th>Email:</th>
						<th>Comment:</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($post->comments as $comment)
					<tr>
						<td>{{$comment->name}}</td>
						<td>{{$comment->email}}</td>
						<td>{{$comment->comment}}</td>
						<td class="wider"><a href="{{route('comments.edit',$comment->id)}}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="{{route('comments.delete',$comment->id)}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>


	</div>

		<div class="col-md-4">
			<div class="well">
				<dl >
					<dt>Url Slug:</dt>
					<dd>{{route('blog.single',$post->slug) }}</dd>
				</dl>
				<dl >
					<dt>Created at:</dt>
					<dd>{{date('M j,Y H:i',strtotime($post->created_at))}}</dd>
				</dl>
				<dl >
					<dt>Category:</dt>
					<dd>{{$post->category->name}}</dd>
				</dl>
				
				<dl class="dl-horizontal">
					<dt>Last Updated at:</dt>
					<dd>{{date('M j,Y h:ia',strtotime($post->updated_at))}}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!!Html::linkRoute('posts.edit','Edit',[$post->id],['class'=>'btn btn-primary btn-block'])!!}
											
					</div>
					<div class="col-sm-6">
						{!!Form::open(['route'=>['posts.destroy',$post->id],'method'=>'DELETE'])!!}

						<!-- makes button -->
						{{Form::submit('Delete',['class'=>'btn btn-danger btn-block '])}}
						{!!Form::close()!!}
					</div> 
				</div>
				<div class="row">
					<div class="col-md-12">
						{{Html::linkRoute('posts.index','See All Posts',[],['class'=>'btn btn-success btn-lg top-spacing btn-block '])}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
