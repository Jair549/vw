@extends('panel.index')
@section('pageTitle', $section->name)

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
        @if($section->type == 'array')
            <!-- tabela -->
             @include('panel.components.table')
        @else
            <!-- formulario -->
            @include('panel.components.formMain')
        @endif
    </div>
</div>
@endsection

@section('Js')

@include('panel.partials.fileScripts')

@endsection