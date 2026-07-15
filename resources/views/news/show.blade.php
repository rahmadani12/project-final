@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    📰 Detail News
</h1>

<div class="bg-white rounded-lg shadow p-6">

<table class="w-full">

<tr>
    <td class="font-bold w-56 py-2">Country</td>
    <td>{{ $news->country->name }}</td>
</tr>

<tr>
    <td class="font-bold py-2">Title</td>
    <td>{{ $news->title }}</td>
</tr>

<tr>
    <td class="font-bold py-2">Category</td>
    <td>{{ $news->category }}</td>
</tr>

<tr>
    <td class="font-bold py-2">Source</td>
    <td>{{ $news->source }}</td>
</tr>

<tr>
    <td class="font-bold py-2">Published</td>
    <td>{{ $news->published_at }}</td>
</tr>

<tr>
    <td class="font-bold py-2">Risk Level</td>
    <td>{{ $news->risk_level }}</td>
</tr>

<tr>
    <td class="font-bold py-2 align-top">Description</td>
    <td>{{ $news->description }}</td>
</tr>

</table>

<div class="mt-6">

<a href="{{ route('news.index') }}"
   class="bg-gray-600 text-white px-5 py-2 rounded">

    Kembali

</a>

</div>

</div>

@endsection