
@php
    $columns = json_decode($section->columns);
    $fields = json_decode($section->fields, true);
@endphp


<h3>Formulario de cadastro da seção</h3>

<form action="{{ route('sections.store') }}" method="post">
    @csrf
    @method('put')

    @foreach($columns as $column)
        @if($column->type == 'array')
        
            @foreach($column->fields as $field)
                <input type="hidden" name="section_id" value="{{ $section->id }}">
                <div class="container-items">
                    <div class="form-group">
                        <label for="{{ $field->name }}">{{ $field->name }}</label>
                        <input type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}" value="{{ $fields[$field->name] }}">
                    </div>

                </div>
            @endforeach
        @else
        
            <div class="form-group">
                <label for="{{ $column->name }}">{{ $column->name }}</label>
                <input type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}" value="{{ $fields[$column->name] }}">
            </div>
        
        @endif
    @endforeach

    <button type="submit">Cadastrar</button>
</form>