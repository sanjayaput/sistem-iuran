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
                            <input type="hidden" name="pemasukan_id" id="pemasukan_id">
                            <input type="text" name="tanggal" id="tanggal" data-msg-required="Tidak boleh kosong !" required class="tanggal form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Nominal  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nominal" id="nominal" data-msg-required="Tidak boleh kosong !" required class="form-control">
                        </div>
                    </div>

                    @role('kades')
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Status  <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                            <select class="form-control" name="status" id="status" data-msg-required="Tidak boleh kosong !">
                                <option value="1">Sudah Disetujui</option>
                                <option value="0">Belum Disetujui</option>
                            </select>
                            </div>
                        </div>
                    @endrole

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Jenis Pemasukan  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <select class="form-control" name="jenis_pemasukan" id="jenis_pemasukan" data-msg-required="Tidak boleh kosong !">
                            <option value="Cash">Cash</option>
                            <option value="Credit">Credit</option>
                        </select>
                     </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Keterangan  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                        <textarea rows="3" cols="3" name="keterangan" id="keterangan" class="form-control" placeholder="Isi disini..."></textarea>
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
