@extends('admin::layouts.app', ['titlePage' => __('Potensi SDA')])

@section('content')
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Show Page') }} #{{ $potensisda->id }}</h4>
                    </div>
                    <div class="card-body">

                        <a href="{{ route('admin.potensisda.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Back') }}</button></a>
                        <a href="{{ route('admin.potensisda.edit', $potensisda) }}" title="Edit Page"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{ __('Edit') }}</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'route' => ['admin.potensisda.destroy', $potensisda],
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

                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

                    <style>
                      html, body {
                        height: 100%;
                        margin: 0;
                      }
                      .leaflet-container {
                        height: 400px;
                        max-width: 100%;
                        max-height: 100%;
                      }
                    </style>

                    <div id="map" style="height: 400px;"></div>
                    <script>

                    const map = L.map('map').setView([-0.4154958,116.9814559], 13);

                    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                      maxZoom: 19,
                      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

                    // const marker = L.marker([51.5, -0.09]).addTo(map)
                    //   .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

                    // const circle = L.circle([51.508, -0.11], {
                    //   color: 'red',
                    //   fillColor: '#f03',
                    //   fillOpacity: 0.5,
                    //   radius: 500
                    // }).addTo(map).bindPopup('I am a circle.');

                    // const polygon = L.polygon([
                    //   [51.509, -0.08],
                    //   [51.503, -0.06],
                    //   [51.51, -0.047]
                    // ]).addTo(map).bindPopup('I am a polygon.');

                    //Converting the data
                    var polygon = @json($potensisda->geom);

                    //Parsing the data and adding the layer to map
                    var layer = L.geoJSON(JSON.parse(polygon)).addTo(map);
                    // Adjust map to show the Layer
                    var bounds = layer.getBounds();
                    map.fitBounds(bounds); 

                    </script>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                    <tr>
                                        <th>ID</th><td>{{ $potensisda->id }}</td>
                                    </tr>
                                    <tr><th> {{ __('Gambar') }} </th><td> <img width="350px" height="200px" src="{{asset('../img/images').'/'. $potensisda->image}}" alt=""> </td></tr>
                                    <tr><th> {{ __('Nama') }} </th><td> {{ $potensisda->nama }} </td></tr>
                                    <tr><th> {{ __('Deskripsi') }} </th><td> {{ $potensisda->deskripsi }} </td></tr>
                                    <tr><th> {{ __('Kategori') }} </th><td> {{ $potensisda->kategori->nama_kategori }} </td></tr>
                                    <tr><th> {{ __('Kecamatan') }} </th><td> {{ $potensisda->kecamatan->kecamatan }} </td></tr>
                                    <tr><th> {{ __('Kelurahan/Desa') }} </th><td> {{ $potensisda->kelurahan->kelurahan }} </td></tr>
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
