@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
💱 Currency Management
</h1>

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

<div class="bg-white rounded-lg shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <div class="flex gap-2">

            <a href="{{ route('currency.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                + Tambah Currency

            </a>

            <form action="{{ route('currency.updateRates') }}"
                  method="POST">

                @csrf

                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">

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
                class="border rounded px-3 py-2">

            <button
                class="bg-gray-700 text-white px-4 py-2 rounded">

                Cari

            </button>

        </form>

    </div>

    <table class="w-full border-collapse">

        <thead>

        <tr class="bg-gray-100">

            <th class="border p-3">Country</th>

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

            <td class="border p-2">

                {{ $currency->country->name ?? '-' }}

            </td>

            <td class="border p-2">

                {{ $currency->code }}

            </td>

            <td class="border p-2">

                {{ $currency->name }}

            </td>

            <td class="border p-2">

                {{ $currency->symbol }}

            </td>

            <td class="border p-2 font-semibold">

                {{ number_format($currency->exchange_rate,6) }}

            </td>

            <td class="border p-2">

                {{ $currency->updated_at_rate }}

            </td>

            <td class="border p-2 text-center">

                <a href="{{ route('currency.show',$currency) }}"
                   class="bg-blue-500 text-white px-2 py-1 rounded">

                    Detail

                </a>

                <a href="{{ route('currency.edit',$currency) }}"
                   class="bg-yellow-500 text-white px-2 py-1 rounded">

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
                        class="bg-red-600 text-white px-2 py-1 rounded">

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

    <div class="mt-6">

        {{ $currencies->links() }}

    </div>

</div>

@endsection