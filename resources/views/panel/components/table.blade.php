@php
    $columns = json_decode($section->columns);
    $fields = json_decode($section->fields, true);

    function getLabelByName($columns, $name) {
        foreach ($columns as $field) {
            if ($field->name == $name) {
                return $field->label;
            }
        }
        return $name;
    }

@endphp

<div class="main-form">
    @include('panel.components.formMain')
</div>

<div class="divider"></div>

<div class="card-header text-right">
            <a href="{{ route('sections.create', $section->slug) }}" class="btn-default">Novo</a>
        </div>
        @if($fields && !empty($fields['fields']))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                    @if(!empty($fields))
                        @foreach(array_keys($fields['fields'][0]) as $key)
                            @if($key == 'files')
                                <th>Imagem</th>
                            @else
                                <th>{{ getLabelByName($columns[1]->fields, $key) }}</th>
                            @endif
                        @endforeach
                    @endif
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fields['fields'] as $item)
                        <tr>
                            @foreach($item as $key => $field)
                            
                                @if(($key == 'files'))
                                    <td>
                                        <img src="{{ asset('storage/' . $field['path']) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    @continue
                                @endif
                                <td>{{ $field }}</td>
                            @endforeach
                            
                            <td class="actions text-center">
                                <a href="{{ route('sections.edit', ['section' => $section->slug, 'fieldId' => $item['id']]) }}" class="link edit"><i class="fas fa-edit"></i></a>
                                <a data-toggle="modal" data-target="#modalDelete-{{$item['id']}}" class="link delete"><i class="fas fa-trash-alt"></i></a>

                                <div id="modalDelete-{{$item['id']}}" class="modal fade modal-warning" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon">
                                                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                                    </svg>
                                                </span>
                                                <span class="title">Você tem certeza?</span>
                                                <span class="message">Você realmente quer apagar este item?<br> Esta ação não poderá ser desfeita.</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancelar</button>
                                                <a href="#" class="btn btn-default" onclick="event.preventDefault();
                                                    document.getElementById(`form-delete-{{ $item['id']}}`).submit();">
                                                    Deletar
                                                </a>



                                                <form id="form-delete-{{ $item['id']}}" action="#" method="post" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="no-data">
            <span>Nenhum registro encontrado</span>
        </div>
        @endif