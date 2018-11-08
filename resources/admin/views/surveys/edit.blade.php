@extends('admin::layouts.default')

@section('title', 'Editer un questionnaire')

@section('content')
    <div class="card">
        <div class="card-header">@yield('title')</div>
        <div class="card-body">
            {!! Form::open([ 'route' => [ 'admin::surveys.update', $survey ], 'method' => 'PUT' ]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nom du questionnaire<span class="text-danger">*</span>', null, false) !!}
                    {!! Form::text('name', $survey->name, [ 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '') ]) !!}

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description du questionnaire') !!}
                    {!! Form::textarea('description', $survey->description, [ 'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : '') ]) !!}

                    @if ($errors->has('description'))
                        <span class="invalid-feedback">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group mb-0">
                    <hr>
                    {!! Form::button('Enregistrer', [ 'type' => 'submit', 'class' => 'btn btn-outline-success' ]) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
