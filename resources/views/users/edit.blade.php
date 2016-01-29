@extends('layouts.master')

@section('title', 'Edit User Profile — See&Do')

@section('content')
    <h2 class="aligned">Edit Profile - {{$user->username}}</h2>

    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'class' => 'form']) !!}

    <div class="form-row">
        {!! Form::label('email', 'Email') !!}

        <div class="form-row-body">
            {!! Form::text('email', null, ['class' => 'input-text', 'placeholder' => 'marty@thefuture.org']) !!}

            @include('common.forms.field-errors', ['errors' => $errors->get('email')])
        </div>
    </div>

	<div class="form-row">
	    {!! Form::label('name_first', 'First Name') !!}

	    <div class="form-row-body">
	        {!! Form::text('name_first', null, ['class' => 'input-text', 'placeholder' => 'Your Name']) !!}

	        @include('common.forms.field-errors', ['errors' => $errors->get('name_second')])
	    </div>
	</div>


	<div class="form-row">
	    {!! Form::label('name_last', 'Surname') !!}

	    <div class="form-row-body">
	        {!! Form::text('name_last', null, ['class' => 'input-text', 'placeholder' => 'Your Name']) !!}

	        @include('common.forms.field-errors', ['errors' => $errors->get('name_second')])
	    </div>
	</div>

	<div class="form-row">
	    {!! Form::label('bio', 'User Bio') !!}

	    <div class="form-row-body">
	        {!! Form::textarea('bio', null, ['class' => 'input-text', 'placeholder' => 'Your Name']) !!}

	        @include('common.forms.field-errors', ['errors' => $errors->get('name_second')])
	    </div>
	</div>

	<div class="form-row">
	    <div class="form-row-body">
	        {!! Form::submit('[ Submit ]', ['class' => 'btn primary']) !!}
	    </div>
	</div>


    {!! Form::close() !!}
	<div class="form no-mgt">
		<div class="form-row">
		    <div class="form-row-body">

		    </div>
		</div>
	</div>

@stop
