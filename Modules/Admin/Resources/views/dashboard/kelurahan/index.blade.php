@extends('admin::layouts.app', ['titlePage' => __('Halaman Manajemen Kelurahan/Desa')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Data Kelurahan/Desa') }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.kelurahan.create') }}" class="btn btn-success btn-sm" title="Add New Page">
                            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Tambah') }}
                        </a>

                        {!! Form::open(['method' => 'GET', 'route' => 'admin.kelurahan.index', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ __('Kelurahan Id') }}</th>
                                        <th>{{ __('Kelurahan/Desa') }}</th>
                                        <th>{{ __('Kecamatan') }}</th>
                                        <th>{{ __('Kabupaten') }}</th>
                                        <th>{{ __('Provinsi') }}</th>
                                        <th class="text-right">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($kelurahan as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->kelurahan_id }}</td>
                                        <td>{{ $item->kelurahan }}</td>
                                        <td>{{ $item->kecamatan->kecamatan }}</td>
                                        <td>{{ $item->kabupaten->kabupaten }}</td>
                                        <td>{{ $item->provinsi->provinsi }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.kelurahan.show' , $item) }}" title="{{ __('View Page') }}"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ route('admin.kelurahan.edit' , $item) }}" title="{{ __('Edit Page') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['admin.kelurahan.destroy', $item],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Page',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $kelurahan->appends(['search' => Request::get('search')])->links() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
