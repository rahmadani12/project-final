@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    🚢 Detail Port
</h1>

<div class="bg-white shadow rounded-lg p-8">

    <table class="table-auto w-full">

        <tr>
            <td class="font-bold w-48 py-3">Port Name</td>
            <td>{{ $port->name }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Country</td>
            <td>{{ $port->country }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">City</td>
            <td>{{ $port->city }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Type</td>
            <td>{{ $port->type }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Latitude</td>
            <td>{{ $port->latitude }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Longitude</td>
            <td>{{ $port->longitude }}</td>
        </tr>

        <tr>
            <td class="font-bold py-3">Status</td>

            <td>
                @if($port->status == 'Active')

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded">
                        Active
                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                        Inactive
                    </span>

                @endif
            </td>
        </tr>

    </table>

    <div class="mt-8">

        <a href="{{ route('ports.index') }}"
           class="bg-gray-700 text-white px-5 py-2 rounded">

            ← Back

        </a>

    </div>

</div>

@endsection