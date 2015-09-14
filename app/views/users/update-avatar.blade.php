@extends('layouts.default')

@section('title')
更新头像_@parent
@stop

@section('content')

<div class="users-show">

  <div class="col-md-3 box" style="padding: 15px 15px;">
    @include('users.partials.basicinfo')
  </div>

  <div class="main-col col-md-9 left-col">

    <div class="panel panel-default">

      <div class="panel-body ">

        {{ Form::open(['route' => ['users.update_avatar', $user->id], 'files' => true]) }}

          <div class="form-group">
            {{ Form::file('image') }}
          </div>

          <div class="form-group status-post-submit">
            {{ Form::submit(lang('Upload Avatar'), ['class' => 'btn btn-primary', 'id' => 'user-avatar-upload']) }}
          </div>


        {{ Form::close() }}

      </div>

    </div>
  </div>


</div>




@stop
