@extends('main')

@section('title','| Edit')
@section('stylesheets')

	{!!Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css')!!}
	{!! Html::style('css/parsley.css') !!}
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xsth51xvgw4wdkarb7nx4v5p7doyl042l19imq20w314776v"></script>
    <script>tinymce.init({ selector:'textarea',
    						height: 300, theme: 'modern', plugins: [ 'advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', ' paste textcolor colorpicker textpattern imagetools codesample toc' ], toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image', toolbar2: 'print preview media | forecolor backcolor emoticons | codesample', image_advtab: true, templates: [ { title: 'Test template 1', content: 'Test 1' }, { title: 'Test template 2', content: 'Test 2' } ], content_css: [ '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i', '//www.tinymce.com/css/codepen.min.css' ] });</script>

@endsection

@section('content')
	<div class="row">
	{!!Form::model($post,['route'=>['posts.update',$post->id],'method'=>'PUT','data-parsley-validate'=>'','files'=>true])!!}
		<div class="col-md-8">
			{{Form::label('title','Title:',['class'=>'top-spacing'])}}
			{{ Form::text('title',null,['class'=>'form-control input-lg','required'=>'']) }}
			{{Form::label('slug','Slug:',['class'=>'top-spacing'])}}
			{{Form::text('slug',null,['class'=>'form-control','required'=>''])}}
			{{Form::label('category_id','Category:')}}
			{{Form::select('category_id',$categories,null,['class'=>'form-control'])}}
			{{Form::label('tags','Tags:')}}
			{{Form::select('tags[]',$tags,null,['class'=>'form-control select-multi','multiple'=>'multiple'])}}
			{{Form::label('featured_image','Image')}}
			{{Form::file('featured_image')}}
			{{Form::label('body','Body:',['class'=>'top-spacing'])}}
			{{Form::textarea('body',null,['class'=>'form-control','required'=>''])}}
			
			
		</div>

		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created at:</dt>
					<dd>{{date('M j,Y H:i',strtotime($post->created_at))}}</dd>
				</dl>
				
				<dl class="dl-horizontal">
					<dt>Last Updated at:</dt>
					<dd>{{date('M j,Y h:ia',strtotime($post->updated_at))}}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!!Html::linkRoute('posts.show','Cancel',array($post->id),array('class'=>'btn btn-danger btn-block'))!!}
											
					</div>
					<div class="col-sm-6">
						{{Form::submit('Save changes',['class'=>'btn btn-success btn-block'])}}<!-- makes button -->
					</div> 
				</div>
			</div>
		</div>
		{!!	Form::close()!!}
	</div><!-- end of .row (form) -->
@stop
@section('scripts')
	{!!Html::script('js/parsley.min.js')!!}
	{!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js')!!}
	{!!Html::script('js/select.js')!!}
@stop