@extends('admin::layouts.default')

@section('title', 'Visualisation de la page')

@section('content')
    <div class="jumbotron bg-light">
        <h1>{{ $page->name }}</h1>
    </div>

    <div class="card">
        <div class="card-header">Gestion des questions</div>
        <div class="card-body">
            {!! Form::open([ 'route' => 'admin::questions.store' ]) !!}

                {!! Form::hidden('page_id', $page->id) !!}

                <div class="row">
                    <div class="col-sm-8 form-group">
                        {!! Form::label('name', 'Intitulé de la question<span class="text-danger">*</span>', null, false) !!}
                        {!! Form::text('name', null, [ 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '') ]) !!}

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-4 form-group">
                        {!! Form::label('question_type_id', 'Type de la question<span class="text-danger">*</span>', null, false) !!}
                        {!! Form::select('question_type_id', $questionTypes, null, [ 'class' => 'form-control' . ($errors->has('question_type_id') ? ' is-invalid' : '') ]) !!}

                        @if ($errors->has('question_type_id'))
                            <span class="invalid-feedback">{{ $errors->first('question_type_id') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group mb-0">
                    <hr>
                    {!! Form::button('Ajouter', [ 'type' => 'submit', 'class' => 'btn btn-outline-success' ]) !!}
                </div>

            {!! Form::close() !!}
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Nombre de réponse</th>
                        <th>Créé le</th>
                        <th>Mise à jour le</th>
                        <th class="text-right">
                            <span class="fa fa-toolbox"></span>
                        </th>
                    </tr>
                </thead>
                <tbody data-sortable="\App\Question">
                    @foreach ($page->questions as $question)
                        <tr class="table-align-middle" data-id="{{ $question->id }}">
                            <td style="border-left: 5px solid #{{ substr(md5($question->type->name), 0, 6) }};">
                                <span class="fa fa-bars" style="cursor: move;"></span>
                                <span class="ml-3">{{ $question->name }}</span>
                            </td>
                            <td>{{ $question->type->label }}</td>
                            <td>
                                @if ($question->type->is_multiple)
                                    @if ($question->answer_count === 0)
                                        <span class="badge badge-danger">{{ $question->answer_count }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $question->answer_count }}</span>
                                    @endif
                                @else
                                    N/D
                                @endif
                            </td>
                            <td>{{ $question->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $question->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin::questions.show', $question) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Voir la questions">
                                    <span class="fa fa-eye"></span>
                                </a>

                                <a href="{{ route('admin::questions.edit', $question) }}" class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Editer la question">
                                    <span class="fa fa-edit"></span>
                                </a>

                                <a href="{{ route('admin::questions.destroy', $question) }}" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer la question" onclick="confirm('Voulez-vous vraiment supprimer cette question ?\nToutes les informations associées seront perdues.') ? document.getElementById('questions-destroy-{{ $question->id }}').submit() : false; return false;">
                                    <span class="fa fa-trash"></span>
                                </a>

                                {!! Form::open([ 'route' => [ 'admin::questions.destroy', $question ], 'class' => 'd-none', 'id' => 'questions-destroy-' . $question->id, 'method' => 'DELETE' ]) !!}{!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
