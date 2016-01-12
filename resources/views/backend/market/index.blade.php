@extends('backend.theme.main')

@section('content')
<section class="content-header">
    <h1>
        Markets
        <small>List of all markets</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-globe"></i> Markets</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Markets in the database</h3>
                </div>
                <div class="box-body">
                    <table id="market-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Market</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($markets as $market)
                                <tr>
                                    <td>{{ $market->title }}</td>
                                    <td>{{ $market->type->title }}</td>
                                    <td>{{ $market->start_at->toFormattedDateString() }}</td>
                                    <td>{{ $market->end_at->toFormattedDateString() }}</td>
                                    <td class="btn-group">
                                        <a href="{{ route('admin.market.edit', $market->id) }}" class="btn btn-primary btn-sm">
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
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{ asset('backend/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
      $(function () {
        $("#market-table").DataTable();
      });
    </script>
@endsection