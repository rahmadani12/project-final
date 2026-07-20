@extends('layouts.app')

@section('content')

<div class="p-8">

    <h1 class="text-3xl font-bold">
        My Profile
    </h1>

    <br>

    <p>
        Nama :
        {{ Auth::user()->name }}
    </p>

    <p>
        Email :
        {{ Auth::user()->email }}
    </p>

</div>

@endsection