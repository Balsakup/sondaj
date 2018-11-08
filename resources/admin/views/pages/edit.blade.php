@extends('admin::layouts.default')

@section('title', 'Editer une page')

@section('content')
    <div class="card">
        <div class="card-header">@yield('title')</div>
        <div class="card-body">
            {!! Form::open([ 'route' => [ 'admin::pages.update', $page ], 'method' => 'PUT' ]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nom de la page<span class="text-danger">*</span>', null, false) !!}
                    {!! Form::text('name', $page->name, [ 'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '') ]) !!}

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group mb-0">
                    <hr>
                    {!! Form::button('Enregistrer', [ 'type' => 'submit', 'class' => 'btn btn-outline-success' ]) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsectioN
