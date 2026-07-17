@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    📰 News Management
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

            <a href="{{ route('news.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                + Tambah Berita

            </a>

            <form action="{{ route('news.updateApi') }}"
                  method="POST">

                @csrf

                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">

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
            <th class="border p-3">Title</th>
            <th class="border p-3">Category</th>
            <th class="border p-3">Source</th>
            <th class="border p-3">Risk</th>
            <th class="border p-3">Published</th>
            <th class="border p-3">Action</th>

        </tr>

        </thead>

        <tbody>

        @forelse($news as $item)

        <tr>

            <td class="border p-2">
                {{ $item->country->name ?? '-' }}
            </td>

            <td class="border p-2">
                {{ $item->title }}
            </td>

            <td class="border p-2">
                {{ $item->category }}
            </td>

            <td class="border p-2">
                {{ $item->source }}
            </td>

            <td class="border p-2 text-center">

                @if($item->risk_level == 'High')

                    <span class="bg-red-500 text-white px-2 py-1 rounded">
                        🔴 High
                    </span>

                @elseif($item->risk_level == 'Medium')

                    <span class="bg-yellow-500 text-white px-2 py-1 rounded">
                        🟡 Medium
                    </span>

                @else

                    <span class="bg-green-500 text-white px-2 py-1 rounded">
                        🟢 Low
                    </span>

                @endif

            </td>

            <td class="border p-2">
                {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y H:i') }}
            </td>

            <td class="border p-2 text-center">

                <a href="{{ route('news.show', $item) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">

                    Detail

                </a>

                <a href="{{ route('news.edit', $item) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">

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
                        class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">

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

    <div class="mt-6">

        {{ $news->links() }}

    </div>

</div>

@endsection