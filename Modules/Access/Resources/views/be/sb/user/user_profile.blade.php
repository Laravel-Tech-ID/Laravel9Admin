@extends(config('app.be').'.main')
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
            <h1 class="h3 mb-0 text-gray-800">Profile Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input id="id" name="id" type="hidden" value="{{ $user->id }}">
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="gender" class="col-md-3 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="gender" id="gender" class="form-control form-control-user @error('gender') is-invalid @enderror" value="{{ $user->gender }}" required autocomplete="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" gender="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>        
                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="card_type" class="col-md-3 col-form-label text-md-right">{{ __('Card Type') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="card_type" id="card_type" class="form-control form-control-user @error('card_type') is-invalid @enderror" value="{{ $user->card_type }}" autocomplete="card_type">
                                        <option value="ktp">KTP</option>
                                        <option value="sim">SIM</option>
                                        <option value="kk">KK</option>
                                        <option value="surat nikah">Surat Nikah</option>
                                        <option value="other">Lain-lain</option>
                                    </select>
                                    @error('card_type')
                                        <span class="invalid-feedback" card_type="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label for="card_id" class="col-md-3 col-form-label text-md-right">{{ __('ID Number') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="card_id" type="text" class="form-control form-control-user @error('card_id') is-invalid @enderror" name="card_id" value="{{ $user->card_id }}" autocomplete="card_id">
                                    @error('card_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="card_image" class="col-md-3 col-form-label text-md-right">{{ __('ID Card Image') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    <div class="col-md-8">
                                        <img src="{{ asset(($user->card_image) ? 'User/'.$user->card_image : 'User/card.png' ) }}" width="100%" height="100%" style="margin-bottom:20px;"/>
                                    </div>
                                    <input id="card_image" type="file" class="form-control form-control-user @error('card_image') is-invalid @enderror" name="card_image" value="{{ $user->card_image }}" autocomplete="card_image">
                                    @error('card_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="address" type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" autocomplete="address">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="phone" type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="photo" class="col-md-3 col-form-label text-md-right">{{ __('User Picture') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    <div class="col-md-8">
                                        <img src="{{ asset(($user->photo) ? 'User/'.$user->photo : 'modules/access/user/user.png' ) }}" width="100%" height="100%" style="margin-bottom:20px;"/>
                                    </div>
                                    <input id="photo" type="file" class="form-control form-control-user @error('photo') is-invalid @enderror" name="photo" value="{{ $user->photo }}" autocomplete="photo">
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="position" class="col-md-3 col-form-label text-md-right">{{ __('User Position') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="position" type="text" class="form-control form-control-user @error('position') is-invalid @enderror" name="position" value="{{ $user->position }}" autocomplete="position">
                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="description" type="text" class="form-control form-control-user @error('description') is-invalid @enderror" name="description" value="{{ $user->description }}" autocomplete="description">
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="testimony" class="col-md-3 col-form-label text-md-right">{{ __('Testimony') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <textarea id="testimony" class="form-control form-control-user @error('testimony') is-invalid @enderror" name="testimony" autocomplete="testimony">{{ $user->testimony }}</textarea>
                                    @error('testimony')
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
