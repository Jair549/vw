@php
    $columns = $mainColumns;
    $fields = json_decode($section->fields, true);
    $route = $update ? 'sections.update' : 'sections.store';
@endphp

<form action="{{ route($route, $section->slug) }}" method="post" enctype="multipart/form-data">
    @csrf
    @if($update)
        @method('PUT')
    @endif
    
    <input type="hidden" name="formMain" value="1">

    @if($fields)
        <input type="hidden" name="mainDataId" value="{{ $fields['id']}}">
    @endif
    
    @foreach($columns as $column)
    
        @if($column['type'] == 'array')
            
            @continue
            
        @elseif($column['type'] == 'file')

            <div class="form-group">
                <div class="custom-input-file">
                    <label for="logo">{{ $column['label'] }}</label>
                    <input type="{{ $column['type']}}" name="{{ $column['name'] }}" accept="image/*" class="form-control" onchange="showTempFile(event, 'custom-input-file', 'container-temp-file')">
                    <div class="container-temp-file">
                        @if(isset($fields['files']))
                        <img class="image" src="{{ asset('storage/' . $fields['files']['path']) }}" />
                        <button class="btn-delete" onclick="removeFile(event, '/painel/{{ $section->slug . '/' . $fields['id'] }}/remove-file/{{ $fields['files']['id'] }}')">
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

        @elseif($column['type'] == 'select')
        
            <div class="form-group">
                <label for="{{ $column['name'] }}">{{ $column['label'] }}</label>
                <select class="form-control" name="{{ $column['name'] }}" id="{{ $column['name'] }}" {{ isset($column['required']) && $update ? 'required' : '' }}>
                    @foreach($column['options'] as $option)
                        <option value="{{ $option->value }}">{{ $option->label }}</option>
                    @endforeach
                </select>
            </div>
        @elseif($column['type'] == 'checkbox')
        
            <div class="form-group">
                <label for="{{ $column['name'] }}">{{ $column['label'] }}</label>
                @foreach($column['options'] as $option)
                    <input class="form-control" type="checkbox" name="{{ $column['name'] }}" id="{{ $column['name'] }}" value="{{ $option->value }}" {{ isset($column['required']) && $update ? 'required' : '' }}>
                    <label for="{{ $column['name'] }}">{{ $option->label }}</label>
                @endforeach
            </div>
        @elseif($column['type'] == 'radio')

            <div class="form-group">
                <label for="{{ $column['name'] }}">{{ $column['label'] }}</label>
                @foreach($column['options'] as $option)
                    <input class="form-control" type="radio" name="{{ $column['name'] }}" id="{{ $column['name'] }}" value="{{ $option->value }}" {{ isset($column['required']) && $update ? 'required' : '' }}>
                    <label for="{{ $column['name'] }}">{{ $option->label }}</label>
                @endforeach
            </div>
        @elseif($column['type'] == 'text')
            
            <div class="form-group">
                <label for="{{ $column['name'] }}">{{ $column['label'] }}</label>
                <input class="form-control" type="{{ $column['type']}}" name="{{ $column['name'] }}" id="{{ $column['name'] }}" value="{{ old($column['name'], isset($fields[$column['name']]) ? $fields[$column['name']] : '') }}" {{ isset($column['required']) && $update ? 'required' : '' }}>
            </div>
        @elseif($column['type'] == 'url')
            <div class="form-group
                <label for="{{ $column['name'] }}">{{ $column['label'] }}</label>
                <input class="form-control" type="{{ $column['type']}}" name="{{ $column['name'] }}" id="{{ $column['name'] }}" value="{{ old($column['name'], isset($fields[$column['name']]) ? $fields[$column['name']] : '') }}" {{ isset($column['required']) && $update ? 'required' : '' }}>
            </div>     

        @else
            <div class="form-group">
                <label for="{{ $column['name'] }}">{{ $column['label'] }}</label>
                <textarea class="form-control" name="{{ $column['name'] }}" id="{{ $column['name'] }}" {{ isset($column['required']) && $update ? 'required' : '' }}></textarea>
            </div>
        @endif

    @endforeach
    
    <div class="form-group text-right">
        <button class="btn btn-default" type="submit">Cadastrar</button>
    </div>
</form>

@include('panel.partials.fileScripts')