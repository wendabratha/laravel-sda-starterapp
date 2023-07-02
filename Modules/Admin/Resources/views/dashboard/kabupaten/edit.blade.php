@extends('admin::layouts.app', ['titlePage' => __('Kabupaten')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Edit Page') }} #{{ $kabupaten->id }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.kabupaten.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($kabupaten, [
                            'method' => 'PATCH',
                            'route' => ['admin.kabupaten.update', $kabupaten],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin::dashboard.kabupaten.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
