@extends('admin::layouts.default')

@section('title', 'Visualisation de la question')

@section('content')
    <div class="jumbotron bg-light">
        <h1>{{ $question->name }}</h1>

        @switch(request('page'))
            @case('rules')
                <p class="lead">Gestion des règles</p>
                @break
            @case('actions')
                <p class="lead">Gestion des actions</p>
                @break
            @default
                <p class="lead">Gestions des réponses</p>
        @endswitch
    </div>

    <nav class="nav nav-pills nav-justified mb-3">
        <a href="{{ route('admin::questions.show', [ $question, 'page' => 'answers' ]) }}" class="nav-item nav-link{{ request('page') === 'answers' || !request('page') ? ' active' : '' }}">Réponses</a>
        <a href="{{ route('admin::questions.show', [ $question, 'page' => 'rules' ]) }}" class="nav-item nav-link{{ request('page') === 'rules' ? ' active' : '' }}">Règles</a>
        <a href="{{ route('admin::questions.show', [ $question, 'page' => 'actions' ]) }}" class="nav-item nav-link{{ request('page') === 'actions' ? ' active' : '' }}">Actions</a>
    </nav>

    @if ($question->type->is_multiple)
        <div class="card">
            <div class="card-body">
                {!! Form::open([ 'route' => 'admin::answers.store' ]) !!}

                    {!! Form::hidden('question_id', $question->id) !!}

                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('name', 'Nom de la réponse<span class="text-danger">*</span>', null, false) !!}
                            {!! Form::text('name', null, [ 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '') ]) !!}

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('value', 'Valeur de la réponse') !!}
                            {!! Form::text('value', null, [ 'class' => 'form-control' . ($errors->has('value') ? ' is-invalid' : '') ]) !!}

                            @if ($errors->has('value'))
                                <span class="invalid-feedback">{{ $errors->first('value') }}</span>
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
                            <th>Valeur</th>
                            <th class="text-right">
                                <span class="fa fa-toolbox"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($question->answers as $answer)
                            <tr>
                                <td>{{ $answer->name }}</td>
                                <td>{{ $answer->value }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin::answers.edit', $answer) }}" class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Editer la réponse">
                                        <span class="fa fa-edit"></span>
                                    </a>

                                    <a href="{{ route('admin::answers.destroy', $answer) }}" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer la réponse" onclick="confirm('Voulez-vous vraiment supprimer cette réponse ?\nToutes les informations associées seront perdues.') ? document.getElementById('answers-destroy-{{ $answer->id }}').submit() : false; return false;">
                                        <span class="fa fa-trash"></span>
                                    </a>

                                    {!! Form::open([ 'route' => [ 'admin::answers.destroy', $answer ], 'class' => 'd-none', 'id' => 'answers-destroy-' . $answer->id, 'method' => 'DELETE' ]) !!}{!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-danger">Le type de question <span class="font-italic font-weight-bold">{{ $question->type->label }}</span> ne prend pas en charge les réponses</div>
    @endif
@endsection
