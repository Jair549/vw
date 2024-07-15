<h3>menu</h3>

<ol>
    @foreach($sections as $section)
    <li>
    <a href="#">{{ $section->name }}</a>
    </li>
    @endforeach
</ol>

<h3>Formulario de cadastro da seção</h3>

<form action="{{ route('sections.store') }}" method="post">
    @csrf
    
    @foreach(json_decode($sections[2]->columns) as $column)

    @if($column->type == 'array')
    @foreach($column->fields as $field)
    <input type="hidden" name="section_id" value="{{ $sections[2]->id }}">
    <div class="container-items">
        <div class="form-group">
            <label for="{{ $field->name }}">{{ $field->name }}</label>
            <input type="{{ $field->type}}" name="{{ $field->name }}" id="{{ $field->name }}">
        </div>

    </div>
    @endforeach
    @else
    <div class="form-group">
        <label for="{{ $column->name }}">{{ $column->name }}</label>
        <input type="{{ $column->type}}" name="{{ $column->name }}" id="{{ $column->name }}">
    </div>
    
    @endif
    @endforeach

    <button type="submit">Cadastrar</button>
</form>

<h3>A landing page listando o conteúdo de todas as seções</h3>

@foreach($sections as $section)
    @if($section->name == 'Carros')
        @php
            $items = json_decode($section->fields, true);
        @endphp
        <section>
            <h2>{{ $section->name }}</h2>
            <ul>
                <li>
                    <h3>{{ $items['title'] }}</h3>
                    <h6>{{ $items['subtitle'] }}</h6>
                    <p>{{ $items['price'] }}</p>
                    <a href="{{ $items['button_link'] }}">{{ $items['button_text'] }}</a>
                </li>
            </ul>
        </section>
    @endif
@endforeach