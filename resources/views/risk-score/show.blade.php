@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    ⚠️ Detail Risk Score
</h1>

<div class="bg-white rounded-lg shadow p-6">

    <table class="w-full">

        <tr>
            <td class="font-bold w-64 py-3">Country</td>
            <td>{{ $riskScore->country->name }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Weather Score</td>
            <td>{{ $riskScore->weather_score }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Economy Score</td>
            <td>{{ $riskScore->economy_score }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">News Score</td>
            <td>{{ $riskScore->news_score }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Total Score</td>
            <td>
                <span class="text-xl font-bold">
                    {{ $riskScore->total_score }}
                </span>
            </td>
        </tr>

        <tr>
            <td class="font-bold py-3">Risk Level</td>
            <td>

                @if($riskScore->risk_level == 'High')

                    <span class="bg-red-600 text-white px-3 py-1 rounded">
                        🔴 HIGH
                    </span>

                @elseif($riskScore->risk_level == 'Medium')

                    <span class="bg-yellow-500 text-white px-3 py-1 rounded">
                        🟡 MEDIUM
                    </span>

                @else

                    <span class="bg-green-600 text-white px-3 py-1 rounded">
                        🟢 LOW
                    </span>

                @endif

            </td>
        </tr>

        <tr>
            <td class="font-bold py-3">Created At</td>
            <td>{{ $riskScore->created_at }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Updated At</td>
            <td>{{ $riskScore->updated_at }}</td>
        </tr>

    </table>

    <div class="mt-8">

        <a href="{{ route('risk-score.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded">

            ← Kembali

        </a>

        <form action="{{ route('risk-score.calculate',$riskScore->country) }}"
              method="POST"
              class="inline">

            @csrf

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                🔄 Hitung Ulang

            </button>

        </form>

    </div>

</div>

@endsection