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

                        <div class="form-group">
                            <div class="custom-input-file">
                                <label for="logo">Imagem</label>
                                <input type="file" name="image" accept="image/*" class="form-control" onchange="showTempFile(event, 'custom-input-file', 'container-temp-file')">
                                <div class="container-temp-file">
                                    <button type="button" class="btn btn-toggle-file" onclick="toggleFile(event)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
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
        @endif

    @endforeach
    <div class="form-group text-right">
        <button class="btn btn-default" type="submit">Cadastrar</button>
    </div>
</form>

@include('panel.partials.fileScripts')