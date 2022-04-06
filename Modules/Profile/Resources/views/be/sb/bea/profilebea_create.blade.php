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
            <h1 class="h3 mb-0 text-gray-800">Beasiswa {{$personal->user->name}} Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Beasiswa {{$personal->user->name}} Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('admin.v1.profile.bea.store') }}">
                            @csrf

                            <div class="form-group row" id="div_ref_bea_id">
                                <label for="ref_bea_id" class="col-md-3 col-form-label text-md-right">{{ __('Pilih dari Daftar') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="ref_bea_id" id="ref_bea_id" class="form-control form-control-user @error('ref_bea_id') is-invalid @enderror" value="{{ old('ref_bea_id') }}" autocomplete="ref_bea_id">
                                                <option value="" selected disabled>Pilih dari daftar</option>                                            
                                                @foreach($refs as $ref)
                                                    <option value="{{ $ref->id }}">{{ $ref->nama }}</option>                                            
                                                @endforeach
                                            </select>
                                            @error('ref_bea_id')
                                                <span class="invalid-feedback" ref_bea_id="alert">
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

                            <div class="form-group row" id="div_nama">
                                <label for="nama" class="col-md-3 col-form-label text-md-right">{{ __('Data Beasiswa Baru') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="nama" type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" autocomplete="nama" autofocus>
    
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row" id="div_instansi">
                                <label for="instansi" class="col-md-3 col-form-label text-md-right">{{ __('Instansi Pemberi Beasiswa') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="instansi" type="text" class="form-control form-control-user @error('instansi') is-invalid @enderror" name="instansi" value="{{ old('instansi') }}" autocomplete="instansi" required autofocus>    
                                    @error('instansi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_thn_mulai">
                                <label for="thn_mulai" class="col-md-3 col-form-label text-md-right">{{ __('Tahun Mulai') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="thn_mulai" type="text" class="form-control form-control-user @error('thn_mulai') is-invalid @enderror" name="thn_mulai" value="{{ old('thn_mulai') }}" autocomplete="thn_mulai" required autofocus>    
                                    @error('thn_mulai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_thn_selesai">
                                <label for="thn_selesai" class="col-md-3 col-form-label text-md-right">{{ __('Tahun Selesai') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="thn_selesai" type="text" class="form-control form-control-user @error('thn_selesai') is-invalid @enderror" name="thn_selesai" value="{{ old('thn_selesai') }}" autocomplete="thn_selesai" required autofocus>    
                                    @error('thn_selesai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ket" class="col-md-3 col-form-label text-md-right">{{ __('Keterangan') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="ket" type="text" class="form-control form-control-user @error('ket') is-invalid @enderror" name="ket" value="{{ old('ket') }}" autocomplete="ket">
    
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
                                    <a href="{{ route('admin.v1.profile.bea.index') }}" type="submit" class="btn btn-user btn-danger btn-block text-white">
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
                    $('#div_nama').show();
                }else{
                    $('#div_nama').hide();
                }
            });
            if($('#ref').is(':checked')){
                $('#div_nama').show();
            }else{
                $('#div_nama').hide();
            }
        });
    </script>
@endsection
