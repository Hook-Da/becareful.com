@extends('main')

@section('title',"| $post->title")

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<img src="{{asset('images/'.$post->image)}}">
		<h1>{{$post->title}}</h1>
		<p>{!!$post->body!!}</p>
		<hr>
		<p>Posted in:{{$post->category->name}}</p>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h3 class="comment-title"><span class="glyphicon glyphicon-comment"></span>{{$post->comments->count()}} Comments</h3>
		@foreach($post->comments as $comment)
		<div class="comment">
			<div class="author-info">
				<img src="{{"https://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email)))."?s=50&d=monsterid"}}" class="author-image">
				<div class="author-name">
				<h4>{{$comment->name}}</h4>
				<p class="author-time">{{$comment->created_at->diffForHumans()}}</p>
			</div></div>
			<div class="comment-content">{{$comment->comment}}</div>
			
		</div>
		@endforeach
	</div>
</div>
<div class="row">
	<div id="comment-form" class=" col-md-8 col-md-offset-2">
		{{Form::open(['route'=>['comments.store',$post->id],'method'=>'POST'])}}
		<div class="row">
			<div class="col-md-6">
				{{Form::label('name',"Name:")}}
				{{Form::text('name',null,['class'=>'form-control'])}}
			</div>
			<div class="col-md-6">
				{{Form::label('email',"Email:")}}
				{{Form::email('email',null,['class'=>'form-control'])}}
			</div>
			<div class="col-md-12">
				{{Form::label('comment',"Comment:")}}
				{{Form::textarea('comment',null,['class'=>'form-control'])}}
				{{Form::submit('Submit!',['class'=>'btn btn-success btn-block top-spacing'])}}
			</div>
		</div>
	</div>
</div>
@endsection