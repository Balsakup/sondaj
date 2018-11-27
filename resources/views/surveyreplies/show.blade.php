@extends('layouts.default')

@section('title', $reply->survey->name)

@section('content')
    <div id="survey"></div>

    <script type="application/json" data-survey-json>{!! $reply->toJson() !!}</script>
@endsection
