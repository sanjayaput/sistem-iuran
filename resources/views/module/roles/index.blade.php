@extends('layouts.app')

@section('title')
    Daftar Level
@endsection

@section('javascript')
<script src="{{ asset('assets/global/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('assets/global/js/my_init/datatables.js') }}"></script>
<script src="{{ asset('assets/global/js/init/form_layouts.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/validation/validate.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('assets/global/js/init/form_validation.js') }}"></script>
@endsection

@section('init')
<script>
// Fungsi hapus data
  $(document).on('click', '.badge-danger', function(e){
    e.preventDefault();
    var id = $(this).attr('id'); 
    var $row = $(this);
    var table = $('.datatable-button-init-custom').DataTable();
    swal({
        title: 'Apakah anda yakin ?',
        text: "Anda tidak akan dapat mengembalikan data ini !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus !',
        cancelButtonText: 'Batal',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then((result) => {
        if (result.value) {
            $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ URL::to('roles/delete') }}/"+id,
                    data: {id:id},
                success: function (data) {
                    table.row( $row.parents('tr') ).remove().draw();
                    new PNotify({
                        title: 'Sukses !',
                        text: 'Data berhasil dihapus...',
                        addclass: 'alert bg-success border-success alert-styled-right',
                        type: 'success'
                    });
                }         
            });
        }
    });
});

// fungsi edit
$(document).on('click', '.badge-success', function(e){
    e.preventDefault();
    var id = $(this).attr('id'); 
    $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ URL::to('roles/edit') }}/"+id,
            method: 'GET',
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function(response){
                var role = response.data.role;
                var permission = response.data.permission;
                if (response.status == 200) {
                    $("#modal_form").modal('show');
                    $(".modal-title").text("Edit Level");
                    $('#id_form').val("1");
                    $('#id_level').val(role.id);
                    $('#level_name').val(role.name);
                    $('input:checkbox').removeAttr('checked');

                    // set input checkbox
                    $.each(permission, function(key, role) {
                        $("#checkbox_"+role).attr('checked', true);
                    });
                }
            }, 
        });
});

var url         = "{{ route ('api.roles') }}";
var token       = "{{Auth::user()->api_token}}";
var can_create  = "{{ Auth::user()->can('role-create') }}";
var can_edit    = "{{ Auth::user()->can('role-edit') }}";
var can_delete  = "{{ Auth::user()->can('role-delete') }}";
var columns, center, button;

// jika user bisa edit atau delete maka tampilkan row aksi
if(can_edit==="1" || can_delete==="1"){
    columns = [
        {"data":"DT_RowIndex", orderable: false, searchable: false},
        {"data":"name"},
        {"data":"guard_name"},
        {"data":"created_at"},
        {"data":"action"},
    ];
    center = 4;
}else{
    columns = [
        {"data":"DT_RowIndex", orderable: false, searchable: false},
        {"data":"name"},
        {"data":"guard_name"},
        {"data":"created_at"},
    ];
    center = 3;
}

// jika user bisa tambah data maka generate button
if(can_create=='1'){
    button = {
                text: 'Tambah Level',
                className: 'btn bg-teal-400',
                action: function(e, dt, node, config) {
                    document.getElementById("role_form").reset();
                    $('input:checkbox').removeAttr('checked');
                    $("#modal_form").modal('show');
                    $('#id_form').val("0");
                    $(".modal-title").text("Tambah Level");
                }
            }
}


var table = $('.datatable-button-init-custom').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: url+'?api_token='+token,
        type: 'GET',
    },

    columns: columns,
    columnDefs: [
        { className: 'text-center', targets: [center] },
    ],
    autoWidth: false,
    dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
    buttons: [
        button
    ],
    "language": {
        "url": "{{ asset('json/id-datatables.json') }}",
    }
});


// fungsi tambah data
$('#role_form').submit(function(e){
    e.preventDefault();
    var id_form    = $('#id_form').val();
    var id_level   = $('#id_level').val();
    var url_store  = "{{ URL::to('roles/store') }}";
    var url_update = "{{ URL::to('roles/update') }}/"+id_level;

    var url      = id_form=="1" ? url_update : url_store; 

    var level_name = $('input[name="level_name"]').val();
    var sel = $('.permission:checked').map(function(_, el) {
        return $(el).val();
    }).get();
    

    var formData = new FormData();
    formData.append('name', level_name);
    formData.append('permission', sel);

        console.log(sel);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data:  formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function(data){
                $("#modal_form").modal('hide');
                new PNotify({
                    title: 'Sukses !',
                    text: data.message,
                    addclass: 'alert bg-success border-success alert-styled-right',
                    type: 'success'
                });
                $('.datatable-button-init-custom').DataTable().ajax.reload();
                document.getElementById("role_form").reset();
            }, 
            error: function (xhr) {
                $("#modal_form").modal('hide');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    new PNotify({
                    title: 'Gagal !',
                    text: value,
                    addclass: 'alert bg-danger border-danger alert-styled-right',
                    type: 'danger'
                });
                });
            }
        });
})
</script>
@endsection

@section('content')
<!-- Custom button -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"></h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <table class="table datatable-button-init-custom">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th width="20%">Guard</th>
                <th width="20%">Dibuat</th>
                @if(Gate::check('role-edit') || Gate::check('role-delete'))
                <th width="10%" class="text-center">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- /custom button -->

@include('module.roles.modal')
</div>



@endsection
