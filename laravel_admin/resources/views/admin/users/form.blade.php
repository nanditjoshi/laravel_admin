@extends('admin.app')

@section('content')
    <section class="content">
        @include('admin.includes.breadcumb', ['pageTitle' => 'Users', 'pageSubTitle' => (isset($user)) ? 'Edit User' : 'Add User'])
        <section class="content">
            <div class="row">
                <div class="col-xs-6">
                    <form method="POST" action="{{ action('Admin\UserController@store')}}">
                        @csrf
                        <div class="form-group has-feedback">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('First Name') }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('first_name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Last Name') }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('first_name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Email') }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Password') }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="password-confirm" type="password" class="form-control"
                                   placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                        </div>
                        @if($role == \App\Models\User::SUPER_ADMIN)
                        <div class="form-group has-feedback">
                            <select class="custom-select form-control" name="company_id" id="company_id">
                                <option value="">{{ __('Select Company') }}</option>
                                @if ($companies)
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('company_id'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('company_id') }}</strong></span>
                            @endif
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Create') }}</button>
                            </div>
                            <div class="col-xs-4"></div>
                            <div class="col-xs-4">
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-block btn-flat" title="{{ __('Cancel') }}">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
@endsection