@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    ✏️ Edit Port
</h1>

<div class="bg-white shadow rounded-lg p-8">

<form action="{{ route('ports.update',$port) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Port Name</label>
        <input type="text"
               name="name"
               value="{{ old('name',$port->name) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Country</label>
        <input type="text"
               name="country"
               value="{{ old('country',$port->country) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>City</label>
        <input type="text"
               name="city"
               value="{{ old('city',$port->city) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Type</label>
        <input type="text"
               name="type"
               value="{{ old('type',$port->type) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Latitude</label>
        <input type="text"
               name="latitude"
               value="{{ old('latitude',$port->latitude) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Longitude</label>
        <input type="text"
               name="longitude"
               value="{{ old('longitude',$port->longitude) }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Status</label>

        <select name="status"
                class="w-full border rounded p-2">

            <option value="Active"
                {{ $port->status=='Active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="Inactive"
                {{ $port->status=='Inactive' ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

    </div>

    <button class="bg-blue-600 text-white px-5 py-2 rounded">
        Update
    </button>

    <a href="{{ route('ports.index') }}"
       class="bg-gray-500 text-white px-5 py-2 rounded">
        Kembali
    </a>

</form>

</div>

@endsection