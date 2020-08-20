@extends('admin.app')

@section('content')
    <section class="content">
        @include('admin.includes.breadcumb', ['pageTitle' => 'Companies', 'pageSubTitle' => (isset($user)) ? 'Edit Company' : 'Add Company'])
        <section class="content">
            <div class="row">
                <div class="col-xs-6">
                    <form method="POST" action="{{ action('Admin\CompanyController@update', ['id' => $company->id])}}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group has-feedback">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Name') }}" name="name" value="{{ $company->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Email') }}" name="email" value="{{ $user->email }}" required readonly>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <div class="row">
                                <div class="col-xs-2">{{ __('Company Type:') }}</div>
                                <div class="col-xs-10">
                                    <div class="radio-inline">
                                        <input type="radio" name="type" value="1" {{ ($company->type=="1")? "checked" : "" }}>{{ __('Organization') }}
                                    </div>
                                    <div class="radio-inline">
                                        <input type="radio" name="type" value="2" {{ ($company->type=="2")? "checked" : "" }}>{{ __('Charity') }}
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('type') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Website') }}" name="website" value="{{ $companyProfile->website }}" required autofocus>
                            @if ($errors->has('website'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('website') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Description') }}" name="description" value="{{ $companyProfile->description }}" required autofocus>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group has-feedback">
                            <input id="first_name" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                   placeholder="{{ __('Phone') }}" name="phone" value="{{ $companyProfile->phone }}" required autofocus>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Update') }}</button>
                            </div>
                            <div class="col-xs-4"></div>
                            <div class="col-xs-4">
                                <a href="{{ route('companies.index') }}" class="btn btn-primary btn-block btn-flat" title="{{ __('Cancel') }}">
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