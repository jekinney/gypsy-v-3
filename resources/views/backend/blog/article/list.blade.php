@extends('backend.theme.main')

@section('content')
	<section class="content-header">
	    <h1>
	        Articles
	        <small>List of {{ $list_type }} Articles</small>
	    </h1>
	    <ol class="breadcrumb">
	        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	        <li><i class="fa fa-th-large"></i> Blog</li>
	        <li class="active"><i class="fa fa-location-arrow"></i> {{ $list_type }} Articles</li>
	    </ol>
	</section>
	<section class="content">
		<div class="row">
			<section class="col-xs-12">
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
			        	<table id="article-list" class="table">
			        		<thead>
			        			<tr>
			        				<th>Title</th>
				        			<th>Category</th>
				        			<th>Reads</th>
				        			<th>Publish At</th>
				        			<th>Options</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			@foreach($articles as $article)
									<tr>
				        				<td>{{ $article->title }}</td>
					        			<td>{{ $article->category->title }}</td>
					        			<td>{{ $article->reads }}</td>
					        			<td>{{ $article->publish_at->diffForHumans() }}</td>
					        			<td class="btn-group">
											<a href="{{ route('admin.blog.article.edit', $article->id) }}" class="btn btn-primary btn-sm">
                                            	<i class="fa fa-cog"></i>
                                        	</a>
                                        	@if($article->draft === 1)
                                        		<button class="btn btn-danger btn-sm"><i class="fa fa-check-square"></i></button>
                                        	@else
												<button class="btn btn-success btn-sm"><i class="fa fa-check-square"></i></button>
                                        	@endif
					        			</td>
			        				</tr>
			        			@endforeach
			        	</table>
			        </tbody>
			    </table>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
    <script src="{{ asset('backend/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
      $(function () {
        $("#article-list").DataTable();
      });
    </script>
@endsection