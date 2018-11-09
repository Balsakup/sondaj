@extends('admin::layouts.default')

@section('title', 'Editer une question')

@section('content')
    <div class="card">
        <div class="card-header">@yield('title') :: <b>{{ $question->name }}</b></div>
        <div class="card-body">
            {!! Form::open([ 'route' => [ 'admin::questions.update', $question ], 'method' => 'PUT' ]) !!}

                <div class="row">
                    <div class="col-sm-8 form-group">
                        {!! Form::label('name', 'Intitulé de la question<span class="text-danger">*</span>', null, false) !!}
                        {!! Form::text('name', $question->name, [ 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '') ]) !!}

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-4 form-group">
                        {!! Form::label('question_type_id', 'Type de la question<span class="text-danger">*</span>', null, false) !!}
                        {!! Form::select('question_type_id', $questionTypes, $question->question_type_id, [ 'class' => 'form-control' . ($errors->has('question_type_id') ? ' is-invalid' : '') ]) !!}

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
