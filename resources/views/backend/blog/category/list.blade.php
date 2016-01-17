@extends('backend.theme.main')

@section('content')
<section class="content-header">
    <h1>
        Manage Blog Categories
        <small>Add a new market event</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.market.index') }}"><i class="fa fa-globe"></i> Blog</a></li>
        <li class="active"><i class="fa fa-location-arrow"></i> Manage Categories</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <section class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Create New Category</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info btn-sm" 
                            data-widget="collapse" data-toggle="tooltip" title="" 
                            data-original-title="Collapse"
                        >
                            <i class="fa fa-minus"></i>
                        </button>
                      </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <form action="{{ route('admin.blog.category.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Short but descriptive title" required>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="form-control" placeholder="Describe your category. Mainly just for your notes" required>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        Current Categories
                    </h3>
                    <div class="pull-right box-tools">
                        <a role="button" class="text-primary" data-toggle="modal" data-target="#categoryHelp">
                            <i class="fa fa-question-circle fa-2x"></i>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Article Count</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->articles()->count() }}</td>
                                    <td>
                                        <form action="{{ route('admin.blog.category.remove', $category->id) }}" method="post">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ csrf_field() }}
                                            <div class="btn-group">
                                                <a role="button" class="btn btn-primary btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#editCategory{{ $category->id }}"
                                                >
                                                    <i class="fa fa-cog"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm" @if($category->articles()->count() > 0) disabled @endif>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @include('backend.blog.category.modals.edit_modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>
@include('backend.blog.category.modals.help_modal')
@endsection