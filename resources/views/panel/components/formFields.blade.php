@php
    $columns = $fieldsColumns;
    $fields = json_decode($section->fields, true);
    $route = $update ? 'sections.update' : 'sections.store';
    
    $params = $update ? ['section' => $section->slug, 'fieldId' => $currentField['id']] : ['section' => $section->slug];
@endphp
<form action="{{ route($route, $params) }}" method="post" enctype="multipart/form-data">
    @csrf
    @if($update)
        @method('PUT')
    @endif
    
    <input type="hidden" name="formMain" value="0">

    @foreach($columns as $column)
        @if(isset($column['fields']))
            
            @foreach($column['fields'] as $field)
                <div class="container-items">
                    @if($field['type'] == 'file')

                        <div class="form-group">
                            <div class="custom-input-file">
                                <label for="logo">{{ $field['label'] }}</label>
                                <input type="{{ $field['type']}}" name="{{ $field['name'] }}" accept="image/*" class="form-control" onchange="showTempFile(event, 'custom-input-file', 'container-temp-file')">
                                <div class="container-temp-file">
                                    @if(isset($currentField['files']))
                                    <img class="image" src="{{ asset('storage/' . $currentField['files']['path']) }}" />
                                    <button class="btn-delete" onclick="removeFile(event, '/painel/{{ $section->slug . '/' . $currentField['id'] }}/remove-file/{{ $currentField['files']['id'] }}')">
                                        <svg viewBox="0 0 24 24" style="fill: white; width: 20px; height: 20px;">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" style="stroke-width: 4px;"></path>
                                        </svg>
                                    </button>
                                    @endif
                                    <button type="button" class="btn btn-toggle-file" onclick="toggleFile(event)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    @elseif($field['type'] == 'select')
                        <div class="form-group
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                            <select class="form-control" name="{{ $field['name'] }}" id="{{ $field['name'] }}" {{ isset($field['required']) && $update ? 'required' : '' }}>
                                @foreach($field['options'] as $option)
                                    <option value="{{ $option->value }}">{{ $option->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif($field['type'] == 'checkbox')
                        <div class="form-group
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                            @foreach($field['options'] as $option)
                                <input class="form-control" type="checkbox" name="{{ $field['name'] }}" id="{{ $field['name'] }}" value="{{ $option->value }}" {{ isset($field['required']) && $update ? 'required' : '' }}>
                                <label for="{{ $field['name'] }}">{{ $option->label }}</label>
                            @endforeach
                        </div>
                    @elseif($field['type'] == 'radio')
                        <div class="form-group
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                            @foreach($field['options'] as $option)
                                <input class="form-control" type="radio" name="{{ $field['name'] }}" id="{{ $field['name'] }}" value="{{ $option->value }}" {{ isset($field['required']) && $update ? 'required' : '' }}>
                                <label for="{{ $field['name'] }}">{{ $option->label }}</label>
                            @endforeach
                        </div>
                    @elseif($field['type'] == 'text' || $field['type'] == 'email' || $field['type'] == 'url' || $field['type'] == 'number' || $field['type'] == 'password')
                        <div class="form-group
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                            <input class="form-control" type="{{ $field['type']}}" name="{{ $field['name'] }}" id="{{ $field['name'] }}" value="{{ old($field['name'], $update ? $currentField[$field['name']] : '') }}" {{ isset($field['required']) && $update ? 'required' : '' }}>
                        </div>
                    @elseif($field['type'] == 'textarea')
                        <div class="form-group">
                            <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                            <textarea class="form-control" name="{{ $field['name'] }}" id="{{ $field['name'] }}" {{ isset($field['required']) && $update ? 'required' : '' }}>
                                {{ $update ? $currentField[$field['name']] : '' }}
                            </textarea>
                        </div>
                    @endif

                </div>
            @endforeach

        @endif

    @endforeach

    <button class="btn btn-default" type="submit">Cadastrar</button>
</form>

@include('panel.partials.fileScripts')