<div class="">

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <!-- leaflet -->
        <link rel="stylesheet" href="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7/leaflet.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
        </script>
        <script src="https://wendabratha.github.io/js/leaflet.draw.js">
        </script>
        
    </head>
    <body>



    <div id="map" style="height: 600px"></div>
    <script>
        ///Setting the center of the map
        var center = [-0.4154958,116.9814559];
        // Create the map
        var map = L.map('map').setView(center, 10);
        // Set up the Open Street Map layer 
        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
                maxZoom: 18
            }).addTo(map);
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);
        var drawControl = new L.Control.Draw({
            position: 'topright',
            draw: {
                polygon: {
                    shapeOptions: {
                        color: 'purple' //polygons being drawn will be purple color
                    },
                    allowIntersection: false,
                    drawError: {
                        color: 'orange',
                        timeout: 1000
                    },
                    showArea: true, //the area of the polygon will be displayed as it is drawn.
                    metric: false,
                    repeatMode: true
                },
                polyline: {
                    shapeOptions: {
                        color: 'red'
                    },
                },
                circlemarker: false, //circlemarker type has been disabled.
                rect: {
                    shapeOptions: {
                        color: 'green'
                    },
                },
                circle: false,
            },
            edit: {
                featureGroup: drawnItems
            }
        });
        map.addControl(drawControl);
        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;
            drawnItems.addLayer(layer);
            $('#geom').val(JSON.stringify(layer.toGeoJSON()));
        });
    </script>



    </body>
    </html>

</div>
<div class="form-group row">
    <div class="col-sm-7">
    <input type="hidden" class="form-control @error('geom') is-invalid @enderror" name="geom" id="geom" rows="3">{{request('geom')}}
    @error('geom')
          <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('nama', 'Nama', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::text('nama', null, ['class' => 'form-control ' . ($errors->has('nama') ? ' is-invalid' : ''), 'required' => true]) !!}
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('deskripsi', 'Content', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-7">
        {!! Form::textarea('deskripsi', null, ['class' => 'form-control textarea-editor' . ($errors->has('deskripsi') ? ' is-invalid' : '')]) !!}
        {!! $errors->first('deskripsi', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('kategori', 'Kategori SDA', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-10">
        <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
            <option value="">-Pilih kategori-</option>
            @foreach ($kategori as $item)
            <option value="{{ $item->id  }}"
                    @if ($item->id == old('kategori_id'))
                        selected
                    @endif    
                >
                
                {{ $item->nama_kategori }}
            </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('content', 'Kecamatan', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-10">
        <select name="kecamatan_kecamatan_id" id="kecamatan_kecamatan_id" class="form-control @error('kecamatan_kecamatan_id') is-invalid @enderror">
            <option value="">-Pilih Kecamatan-</option>
            @foreach ($kecamatan as $item)
            <option value="{{ $item->kecamatan_id  }}"
                    @if ($item->kecamatan_id == old('kecamatan_id'))
                        selected
                    @endif    
                >
                
                {{ $item->kecamatan }}
            </option>
            @endforeach
        </select>
        @error('kecamatan_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::label('kelurahan', 'Kelurahan/Desa', ['class' => 'col-sm-2  control-label']) !!}
    <div class="col-sm-10">
        <select name="kelurahan_kelurahan_id" id="kelurahan_kelurahan_id" class="form-control @error('kelurahan_kelurahan_id') is-invalid @enderror">
            <option value="">-Pilih Kelurahan/Desa-</option>
            @foreach ($kelurahan as $item)
            <option value="{{ $item->kelurahan_id  }}"
                    @if ($item->kelurahan_id == old('kelurahan_id'))
                        selected
                    @endif    
                >
                
                {{ $item->kelurahan }}
            </option>
            @endforeach
        </select>
        @error('kelurahan_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.textarea-editor'
        });
    </script>
@endpush

@section('scripts')

@endsection