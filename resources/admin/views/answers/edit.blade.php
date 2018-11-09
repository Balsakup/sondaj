@extends('admin::layouts.default')

@section('title', 'Editer une réponse')

@section('content')
    <div class="card">
        <div class="card-header">@yield('title') :: <b>{{ $answer->name }} <i>({{ $answer->value }})</i></b></div>
        <div class="card-body">
            {!! Form::open([ 'route' => [ 'admin::answers.update', $answer ], 'method' => 'PUT' ]) !!}

                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('name', 'Nom de la réponse<span class="text-danger">*</span>', null, false) !!}
                        {!! Form::text('name', $answer->name, [ 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '') ]) !!}

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('value', 'Valeur de la réponse') !!}
                        {!! Form::text('value', $answer->value, [ 'class' => 'form-control' . ($errors->has('value') ? ' is-invalid' : '') ]) !!}

                        @if ($errors->has('value'))
                            <span class="invalid-feedback">{{ $errors->first('value') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group mb-0">
                    <hr>
                    {!! Form::button('Enregistrer', [ 'type' => 'submit', 'class' => 'btn btn-outline-success' ]) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
