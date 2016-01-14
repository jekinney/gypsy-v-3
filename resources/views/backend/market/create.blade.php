@extends('backend.theme.main')

@section('content')
<section class="content-header">
    <h1>
        Add New Market
        <small>Add a new market event</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.market.index') }}"><i class="fa fa-globe"></i> Markets</a></li>
        <li class="active"><i class="fa fa-location-arrow"></i> Create</li>
    </ol>
</section>
<form action="{{ route('admin.market.store') }}" method="post">
    <input type="hidden" name="days" :value="days">
    {{ csrf_field() }}
    <section class="content">
        <div class="row">
            <section class="col-xs-12 col-md-9">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">
                            Create New Market
                        </h3>
                        <div class="pull-right box-tools">
                            <a role="button" class="text-primary" data-toggle="modal" data-target="#market-form-help">
                                <i class="fa fa-question-circle fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body pad">
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="type">Market Type:</label>
                                <select name="type_id" id="type" class="form-control">
                                    <option value="">Select A Market Type</option>
                                    @foreach($types as $type)
                                        <option 
                                            value="{{ $type->id }}" 
                                            @if(old('type_id') == $type->id) selected @endif 
                                        >
                                            {{ $type->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="title">Title</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    value="{{ old('title') }}" 
                                    class="form-control" 
                                    placeholder="Title or Name for your Market"
                                    required
                                    maxlength="120" 
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-6 col-sm-3 date" :class="startError">
                                <label class="control-label" for="start_at">Start Date</label>
                                <input 
                                    type="text" 
                                    name="start_at" 
                                    id="start_at" 
                                    value="{{ old('start_at') }}" 
                                    v-model="start"
                                    class="form-control" 
                                    data-provide="datepicker"
                                    data-date-format="yyyy-mm-dd"
                                    required 
                                >
                            </div>
                            <div class="form-group col-xs-6 col-sm-3 date" :class="endError">
                                <label class="control-label" for="end_at">End Date</label>
                                <input 
                                    type="text" 
                                    name="end_at" 
                                    id="end_at" 
                                    value="{{ old('end_at') }}" 
                                    v-model="end"
                                    class="form-control" 
                                    data-provide="datepicker"
                                    data-date-format="yyyy-mm-dd"
                                    required 
                                >
                            </div>
                            <div class="col-xs-6 col-sm-6" style="margin-top:25px">
                                <button type="button" @click="computeDays" class="btn btn-info">Set Hours</button>
                            </div>
                        </div>
                        <div class="alert alert-danger" v-show="errorMessage">
                            <h5 class="text-center" v-text="errorMessage"></h5>
                        </div>
                        <div v-if="days > 0">
                            <h4 class="text-center">Total Days: <span v-text="days"></span></h4>
                            <hr>
                            <div v-for="date in dates" class="row">
                                <div class="col-xs-12 col-sm-4" style="margin-top:20px;">
                                    <h4 v-text="date"></h4>
                                </div>
                                <div class="form-group col-xs-6 col-sm-4 bootstrap-timepicker">
                                    <label for="start_time@{{ $index }}">Start Time</label>
                                    <input type="text" name="start_time[]" id="start_time@{{ $index }}" class="form-control timepicker">
                                </div>
                                <div class="form-group col-xs-6 col-sm-4">
                                    <label for="end_time@{{ $index }}">End Time</label>
                                    <input type="text" name="end_time[]" id="end_time@{{ $index }}" class="form-control">
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" v-show="hoursSet" class="btn btn-primary">Add Market</button>
                        </div>
                    </div>
                </div>
            </section>
            <aside class="hidden-xs col-sm-3">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">
                            List of Items to Select
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-danger btn-sm" 
                                data-widget="collapse" data-toggle="tooltip" title="" 
                                data-original-title="Collapse"
                            >
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body pad">
                    </div>
                </div>
            </aside>
        </div>
    </section>
</form>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.4.3/basic/ckeditor.js"></script>    
    <script>
        new Vue({
            el: 'body',
            data: {
                start: '',
                end: '',
                days: 0,
                dates: {},
                hoursSet: false,
                startError: false,
                endError: false,
                errorMessage: '',
            },
            ready: function() {
                CKEDITOR.replace('description');
            },
            methods: {
                computeDays: function() {
                    this.hoursSet = false;
                    this.startError = false;
                    this.endError = false;
                    this.errorMessage = '';
                    this.dates = {};
                    if(!this.start) {
                        return this.startError = 'has-error';
                    }
                    if(!this.end) {
                        return this.endError = 'has-error';
                    }
                    if(moment(this.end).isBefore(this.start)) {
                        this.endError = 'has-error';
                        this.startError = 'has-error';
                        return this.errorMessage = 'The End Date can not be before the Start Date Princess';
                    } 
                    if(moment(this.start).isBefore(new Date()))
                    {
                        this.errorMessage = 'The Start date is in the past sis, are you sure?';
                    }
                    if(moment(this.end).isBefore(new Date()))
                    {
                        this.endError = 'has-error';
                        this.startError = 'has-error';
                        return this.errorMessage = 'WOAH, Come on girl. The end date is in the past!';
                    }
                    this.days = moment(this.end).diff(this.start, 'days')+1;
                    for(i=0; this.days > i; ++i) {
                        this.dates[i] = moment(this.start).add(i, 'days').format('dddd Do of MMMM, YYYY');
                    }
                    this.hoursSet = true;
                    return this.dates;
                }

            }
        })

    </script>
@endsection