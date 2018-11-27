@extends('layouts.default')

@section('title', 'Choix du questionnaire')

@section('content')
    <div class="jumbotron">
        <h1>@yield('title')</h1>
    </div>

    <nav class="list-group">
        @foreach ($surveys as $survey)
            <a href="{{ route('surveys.show', $survey) }}" class="list-group-item">{{ $survey->name }}</a>
        @endforeach
    </nav>
@endsection
