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
            <h1 class="h3 mb-0 text-gray-800">Personal Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Personal Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('admin.profile.personal.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$data->id}}" />
                            <div class="form-group row">
                                <label for="code" class="col-md-3 col-form-label text-md-right">{{ __('Kode Pengguna') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="code" type="text" class="form-control form-control-user @error('code') is-invalid @enderror" name="code" value="{{ $data->user->code }}" autocomplete="code">
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
                                    <input id="name" required type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ $data->user->name }}"  autocomplete="name" autofocus>
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
                                    <input id="phone" required type="text" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ $data->user->phone }}" autocomplete="phone">
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
                                    <input id="email" required type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $data->user->email }}"  autocomplete="email">
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
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 60px;">
                                <label for="picture" class="col-md-3 col-form-label text-md-right">{{ __('Foto') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0" style="text-align:center;padding:10px;">
                                    <img src="{{ ($data->user->picture) ? route('admin.profile.personal.file',$data->user->picture) : asset(config('access.media').'user/user.png') }}" width="100%" height="100%" style="padding:10px;"/>
                                    <input id="picture" type="file" class="form-control form-control-user @error('picture') is-invalid @enderror" name="picture" value="{{ $data->user->picture }}" autocomplete="picture">
                                    @error('picture')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                

                            <!-- ===== KHUSUS SISWA ===== -->
                            <!-- <div class="form-group row">
                                <label for="nis_ra" class="col-md-3 col-form-label text-md-right">{{ __('NIS RA') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="nis_ra" type="text" class="form-control form-control-user @error('nis_ra') is-invalid @enderror" name="nis_ra" value="{{ $data->nis_ra }}" autocomplete="nis_ra">
                                    @error('nis_ra')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nis_tk" class="col-md-3 col-form-label text-md-right">{{ __('NIS TK') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="nis_tk" type="text" class="form-control form-control-user @error('nis_tk') is-invalid @enderror" name="nis_tk" value="{{ $data->nis_tk }}" autocomplete="nis_tk">
                                    @error('nis_tk')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nis_sd" class="col-md-3 col-form-label text-md-right">{{ __('NIS SD') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="nis_sd" type="text" class="form-control form-control-user @error('nis_sd') is-invalid @enderror" name="nis_sd" value="{{ $data->nis_sd }}" autocomplete="nis_sd">
                                    @error('nis_sd')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nis_smp" class="col-md-3 col-form-label text-md-right">{{ __('NIS SMP') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="nis_smp" type="text" class="form-control form-control-user @error('nis_smp') is-invalid @enderror" name="nis_smp" value="{{ $data->nis_smp }}" autocomplete="nis_smp">
                                    @error('nis_smp')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nis_sma" class="col-md-3 col-form-label text-md-right">{{ __('NIS SMA') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="nis_sma" type="text" class="form-control form-control-user @error('nis_sma') is-invalid @enderror" name="nis_sma" value="{{ $data->nis_sma }}" autocomplete="nis_sma">
                                    @error('nis_sma')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> -->
                            <!-- ===== KHUSUS SISWA ===== -->


                            <div class="form-group row">
                                <label for="jk" class="col-md-3 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="jk" id="jk"  class="form-control @error('jk') is-invalid @enderror" value="{{ $data->jk }}" autocomplete="jk">
                                        <option value="Laki-Laki" {{ ($data->jk == 'Laki-Laki') ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="Perempuan" {{ ($data->jk == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jk')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lahir_tmpt" class="col-md-3 col-form-label text-md-right">{{ __('Tempat Lahir') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input name="lahir_tmpt"  type="text" value="{{ $data->lahir_tmpt }}" class="form-control @error('lahir_tmpt') is-invalid @enderror">
                                    @error('lahir_tmpt')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lahir_tgl" class="col-md-3 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                <input name="lahir_tgl"  type="date" value="{{ optional($data->lahir_tgl)->format('Y-m-d') }}" class="form-control @error('lahir_tgl') is-invalid @enderror">
                                    @error('lahir_tgl')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="anak_ke" class="col-md-3 col-form-label text-md-right">{{ __('Anak Ke') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <div class="input-group">
                                        <input name="anak_ke"  type="number" value="{{ $data->anak_ke }}" class="form-control @error('anak_ke') is-invalid @enderror">
                                        @error('anak_ke')
                                            <span class="invalid-feedback" status="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror                                                
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="saudara" class="col-md-3 col-form-label text-md-right">{{ __('Jumlah Saudara') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input name="saudara" type="number" value="{{ $data->saudara }}" class="form-control @error('saudara') is-invalid @enderror">
                                    @error('saudara')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="agama" class="col-md-3 col-form-label text-md-right">{{ __('Agama') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="agama" id="agama"  class="form-control @error('agama') is-invalid @enderror" value="{{ $data->agama }}" autocomplete="agama">
                                        <option value="Islam" {{ ($data->agama == 'Islam') ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen/Protestan" {{ ($data->agama == 'Kristen/Protestan') ? 'selected' : '' }}>Kristen/Protestan</option>
                                        <option value="Katholik" {{ ($data->agama == 'Katholik') ? 'selected' : '' }}>Katholik</option>
                                        <option value="Hindu" {{ ($data->agama == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ ($data->agama == 'Budha') ? 'selected' : '' }}>Budha</option>
                                        <option value="Khong Hu Chu" {{ ($data->agama == 'Khong Hu Chu') ? 'selected' : '' }}>Khong Hu Chu</option>
                                    </select>
                                    @error('agama')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="negara" class="col-md-3 col-form-label text-md-right">{{ __('Kewarganegaraan') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input name="negara"  type="text" value="{{ $data->negara }}" class="form-control @error('negara') is-invalid @enderror">
                                    @error('negara')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="golongan" class="col-md-3 col-form-label text-md-right">{{ __('Golongan') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="golongan" id="golongan"  class="form-control @error('golongan') is-invalid @enderror" value="{{ $data->golongan }}" autocomplete="golongan">
                                        <option value="None" {{ ($data->golongan == 'None') ? 'selected' : '' }}>None</option>
                                        <option value="IA" {{ ($data->golongan == 'IA') ? 'selected' : '' }}>IA</option>
                                        <option value="IB" {{ ($data->golongan == 'IB') ? 'selected' : '' }}>IB</option>
                                        <option value="IC" {{ ($data->golongan == 'IC') ? 'selected' : '' }}>IC</option>
                                        <option value="IIA" {{ ($data->golongan == 'IIA') ? 'selected' : '' }}>IIA</option>
                                        <option value="IIB" {{ ($data->golongan == 'IIB') ? 'selected' : '' }}>IIB</option>
                                        <option value="IIC" {{ ($data->golongan == 'IIC') ? 'selected' : '' }}>IIC</option>
                                        <option value="IIIA" {{ ($data->golongan == 'IIIA') ? 'selected' : '' }}>IIIA</option>
                                        <option value="IIIB" {{ ($data->golongan == 'IIIB') ? 'selected' : '' }}>IIIB</option>
                                        <option value="IIIC" {{ ($data->golongan == 'IIIC') ? 'selected' : '' }}>IIIC</option>
                                        <option value="IVA" {{ ($data->golongan == 'IVA') ? 'selected' : '' }}>IVA</option>
                                        <option value="IVB" {{ ($data->golongan == 'IVB') ? 'selected' : '' }}>IVB</option>
                                    </select>
                                    @error('golongan')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pangkat" class="col-md-3 col-form-label text-md-right">{{ __('Pangkat') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="pangkat" id="pangkat"  class="form-control @error('pangkat') is-invalid @enderror" value="{{ $data->pangkat }}" autocomplete="pangkat">
                                        <option value="None" {{ ($data->pangkat == '') ? 'selected' : '' }}>None</option>
                                        <option value="Mudarris A" {{ ($data->pangkat == 'Mudarris A') ? 'selected' : '' }}>Mudarris A</option>
                                        <option value="Mudarris B" {{ ($data->pangkat == 'Mudarris B') ? 'selected' : '' }}>Mudarris B</option>
                                        <option value="Muallim A" {{ ($data->pangkat == 'Muallim A') ? 'selected' : '' }}>Muallim A</option>
                                        <option value="Muallim B" {{ ($data->pangkat == 'Muallim B') ? 'selected' : '' }}>Muallim B</option>
                                        <option value="Muaddib A" {{ ($data->pangkat == 'Muaddib A') ? 'selected' : '' }}>Muaddib A</option>
                                        <option value="Muaddib B" {{ ($data->pangkat == 'Muaddib B') ? 'selected' : '' }}>Muaddib B</option>
                                        <option value="Murobbi A" {{ ($data->pangkat == 'Murobbi A') ? 'selected' : '' }}>Murobbi A</option>
                                        <option value="Murobbi B" {{ ($data->pangkat == 'Murobbi B') ? 'selected' : '' }}>Murobbi B</option>
                                    </select>
                                    @error('pangkat')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="berkebutuhan" class="col-md-3 col-form-label text-md-right">{{ __('Berkebutuhan') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="berkebutuhan" id="berkebutuhan"  class="form-control @error('berkebutuhan') is-invalid @enderror" value="{{ $data->berkebutuhan }}" autocomplete="berkebutuhan">
                                        <option value="Tidak" {{ ($data->berkebutuhan == 'Tidak') ? 'selected' : '' }}>Tidak</option>
                                        <option value="Netra" {{ ($data->berkebutuhan == 'Netra') ? 'selected' : '' }}>Netra</option>
                                        <option value="Rungu" {{ ($data->berkebutuhan == 'Rungu') ? 'selected' : '' }}>Rungu</option>
                                        <option value="Grahita Ringan (C)" {{ ($data->berkebutuhan == 'Grahita Ringan (C)') ? 'selected' : '' }}>Grahita Ringan (C)</option>
                                        <option value="Grahita Sedang (D)" {{ ($data->berkebutuhan == 'Grahita Sedang (D)') ? 'selected' : '' }}>Grahita Sedang (D)</option>
                                        <option value="Daksa Sedang (D1)" {{ ($data->berkebutuhan == 'Daksa Sedang (D1)') ? 'selected' : '' }}>Daksa Sedang (D1)</option>
                                        <option value="Laras (E)" {{ ($data->berkebutuhan == 'Laras (E)') ? 'selected' : '' }}>Laras (E)</option>
                                        <option value="Wicara" {{ ($data->berkebutuhan == 'Wicara') ? 'selected' : '' }}>Wicara</option>
                                        <option value="Tuna Ganda (G)" {{ ($data->berkebutuhan == 'Tuna Ganda (G)') ? 'selected' : '' }}>Tuna Ganda (G)</option>
                                        <option value="Hiper Aktif (H)" {{ ($data->berkebutuhan == 'Hiper Aktif (H)') ? 'selected' : '' }}>Hiper Aktif (H)</option>
                                        <option value="Cerdas Istimewa (I)" {{ ($data->berkebutuhan == 'Cerdas Istimewa (I)') ? 'selected' : '' }}>Cerdas Istimewa (I)</option>
                                        <option value="Kesulian Belajar (K)" {{ ($data->berkebutuhan == 'Kesulian Belajar (K)') ? 'selected' : '' }}>Kesulian Belajar (K)</option>
                                        <option value="Narkoba (N)" {{ ($data->berkebutuhan == 'Narkoba (N)') ? 'selected' : '' }}>Narkoba (N)</option>
                                        <option value="Indigo (0)" {{ ($data->berkebutuhan == 'Indigo (0)') ? 'selected' : '' }}>Indigo (0)</option>
                                        <option value="Down Syndrome (P)" {{ ($data->berkebutuhan == 'Down Syndrome (P)') ? 'selected' : '' }}>Down Syndrome (P)</option>
                                        <option value="Autis (Q)" {{ ($data->berkebutuhan == 'Autis (Q)') ? 'selected' : '' }}>Autis (Q)</option>
                                    </select>
                                    @error('berkebutuhan')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>

                            <!-- ===== KHUSUS SISWA ===== -->
                            <!-- <div class="form-group row">
                                <label for="paud" class="col-md-3 col-form-label text-md-right">{{ __('Pernah Paud') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="paud" id="paud"  class="form-control @error('paud') is-invalid @enderror" value="{{ $data->paud }}" autocomplete="paud">
                                        <option value="Ya" {{ ($data->paud == 'Ya') ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ ($data->paud == 'Tidak') ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('paud')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tk" class="col-md-3 col-form-label text-md-right">{{ __('Pernah TK') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="tk" id="tk"  class="form-control @error('tk') is-invalid @enderror" value="{{ $data->tk }}" autocomplete="tk">
                                        <option value="Ya" {{ ($data->tk == 'Ya') ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ ($data->tk == 'Tidak') ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('tk')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div> -->
                            <!-- ===== KHUSUS SISWA ===== -->

                            <div class="form-group row">
                                <label for="nik" class="col-md-3 col-form-label text-md-right">{{ __('NIK') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input name="nik"  type="text" value="{{ $data->nik }}" class="form-control @error('nik') is-invalid @enderror">
                                    @error('nik')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kps" class="col-md-3 col-form-label text-md-right">{{ __('Penerima KPS') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <select name="kps" id="kps"  class="form-control @error('kps') is-invalid @enderror" value="{{ $data->kps }}" autocomplete="kps">
                                        <option value="Ya" {{ ($data->kps == 'Ya') ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ ($data->kps == 'Tidak') ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('kps')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kps_no" class="col-md-3 col-form-label text-md-right">{{ __('Nomor KPS Jika Penerima KPS') }}</label>
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input name="kps_no" type="text" value="{{ $data->kps_no }}" class="form-control @error('kps_no') is-invalid @enderror">
                                    @error('kps_no')
                                        <span class="invalid-feedback" status="alert">
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
