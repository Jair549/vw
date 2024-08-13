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
        <form action="{{ route('sections.store', $section->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="section_id" value="{{ $section->id }}">
            
            @foreach($columns as $column)

                @if($column->type == 'array')
                    
                    @foreach($column->fields as $field)
                        
                        <div class="container-items">
                            @if($field->type == 'file')
                                <div class="form-group">
                                    <label for="{{ $field->name }}">{{ $field->label }}</label>
                                    <input class="form-control" type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}">
                                </div>
                            @elseif($field->type == 'select')
                                <div class="form-group
                                    <label for="{{ $field->name }}">{{ $field->label }}</label>
                                    <select class="form-control" name="{{ $field->name }}" id="{{ $field->name }}">
                                        @foreach($field->options as $option)
                                            <option value="{{ $option->value }}">{{ $option->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif($field->type == 'checkbox')
                                <div class="form-group
                                    <label for="{{ $field->name }}">{{ $field->label }}</label>
                                    @foreach($field->options as $option)
                                        <input class="form-control" type="checkbox" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ $option->value }}">
                                        <label for="{{ $field->name }}">{{ $option->label }}</label>
                                    @endforeach
                                </div>
                            @elseif($field->type == 'radio')
                                <div class="form-group
                                    <label for="{{ $field->name }}">{{ $field->label }}</label>
                                    @foreach($field->options as $option)
                                        <input class="form-control" type="radio" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ $option->value }}">
                                        <label for="{{ $field->name }}">{{ $option->label }}</label>
                                    @endforeach
                                </div>
                            @elseif($field->type == 'text')
                                <div class="form-group
                                    <label for="{{ $field->name }}">{{ $field->label }}</label>
                                    <input class="form-control" type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}">
                                </div>
                            @elseif($field->type == 'url')
                                <div class="form-group
                                    <label for="{{ $field->name }}">{{ $field->label }}</label>
                                    <input class="form-control" type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}">
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="{{ $field->name }}">{{ $field->label }}</label>
                                    <textarea class="form-control" name="{{ $field->name }}" id="{{ $field->name }}"></textarea>
                                </div>
                            @endif

                        </div>
                    @endforeach
                    
                @elseif($column->type == 'file')
                    
                    <div class="form-group
                        <label for="{{ $column->name }}">{{ $column->label }}</label>
                        <input class="form-control" type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}">
                    </div>


                @elseif($column->type == 'select')
                
                    <div class="form-group">
                        <label for="{{ $column->name }}">{{ $column->label }}</label>
                        <select class="form-control" name="{{ $column->name }}" id="{{ $column->name }}">
                            @foreach($column->options as $option)
                                <option value="{{ $option->value }}">{{ $option->label }}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif($column->type == 'checkbox')
                
                    <div class="form-group">
                        <label for="{{ $column->name }}">{{ $column->label }}</label>
                        @foreach($column->options as $option)
                            <input class="form-control" type="checkbox" name="{{ $column->name }}" id="{{ $column->name }}" value="{{ $option->value }}">
                            <label for="{{ $column->name }}">{{ $option->label }}</label>
                        @endforeach
                    </div>
                @elseif($column->type == 'radio')

                    <div class="form-group">
                        <label for="{{ $column->name }}">{{ $column->label }}</label>
                        @foreach($column->options as $option)
                            <input class="form-control" type="radio" name="{{ $column->name }}" id="{{ $column->name }}" value="{{ $option->value }}">
                            <label for="{{ $column->name }}">{{ $option->label }}</label>
                        @endforeach
                    </div>
                @elseif($column->type == 'text')
                    
                    <div class="form-group">
                        <label for="{{ $column->name }}">{{ $column->label }}</label>
                        <input class="form-control" type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}">
                    </div>
                @elseif($field->type == 'url')
                    <div class="form-group
                        <label for="{{ $field->name }}">{{ $field->label }}</label>
                        <input class="form-control" type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}">
                    </div>

                @else
                    <div class="form-group">
                        <label for="{{ $column->name }}">{{ $column->label }}</label>
                        <textarea class="form-control" name="{{ $column->name }}" id="{{ $column->name }}"></textarea>
                    </div>
                @endif

            @endforeach

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</div>
@endsection

@section('Js')

@include('panel.partials.fileScripts')

@endsection