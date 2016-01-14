@extends('backend.theme.main')

@section('content')
	<section class="content-header">
	    <h1>
	        Article Creater
	        <small>Create a new Article</small>
	    </h1>
	    <ol class="breadcrumb">
	        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	        <li><i class="fa fa-th-large"></i> Blog</li>
	        <li class="active"><i class="fa fa-location-arrow"></i> Create Article</li>
	    </ol>
	</section>
	<section class="content">
		<div class="row">
			<section class="col-xs-12 col-md-9">
		        <div class="box box-info">
		            <div class="box-header">
		                <h3 class="box-title">
		                    Create New Article Form
		                </h3>
		                <div class="pull-right box-tools">
		                    <a role="button" class="text-primary" data-toggle="modal" data-target="#article-form-help">
		                        <i class="fa fa-question-circle fa-2x"></i>
		                    </a>
		                </div>
		            </div>
			        <div class="box-body pad">
			            <form action="{{ route('admin.blog.article.store') }}" method="post" enctype="multipart/form-data">
			                {{ csrf_field() }}
			                <img id="header-preview" src="#" alt="Your Header Image" class="img-responsive" style="max-height:300px; max-width:1200px;">
			                <div class="form-group">
			                	<label for="header">Header Image/Banner</label>
			                	<input type="file" name="header_image"  id="header" class="form-control">
			                </div>
			                <div class="row">
				                <div class="form-group col-xs-12 col-sm-6">
				                    <label for="category">Category:</label>
				                    <select name="category_id" id="category" class="form-control">
				                        <option value="">Select A Category</option>
				                        @foreach($categories as $category)
				                            <option 
				                                value="{{ $category->id }}" 
				                                @if(old('category_id') == $category->id) selected @endif 
				                            >
				                                {{ $category->title }}
				                            </option>
				                        @endforeach
				                    </select>
				                </div>
				                <div class="form-group col-xs-6 col-sm-3 date">
			                        <label for="publish_at">Publish Date</label>
			                        <input 
			                            type="text" 
			                            name="publish_at" 
			                            id="publish_at" 
			                            value="{{ old('publish_at') }}" 
			                            class="form-control" 
			                            data-provide="datepicker"
			                            data-date-format="yyyy-mm-dd"
			                            required 
			                        >
			                    </div>
			                    <div class="checkbox col-xs-6 col-sm-3" style="margin-top:30px;">
			                        <label for="draft">
				                        <input 
				                            type="checkbox" 
				                            name="draft" 
				                            id="draft" 
				                            value="1" 
				                            class="flat-red"
				                            @if(old('draft')) checked="true" @endif 
				                        >
				                        Keep Article as a Draft
				                    </label>
			                    </div>
			                </div>
		                    <div class="form-group">
		                        <label for="title">Title</label>
		                        <input 
		                            type="text" 
		                            name="title" 
		                            id="title" 
		                            value="{{ old('title') }}" 
		                            class="form-control" 
		                            placeholder="Title for your Article"
		                            required
		                            maxlength="120" 
		                        >
		                    </div>
			                <div class="form-group">
			                    <label for="snippet">Snippet (Short overview or part of your article) </label>
			                    <textarea name="snippet" id="snippet" class="form-control">{{ old('snippet') }}</textarea>
			                </div>
			                <div class="form-group">
			                    <label for="body">Article Body</label>
			                    <textarea name="body" id="body" class="form-control">{{ old('body') }}</textarea>
			                </div>
			                <div class="form-group text-right">
			                    <button type="submit" class="btn btn-primary">Add Article</button>
			                </div>
			            </form>
			        </div>
			    </div>
		    </section>
		    <aside class="hidden-xs col-sm-3">
		        <div class="box box-success">
		            <div class="box-header">
		                <h3 class="box-title">
		                    Images For Articles
		                </h3>
		            </div>
		            <div class="box-body pad">
		            </div>
		        </div>
		    </aside>
		</div>
	</section>
	@include('backend.blog.article.modals.form_help')
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/icheck.min.js"></script>
    
    <script>
	    function readURL(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
	                $('#header-preview').attr('src', e.target.result);
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	    
	    $("#header").change(function(){
	        readURL(this);
	    });
        $(function () {
            CKEDITOR.replace('body');
        });
        $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_square',
                increaseArea: '20%' 
            });
    </script>
@endsection