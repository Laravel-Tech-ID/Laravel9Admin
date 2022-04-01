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
            <h1 class="h3 mb-0 text-gray-800">Penyakit {{$personal->user->name}} Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Penyakit {{$personal->user->name}} Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('admin.profile.sakit.update',$data->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$data->id}}" />
                            <div class="form-group row" id="div_ref_penyakit_id">
                                <label for="ref_penyakit_id" class="col-md-3 col-form-label text-md-right">{{ __('Pilih dari Daftar') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="ref_penyakit_id" id="ref_penyakit_id" class="form-control form-control-user @error('ref_penyakit_id') is-invalid @enderror" value="{{ $data->ref_penyakit_id }}" autocomplete="ref_penyakit_id">
                                                <option value="" selected disabled>Pilih dari daftar</option>                                            
                                                @foreach($refs as $ref)
                                                    <option value="{{ $ref->id }}" {{($data->ref_penyakit_id == $ref->id) ? 'selected' : '' }}>{{ $ref->nama }}</option>                                            
                                                @endforeach
                                            </select>
                                            @error('ref_penyakit_id')
                                                <span class="invalid-feedback" ref_penyakit_id="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                            </div>

                            <div class="form-group row" id="div_ref">
                                <label for="ref" class="col-md-3 col-form-label text-md-right">{{ __('Tambah Data Baru') }}</label>
                                <div class="col-md-9 mb-3 mb-sm-0">
                                    <div class="col-md-13 mb-4 mb-sm-0" style="float: left; padding: 5px;">
                                    <input id="ref" type="checkbox" {{ ($data->ref == true) ? 'checked' : '' }} class="form-control-user @error('ref') is-invalid @enderror" name="ref" autocomplete="ref">
                                    </div>
                                    @error('ref')
                                        <span class="invalid-feedback" ref="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_nama">
                                <label for="nama" class="col-md-3 col-form-label text-md-right">{{ __('Data Penyakit Baru') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="nama" type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" name="nama" value="{{ $data->nama }}" autocomplete="nama" autofocus>
    
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="stadium" class="col-md-3 col-form-label text-md-right">{{ __('Stadium') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="stadium" id="stadium" required class="form-control @error('stadium') is-invalid @enderror" value="{{ $data->stadium }}" autocomplete="stadium">
                                        <option value="Ringan" {{($data->stadium == 'Ringan') ? 'selected' : ''}}>Ringan</option>
                                        <option value="Berat" {{($data->stadium == 'Berat') ? 'selected' : ''}}>Berat</option>
                                        <option value="Stadium I" {{($data->stadium == 'Stadium I') ? 'selected' : ''}}>Stadium I</option>
                                        <option value="Stadium II" {{($data->stadium == 'Stadium II') ? 'selected' : ''}}>Stadium II</option>
                                        <option value="Stadium III" {{($data->stadium == 'Stadium III') ? 'selected' : ''}}>Stadium III</option>
                                        <option value="Stadium IV" {{($data->stadium == 'Stadium IV') ? 'selected' : ''}}>Stadium IV</option>
                                    </select>    
                                    @error('stadium')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_thn">
                                <label for="thn" class="col-md-3 col-form-label text-md-right">{{ __('Tahun') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="thn" type="number" class="form-control form-control-user @error('thn') is-invalid @enderror" name="thn" value="{{ $data->thn }}" autocomplete="thn" autofocus>
    
                                    @error('thn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_pantangan">
                                <label for="pantangan" class="col-md-3 col-form-label text-md-right">{{ __('Pantangan') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="pantangan" type="text" class="form-control form-control-user @error('pantangan') is-invalid @enderror" name="pantangan" value="{{ $data->pantangan }}" autocomplete="pantangan" autofocus>
    
                                    @error('pantangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_penanganan">
                                <label for="penanganan" class="col-md-3 col-form-label text-md-right">{{ __('Penanganan') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="penanganan" type="text" class="form-control form-control-user @error('penanganan') is-invalid @enderror" name="penanganan" value="{{ $data->penanganan }}" autocomplete="penanganan" autofocus>
    
                                    @error('penanganan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="status" id="status" required class="form-control @error('status') is-invalid @enderror" value="{{ $data->status }}" autocomplete="status">
                                        <option value="Sembuh" {{($data->status == 'Sembuh') ? 'selected' : '' }}>Sembuh</option>
                                        <option value="Sesekali Kambuh" {{($data->status == 'Sesekali Kambuh') ? 'selected' : '' }}>Sesekali Kambuh</option>
                                        <option value="Berobat Jalan" {{($data->status == 'Berobat Jalan') ? 'selected' : '' }}>Berobat Jalan</option>
                                        <option value="Perawatan Rutin" {{($data->status == 'Perawatan Rutin') ? 'selected' : '' }}>Perawatan Rutin</option>
                                    </select>    
                                    @error('status')
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
                                    <a href="{{ route('admin.profile.sakit.index') }}" type="submit" class="btn btn-user btn-danger btn-block text-white">
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
