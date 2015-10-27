@extends('layouts.master')

@section('title', 'Add an Event — See&Do')

@section('content')
    <h2>Add an Event</h2>

    {!! Form::open(['action' => 'EventsController@store']) !!}
		
		@include('events.eventForm')

    {!! Form::close() !!}
@stop
