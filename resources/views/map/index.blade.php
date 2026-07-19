@extends('layouts.app')

@section('content')

<div class="bg-pink-50 rounded-2xl p-8">

    <div class="flex items-center gap-4 mb-8">

        <div class="text-6xl">
            🌍
        </div>

        <div>

            <h1 class="text-5xl font-bold">
                Interactive Risk Map
            </h1>

            <p class="text-gray-500">
                Monitor global supply chain risk by country.
            </p>

        </div>

    </div>

    <div class="grid grid-cols-4 gap-5 mb-6">

        <div class="bg-red-50 border border-red-200 rounded-xl p-5">
            <h5 class="text-red-600 font-semibold">🔴 High Risk</h5>

            <h2 class="text-4xl font-bold">
                {{ $high }}
            </h2>

            <p>Countries</p>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5">
            <h5 class="text-yellow-600 font-semibold">
                🟡 Medium Risk
            </h5>

            <h2 class="text-4xl font-bold">
                {{ $medium }}
            </h2>

            <p>Countries</p>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-xl p-5">
            <h5 class="text-green-600 font-semibold">
                🟢 Low Risk
            </h5>

            <h2 class="text-4xl font-bold">
                {{ $low }}
            </h2>

            <p>Countries</p>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">
            <h5 class="text-blue-600 font-semibold">
                🌎 Total Countries
            </h5>

            <h2 class="text-4xl font-bold">
                {{ $total }}
            </h2>

            <p>Countries</p>
        </div>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <div id="map"
             style="height:700px;border-radius:15px;">
        </div>

    </div>

    <div class="mt-10">

        <div class="flex items-center gap-3 mb-4">

            <div class="text-5xl">
                🚢
            </div>

            <div>

                <h2 class="text-3xl font-bold">
                    Shipping Route Map
                </h2>

                <p class="text-gray-500">
                    Monitor port locations and shipping routes.
                </p>

            </div>

            <div class="grid grid-cols-6 gap-4 mb-5">

                <div class="bg-blue-50 rounded-xl p-4">
                    <h5>Total Ports</h5>
                    <h2 class="text-3xl font-bold">
                        {{ $ports->count() }}
                    </h2>
                </div>

                <div class="bg-green-50 rounded-xl p-4">
                    <h5>Shipping Routes</h5>
                    <h2 class="text-3xl font-bold">
                        {{ $routes->count() }}
                    </h2>
                </div>

                <div class="bg-yellow-50 rounded-xl p-4">
                    <h5>Maintenance</h5>
                    <h2 class="text-3xl font-bold">
                        {{ $ports->where('status','Under Maintenance')->count() }}
                    </h2>
                </div>

                <div class="bg-purple-50 rounded-xl p-4">
                    <h5>Expansion</h5>
                    <h2 class="text-3xl font-bold">
                        {{ $ports->where('status','Expansion')->count() }}
                    </h2>
                </div>

                <div class="bg-cyan-50 rounded-xl p-4">
                    <h5>Container</h5>

                    <h2 class="text-3xl font-bold text-cyan-700">
                        {{ $routes->where('route_type','Container')->count() }}
                    </h2>
                </div>

                <div class="bg-red-50 rounded-xl p-4">
                    <h5>Oil</h5>

                    <h2 class="text-3xl font-bold text-red-700">
                        {{ $routes->where('route_type','Oil')->count() }}
                    </h2>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

        <div class="flex gap-6 mb-4">

            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-blue-500"></div>
                <span>Normal Port</span>
            </div>

            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-green-600"></div>
                <span>Active Shipping Route</span>
            </div>

            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-yellow-500"></div>
                <span>Maintenance</span>
            </div>

            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-purple-600"></div>
                <span>Expansion</span>
            </div>

        </div>

            <div id="routeMap"
                style="height:700px;border-radius:15px;">
            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

var map = L.map('map').setView([20,0],2);

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
    attribution:'© OpenStreetMap'
}).addTo(map);

const countries = @json($countries);

countries.forEach(country=>{

    if(!country.latitude || !country.longitude)
        return;

    let risk = null;

    if(country.risk_scores.length>0){
        risk = country.risk_scores[0];
    }

    let color="green";

    if(risk){

        if(risk.risk_level=="High")
            color="red";

        else if(risk.risk_level=="Medium")
            color="orange";

        else
            color="green";

    }

    let weather="-";

    if(country.weather_data.length>0){
        weather=country.weather_data[0].condition;
    }

    L.circleMarker(
        [
            parseFloat(country.latitude),
            parseFloat(country.longitude)
        ],
        {
            radius:8,
            color:color,
            fillColor:color,
            fillOpacity:0.9,
            weight:2
        }
    )
    .addTo(map)
    .bindPopup(

        `
        <div style="width:220px">

            <h5 style="font-weight:bold;font-size:18px">
                ${country.name}
            </h5>

            <hr>

            <b>Weather :</b>
            ${weather}
            <br>

            <b>Risk Level :</b>
            ${risk ? risk.risk_level : '-'}
            <br>

            <b>Risk Score :</b>
            ${risk ? risk.total_score : '-'}
            <br><br>

            <a
                href="/countries/${country.id}"
                style="
                    background:#2563eb;
                    color:white;
                    padding:6px 12px;
                    border-radius:6px;
                    text-decoration:none;
                ">

                Detail

            </a>

        </div>

        `

    );

});

    // ================================
    // SHIPPING ROUTE MAP
    // ================================

    const routeMap = L.map('routeMap').setView([20,20],2);

    L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        attribution:'© OpenStreetMap'
    }).addTo(routeMap);

    const ports = @json($ports);
    const routes = @json($routes);

    function getMarkerColor(status){

        switch(status){

            case "Active":
                return "#2563eb";

            case "Under Maintenance":
                return "#f59e0b";

            case "Expansion":
                return "#9333ea";

            default:
                return "#6b7280";
        }

    }

    function getRouteColor(type){

        switch(type){

            case "Container":
                return "#2563eb";

            case "Bulk":
                return "#16a34a";

            case "Oil":
                return "#ea580c";

            case "General Cargo":
                return "#dc2626";

            default:
                return "#6b7280";
        }

    }

    let bounds = [];

    /* =======================
    Marker Pelabuhan
    ======================= */

    ports.forEach(port=>{

        if(!port.latitude || !port.longitude) return;

        let color = "#2563eb";

        if(port.status === "Under Maintenance"){
            color = "#f59e0b";
        }

        if(port.status === "Expansion"){
            color = "#9333ea";
        }

        const portIcon = L.divIcon({

            className: '',

            html: `
            <div style="
                width:30px;
                height:30px;
                display:flex;
                justify-content:center;
                align-items:center;
                background:white;
                border-radius:50%;
                border:2px solid ${color};
                box-shadow:0 0 8px rgba(0,0,0,.35);
                font-size:18px;
                color:${color};
            ">
                ⚓
            </div>
            `,

            iconSize:[30,30],
            iconAnchor:[15,15],
            popupAnchor:[0,-15]

        });

        let marker = L.marker(
            [port.latitude, port.longitude],
            {
                icon: portIcon
            }
        ).addTo(routeMap);

        marker.bindPopup(`
            <div style="min-width:220px">

                <h5 style="margin-bottom:8px;">
                    ⚓ ${port.name}
                </h5>

                <hr>

                <b>Country</b><br>
                ${port.country}

                <br><br>

                <b>City</b><br>
                ${port.city}

                <br><br>

                <b>Port Type</b><br>
                ${port.type}

                <br><br>

                <b>Status</b><br>

                <span style="
                    padding:4px 10px;
                    border-radius:15px;
                    background:
                    ${
                        port.status=="Active"
                        ? "#dcfce7"
                        : (
                            port.status=="Under Maintenance"
                            ? "#fef3c7"
                            : "#ede9fe"
                        )
                    };

                    color:
                    ${
                        port.status=="Active"
                        ? "#15803d"
                        : (
                            port.status=="Under Maintenance"
                            ? "#b45309"
                            : "#6d28d9"
                        )
                    };

                    font-weight:bold;
                ">
                    ${port.status}
                </span>

            </div>
        `);

        bounds.push([port.latitude, port.longitude]);

    });

    /* =======================
    Garis Shipping Route
    ======================= */

    routes.forEach(route=>{

        if(!route.origin_port || !route.destination_port) return;

        L.polyline.antPath(
        [
            [
                route.origin_port.latitude,
                route.origin_port.longitude
            ],
            [
                route.destination_port.latitude,
                route.destination_port.longitude
            ]
        ],
        {
            delay:800,
            dashArray:[20,15],
            weight:5,
            color:getRouteColor(route.route_type),
            pulseColor:"#ffffff",
            paused:false,
            reverse:false,
            hardwareAccelerated:true
        })
        .bindPopup(`
        <b>🚢 Shipping Route</b>

        <hr>

        <b>Origin</b><br>
        ${route.origin_port.name}

        <hr>

        <b>Destination</b><br>
        ${route.destination_port.name}

        <hr>

        Distance : ${route.distance} km

        <br>

        Duration : ${route.duration}

        <br>

        Cargo : ${route.route_type}
        `)
        .addTo(routeMap);

    });

    /* =======================
    Auto Zoom
    ======================= */

    routeMap.fitBounds(bounds,{
        padding:[40,40]
    });

    <script src="https://unpkg.com/leaflet-ant-path/dist/leaflet-ant-path.min.js"></script>
</script>

@endpush