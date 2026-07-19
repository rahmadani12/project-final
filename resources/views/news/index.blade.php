@extends('layouts.app')

@section('content')

<div class="bg-pink-50 rounded-2xl p-8">

    <div class="flex items-center gap-4 mb-8">

        <div class="text-5xl">
            📰
        </div>

        <div>

            <h1 class="text-5xl font-bold text-slate-800">
                News Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage global news and supply chain events.
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

            <a href="{{ route('news.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold">

                + Tambah Berita

            </a>

            <form action="{{ route('news.updateApi') }}"
                  method="POST">

                @csrf

                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold">

                    🔄 Update News API

                </button>

            </form>

        </div>

        <form method="GET"
              action="{{ route('news.index') }}"
              class="flex gap-2">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Judul / Negara..."
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

            <th class="px-6 py-5">Country</th>
            <th class="px-6 py-5">Title</th>
            <th class="px-6 py-5">Category</th>
            <th class="px-6 py-5">Source</th>
            <th class="px-6 py-5">Risk</th>
            <th class="px-6 py-5">Published</th>
            <th class="px-6 py-5">Action</th>

        </tr>

        </thead>

        <tbody>

        @forelse($news as $item)

        <tr>
            
            <td class="px-6 py-5">
            {{ $loop->iteration + ($news->currentPage()-1) * $news->perPage() }}
            </td>

            <td class="px-6 py-5">
                {{ $item->country->name ?? '-' }}
            </td>

            <td class="px-6 py-5">
                <div class="max-w-md font-medium">
                {{ \Illuminate\Support\Str::limit($item->title,70) }}
                </div>
            </td>

            <td class="px-6 py-5">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                {{ $item->category }}
                </span>
            </td>

            <td class="px-6 py-5">
                <span class="font-semibold text-gray-700">
                {{ $item->source }}
                </span>
            </td>

            <td class="border p-2 text-center">

                @if($item->risk_level=='High')

                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                🔴 High

                </span>

                @elseif($item->risk_level=='Medium')

                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                🟡 Medium

                </span>

                @else

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                🟢 Low

                </span>

                @endif

            </td>

            <td class="px-6 py-5">
                <div>

                {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}

                </div>

                <div class="text-gray-500 text-sm">

                {{ \Carbon\Carbon::parse($item->published_at)->format('H:i') }}

                </div>
            </td>

            <td class="border p-2 text-center">

                <a href="{{ route('news.show', $item) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg">

                    Detail

                </a>

                <a href="{{ route('news.edit', $item) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">

                    Edit

                </a>

                <form
                    action="{{ route('news.destroy', $item) }}"
                    method="POST"
                    class="inline">

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Yakin ingin menghapus berita ini?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="7" class="text-center py-6">

                Belum ada data berita.

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

    <div class="flex justify-between items-center p-6 border-t">

    <div class="text-gray-500">

    Menampilkan

    {{ $news->firstItem() }}

    -

    {{ $news->lastItem() }}

    dari

    {{ $news->total() }}

    data

    </div>

    {{ $news->links() }}

    </div>

    </div>

    </div>

</div>

@endsection