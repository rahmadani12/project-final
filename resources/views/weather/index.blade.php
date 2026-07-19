@extends('layouts.app')

@section('content')
<div class="bg-pink-50 rounded-2xl p-8">
<h1 class="text-4xl font-bold mb-6">🌤️ Weather Management</h1>

<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
<div class="flex justify-between items-center p-6 border-b">
<div class="flex gap-3">
<a href="{{ route('weather.create') }}" class="bg-pink-600 text-white px-6 py-3 rounded-xl">+ Tambah Weather</a>
<form action="{{ route('weather.updateAll') }}" method="POST">
@csrf
<button class="border px-6 py-3 rounded-xl">🔄 Update Weather API</button>
</form>
</div>

<form action="{{ route('weather.index') }}" method="GET">
<div class="flex">
<input type="text" name="search" value="{{ request('search') }}" placeholder="Cari negara, kota, cuaca..." class="border px-4 py-3 rounded-l-xl w-80">
<button class="bg-slate-800 text-white px-5 rounded-r-xl">Cari</button>
</div>
</form>
</div>

<div class="overflow-x-auto">
<table class="min-w-full">
<thead class="bg-gray-50">
<tr>
<th class="px-6 py-4">No</th>
<th class="px-6 py-4">Country</th>
<th class="px-6 py-4">City</th>
<th class="px-6 py-4">Temperature</th>
<th class="px-6 py-4">Humidity</th>
<th class="px-6 py-4">Wind</th>
<th class="px-6 py-4">Weather</th>
<th class="px-6 py-4">Action</th>
</tr>
</thead>
<tbody>
@forelse($weather as $item)
<tr class="border-t hover:bg-gray-50">
<td class="px-6 py-4">{{ $loop->iteration + ($weather->currentPage()-1)*$weather->perPage() }}</td>
<td class="px-6 py-4">{{ $item->country->name ?? '-' }}</td>
<td class="px-6 py-4">{{ $item->city ?? '-' }}</td>
<td class="px-6 py-4">{{ number_format($item->temperature,2) }} °C</td>
<td class="px-6 py-4">{{ $item->humidity }} %</td>
<td class="px-6 py-4">{{ number_format($item->wind_speed,2) }} km/h</td>
<td class="px-6 py-4">{{ $item->weather }}</td>
<td class="px-6 py-4">
<div class="flex gap-2">
<a href="{{ route('weather.show',$item) }}" class="bg-blue-500 text-white px-3 py-2 rounded">Detail</a>
<a href="{{ route('weather.edit',$item) }}" class="bg-yellow-500 text-white px-3 py-2 rounded">Edit</a>
<a href="{{ route('weather.refresh',$item) }}" class="bg-green-600 text-white px-3 py-2 rounded">Update API</a>
<form action="{{ route('weather.destroy',$item) }}" method="POST">@csrf @method('DELETE')<button class="bg-red-600 text-white px-3 py-2 rounded">Hapus</button></form>
</div>
</td>
</tr>
@empty
<tr><td colspan="8" class="text-center py-8">Data tidak ditemukan.</td></tr>
@endforelse
</tbody>
</table>
</div>
<div class="p-6 flex justify-between">
<div>Menampilkan {{ $weather->firstItem() ?? 0 }} - {{ $weather->lastItem() ?? 0 }} dari {{ $weather->total() }} data</div>
{{ $weather->links() }}
</div>
</div>
</div>
@endsection
