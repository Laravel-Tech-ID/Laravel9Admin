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
            <h1 class="h3 mb-0 text-gray-800">Hobi {{$personal->user->name}} Management</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Hobi {{$personal->user->name}} Form</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <form method="POST" action="{{ route('admin.profile.sehat.store') }}">
                            @csrf
    
                            <div class="form-group row" id="div_tanggal">
                                <label for="tanggal" class="col-md-3 col-form-label text-md-right">{{ __('Tanggal Periksa') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="tanggal" type="date" class="form-control form-control-user @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}" autocomplete="tanggal" autofocus>
    
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_tinggi">
                                <label for="tinggi" class="col-md-3 col-form-label text-md-right">{{ __('Tinggi Badan') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="tinggi" type="number" class="form-control form-control-user @error('tinggi') is-invalid @enderror" name="tinggi" value="{{ old('tinggi') }}" autocomplete="tinggi" autofocus>
    
                                    @error('tinggi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="div_berat">
                                <label for="berat" class="col-md-3 col-form-label text-md-right">{{ __('Berat Badan') }}</label>
    
                                <div class="col-md-8 mb-3 mb-sm-0">
                                    <input id="berat" type="number" class="form-control form-control-user @error('berat') is-invalid @enderror" name="berat" value="{{ old('berat') }}" autocomplete="berat" autofocus>
    
                                    @error('berat')
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
                                    <a href="{{ route('admin.profile.sehat.index') }}" type="submit" class="btn btn-user btn-danger btn-block text-white">
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
