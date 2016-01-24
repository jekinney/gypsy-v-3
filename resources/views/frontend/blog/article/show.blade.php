@extends('frontend.theme.main')

@section('content')
	<section class="thumbnail">
		<img src="{{ asset($article->header_image) }}">
		<div class="caption">
			<header>
				<h1>{{ $article->title }}</h1>
			</header>
			<footer>
				<ul class="list-inline">
					<li>Author: {{ $article->author->username }}</li>
					<li>Category: {{ $article->category->title }}</li>
					<li>Published on: {{ $article->publish_at->diffForHumans() }}</li>
					<li>Reads: {{ $article->reads }}</li>
				</ul>
			</footer>
			<hr>
			<article class="lead">
				{!! $article->body !!}
			</article>
		</div>
	</section>

	<section id="comments" data-article-id="{{ $article->id }}" class="panel panel-default">
		<div class="panel-body">	
		<header>
			<h3>
				Total of 
				<span id="comment-count" data-comment-count="{{ $article->comments->count() }}" v-text="commentCount"></span> 
				Comments
				<div class="pull-right text-right">
					<button @click="displayAllComments" class="btn btn-primary">See All Comments</button>
				</div>
			</h3>
		</header>
			@if(auth()->guest())
				<h5 class="text-center">Sorry, you must be logged in to leave a comment</h5>
			@endif
			<div  v-for="comment in comments" class="media">
			  	<div class="media-left">
			      	<img class="media-object img-circle" 
			      		:src="comment.user.avatar" 
			      		:bind:alt="comment.user.username"
			      		height="75px" 
			      	>
			  	</div>
			  	<div class="media-body">
			    	<h4 class="media-heading">
			    		<span v-text="comment.user.username"></span> 
			    		said on 
			    		<span v-text="formatCreatedAtDate(comment.created_at)"></span>
			    	</h4>
			    	<span v-html="comment.body"></span>
			  	</div>
			</div>
			@if(auth()->check())
				<form method="post" @submit.prevent="addComment">
					<h5 v-show="validation.error" v-text="validation.message" class="text-danger"></h5>
					<div class="form-group" :class="{ 'has-error': validation.error }">
						<label for="comment" class="control-label">Leave a comment</label>
						<textarea v-model="comment" id="comment" class="form-control"></textarea>
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-primary">Leave Comment</button>
					</div>
				</form>
			@endif
		</div>
	</section>
@endsection

@section('scripts')
	<script>
	new Vue({
		el: '#comments',

		data: {
			article_id: 0,
			commentCount: 0,
			comments: {},
			comment: '',
			showAllComments: false,
			commentsLoading: false,
			apiError: {
				error: false,
				message: '',
			},
			validation: {
				error: false,
				message: ''
			},
		},
		ready: function() {
			this.article_id   = document.getElementById('comments').dataset.articleId;
			this.commentCount = document.getElementById('comment-count').dataset.commentCount;
			this.getLatestComments();
		},
		methods: {
			getLatestComments: function() {
				this.$http.get('/blog/comment/latest/'+this.article_id).then(function(response) {
					this.clearApiErrorData();
					this.$set('comments', response.data);
				}, function(response) {
					this.setApiErrorData();
				});
			},
			getAllComments: function() {
				this.$http.get('/blog/comment/all/'+this.article_id).then(function(response) {
					this.clearApiErrorData();
					this.$set('comments', response.data);
				}, function(response) {
					this.setApiErrorData();
				});
			},
			addComment: function() {
				this.validateComment();
				this.$http.post('/blog/comment/add', {article_id: this.article_id, body: this.comment}).then(function(response) {
					this.comment = '';
					this.displayComments(response.data);
					this.successMessage('Comment Added');
				}, function(response) {
					this.errorMessage('Oops, something went wrong');
				});
			},
			displayAllComments: function() {
				this.showAllComments = true;
				this.comments = {};
				this.getAllComments();
			},
			clearApiErrorData: function() {
				this.apiError = {error: false, message: ''};
			},
			setApiErrorData: function() {
				this.ApiError = {error: true, message: 'Sorry, Could not get the comments at this time'};
			},
			validateComment: function() {
				var comment = this.comment;
				if(comment.length === 0) {
					return this.setValidationError('Looks like your comment is blank');
				} else if(comment.length > 2000) {
					return this.setValidationError('Sorry, your comment is to long');
				}
			},
			setValidationError: function(message) {
				this.validation = {error: true, message: message};
				return;
			},
			formatCreatedAtDate: function(date)
			{
				return moment(date).format('MMMM Do YYYY, h:mm a');
			},
			displayComments: function(comment) {
				if(this.showAllComments === false) {
					this.comments = this.comments.slice(0, 3);
				}
				this.comments.unshift(comment);
				this.commentCount++;
			},
			successMessage: function(title) {
				new swal({   
					title: title, 
					type: 'success',  
					timer: 2000,   
					showConfirmButton: false 
				});
			},
			errorMessage: function(title, message) {
				new swal({   
					title: title, 
					type: 'error',  
					showConfirmButton: true,
					confirmButtonText: 'Got it'
				});
			},
		}
	});
	</script>
@endsection