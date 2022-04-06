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
            <h1 class="h3 mb-0 text-gray-800">Alamat {{$personal->user->name}} Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Alamat {{$personal->user->name}} Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('admin.v1.profile.alamat.store') }}">
                            @csrf


                                    <div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Nama Provinsi</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="provinsi_id" id="provinsi_id" required class="form-control @error('provinsi_id') is-invalid @enderror" value="{{ old('provinsi_id') }}" autocomplete="provinsi_id">
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
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Nama Kabupaten</span></label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="kabupaten_id" id="kabupaten_id" required class="form-control @error('kabupaten_id') is-invalid @enderror" value="{{ old('kabupaten_id') }}" autocomplete="kabupaten_id">
                                            </select>
                                            @error('kabupaten_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Nama Kecamatan</span></label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="kecamatan_id" id="kecamatan_id" required class="form-control @error('kecamatan_id') is-invalid @enderror" value="{{ old('kecamatan_id') }}" autocomplete="kecamatan_id">
                                            </select>
                                            @error('kecamatan_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
										</div>
									</div>
                                    <div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Desa</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="desa_id" id="desa_id" required class="form-control @error('desa_id') is-invalid @enderror" value="{{ old('desa_id') }}" autocomplete="desa_id">
                                            </select>
                                            @error('desa_id')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Dusun/Kampung</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <input name="dusun" required type="text" class="form-control @error('dusun') is-invalid @enderror">
                                            @error('dusun')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
                                    <div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Jalan</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <input name="jln" required type="text" class="form-control @error('jln') is-invalid @enderror">
                                            @error('jln')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
                                    <div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Kode Pos</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <input name="kodepos" required type="number" class="form-control @error('kodepos') is-invalid @enderror">
                                            @error('kodepos')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">RT</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <input name="rt" required type="number" class="form-control @error('rt') is-invalid @enderror">
                                            @error('rt')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">RW</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <input name="rw" required type="number" class="form-control @error('rw') is-invalid @enderror">
                                            @error('rw')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Tinggal Bersama</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="tinggal" id="tinggal" required class="form-control @error('tinggal') is-invalid @enderror" value="{{ old('tinggal') }}" autocomplete="tinggal">
                                                <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                                                <option value="Bersama Wali">Bersama Wali</option>
                                                <option value="Kos">Kos</option>
                                                <option value="Asrama">Asrama</option>
                                                <option value="Panti Asuhan">Panti Asuhan</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            @error('tinggal')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Transportasi</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="transport" id="transport" required class="form-control @error('transport') is-invalid @enderror" value="{{ old('transport') }}" autocomplete="transport">
                                                <option value="Jalan Kaki">Jalan Kaki</option>
                                                <option value="Kendaraan Pribadi">Kendaraan Pribadi</option>
                                                <option value="Kendaraan Umum/Angkot/Pete-Pete">Kendaraan Umum/Angkot/Pete-Pete</option>
                                                <option value="Jemputan Sekolah">Jemputan Sekolah</option>
                                                <option value="Kereta Api">Kereta Api</option>
                                                <option value="Ojek">Ojek</option>
                                                <option value="Andong/Bendi/Sado/Dokar/Delman/Beca">Andong/Bendi/Sado/Dokar/Delman/Beca</option>
                                                <option value="Perahu Penyebrangan/Rakit/Getek">Perahu Penyebrangan/Rakit/Getek</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            @error('transport')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Jarak</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="jarak_status" id="jarak_status" required class="form-control @error('jarak_status') is-invalid @enderror" value="{{ old('jarak_status') }}" autocomplete="jarak_status">
                                                <option value="Laki-Laki">Kurang dari 1 KM</option>
                                                <option value="Laki-Laki">Lebih dari 1 KM</option>
                                            </select>
                                            @error('jarak_status')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Perkiraan Jarak Bila Lebih dari 1 KM</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <input name="jarak" type="number" class="form-control @error('jarak') is-invalid @enderror">
                                            @error('jarak')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Waktu Tempuh Jam</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <input name="waktu_jam" type="number" class="form-control @error('waktu_jam') is-invalid @enderror">
                                            @error('waktu_jam')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror                                                
										</div>
									</div>
									<div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Waktu Tempuh Menit</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <input name="waktu_menit" required type="number" class="form-control @error('waktu_menit') is-invalid @enderror">
                                            @error('waktu_menit')
                                                <span class="invalid-feedback" status="alert">
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
                                    <a href="{{ route('admin.v1.profile.alamat.index') }}" type="submit" class="btn btn-user btn-danger btn-block text-white">
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
                $('#provinsi_id').change(function(){
					var provinceid = $(this).children("option:selected").val();
                    kabupaten(provinceid);
				}).trigger("change");

                $('#kabupaten_id').change(function(){
					var kabupatenid = $(this).children("option:selected").val();
                    kecamatan(kabupatenid);
                }).trigger("change");

                $('#kecamatan_id').change(function(){
                    var kecamatanid = $(this).children("option:selected").val();
                    desa(kecamatanid);
                }).trigger("change");

                function kabupaten(provinceid){
                    var url = "{{ route('kabupaten',':id') }}";
                    url = url.replace(':id', provinceid);
                    $.ajax({url: url, success: function(result){
						$('#kabupaten_id').empty();
						var res = result.data;
						var options = "";
						for (i = 0; i < res.length; i++)
                        {
							$('#kabupaten_id').append('<option value="'+res[i].id+'">'+res[i].nama+'</option>');
							// $('#kabupaten_id').selectpicker('refresh');
                        }
                        var kabupatenid = $('#kabupaten_id').val();
                        kecamatan(kabupatenid);
                    }});
                }

                function kecamatan(kabupatenid){
                    var url = "{{ route('kecamatan',':id') }}";
                    url = url.replace(':id', kabupatenid);
                    $.ajax({url: url, success: function(result){
						$('#kecamatan_id').empty();
                        var res = result.data;
                        for (i = 0; i < res.length; i++)
                        {
                            $('#kecamatan_id').append('<option value="'+res[i].id+'">'+res[i].nama+'</option>');
							// $('#kecamatan_id').selectpicker('refresh');
                        }                
						var desaid = $('#kecamatan_id').val();
	                    desa(desaid);
                    }});
                }                

                function desa(kecamatanid){
                    var url = "{{ route('desa',':id') }}";
                    url = url.replace(':id', kecamatanid);
                    $.ajax({url: url, success: function(result){
						$('#desa_id').empty();
                        var res = result.data;
                        for (i = 0; i < res.length; i++)
                        {
                            $('#desa_id').append('<option value="'+res[i].id+'">'+res[i].nama+'</option>');
							// $('#desa_id').selectpicker('refresh');
                        }                
                    }});
                }                
            });
        </script>	
@endsection
