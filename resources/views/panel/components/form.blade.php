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
            
            @foreach($column->fields as $field)
                <div class="container-items">
                    @if($field->type == 'file')
                        <div class="form-group">
                            <label for="{{ $field->name }}">{{ $field->label }}</label>
                            <input class="form-control" type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}" {{ isset($field->required) && $update ? 'required' : '' }}>
                        </div>
                        
                    @elseif($field->type == 'select')
                        <div class="form-group
                            <label for="{{ $field->name }}">{{ $field->label }}</label>
                            <select class="form-control" name="{{ $field->name }}" id="{{ $field->name }}" {{ isset($field->required) && $update ? 'required' : '' }}>
                                @foreach($field->options as $option)
                                    <option value="{{ $option->value }}">{{ $option->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif($field->type == 'checkbox')
                        <div class="form-group
                            <label for="{{ $field->name }}">{{ $field->label }}</label>
                            @foreach($field->options as $option)
                                <input class="form-control" type="checkbox" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ $option->value }}" {{ isset($field->required) && $update ? 'required' : '' }}>
                                <label for="{{ $field->name }}">{{ $option->label }}</label>
                            @endforeach
                        </div>
                    @elseif($field->type == 'radio')
                        <div class="form-group
                            <label for="{{ $field->name }}">{{ $field->label }}</label>
                            @foreach($field->options as $option)
                                <input class="form-control" type="radio" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ $option->value }}" {{ isset($field->required) && $update ? 'required' : '' }}>
                                <label for="{{ $field->name }}">{{ $option->label }}</label>
                            @endforeach
                        </div>
                    @elseif($field->type == 'text')
                        <div class="form-group
                            <label for="{{ $field->name }}">{{ $field->label }}</label>
                            <input class="form-control" type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ old($field->name, $update ? $fields[0]['fields'][$field->name] : '') }}" {{ isset($field->required) && $update ? 'required' : '' }}>
                        </div>
                    @elseif($field->type == 'url')
                        <div class="form-group
                            <label for="{{ $field->name }}">{{ $field->label }}</label>
                            <input class="form-control" type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ old($field->name, $update ? $fields[0]['fields'][$field->name] : '') }}" {{ isset($field->required) && $update ? 'required' : '' }}>
                        </div>
                    @elseif($field->type == 'textarea')
                        <div class="form-group">
                            <label for="{{ $field->name }}">{{ $field->label }}</label>
                            <textarea class="form-control" name="{{ $field->name }}" id="{{ $field->name }}" {{ isset($field->required) && $update ? 'required' : '' }}>
                                {{ old($field->name, $update ? $fields[0]['fields'][$field->name] : '') }}
                            </textarea>
                        </div>
                    @endif

                </div>
            @endforeach
            
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
                <input class="form-control" type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}" {{ isset($column->required) && $update ? 'required' : '' }}>
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

    <button type="submit">Cadastrar</button>
</form>