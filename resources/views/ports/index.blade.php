@extends('layouts.app')

@section('content')

<div class="bg-pink-50 rounded-2xl p-8">

    <div class="flex items-center gap-4 mb-8">

        <div class="text-5xl">
            🚢
        </div>

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                Ports Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage global port information.
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

        <a href="{{ route('ports.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold">

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
            class="border border-gray-300 rounded-l-xl px-4 py-3 w-72">

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

Name

</th>

<th class="border p-3">Country</th>

<th class="border p-3">City</th>

<th class="border p-3">Type</th>

<th class="border p-3">Status</th>

<th class="border p-3">Action</th>

</tr>

</thead>

<tbody>

@forelse($ports as $port)

<tr class="border-t hover:bg-gray-50">

<td class="px-6 py-5">

{{ $loop->iteration + ($ports->currentPage()-1) * $ports->perPage() }}

</td>

<td class="px-6 py-5">

{{ $port->name }}

</td>

<td class="px-6 py-5">

{{ $port->country }}

</td>

<td class="px-6 py-5">

{{ $port->city }}

</td>

<td class="px-6 py-5">

<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

{{ $port->type }}

</span>

</td>

<td class="px-6 py-5">

@if($port->status == 'Active')

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

Active

</span>

@elseif($port->status == 'Under Maintenance')

<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

Under Maintenance

</span>

@else

<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

{{ $port->status }}

</span>

@endif

</td>

<td class="border p-3 text-center">

<a href="{{ route('ports.show', $port) }}"
   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">

    Detail

</a>

<a href="{{ route('ports.edit', $port) }}"
   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

    Edit

</a>

<form action="{{ route('ports.destroy', $port) }}"
      method="POST"
      class="inline">

    @csrf
    @method('DELETE')

    <button
        onclick="return confirm('Yakin ingin menghapus port ini?')"
        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">

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

<div class="flex justify-between items-center p-6 border-t">

<div class="text-gray-500">

Menampilkan

{{ $ports->firstItem() }}

-

{{ $ports->lastItem() }}

dari

{{ $ports->total() }}

data

</div>

{{ $ports->links() }}

</div>

</div>

</div>

</div> 

@endsection