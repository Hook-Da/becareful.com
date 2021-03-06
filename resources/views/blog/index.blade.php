@extends('main')

@section('title','| Blog')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Blog</h1>
	</div>
</div>
@foreach($posts as $post)
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h2>{{$post->title}}</h2>
		<h5>Published date:{{ date('M j, Y',strtotime($post->created_at))}}</h5>
		<p>{!! str_limit($post->body,200) !!} </p>
		<a href="{{ route('blog.single',$post->slug) }}" class="btn btn-success">View Post</a>
	</div>
</div><hr>
@endforeach
<div class="row">
	<div class="col-md-12 text-center">
		{!! $posts->links(); !!}
	</div>
</div>

@endsection