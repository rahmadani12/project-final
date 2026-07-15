@extends('layouts.master')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    ✏️ Edit News
</h1>

<div class="bg-white rounded-lg shadow p-6">

<form action="{{ route('news.update',$news) }}" method="POST">

@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-6">

<div>
<label class="font-semibold">Country</label>

<select name="country_id"
        class="w-full border rounded px-3 py-2">

@foreach($countries as $country)

<option value="{{ $country->id }}"
{{ $news->country_id == $country->id ? 'selected' : '' }}>

{{ $country->name }}

</option>

@endforeach

</select>

</div>

<div>
<label class="font-semibold">Title</label>

<input
type="text"
name="title"
value="{{ old('title',$news->title) }}"
class="w-full border rounded px-3 py-2">

</div>

<div>
<label class="font-semibold">Category</label>

<input
type="text"
name="category"
value="{{ old('category',$news->category) }}"
class="w-full border rounded px-3 py-2">

</div>

<div>
<label class="font-semibold">Source</label>

<input
type="text"
name="source"
value="{{ old('source',$news->source) }}"
class="w-full border rounded px-3 py-2">

</div>

<div>
<label class="font-semibold">Published Date</label>

<input
type="date"
name="published_at"
value="{{ old('published_at',$news->published_at) }}"
class="w-full border rounded px-3 py-2">

</div>

<div>
<label class="font-semibold">Risk Level</label>

<select
name="risk_level"
class="w-full border rounded px-3 py-2">

<option value="Low"
{{ $news->risk_level=='Low'?'selected':'' }}>
Low
</option>

<option value="Medium"
{{ $news->risk_level=='Medium'?'selected':'' }}>
Medium
</option>

<option value="High"
{{ $news->risk_level=='High'?'selected':'' }}>
High
</option>

</select>

</div>

<div class="col-span-2">

<label class="font-semibold">
Description
</label>

<textarea
name="description"
rows="5"
class="w-full border rounded px-3 py-2">{{ old('description',$news->description) }}</textarea>

</div>

</div>

<div class="mt-6">

<button
class="bg-blue-600 text-white px-5 py-2 rounded">

Update

</button>

<a href="{{ route('news.index') }}"
class="bg-gray-600 text-white px-5 py-2 rounded">

Kembali

</a>

</div>

</form>

</div>

@endsection