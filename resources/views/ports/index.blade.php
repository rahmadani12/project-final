@extends('layouts.master')

@section('content')

<h1 class="text-4xl font-bold mb-6">

🚢 Ports Management

</h1>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-4 rounded mb-5">

{{ session('success') }}

</div>

@endif

<div class="bg-white rounded shadow p-6">

<div class="flex justify-between items-center mb-5">

    <div class="flex gap-2">

        <a href="{{ route('ports.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

            + Tambah Port

        </a>

        <form action="{{ route('ports.updateApi') }}" method="POST">

            @csrf

            <button
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">

                🔄 Update Ports

            </button>

        </form>

    </div>

    <form method="GET" action="{{ route('ports.index') }}" class="flex gap-2">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari Port..."
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

<th class="border p-3">Name</th>

<th class="border p-3">Country</th>

<th class="border p-3">City</th>

<th class="border p-3">Type</th>

<th class="border p-3">Status</th>

<th class="border p-3">Action</th>

</tr>

</thead>

<tbody>

@forelse($ports as $port)

<tr>

<td class="border p-3">

{{ $port->name }}

</td>

<td class="border p-3">

{{ $port->country }}

</td>

<td class="border p-3">

{{ $port->city }}

</td>

<td class="border p-3">

{{ $port->type }}

</td>

<td class="border p-3">

{{ $port->status }}

</td>

<td class="border p-3 text-center">

<a href="{{ route('ports.show', $port) }}"
   class="bg-blue-500 text-white px-3 py-1 rounded">

    Detail

</a>

<a href="{{ route('ports.edit', $port) }}"
   class="bg-yellow-500 text-white px-3 py-1 rounded">

    Edit

</a>

<form action="{{ route('ports.destroy', $port) }}"
      method="POST"
      class="inline">

    @csrf
    @method('DELETE')

    <button
        onclick="return confirm('Yakin ingin menghapus port ini?')"
        class="bg-red-600 text-white px-3 py-1 rounded">

        Hapus

    </button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center p-6">

Belum ada data pelabuhan.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-5">

{{ $ports->links() }}

</div>

</div>

@endsection