
@php
    $columns = json_decode($section->columns);
    $fields = json_decode($section->fields, true);
@endphp

<h3>Formulario de cadastro da seção</h3>

<form action="{{ route('sections.update', $section->slug) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    
    <input type="hidden" name="section_id" value="{{ $section->id }}">
    
    @foreach($columns as $column)

        @if($column->type == 'array')
            
            @foreach($column->fields as $field)
                    <div class="container-items">
                        @if($field->type == 'file')
                            <div class="form-group">
                                <label for="{{ $field->name }}">{{ $field->name }}</label>
                                <input type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}">
                            </div>
                        @elseif($field->type == 'select')
                            <div class="form-group
                                <label for="{{ $field->name }}">{{ $field->name }}</label>
                                <select name="{{ $field->name }}" id="{{ $field->name }}">
                                    @foreach($field->options as $option)
                                        <option value="{{ $option->value }}">{{ $option->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @elseif($field->type == 'checkbox')
                            <div class="form-group
                                <label for="{{ $field->name }}">{{ $field->name }}</label>
                                @foreach($field->options as $option)
                                    <input type="checkbox" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ $option->value }}">
                                    <label for="{{ $field->name }}">{{ $option->label }}</label>
                                @endforeach
                            </div>
                        @elseif($field->type == 'radio')
                            <div class="form-group
                                <label for="{{ $field->name }}">{{ $field->name }}</label>
                                @foreach($field->options as $option)
                                    <input type="radio" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ $option->value }}">
                                    <label for="{{ $field->name }}">{{ $option->label }}</label>
                                @endforeach
                            </div>
                        @elseif($field->type == 'text')
                            <div class="form-group
                                <label for="{{ $field->name }}">{{ $field->name }}</label>
                                <input type="{{ $field->type }}" name="{{ $field->name }}" id="{{ $field->name }}" value="oxe">
                            </div>
                        @else
                            <div class="form-group">
                                <label for="{{ $field->name }}">{{ $field->name }}</label>
                                <textarea class="form-control" name="{{ $field->name }}" id="{{ $field->name }}"></textarea>
                            </div>
                        @endif

                    </div>
                @endforeach
            
            @elseif($column->type == 'file')

        @elseif($column->type == 'select')
        
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->name }}</label>
                <select name="{{ $column->name }}" id="{{ $column->name }}">
                    @foreach($column->options as $option)
                        <option value="{{ $option->value }}">{{ $option->label }}</option>
                    @endforeach
                </select>
            </div>
        @elseif($column->type == 'checkbox')
        
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->name }}</label>
                @foreach($column->options as $option)
                    <input type="checkbox" name="{{ $column->name }}" id="{{ $column->name }}" value="{{ $option->value }}">
                    <label for="{{ $column->name }}">{{ $option->label }}</label>
                @endforeach
            </div>
        @elseif($column->type == 'radio')

            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->name }}</label>
                @foreach($column->options as $option)
                    <input type="radio" name="{{ $column->name }}" id="{{ $column->name }}" value="{{ $option->value }}">
                    <label for="{{ $column->name }}">{{ $option->label }}</label>
                @endforeach
            </div>
        @elseif($column->type == 'text')
            
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->name }}</label>
                <input type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}">
            </div>        

        @else
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->name }}</label>
                <textarea class="form-control" name="{{ $column->name }}" id="{{ $column->name }}"></textarea>
            </div>
        @endif

    @endforeach

    <button type="submit">Cadastrar</button>
</form>