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
            <h1 class="h3 mb-0 text-gray-800">Ortu {{$personal->user->name}} Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Ortu {{$personal->user->name}} Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('admin.v1.profile.ortu.update',$data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$data->id}}" />
                            <div class="form-group row" id="div_ref_ortu_id">
                                <label for="ref_ortu_id" class="col-md-3 col-form-label text-md-right">{{ __('Pilih dari Daftar') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="ref_ortu_id" id="ref_ortu_id" class="form-control form-control-user @error('ref_ortu_id') is-invalid @enderror" value="{{ $data->ref_ortu_id }}" autocomplete="ref_ortu_id">
                                                <option value="" selected disabled>Pilih dari daftar</option>                                            
                                                @foreach($refs as $ref)
                                                    <option value="{{ $ref->id }}" {{($data->user_id == $ref->id) ? 'selected' : '' }}>{{$ref->code}} | {{$ref->name}} | {{ $ref->email }}</option>                                            
                                                @endforeach
                                            </select>
                                            @error('ref_ortu_id')
                                                <span class="invalid-feedback" ref_ortu_id="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                            </div>

                            <div class="form-group row" id="div_ref">
                                <label for="ref" class="col-md-3 col-form-label text-md-right">{{ __('Tambah Data Baru') }}</label>
                                <div class="col-md-9 mb-3 mb-sm-0">
                                    <div class="col-md-13 mb-4 mb-sm-0" style="float: left; padding: 5px;">
                                    <input id="ref" type="checkbox" {{ (old('ref') == true) ? 'checked' : '' }} class="form-control-user @error('ref') is-invalid @enderror" name="ref" autocomplete="ref">
                                    </div>
                                    @error('ref')
                                        <span class="invalid-feedback" ref="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_code">
                                <label for="code" class="col-md-3 col-form-label text-md-right">{{ __('NIK') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="code" type="text" class="form-control form-control-user @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" autocomplete="code">
                                    @error('code')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="div_name">
                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nama') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    
                            <div class="form-group row" id="div_phone">
                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Telepon') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="phone" type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="div_email">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="div_password">
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
                            <div class="form-group row" id="div_password1">
                                <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Ulangi Password') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row" id="div_picture">
                                <label for="picture" class="col-md-3 col-form-label text-md-right">{{ __('Foto') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    <input id="picture" type="file" class="form-control form-control-user @error('picture') is-invalid @enderror" name="picture" value="{{ old('picture') }}" autocomplete="picture">
                                    @error('picture')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>         

                            <div class="form-group row">
                                <label for="jenis" class="col-md-3 col-form-label text-md-right">{{ __('Keterangan') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="jenis" id="jenis" required class="form-control @error('jenis') is-invalid @enderror" value="{{ $data->jenis }}" autocomplete="jenis">
                                        <option value="Ayah Kandung" {{($data->jenis == 'Ayah Kandung') ? 'selected' : ''}}>Ayah Kandung</option>
                                        <option value="Ayah Angkat" {{($data->jenis == 'Ayah Angkat') ? 'selected' : ''}}>Ayah Angkat</option>
                                        <option value="Ibu Kandung" {{($data->jenis == 'Ibu Kandung') ? 'selected' : ''}}>Ibu Kandung</option>
                                        <option value="Ibu Angkat" {{($data->jenis == 'Ibu Angkat') ? 'selected' : ''}}>Ibu Angkat</option>
                                        <option value="Wali" {{($data->jenis == 'Wali') ? 'selected' : ''}}>Wali</option>
                                    </select>    
                                    @error('jenis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ket" class="col-md-3 col-form-label text-md-right">{{ __('Keterangan') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="ket" type="text" class="form-control form-control-user @error('ket') is-invalid @enderror" name="ket" value="{{ $data->ket }}" autocomplete="ket">
    
                                    @error('ket')
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
                                <div class="col-md-6 offset-md-12">
                                    <a href="{{ route('admin.v1.profile.ortu.index') }}" type="submit" class="btn btn-user btn-danger btn-block text-white">
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
            $('#ref').click(function(){
                if(this.checked){
                    $('#div_code').show();
                    $('#div_name').show();
                    $('#div_phone').show();
                    $('#div_email').show();
                    $('#div_password').show();
                    $('#div_password1').show();
                    $('#div_picture').show();
                }else{
                    $('#div_code').hide();
                    $('#div_name').hide();
                    $('#div_phone').hide();
                    $('#div_email').hide();
                    $('#div_password').hide();
                    $('#div_password1').hide();
                    $('#div_picture').hide();
                }
            });
            if($('#ref').is(':checked')){
                $('#div_code').show();
                    $('#div_name').show();
                    $('#div_phone').show();
                    $('#div_email').show();
                    $('#div_password').show();
                    $('#div_password1').show();
                    $('#div_picture').show();
            }else{
                $('#div_code').hide();
                    $('#div_name').hide();
                    $('#div_phone').hide();
                    $('#div_email').hide();
                    $('#div_password').hide();
                    $('#div_password1').hide();
                    $('#div_picture').hide();
            }
        });
    </script>
@endsection
