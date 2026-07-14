@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    🌍 Countries Management
</h1>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <a href="{{ route('countries.import') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">

                        Import Countries

                    </a>

                    <form method="GET" action="{{ route('countries.index') }}">

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

                        <th class="border p-3">Flag</th>
                        <th class="border p-3">Country</th>
                        <th class="border p-3">Capital</th>
                        <th class="border p-3">Currency</th>
                        <th class="border p-3">Population</th>
                        <th class="border p-3">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($countries as $country)

                        <tr>

                            <td class="border p-2 text-center">
                                <img src="{{ $country->flag }}" width="40">
                            </td>

                            <td class="border p-2">
                                {{ $country->name }}
                            </td>

                            <td class="border p-2">
                                {{ $country->capital }}
                            </td>

                            <td class="border p-2">
                                {{ $country->currency }}
                            </td>

                            <td class="border p-2">
                                {{ number_format($country->population) }}
                            </td>

                            <td class="border p-2 text-center">

                                <a
                                    href="{{ route('countries.show',$country) }}"
                                    class="bg-blue-500 text-white px-2 py-1 rounded">

                                    Detail

                                </a>

                                <a
                                    href="{{ route('countries.edit',$country) }}"
                                    class="bg-yellow-500 text-white px-2 py-1 rounded">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('countries.destroy',$country) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus data?')"
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

                                Belum ada data negara

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="mt-6">

                    {{ $countries->links() }}

                </div>

            </div>

        </div>
    </div>

@endsection