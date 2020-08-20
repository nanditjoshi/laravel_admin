@extends('admin.app')

@section('content')
    <section class="content">
        @include('admin.includes.breadcumb', ['pageTitle' => 'Roles', 'pageSubTitle' => (isset($role)) ? 'Edit Role' : 'Add Role'])
        <section class="content">
            <div class="row">
                <div class="col-xs-6">
                    <form method="POST" action="{{ (isset($role)) ? action('Admin\RoleController@update', ['id' => $role->id]) : action('Admin\RoleController@store') }}">
                        @csrf
                        {!!   isset($role) ? '<input type="hidden" name="_method" value="PUT">' : ''; !!}
                        <div class="form-group has-feedback">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Name') }}" name="name" value="{{ isset($role) ? $role->name : old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Save') }}</button>
                            </div>
                            <div class="col-xs-4"></div>
                            <div class="col-xs-4">
                                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-block btn-flat" title="{{ __('Cancel') }}">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
@endsection