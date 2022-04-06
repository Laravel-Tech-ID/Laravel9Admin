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
            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
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
                        <form method="POST" action="{{ route('admin.v1.access.user.update',$user->id) }}" enctype="multipart/form-data">
                            @csrf  
                            @method('PUT')
                            <div class="form-group row">
                                <label for="code" class="col-md-3 col-form-label text-md-right">{{ __('Kode Pengguna') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="code" type="text" class="form-control form-control-user @error('code') is-invalid @enderror" name="code" value="{{ $user->code }}" autocomplete="code">
                                    @error('code')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nama') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Telepon') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="phone" type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                                
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" status="alert">
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
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Ulangi Password') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    @error('password-confirm')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="status" id="status" class="form-control form-control-user @error('status') is-invalid @enderror" value="{{ $user->status }}" required autocomplete="status">
                                        <option value="Active" {{ ($user->status == 'Active') ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ ($user->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-md-3 col-form-label text-md-right">{{ __('Role') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0 @error('role') rounded border border-danger @enderror">
                                    @foreach($roles as $role)
                                        <div class="col-md-13 mb-4 mb-sm-0" style="float: left; padding: 5px;">
                                            <input id="role" type="checkbox" class="form-control-user @error('role') is-invalid @enderror" name="role[]" value="{{ $role->name }}" {{ ($user->roles->pluck('name')->contains($role->name)) ? 'checked' : '' }} autocomplete="role">
                                            <label for="role" class="col-form-label" style="padding-bottom:5px;">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-md-3 col-form-label text-md-right"></label>
                                <div class="col-md-8 mb-3 mb-sm-0 text-danger">
                                    @error('role')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 60px;">
                                <label for="picture" class="col-md-3 col-form-label text-md-right">{{ __('Foto') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    <img src="{{ ($user->picture) ? route('admin.v1.access.user.file',$user->picture) : asset(config('access.media').'user/user.png') }}" width="100%" height="100%" style="padding:10px;"/>
                                    <input id="picture" type="file" class="form-control form-control-user @error('picture') is-invalid @enderror" name="picture" value="{{ $user->picture }}" autocomplete="picture">
                                    @error('picture')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                
                            <div class="form-group row">
                                <label for="blocked" class="col-md-3 col-form-label text-md-right">{{ __('Blokir') }}</label>
                                <div class="col-md-9 mb-3 mb-sm-0">
                                    <div class="col-md-13 mb-4 mb-sm-0" style="float: left; padding: 5px;">
                                    <input id="blocked" type="checkbox" class="form-control-user @error('blocked_reason') is-invalid @enderror" name="blocked[]" value="{{ $user->blocked }}" autocomplete="blocked" {{ ($user->blocked) ? 'checked' : '' }}>
                                    @error('blocked_reason')
                                        <span class="invalid-feedback" blocked_reason="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>                                                        
                            <div class="form-group row" id="div_blocked_reason">
                                <label for="blocked_reason" class="col-md-3 col-form-label text-md-right">{{ __('Alasan Blokir') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="blocked_reason" type="text" class="form-control form-control-user @error('blocked_reason') is-invalid @enderror" name="blocked_reason" value="{{ $user->blocked_reason }}" autocomplete="blocked_reason">
                                    @error('blocked_reason')
                                        <span class="invalid-feedback" blocked_reason="alert">
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
                                <div class="col-md-6 offset-md-12">
                                    <a href="{{ route('admin.v1.access.user.index') }}" type="submit" class="btn btn-user btn-danger btn-block text-white">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                
            </div>
        </div>
        <script>
        $(document).ready(function(){
            var blocked = $('#blocked').val();
            console.log(blocked);
            if(blocked == 1){
                $('#div_blocked_reason').show();
            }else{
                $('#div_blocked_reason').hide();
            }
            $('#blocked').click(function(){
                if(this.checked){
                    $('#div_blocked_reason').show();
                }else{
                    $('#blocked_reason').val('');
                    $('#div_blocked_reason').hide();
                }
            });
        });
    </script>
@endsection
