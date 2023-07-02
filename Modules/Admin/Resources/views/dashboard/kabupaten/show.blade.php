@extends('admin::layouts.app', ['titlePage' => __('Kabupaten')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Show Page') }} #{{ $kabupaten->id }}</h4>
                    </div>
                    <div class="card-body">

                        <a href="{{ route('admin.kabupaten.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                        <a href="{{ route('admin.kabupaten.edit', $kabupaten) }}" title="Edit Page"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ __('Edit') }}</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['admin.kabupaten.destroy', $kabupaten],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Page',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $kabupaten->id }}</td>
                                    </tr>
                                    <tr><th> {{ __('Kabupaten ID') }} </th><td> {{ $kabupaten->kabupaten_id }} </td></tr>
                                    <tr><th> {{ __('Kabupaten') }} </th><td> {{ $kabupaten->kabupaten }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
