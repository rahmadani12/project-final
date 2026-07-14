@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
➕ Tambah Port
</h1>

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('ports.store') }}" method="POST">

    @csrf

    <div class="mb-4">
        <label>Nama Port</label>
        <input type="text" name="name" class="w-full border rounded p-2" required>
    </div>

    <div class="mb-4">
        <label>Negara</label>
        <input type="text" name="country" class="w-full border rounded p-2" required>
    </div>

    <div class="mb-4">
        <label>Kota</label>
        <input type="text" name="city" class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Jenis Port</label>
        <input type="text" name="type" class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Latitude</label>
        <input type="text" name="latitude" class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Longitude</label>
        <input type="text" name="longitude" class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label>Status</label>

        <select name="status" class="w-full border rounded p-2">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>

    <button class="bg-blue-600 text-white px-5 py-2 rounded">
        Simpan
    </button>

    <a href="{{ route('ports.index') }}"
       class="bg-gray-500 text-white px-5 py-2 rounded">
        Kembali
    </a>

</form>

</div>

@endsection