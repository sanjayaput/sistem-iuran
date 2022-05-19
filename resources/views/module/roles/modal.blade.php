<div id="modal_form" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="role_form" class="form-horizontal form-validate-jquery">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Nama Level  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_form" id="id_form">
                            <input type="hidden" name="id_level" id="id_level">
                            <input type="text" name="level_name" id="level_name" data-msg-required="Tidak boleh kosong !" required placeholder="contoh : admin" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3">Hak Akses  <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            @foreach($permissions as $permission)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="permission[]" id="checkbox_{{$permission->id}}" data-id="{{$permission->id}}" value="{{$permission->id}}" class="form-check-input permission">
                                        {{ $permission->display_name }}
                                    </label>
                                </div>
                            @endforeach
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
