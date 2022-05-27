<div id="modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="modal_form" class="form-horizontal form-validate-jquery">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Tanggal  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_form" id="id_form">
                            <input type="hidden" name="iuran_id" id="iuran_id">
                            <input type="text" name="tanggal" @role('kades') readonly @endrole id="tanggal" data-msg-required="Tidak boleh kosong !" required class="tanggal form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Nominal  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" @role('kades') readonly  @else @endrole name="nominal" id="nominal" data-msg-required="Tidak boleh kosong !" required class="form-control">
                        </div>
                    </div>

                    @role('kades')
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Status  <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                            <select class="form-control" name="status" id="status" data-msg-required="Tidak boleh kosong !">
                                <option value="1">Sudah Bayar</option>
                                <option value="0">Belum Bayar</option>
                            </select>
                            </div>
                        </div>
                    @endrole

                    
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Jenis Iuran  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" 
                                name="jenis_iuran" id="jenis_iuran" 
                                data-msg-required="Tidak boleh kosong !">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Anggota  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <select class="form-control" @role('kades') enable  @else @endrole 
                            name="anggota_id" id="anggota_id" data-msg-required="Tidak boleh kosong !">
                            <option disabled value="" selected>Pilih Anggota</option>
                            @foreach($anggota as $row)
                                <option value="{{$row->id}}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                     </div>
                    </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn bg-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /horizontal form modal -->
