@extends('admin::layouts.default')

@section('title', 'Visualisation de la page')

@section('content')
    <div class="jumbotron bg-light">
        <h1>{{ $page->name }}</h1>
    </div>Un Anneau pour les gouverner tous. Un Anneau pour les trouver. Un Anneau pour les amener tous et dans les ténèbres les lier.

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
    </div>
@endsection
