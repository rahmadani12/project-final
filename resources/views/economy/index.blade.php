@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    💰 Economy Management
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-5">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <a href="{{ route('economy.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

            + Tambah Data Economy

        </a>

        <form method="GET" action="{{ route('economy.index') }}">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Negara..."
                class="border rounded px-3 py-2">

            <button
                class="bg-gray-800 text-white px-4 py-2 rounded">

                Cari

            </button>

        </form>

    </div>

    <table class="w-full border-collapse">

        <thead>

            <tr class="bg-gray-100">

                <th class="border p-3">Country</th>
                <th class="border p-3">GDP</th>
                <th class="border p-3">Inflation</th>
                <th class="border p-3">Growth</th>
                <th class="border p-3">Year</th>
                <th class="border p-3">Action</th>

            </tr>

        </thead>

        <tbody>

        @forelse($economies as $economy)

            <tr>

                <td class="border p-2">
                    {{ $economy->country->name }}
                </td>

                <td class="border p-2">
                    {{ number_format($economy->gdp,2) }}
                </td>

                <td class="border p-2">
                    {{ $economy->inflation }} %
                </td>

                <td class="border p-2">
                    {{ $economy->growth }} %
                </td>

                <td class="border p-2">
                    {{ $economy->year }}
                </td>

                <td class="border p-2 text-center">

                    <a href="{{ route('economy.show',$economy) }}"
                       class="bg-blue-500 text-white px-2 py-1 rounded">

                        Detail

                    </a>

                    <a href="{{ route('economy.edit',$economy) }}"
                       class="bg-yellow-500 text-white px-2 py-1 rounded">

                        Edit

                    </a>

                    <form
                        action="{{ route('economy.destroy',$economy) }}"
                        method="POST"
                        class="inline">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Hapus data ekonomi?')"
                            class="bg-red-600 text-white px-2 py-1 rounded">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6"
                    class="text-center p-6">

                    Belum ada data ekonomi.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <div class="mt-6">

        {{ $economies->links() }}

    </div>

</div>

@endsection