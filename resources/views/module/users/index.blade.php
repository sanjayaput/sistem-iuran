@extends('layouts.app')

@section('title')
    Tabel User
@endsection

@section('javascript')
<script src="{{ asset('assets/global/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('assets/global/js/my_init/datatables.js') }}"></script>
@endsection

@section('init')
<script>
  $(document).on('click', '.badge-danger', function(e){
    e.preventDefault();
    var id = $(this).attr('id'); 
    var $row = $(this);
    var table = $('.datatable-button-init-custom').DataTable();
    console.log(id);
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
                    url: "{{ URL::to('users/delete') }}/"+id,
                    data: {id:id},
                success: function (data) {
                    table.row( $row.parents('tr') ).remove().draw();
                    console.log('success');
                }         
            });
        }
    });
});

var url = "{{ route ('api.users') }}";
var token = "{{Auth::user()->api_token}}";
var can_create  = "{{ Auth::user()->can('user-create') }}";
var can_edit    = "{{ Auth::user()->can('user-edit') }}";
var can_delete  = "{{ Auth::user()->can('user-delete') }}";
var columns, center, button;

// jika user bisa edit atau delete maka tampilkan row aksi
if(can_edit==="1" || can_delete==="1"){
    columns = [
        {"data":"DT_RowIndex", orderable: false, searchable: false},
        {"data":"name"},
        {"data":"email"},
        {"data":"roles"},
        {"data":"active"},
        {"data":"action"},
    ];
    center = 5;
}else{
    columns = [
        {"data":"DT_RowIndex", orderable: false, searchable: false},
        {"data":"name"},
        {"data":"email"},
        {"data":"roles"},
        {"data":"active"},
    ];
    center = 4;
}

// jika user bisa tambah data maka generate button
if(can_create=='1'){
    button = {
                text: ' <i class="icon-add mr-2"></i>Tambah User',
                className: 'btn bg-teal-400',
                action: function() {
                    window.location.href="{{ URL::to('users/create') }}"
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
                <th width="20%">Nama</th>
                <th width="30%">Email</th>
                <th>Level</th>
                <th width="10%">Status</th>
                @if(Gate::check('user-edit') || Gate::check('user-delete'))
                <th width="10%" class="text-center">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- /custom button -->
@endsection
