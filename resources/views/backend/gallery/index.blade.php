@extends('backend.theme.main')

@section('content')
  <section class="content-header">
    <h1>
      Gallery
      <small>album and photo management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-camera"></i> Gallery</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <section class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">
              Current Albums
            </h3>
            <div class="pull-right box-tools">
              <a role="button" class="text-primary" data-toggle="modal" data-target="#album-help">
                <i class="fa fa-question-circle fa-2x"></i>
              </a>
            </div>
            <p>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#album-new">
                New Album
              </button>
            </p>
          </div>
          <div class="box-body pad">
            <table class="table">
              <thead>
                <tr>
                  <th>Name/Title</th>
                  <th>Photos</th>
                  <th>Description</th>
                  <th class="text-center" width="10%">Options</th>
                </tr>
              </thead>
              <tbody>
                @foreach($albums as $album)
                  <tr>
                    <td>{{ $album->name }}</td>
                    <td>{{$album->photos->count() }}</td>
                    <td>{{ $album->description }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="{{ route('admin.gallery.album.show', $album->id) }}" class="btn btn-success btn-sm">
                          <i class="fa fa-picture-o"></i>
                        </a>
                        <button
                          type="button"
                          class="btn btn-primary btn-sm"
                          data-toggle="modal"
                          data-target="#editAlbum{{ $album->id }}"
                        >
                          <i class="fa fa-cog"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  @include('backend.gallery.modals.album_edit')
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </section>
    <div>
  </section>
  @include('backend.gallery.modals.album_help')
  @include('backend.gallery.modals.album_new')
@endsection
