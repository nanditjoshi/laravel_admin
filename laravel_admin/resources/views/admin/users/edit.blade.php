@extends('admin.app')

@section('content')
    <section class="content">
        @include('admin.includes.breadcumb', ['pageTitle' => 'Edit User', 'pageSubTitle' => ''])
        <section class="content">
            <div class="row">
                <div class="row">
                    <div class="col-xs-6">

                            <!-- /.box-header -->
                                <form method="POST" action="{{ action('Admin\UserController@update', ['id' => $user->id])}}">
                                @csrf
                                 <input type="hidden" name="_method" value="PUT">
                                <div class="form-group has-feedback">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('First Name') }}" name="first_name" value="{{ $user->first_name }}" required autofocus>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('first_name') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback">
                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Last Name') }}" name="last_name" value="{{ $user->last_name }}" required autofocus>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('first_name') }}</strong></span>
                                    @endif
                                </div>
                                <div class="row">
                                    <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Update') }}</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                            <!-- /.box-body -->
                    </div>
                </div>
            </div>
            {{--<div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Dashboard</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                You are logged in!
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </section>
    </section>
@endsection