@extends(config('app.be_layout').'.main')
@section('content')
            @if(session('error'))
                <div class="card shadow bg-danger text-white" style="margin-bottom:20px;">
                    <div class="card-body" style="overflow-x:auto;padding:10px;">{!! session('error') !!}</div>
                </div>
            @endif
            @if(session('success'))
                <div class="card shadow bg-success text-white" style="margin-bottom:20px;">
                    <div class="card-body" style="overflow-x:auto;padding:10px;">{!! session('success') !!}</div>
                </div>
            @endif

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Setting Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">User Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('admin.v1.setting.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="initial" class="col-md-3 col-form-label text-md-right">{{ __('Company Initial [initial]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="initial" type="text" class="form-control form-control-user @error('initial') is-invalid @enderror" name="initial" value="{{ $setting->initial }}" autocomplete="initial">
                                    @error('initial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Company Name [name]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ $setting->name }}" autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description [description]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <textarea id="description" class="form-control form-control-user @error('description') is-invalid @enderror" name="description" autocomplete="description">{{ $setting->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="padding-bottom: 30px;">
                                <label for="icon" class="col-md-3 col-form-label text-md-right">{{ __('Company Icon [icon]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    @if($setting->icon)
                                        <img src="{{ asset(config('setting.media').$setting->icon) }}" width="100%" height="100%" style="padding:10px;"/>
                                    @endif
                                    <input id="icon" type="file" class="form-control form-control-user @error('icon') is-invalid @enderror" name="icon" value="{{ $setting->icon }}" autocomplete="icon">
                                    @error('icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row" style="padding-bottom: 30px;">
                                <label for="logo" class="col-md-3 col-form-label text-md-right">{{ __('Company Logo [logo]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    @if($setting->logo)
                                        <img src="{{ asset(config('setting.media').$setting->logo) }}" width="100%" height="100%" style="padding:10px;"/>
                                    @endif
                                    <input id="logo" type="file" class="form-control form-control-user @error('logo') is-invalid @enderror" name="logo" value="{{ $setting->logo }}" autocomplete="logo">
                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row" style="padding-bottom: 30px;">
                                <label for="login_image" class="col-md-3 col-form-label text-md-right">{{ __('Login Image [login_image]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    @if($setting->login_image)
                                        <img src="{{ asset(config('setting.media').$setting->login_image) }}" width="100%" height="100%" style="padding:10px;"/>
                                    @endif
                                    <input id="login_image" type="file" class="form-control form-control-user @error('login_image') is-invalid @enderror" name="login_image" value="{{ $setting->login_image }}" autocomplete="login_image">
                                    @error('login_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                     
                            <div class="form-group row">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone [phone]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="phone" type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ $setting->phone }}" autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Address [address]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="address" type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ $setting->address }}" autocomplete="address">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email [email]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $setting->email }}" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-md-3 col-form-label text-md-right">{{ __('Facebook Link [facebook]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="facebook" type="text" class="form-control form-control-user @error('facebook') is-invalid @enderror" name="facebook" value="{{ $setting->facebook }}" autocomplete="facebook">
                                    @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="twitter" class="col-md-3 col-form-label text-md-right">{{ __('Twitter Link [twitter]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="twitter" type="text" class="form-control form-control-user @error('twitter') is-invalid @enderror" name="twitter" value="{{ $setting->twitter }}" autocomplete="twitter">
                                    @error('twitter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="google" class="col-md-3 col-form-label text-md-right">{{ __('Google+ Link [google]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="google" type="text" class="form-control form-control-user @error('google') is-invalid @enderror" name="google" value="{{ $setting->google }}" autocomplete="google">
                                    @error('google')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instagram" class="col-md-3 col-form-label text-md-right">{{ __('Instagram Link [instagram]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="instagram" type="text" class="form-control form-control-user @error('instagram') is-invalid @enderror" name="instagram" value="{{ $setting->instagram }}" autocomplete="instagram">
                                    @error('instagram')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                      
                            <div class="form-group row">
                                <label for="copyright" class="col-md-3 col-form-label text-md-right">{{ __('Copyright Text [copyright]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    <input id="copyright" type="text" class="form-control form-control-user @error('copyright') is-invalid @enderror" name="copyright" value="{{ $setting->copyright }}" autocomplete="copyright">
                                    @error('copyright')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            

                            <div class="form-group row">
                                <label for="maps_key" class="col-md-3 col-form-label text-md-right">{{ __('Maps Key [maps_key]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="maps_key" type="text" class="form-control form-control-user @error('maps_key') is-invalid @enderror" name="maps_key" value="{{ $setting->maps_key }}" autocomplete="maps_key">
                                    @error('maps_key')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="latitude" class="col-md-3 col-form-label text-md-right">{{ __('Latitude [latitude]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="latitude" type="text" class="form-control form-control-user @error('latitude') is-invalid @enderror" name="latitude" value="{{ $setting->latitude }}" autocomplete="latitude">
                                    @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="longitude" class="col-md-3 col-form-label text-md-right">{{ __('Longitude [longitude]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="longitude" type="text" class="form-control form-control-user @error('longitude') is-invalid @enderror" name="longitude" value="{{ $setting->longitude }}" autocomplete="longitude">
                                    @error('longitude')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="api_key" class="col-md-3 col-form-label text-md-right">{{ __('API Key Mutasi Bank [api_key]') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="api_key" type="text" class="form-control form-control-user @error('api_key') is-invalid @enderror" name="api_key" value="{{ $setting->api_key }}" autocomplete="api_key">
                                    @error('api_key')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-12">
                                    <button type="submit" class="btn btn-user btn-primary btn-block">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>
        </div>
@endsection