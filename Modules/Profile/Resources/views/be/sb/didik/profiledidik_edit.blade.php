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
            <h1 class="h3 mb-0 text-gray-800">Pendidikan {{$personal->user->name}} Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Pendidikan {{$personal->user->name}} Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('admin.profile.didik.update',$data->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$data->id}}" />
                            <div class="form-group row" id="div_ref_sekolah_id">
                                <label for="ref_sekolah_id" class="col-md-3 col-form-label text-md-right">{{ __('Pilih dari Daftar') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="ref_sekolah_id" id="ref_sekolah_id" class="form-control form-control-user @error('ref_sekolah_id') is-invalid @enderror" value="{{ old('ref_sekolah_id') }}" autocomplete="ref_sekolah_id">
                                                <option value="" selected disabled>Pilih dari daftar</option>                                            
                                                @foreach($refs as $ref)
                                                    <option value="{{ $ref->id }}" {{($data->ref_sekolah_id == $ref->id) ? 'selected' : '' }}>{{ $ref->nama }}</option>                                            
                                                @endforeach
                                            </select>
                                            @error('ref_sekolah_id')
                                                <span class="invalid-feedback" ref_sekolah_id="alert">
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
                                <label for="nama" class="col-md-3 col-form-label text-md-right">{{ __('Nama Sekolah') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="nama" type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" autocomplete="nama" autofocus>
    
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_tingkat">
                                <label for="tingkat" class="col-md-3 col-form-label text-md-right">{{ __('Tingkat') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="tingkat" id="tingkat" class="form-control form-control-user @error('tingkat') is-invalid @enderror" value="{{ old('tingkat') }}" required autocomplete="tingkat">
                                        <option value="RA">RA</option>
                                        <option value="TK">TK</option>
                                        <option value="Diniyah">Diniyah</option>
                                        <option value="SD">SD</option>
                                        <option value="SD Sederajat">SD Sederajat</option>
                                        <option value="SMP">SMP</option>
                                        <option value="MTs">MTs</option>
                                        <option value="SMP Sederajat">SMP Sederajat</option>
                                        <option value="SMA">SMA</option>
                                        <option value="MA">MA</option>
                                        <option value="SMK">SMK</option>
                                        <option value="SMA Sederajat">SMA Sederajat</option>
                                        <option value="D1">D1</option>
                                        <option value="Diploma I">Diploma I</option>
                                        <option value="Diploma III">Diploma III</option>
                                        <option value="D3">D3</option>
                                        <option value="D4/S1">D4/S1</option>
                                        <option value="Strata I">Strata I</option>
                                        <option value="Strata II">Strata II</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    @error('tingkat')
                                        <span class="invalid-feedback" tingkat="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    
                            
                            <div class="form-group row" id="div_npsn">
                                <label for="npsn" class="col-md-3 col-form-label text-md-right">{{ __('NPSN') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="npsn" type="text" class="form-control form-control-user @error('npsn') is-invalid @enderror" name="npsn" value="{{ old('npsn') }}" autocomplete="npsn" autofocus>    
                                    @error('npsn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_akreditasi">
                                <label for="akreditasi" class="col-md-3 col-form-label text-md-right">{{ __('Kreditasi') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="akreditasi" id="akreditasi" class="form-control form-control-user @error('akreditasi') is-invalid @enderror" value="{{ old('akreditasi') }}" autocomplete="akreditasi">
                                        <option value="Akreditasi A">Akreditasi A</option>
                                        <option value="Akreditasi B">Akreditasi B</option>
                                        <option value="Akreditasi C">Akreditasi C</option>
                                        <option value="Tidak Tahu">Tidak Tahu</option>
                                    </select>
                                    @error('akreditasi')
                                        <span class="invalid-feedback" akreditasi="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    

                            <div class="form-group row" id="div_milik">
                                <label for="milik" class="col-md-3 col-form-label text-md-right">{{ __('Milik') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="milik" id="milik" class="form-control form-control-user @error('milik') is-invalid @enderror" value="{{ old('milik') }}" required autocomplete="milik">
                                        <option value="Negeri">Negeri</option>
                                        <option value="Swasta">Swasta</option>
                                    </select>
                                    @error('milik')
                                        <span class="invalid-feedback" milik="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    

                            <div class="form-group row" id="div_alamat">
                                <label for="alamat" class="col-md-3 col-form-label text-md-right">{{ __('Alamat') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="alamat" type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" autocomplete="alamat">    
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_provinsi_id">
                                <label for="provinsi_id" class="col-md-3 col-form-label text-md-right">Nama Provinsi</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="provinsi_id" id="provinsi_id" class="form-control @error('provinsi_id') is-invalid @enderror" value="{{ old('provinsi_id') }}" autocomplete="provinsi_id">
                                        @foreach($provinsis as $provinsi)
                                            <option value="{{$provinsi->id}}">{{$provinsi->nama}}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="div_kabupaten_id">
                                <label for="kabupaten_id" class="col-md-3 col-form-label text-md-right">Nama Kabupaten</span></label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="kabupaten_id" id="kabupaten_id" class="form-control @error('kabupaten_id') is-invalid @enderror" value="{{ old('kabupaten_id') }}" autocomplete="kabupaten_id">
                                    </select>
                                    @error('kabupaten_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                     

                            <div class="form-group row" id="div_telp">
                                <label for="telp" class="col-md-3 col-form-label text-md-right">{{ __('Telepon') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="telp" type="text" class="form-control form-control-user @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" autocomplete="telp">    
                                    @error('telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_thn_mulai">
                                <label for="mulai_thn" class="col-md-3 col-form-label text-md-right">{{ __('Tahun Mulai') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="mulai_thn" type="text" class="form-control form-control-user @error('mulai_thn') is-invalid @enderror" name="mulai_thn" value="{{ $data->mulai_thn }}" autocomplete="mulai_thn" required autofocus>    
                                    @error('mulai_thn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_thn_selesai">
                                <label for="lulus_thn" class="col-md-3 col-form-label text-md-right">{{ __('Tahun Selesai') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="lulus_thn" type="text" class="form-control form-control-user @error('lulus_thn') is-invalid @enderror" name="lulus_thn" value="{{ $data->lulus_thn }}" autocomplete="lulus_thn" required autofocus>    
                                    @error('lulus_thn')
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
                                    <a href="{{ route('admin.profile.didik.index') }}" type="submit" class="btn btn-user btn-danger btn-block text-white">
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
                    $('#div_tingkat').show();
                    $('#div_npsn').show();
                    $('#div_akreditasi').show();
                    $('#div_milik').show();
                    $('#div_alamat').show();
                    $('#div_provinsi_id').show();
                    $('#div_kabupaten_id').show();
                    $('#div_telp').show();
                }else{
                    $('#div_nama').hide();
                    $('#div_tingkat').hide();
                    $('#div_npsn').hide();
                    $('#div_akreditasi').hide();
                    $('#div_milik').hide();
                    $('#div_alamat').hide();
                    $('#div_provinsi_id').hide();
                    $('#div_kabupaten_id').hide();
                    $('#div_telp').hide();
                }
            });

            if($('#ref').is(':checked')){
                $('#div_nama').show();
                $('#div_tingkat').show();
                $('#div_npsn').show();
                $('#div_akreditasi').show();
                $('#div_milik').show();
                $('#div_alamat').show();
                $('#div_provinsi_id').show();
                $('#div_kabupaten_id').show();
                $('#div_telp').show();
            }else{
                $('#div_nama').hide();
                $('#div_tingkat').hide();
                $('#div_npsn').hide();
                $('#div_akreditasi').hide();
                $('#div_milik').hide();
                $('#div_alamat').hide();
                $('#div_provinsi_id').hide();
                $('#div_kabupaten_id').hide();
                $('#div_telp').hide();
            }

            var provinsiid = $('#provinsi_id').val();
            kabupaten(provinsiid);
            $('#provinsi_id').change(function(){
                var id = $(this).children("option:selected").val();
                kabupaten(id);
            });

            function kabupaten(id){
                var url = "{{ route('kabupaten',':id') }}";
                url = url.replace(':id', id);
                $.ajax({url: url, success: function(result){
                    $('#kabupaten_id').empty();
                    var res = result.data;
                    for (i = 0; i < res.length; i++)
                    {
                        $('#kabupaten_id').append( '<option value="'+res[i].id+'">'+res[i].nama+'</option>' );
                    }                
                }});
            }
        });
    </script>
@endsection
