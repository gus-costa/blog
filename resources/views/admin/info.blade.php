@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Info</h1>
    <h2>Filesystem</h2>
    <p>Disk: {{ Config::get('filesystems.default') }}</p>
    {{ env('FILESYSTEM_DRIVER') }}
@endsection