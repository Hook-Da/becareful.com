@extends('main')

@section('title','| Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!!	Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css')!!}
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xsth51xvgw4wdkarb7nx4v5p7doyl042l19imq20w314776v"></script>
    <script>tinymce.init({ selector:'textarea',
    						height: 300, theme: 'modern', plugins: [ 'advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'paste textcolor colorpicker textpattern imagetools codesample toc' ], toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image', toolbar2: 'print preview media | forecolor backcolor emoticons | codesample', image_advtab: true, templates: [ { title: 'Test template 1', content: 'Test 1' }, { title: 'Test template 2', content: 'Test 2' } ], content_css: [ '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i', '//www.tinymce.com/css/codepen.min.css' ] });</script>

@endsection

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Create New Post</h1>
		<hr>

		{!! Form::open(['route' => 'posts.store','data-parsley-validate'=>'','files'=>true]) !!}
    		{{Form::label('title','Title:')}}
    		{{Form::text('title',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}

			{{Form::label('slug','Slug:')}}
			{{Form::text('slug',null,array('class'=>'form-control','required'=>'','minlength'=>'5','maxlength'=>'255'))}}

			{{Form::label('category_id','Category:')}}
			{{Form::select('category_id',$categories,null,['class'=>'form-control'])}}

			{{Form::label('tags','Tags:')}}
			{{Form::select('tags[]',$tags,null,['class'=>'form-control select-multi','multiple'=>'multiple'])}}
			
			{{Form::label('featured_image','Upload Featured Image:')}}
			{{Form::file('featured_image',['class'=>'btn btn-success btn-xs'])}}

    		{{Form::label('body','Body:')}}
    		{{Form::textarea('body',null,array('class'=>'form-control'))}}

    		{{Form::submit('Create Post',array('class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px;'))}}
		{!! Form::close() !!}
	</div>
</div>

@endsection

@section('scripts')

	{!!Html::script('js/parsley.min.js')!!}
	{!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js')!!}
	{!!Html::script('js/select.js')!!}

@endsection