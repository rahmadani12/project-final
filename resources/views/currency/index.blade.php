@extends('layouts.app')

@section('content')

<div class="bg-pink-50 rounded-2xl p-8">

    <div class="flex items-center gap-4 mb-8">

        <div class="text-5xl">
            💱
        </div>

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Currency Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage currency information for each country.
            </p>

        </div>

    </div>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-5">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 text-red-700 p-4 rounded mb-5">
    {{ session('error') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

    <div class="flex justify-between items-center p-6 border-b">

        <div class="flex gap-2">

            <a href="{{ route('currency.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold">

                + Tambah Currency

            </a>

            <form action="{{ route('currency.updateRates') }}"
                  method="POST">

                @csrf

                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold">

                    🔄 Update Currency API

                </button>

            </form>

        </div>

        <form action="{{ route('currency.index') }}"
              method="GET">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Country / Currency"
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

            <th class="border p-3">Code</th>

            <th class="border p-3">Name</th>

            <th class="border p-3">Symbol</th>

            <th class="border p-3">Exchange Rate</th>

            <th class="border p-3">Updated</th>

            <th class="border p-3">Action</th>

        </tr>

        </thead>

        <tbody>

        @forelse($currencies as $currency)

        <tr>

            <td class="px-6 py-5">

            {{ $loop->iteration + ($currencies->currentPage()-1) * $currencies->perPage() }}

            </td>

            <td class="px-6 py-5 font-medium">

            {{ $currency->country->name ?? '-' }}

            </td>

            <td class="px-6 py-5">

            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">

            {{ $currency->code }}

            </span>

            </td>

            <td class="border p-2">

                {{ $currency->name }}

            </td>

            <td class="border p-2">

                {{ $currency->symbol }}

            </td>

            <td class="border p-2 font-semibold">

                <span class="font-semibold text-green-600">

                {{ number_format($currency->exchange_rate,6) }}

                </span>

            </td>

            <td class="border p-2">

               {{ \Carbon\Carbon::parse($currency->updated_at_rate)->format('d M Y H:i') }}

            </td>

            <td class="border p-2 text-center">

                <a href="{{ route('currency.show',$currency) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">

                    Detail

                </a>

                <a href="{{ route('currency.edit',$currency) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

                    Edit

                </a>

                <form
                    action="{{ route('currency.destroy',$currency) }}"
                    method="POST"
                    class="inline">

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Hapus currency?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="7"
                class="text-center py-5">

                Belum ada data Currency.

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

    <div class="flex justify-between items-center p-6 border-t">

        <div class="text-gray-500">

            Menampilkan

            {{ $currencies->firstItem() }}

            -

            {{ $currencies->lastItem() }}

            dari

            {{ $currencies->total() }}

            data

        </div>

        {{ $currencies->links() }}

    </div>

    </div>

    </div>

</div>

@endsection