@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    📊 Country Comparison
</h1>

{{-- Statistik --}}
<div class="grid grid-cols-3 gap-6 mb-6">

    <div class="bg-red-100 rounded-lg shadow p-5">

        <h2 class="text-lg font-bold text-red-700">
            High Risk
        </h2>

        <p class="text-4xl font-bold mt-2">
            {{ $comparisons->where('risk_level','High')->count() }}
        </p>

    </div>

    <div class="bg-yellow-100 rounded-lg shadow p-5">

        <h2 class="text-lg font-bold text-yellow-700">
            Medium Risk
        </h2>

        <p class="text-4xl font-bold mt-2">
            {{ $comparisons->where('risk_level','Medium')->count() }}
        </p>

    </div>

    <div class="bg-green-100 rounded-lg shadow p-5">

        <h2 class="text-lg font-bold text-green-700">
            Low Risk
        </h2>

        <p class="text-4xl font-bold mt-2">
            {{ $comparisons->where('risk_level','Low')->count() }}
        </p>

    </div>

</div>

{{-- Chart --}}
<div class="bg-white rounded-lg shadow p-6 mb-6">

    <canvas id="riskChart"></canvas>

</div>

{{-- Table --}}
<div class="bg-white rounded-lg shadow p-6">

<table class="w-full border-collapse">

<thead>

<tr class="bg-gray-100">

<th class="border p-3">Country</th>

<th class="border p-3">Weather</th>

<th class="border p-3">Economy</th>

<th class="border p-3">News</th>

<th class="border p-3">Total</th>

<th class="border p-3">Risk Level</th>

</tr>

</thead>

<tbody>

@forelse($comparisons as $item)

<tr>

<td class="border p-2">

{{ $item->country->name }}

</td>

<td class="border p-2 text-center">

{{ $item->weather_score }}

</td>

<td class="border p-2 text-center">

{{ $item->economy_score }}

</td>

<td class="border p-2 text-center">

{{ $item->news_score }}

</td>

<td class="border p-2 text-center font-bold">

{{ $item->total_score }}

</td>

<td class="border p-2 text-center">

@if($item->risk_level=="High")

<span class="bg-red-600 text-white px-3 py-1 rounded">

🔴 High

</span>

@elseif($item->risk_level=="Medium")

<span class="bg-yellow-500 text-white px-3 py-1 rounded">

🟡 Medium

</span>

@else

<span class="bg-green-600 text-white px-3 py-1 rounded">

🟢 Low

</span>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center p-6">

Belum ada data comparison.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

{{-- Chart JS --}}
<script>

const ctx = document.getElementById('riskChart');

new Chart(ctx,{

    type:'bar',

    data:{

        labels:@json($labels),

        datasets:[{

            label:'Risk Score',

            data:@json($scores),

            borderWidth:1

        }]

    },

    options:{

        responsive:true,

        plugins:{

            legend:{

                display:true

            }

        },

        scales:{

            y:{

                beginAtZero:true,

                max:100

            }

        }

    }

});

</script>

@endsection