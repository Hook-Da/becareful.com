@extends('main')

@section('title','| Homepage')

@section('content')
      {{Auth::check() ? "Logged In" : "Logged out"}}
      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron">
            <h1>Welcome to my blog!</h1>
            <p class="lead">Thank you so much for visiting my site. Go ahead and explore the content of it.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular post</a></p>
          </div>
        </div>
      </div><!--end of header .row -->
      <div class="row">
        <div class="col-md-8"> 

      @foreach($posts as $post)

        <div class="post">
          <h3> {{$post->title}} </h3>
          <p>
            {{str_limit(strip_tags($post->body),40)}}
          </p>
          <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read more</a>
        </div><hr>

      @endforeach
       
        </div>
        <div class="col-md-3 col-md-offset-1">
          <h2>Sidebar</h2>
        </div> 
      </div>
@endsection

