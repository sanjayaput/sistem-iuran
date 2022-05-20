@extends('layouts.app')

@section('title')
    Tambah User
@endsection

@section('javascript')
<script src="{{ asset('assets/global/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('assets/global/js/init/form_layouts.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/validation/validate.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('assets/global/js/init/form_validation.js') }}"></script>
@endsection
@section('content')
<div class="row">
   <div class="col-md-12">
      <!-- Basic layout-->
      <div class="card">
         <div class="card-header header-elements-sm-inline">
            <h5 class="card-title">Formulir Tambah User</h5>
            <div class="header-elements">
               <div class="list-icons">
                  <a class="list-icons-item" data-action="collapse"></a>
                  <a class="list-icons-item" data-action="reload"></a>
                  <a class="list-icons-item" data-action="remove"></a>
               </div>
            </div>
         </div>
         @if (count($errors) > 0)
         <div class="alert alert-warning alert-styled-left alert-dismissible ml-2 mr-2">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Whoops!</span> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
               Session::flash('warning', {{ $error }}); 
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
         <div class="card-body col-md-8">
            <form action="{{ action('UserController@store') }}" enctype="multipart/form-data" class="form-validate-jquery" method="POST">
               {{ csrf_field() }}
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                     <input type="text" placeholder="Nama Lengkap" name="name" class="form-control" data-msg-required="Tidak boleh kosong !" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Username <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                     <input type="username" placeholder="username" name="username" class="form-control" id="username" data-msg-required="Tidak boleh kosong !" required>
                  </div>
               </div>
               {{-- <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Email <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                     <input type="email" placeholder="email@domain.com" name="email" class="form-control" id="email" data-msg-email="Masukkan akun email yang valid !" data-msg-required="Tidak boleh kosong !" required>
                  </div>
               </div> --}}
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Password <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                     <input type="password" id="password" placeholder="Password" name="password" class="form-control" data-msg-required="Tidak boleh kosong !" 
                        data-msg-minlength="Minimal 8 karakter !" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                     <input type="password" placeholder="Konfirmasi Password" name="confirm_password" class="form-control" data-msg-required="Tidak boleh kosong !" data-msg-equalTo="Password tidak sama !" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                        <div class="form-check form-check-inline">
                           <label class="form-check-label">
                              <input type="radio" value="L" class="form-input-styled" name="jenis_kelamin" data-fouc>
                              Laki-laki
                           </label>
                        </div>

                        <div class="form-check form-check-inline">
                           <label class="form-check-label">
                              <input type="radio" value="0" class="form-input-styled" name="jenis_kelamin" data-fouc>
                              Perempuan
                           </label>
                        </div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Alamat </label>
                  <div class="col-lg-9">
                     <textarea rows="5" cols="5" name="alamat" id="alamat" data-msg-minlength="Minimal 20 karakter !" data-msg-required="Tidak boleh kosong !" required class="form-control" placeholder="Ketik disini...."></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Level <span class="text-danger">*</span></label>
                  <div class="col-lg-9">
                     <select multiple="multiple" data-msg-required="Silahkan pilih level !" required name="roles[]" data-placeholder="Pilih Level" class="form-control form-control-select2" data-fouc>
                        @foreach($roles as $role)
                        <option value="{{$role}}">{{ $role }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               
               <div class="text-right">
                  <button type="submit" class="btn btn-primary">Simpan <i class="icon-floppy-disk ml-2"></i></button>
               </div>
            </form>
         </div>
      </div>
      <!-- /basic layout -->
   </div>
</div>
@endsection