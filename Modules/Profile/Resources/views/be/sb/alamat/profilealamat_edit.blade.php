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
                        <form method="POST" action="{{ route('admin.v1.profile.alamat.update',$data->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$data->id}}" />
                            <div class="form-group row">
										<label for="ket" class="col-md-3 col-form-label text-md-right">Nama Provinsi</label>
										<div class="col-md-8 mb-3 mb-sm-0">
                                            <select name="provinsi_id" id="provinsi_id" required class="form-control @error('provinsi_id') is-invalid @enderror" value="{{ $data->provinsi_id }}" autocomplete="provinsi_id">
                                                @foreach($provinsis as $provinsi)
                                                    <option value="{{$provinsi->id}}"  {{($data->desa->kecamatan->kabupaten->provinsi_id == $provinsi->id) ? 'selected' : ''}}>{{$provinsi->nama}}</option>
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
                                            <select name="kabupaten_id" id="kabupaten_id" required class="form-control @error('kabupaten_id') is-invalid @enderror" value="{{ $data->kabupaten_id }}" autocomplete="kabupaten_id">
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
                                            <select name="kecamatan_id" id="kecamatan_id" required class="form-control @error('kecamatan_id') is-invalid @enderror" value="{{ $data->kecamatan_id }}" autocomplete="kecamatan_id">
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
                                            <select name="desa_id" id="desa_id" required class="form-control @error('desa_id') is-invalid @enderror" value="{{ $data->desa_id }}" autocomplete="desa_id">
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
                                            <input name="dusun"  value="{{$data->dusun}}"required type="text" class="form-control @error('dusun') is-invalid @enderror">
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
                                            <input name="jln" value="{{$data->jln}}" required type="text" class="form-control @error('jln') is-invalid @enderror">
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
                                            <input name="kodepos" value="{{$data->kodepos}}" required type="number" class="form-control @error('kodepos') is-invalid @enderror">
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
                                            <input name="rt" value="{{$data->rt}}" required type="number" class="form-control @error('rt') is-invalid @enderror">
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
                                            <input name="rw"  value="{{$data->rw}}" required type="number" class="form-control @error('rw') is-invalid @enderror">
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
                                            <select name="tinggal" id="tinggal" required class="form-control @error('tinggal') is-invalid @enderror" value="{{ $data->tinggal }}" autocomplete="tinggal">
                                                <option value="Bersama Orang Tua" {{($data->transport == 'Bersama Orang Tua') ? 'selected' : ''}}>Bersama Orang Tua</option>
                                                <option value="Bersama Wali" {{($data->transport == 'Bersama Wali') ? 'selected' : ''}}>Bersama Wali</option>
                                                <option value="Kos" {{($data->transport == 'Kos') ? 'selected' : ''}}>Kos</option>
                                                <option value="Asrama" {{($data->transport == 'Asrama') ? 'selected' : ''}}>Asrama</option>
                                                <option value="Panti Asuhan" {{($data->transport == 'Panti Asuhan') ? 'selected' : ''}}>Panti Asuhan</option>
                                                <option value="Lainnya" {{($data->transport == 'Lainnya') ? 'selected' : ''}}>Lainnya</option>
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
                                            <select name="transport" id="transport" required class="form-control @error('transport') is-invalid @enderror" value="{{ $data->transport }}" autocomplete="transport">
                                                <option value="Jalan Kaki" {{($data->transport == 'Jalan Kaki') ? 'selected' : ''}}>Jalan Kaki</option>
                                                <option value="Kendaraan Pribadi" {{($data->transport == 'Kendaraan Pribadi') ? 'selected' : ''}}>Kendaraan Pribadi</option>
                                                <option value="Kendaraan Umum/Angkot/Pete-Pete" {{($data->transport == 'Kendaraan Umum/Angkot/Pete-Pete') ? 'selected' : ''}}>Kendaraan Umum/Angkot/Pete-Pete</option>
                                                <option value="Jemputan Sekolah" {{($data->transport == 'Jemputan Sekolah') ? 'selected' : ''}}>Jemputan Sekolah</option>
                                                <option value="Kereta Api" {{($data->transport == 'Kereta Api') ? 'selected' : ''}}>Kereta Api</option>
                                                <option value="Ojek" {{($data->transport == 'Ojek') ? 'selected' : ''}}>Ojek</option>
                                                <option value="Andong/Bendi/Sado/Dokar/Delman/Beca" {{($data->transport == 'Andong/Bendi/Sado/Dokar/Delman/Beca') ? 'selected' : ''}}>Andong/Bendi/Sado/Dokar/Delman/Beca</option>
                                                <option value="Perahu Penyebrangan/Rakit/Getek" {{($data->transport == 'Perahu Penyebrangan/Rakit/Getek') ? 'selected' : ''}}>Perahu Penyebrangan/Rakit/Getek</option>
                                                <option value="Lainnya" {{($data->transport == 'Lainnya') ? 'selected' : ''}}>Lainnya</option>
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
                                            <select name="jarak_status" id="jarak_status" required class="form-control @error('jarak_status') is-invalid @enderror" value="{{ $data->jarak_status }}" autocomplete="jarak_status">
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
                                            <input name="jarak"  value="{{$data->jarak}}" type="number" class="form-control @error('jarak') is-invalid @enderror">
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
                                            <input name="waktu_jam" value="{{$data->waktu_jam}}" type="number" class="form-control @error('waktu_jam') is-invalid @enderror">
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
                                            <input name="waktu_menit" value="{{$data->waktu_menit}}" required type="number" class="form-control @error('waktu_menit') is-invalid @enderror">
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
                                    <input id="ket" type="text" value="{{$data->ket}}" class="form-control form-control-user @error('ket') is-invalid @enderror" name="ket" value="{{ $data->ket }}" autocomplete="ket">
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

                function kabupaten(provid){
                    var kabupatenid = "{{$data->desa->kecamatan->kabupaten_id}}";
                    var url = "{{ route('kabupaten',':id') }}";
                    url = url.replace(':id', provid);
                    $.ajax({url: url, success: function(result){
                        $('#kabupaten_id').empty();
                        var res = result.data;
                        for (i = 0; i < res.length; i++)
                        {
                            var select = '';
                            if(res[i].id == kabupatenid){
                                select = 'selected';
                            }
                            var isi = '<option value="'+res[i].id+'" '+select+'>'+res[i].nama+'</option>';
                            $('#kabupaten_id').append(isi);
                        }
                        var kabid = $('#kabupaten_id').val();
                        kecamatan(kabid);
                    }});
                }

                function kecamatan(kabid){
                    var kecamatanid = "{{$data->desa->kecamatan_id}}";
                    var url = "{{ route('kecamatan',':id') }}";
                    url = url.replace(':id', kabid);
                    $.ajax({url: url, success: function(result){
                        $('#kecamatan_id').empty();
                        var res = result.data;
                        for (i = 0; i < res.length; i++)
                        {
                            var select = '';
                            if(res[i].id == kecamatanid){
                                select = 'selected';
                            }
                            var isi = '<option value="'+res[i].id+'" '+select+'>'+res[i].nama+'</option>';
                            $('#kecamatan_id').append(isi);
                        }
                        var kecid = $('#kecamatan_id').val();
                        desa(kecid);
                    }});
                }

                function desa(kecid){
                    var desaid = "{{$data->desa_id}}";
                    var url = "{{ route('desa',':id') }}";
                    url = url.replace(':id', kecid);
                    $.ajax({url: url, success: function(result){
                        $('#desa_id').empty();
                        var res = result.data;
                        for (i = 0; i < res.length; i++)
                        {
                            var select = '';
                            if(res[i].id == desaid){
                                select = 'selected';
                            }
                            var isi = '<option value="'+res[i].id+'" '+select+'>'+res[i].nama+'</option>';
                            $('#desa_id').append(isi);
                        }                
                    }});
                }
            });
        </script>	
@endsection
