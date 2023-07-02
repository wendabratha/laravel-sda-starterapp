@extends('admin::layouts.app', ['titlePage' => __('WebGIS')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <base target="_top">
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

                <!-- Load Leaflet.markercluster CSS and JavaScript -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.0/MarkerCluster.css" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.0/MarkerCluster.Default.css" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.0/leaflet.markercluster.js"></script>

                <style>
                    html, body {
                        height: 100%;
                        margin: 0;
                    }
                    .leaflet-container {
                        height: 750px;
                        max-width: 100%;
                        max-height: 100%;
                    }
                </style>

                
            </head>
            <body>

            <div id='map'></div>

            <script>

            const jalanTitik = L.layerGroup();
            // Mendapatkan data GeoJSON dari REST API
            fetch('http://sijangkung.online/api/ptsjalan')
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
                // Buat cluster group
              var jalanTitik = L.markerClusterGroup();

                // Tambahkan titik-titik ke cluster group
              L.geoJSON(data, {
                pointToLayer: function (feature, latlng) {
                  // Tambahkan pushpin dengan warna hijau
                  return L.marker(latlng, {
                    icon: L.icon({
                      iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                      iconSize: [25, 41],
                      iconAnchor: [12, 41],
                      popupAnchor: [1, -34],
                      shadowSize: [41, 41]
                    })
                  });
                },
                onEachFeature: function (feature, layer) {
                  // Tambahkan informasi popup jika diperlukan
                  layer.bindPopup(feature.properties.nama_ruas);
                }
              }).addTo(jalanTitik);

                // Tambahkan cluster group ke peta
              map.addLayer(jalanTitik);
            });

            const overlays = {'Titik Lokasi Jalan': jalanTitik};

            const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            });

            const osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
            });

            const map = L.map('map', {
                center: [-0.4154958,116.9814559],
                zoom: 10,
                layers: [osm, jalanTitik]
            });

            const baseLayers = {
                'OpenStreetMap': osm,
                'OpenStreetMap.HOT': osmHOT
            };

            const layerControl = L.control.layers(baseLayers, overlays,).addTo(map);

            const openTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
            });
            layerControl.addBaseLayer(openTopoMap, 'OpenTopoMap');

            mapLink = '<a href="http://www.esri.com/">Esri</a>';
            wholink = 'i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community';
              const WorldImagery = L.tileLayer(
                  'http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                  attribution: '&copy; '+mapLink+', '+wholink,
                  maxZoom: 18,
                  });
              layerControl.addBaseLayer(WorldImagery, 'WorldImagery');

            const potensisda = L.layerGroup();
            @foreach($potensisda as $potensisda)
            var geometry = @json($potensisda->geom);

            //Parsing the data and adding the layer to map
            var layer = L.geoJSON(JSON.parse(geometry))

            .addTo(potensisda).bindPopup(@json($potensisda->nama));

            @endforeach

            const potensiSDA = L.layerGroup([potensisda]);

            layerControl.addOverlay(potensiSDA, 'Lokasi Potensi SDA');

            const jaringanJalan = L.layerGroup();
            var jaringan_jalan = L.tileLayer.wms("http://geoportal.kukarkab.go.id:8080/geoserver/wms", {
                layers: 'jaringan_jalan',
                format: 'image/png',
                transparent: true,
                attribution: "Geoportal Kutai Kartanegara",
                noWrap: true
            }).addTo(jaringanJalan);


            const JARJAL = L.layerGroup([jaringanJalan]);
            layerControl.addOverlay(JARJAL, 'Jaringan Jalan');


            </script>

            </body>
            </html>

    </div>
    </div>
@endsection
