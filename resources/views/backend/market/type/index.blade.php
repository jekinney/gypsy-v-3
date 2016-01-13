@extends('backend.theme.main')

@section('content')
    <section class="content-header">
        <h1>
            Manage Market Types
            <small>Create, Update or Remove</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.market.index') }}"><i class="fa fa-globe"></i> Markets</a></li>
            <li class="active"><i class="fa fa-location-arrow"></i> Manage Types</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">
                            Create New Market Type
                        </h3>
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
                        <form action="{{ route('admin.market.type.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-4 col-sm-offset-4 text-center">
                                    <label for="image">Market Image</label>
                                    <img id="image-preview" src="#" alt="Your Market Type Image" class="hidden">
                                    <input type="file" name="image"  id="image" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label for="title">Name</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" placeholder="Name of Market Type" required>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" id="location" value="{{ old('location') }}" class="form-control" placeholder="123 Example St Jacksonville, Florida" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Market Type Description" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="text-right">
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button type="submit" class="btn btn-primary">Add Market Type</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        Current Market Types
                    </h3>
                    <div class="pull-right box-tools">
                        <a role="button" class="text-primary" data-toggle="modal" data-target="#categoryHelp">
                            <i class="fa fa-question-circle fa-2x"></i>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    @foreach($types->chunk(3) as $chunk)
                        @foreach($chunk as $type)
                            <div class="col-sm-4 col-md-3">
                                <div class="thumbnail">
                                  <img src="{{ asset($type->image) }}" alt="...">
                                    <div class="caption">
                                        <h3 class="text-center">{{ $type->title }}</h3>
                                        <h4 class="text-center">Market Events: {{ $type->markets()->count() }}</h4>
                                        <p>{{ $type->description }}</p>
                                        <div class="text-center">
                                            <form action="{{ route('admin.market.type.remove', $type->id) }}" method="post">
                                                <input type="hidden" name="_method" value="delete">
                                                {{ csrf_field() }}
                                                <div class="btn-group">
                                                    <a role="button" class="btn btn-primary" 
                                                        data-toggle="modal" 
                                                        data-target="#editMarketType{{ $type->id }}"
                                                    >
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-danger" 
                                                        @if($type->markets()->count() > 0) disabled @endif
                                                    >
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('backend.market.type.modals.type_edit')
                        @endforeach
                    @endforeach
                </div>
            </div>
        </section>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#image-preview').attr('src', e.target.result)
                    .removeClass('hidden')
                    .addClass('thumbnail')
                    .css('max-height', '400px')
                    .css('margin', 'auto');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function(){
            readURL(this);
        });
    </script>
@endsection