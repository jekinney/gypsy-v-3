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
        <section class="col-xs-12 col-sm-6 col-md-9">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        Current Categories
                    </h3>
                    <div class="pull-right box-tools">
                        <a role="button" class="text-primary" data-toggle="modal" data-target="#market-form-help">
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
                                    <td class="btn-group">
                                        <a href="{{ route('admin.market.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-cog"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <aside class="col-xs-12 col-sm-6 col-md-3">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        Create New Category
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Short but descriptive title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Describe your category. Mainly just for your notes" required>
                        </div>
                        <div class="text-right">
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection