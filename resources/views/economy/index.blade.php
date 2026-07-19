@extends('layouts.app')

@section('content')

<div class="bg-pink-50 rounded-2xl p-8">

    <div class="flex items-center gap-4 mb-8">

        <div class="text-5xl">
            💰
        </div>

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Economy Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage economy information for each country.
            </p>

        </div>

    </div>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-5">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

    <div class="flex justify-between items-center p-6 border-b">

        <div class="flex gap-2">

            <a href="{{ route('economy.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold">

                + Tambah Data Economy

            </a>

            <form action="{{ route('economy.updateApi') }}" method="POST" class="mb-4">
                @csrf

                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold">
                    🔄 Update Economy API
                </button>
            </form>

        </div>

        <form method="GET"
              action="{{ route('economy.index') }}"
              class="flex gap-2">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Negara..."
                class="border rounded-l-xl px-4 py-3 w-72">

            <button
                class="bg-slate-800 hover:bg-slate-900 text-white px-6 rounded-r-xl">

                Cari

            </button>

        </form>

    </div>

    <div class="overflow-x-auto">

    <table class="min-w-full">

        <thead class="bg-gray-50">

            <tr class="bg-gray-100">

                <th class="px-6 py-4 text-left">
                    No
                </th>

                <th class="px-6 py-4 text-left">
                    Country
                </th>
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
                <td class="px-6 py-5">

                {{ $loop->iteration + ($economies->currentPage()-1) * $economies->perPage() }}

                </td>

                <td class="px-6 py-5 font-medium">

                {{ $economy->country->name ?? '-' }}

                </td>

                <td <span class="font-semibold text-green-600">

                    ${{ number_format($economy->gdp,2) }}

                    </span>
                </td>

                <td class="border p-2">
                    @if($economy->inflation<3)

                    <span class="text-green-600">

                    {{ number_format($economy->inflation,2) }} %

                    </span>

                    @elseif($economy->inflation<7)

                    <span class="text-orange-500">

                    {{ number_format($economy->inflation,2) }} %

                    </span>

                    @else

                    <span class="text-red-600">

                    {{ number_format($economy->inflation,2) }} %

                    </span>

                    @endif
                </td>

                <td class="border p-2">
                    @if($economy->growth>=5)

                    <span class="text-green-600 font-semibold">

                    {{ number_format($economy->growth,2) }} %

                    </span>

                    @elseif($economy->growth>=2)

                    <span class="text-blue-600">

                    {{ number_format($economy->growth,2) }} %

                    </span>

                    @else

                    <span class="text-red-600">

                    {{ number_format($economy->growth,2) }} %

                    </span>

                    @endif
                </td>

                <td class="border p-2">
                    {{ $economy->year }}
                </td>

                <td class="border p-2 text-center">

                    <a href="{{ route('economy.show',$economy) }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">

                        Detail

                    </a>

                    <a href="{{ route('economy.edit',$economy) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

                        Edit

                    </a>

                    <form action="{{ route('economy.destroy',$economy) }}"
                          method="POST"
                          class="inline">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Hapus data ekonomi?')"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6"
                    class="text-center p-6 text-gray-500">

                    Belum ada data ekonomi.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <div class="flex justify-between items-center p-6 border-t">

        <div class="text-gray-500">

            Menampilkan

            {{ $economies->firstItem() }}

            -

            {{ $economies->lastItem() }}

            dari

            {{ $economies->total() }}

            data

        </div>

        {{ $economies->links() }}

    </div>

    </div>

    </div>

</div>

@endsection