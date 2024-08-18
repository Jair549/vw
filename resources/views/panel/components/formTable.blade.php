@php
    $columns = json_decode($section->columns);
    $fields = json_decode($section->fields, true);
    $route = $update ? 'sections.update' : 'sections.store';
@endphp

<form action="{{ route($route, $section->slug) }}" method="post" enctype="multipart/form-data">
    @csrf
    @if($update)
        @method('PUT')
    @endif
    <input type="hidden" name="section_id" value="{{ $section->id }}">
    
    @foreach($columns as $column)

        @if($column->type == 'array')
            
            @continue
            
        @elseif($column->type == 'file')
                
            <div class="form-group
                <label for="{{ $column->name }}">{{ $column->label }}</label>
                <input class="form-control" type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}" {{ isset($column->required) && $update ? 'required' : '' }}>
            </div>

        @elseif($column->type == 'select')
        
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->label }}</label>
                <select class="form-control" name="{{ $column->name }}" id="{{ $column->name }}" {{ isset($column->required) && $update ? 'required' : '' }}>
                    @foreach($column->options as $option)
                        <option value="{{ $option->value }}">{{ $option->label }}</option>
                    @endforeach
                </select>
            </div>
        @elseif($column->type == 'checkbox')
        
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->label }}</label>
                @foreach($column->options as $option)
                    <input class="form-control" type="checkbox" name="{{ $column->name }}" id="{{ $column->name }}" value="{{ $option->value }}" {{ isset($column->required) && $update ? 'required' : '' }}>
                    <label for="{{ $column->name }}">{{ $option->label }}</label>
                @endforeach
            </div>
        @elseif($column->type == 'radio')

            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->label }}</label>
                @foreach($column->options as $option)
                    <input class="form-control" type="radio" name="{{ $column->name }}" id="{{ $column->name }}" value="{{ $option->value }}" {{ isset($column->required) && $update ? 'required' : '' }}>
                    <label for="{{ $column->name }}">{{ $option->label }}</label>
                @endforeach
            </div>
        @elseif($column->type == 'text')
            
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->label }}</label>
                <input class="form-control" type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}" value="{{ old($column->name, $update ? $fields[0]['fields'][$column->name] : '') }}" {{ isset($column->required) && $update ? 'required' : '' }}>
            </div>
        @elseif($column->type == 'url')
            <div class="form-group
                <label for="{{ $column->name }}">{{ $column->label }}</label>
                <input class="form-control" type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}" {{ isset($column->required) && $update ? 'required' : '' }}>
            </div>     

        @else
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->label }}</label>
                <textarea class="form-control" name="{{ $column->name }}" id="{{ $column->name }}" {{ isset($column->required) && $update ? 'required' : '' }}></textarea>
            </div>
        @endif

    @endforeach
    
    <div class="form-group text-right">
        <button class="btn btn-default" type="submit">Cadastrar</button>
    </div>
</form>

@include('panel.partials.fileScripts')