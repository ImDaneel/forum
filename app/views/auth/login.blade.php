@extends('layouts.default')

@section('title')
{{ lang('User Login') }}_@parent
@stop

@section('content')
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">{{ lang('Login') }}</h3>
        </div>
        <div class="panel-body">

            {{ Form::open(['route'=>'login']) }}

                <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                    <label class="control-label" for="name">{{ lang('Username') }}</label>
                    {{ Form::text('name', (''), ['class' => 'form-control']) }}
                    {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                </div>

                <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
                    <label class="control-label" for="password">{{ lang('Password') }}</label>
                    {{ Form::password('password', ['class' => 'form-control']) }}
                    {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                </div>

                {{ Form::submit(lang('Confirm'), ['class' => 'btn btn-lg btn-success btn-block']) }}

            {{ Form::close() }}

        </div>
      </div>
    </div>
  </div>

@stop
