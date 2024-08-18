@extends('panel.index')
@section('pageTitle', $section->name)

@php
    $columns = json_decode($section->columns);
@endphp

@section('content')
<div class="card">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            <li>{{ $errors->first() }}</li>
        </ul>
    </div>
    @endif

    <div class="card-body">

        @include('panel.components.form', ['update' => $update])
    
    </div>
</div>
@endsection