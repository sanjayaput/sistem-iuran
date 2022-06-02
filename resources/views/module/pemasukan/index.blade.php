@extends('layouts.app')

@section('title')
    Data Pemasukan
@endsection

@section('javascript')
<script src="{{ asset('assets/global/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('assets/global/js/my_init/loadinganimate.js') }}"></script>
<script src="{{ asset('assets/global/js/my_init/datatables.js') }}"></script>
<script src="{{ asset('assets/global/js/init/form_layouts.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/validation/validate.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('assets/global/js/init/form_validation.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/pickers/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('assets/global/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
@endsection

@section('init')
<script>
var url = "{{ route ('api.pemasukan') }}";
var token = "{{Auth::user()->api_token}}";

var startDate='';
var endDate='';

$(document).ready(function() {
    $('.tanggal').pickadate({
        format: 'yyyy-mm-dd',
        today: '',
        close: '',
        clear: 'Batal',
        // onSet: function(context) {
        // endDate = convertDate(new Date(context.select));

        // }
    });
    $('.picker_from').pickadate({
        format: 'dd-mm-yyyy',
        today: '',
        close: '',
        clear: '',
        onSet: function(context) {
        startDate = convertDate(new Date(context.select));
        }
    });
    $('.picker_to').pickadate({
        format: 'dd-mm-yyyy',
        today: '',
        close: '',
        clear: 'Batal',
        onSet: function(context) {
        endDate = convertDate(new Date(context.select));

        }
    });
 });

 $(document).on('click', '#filter', function(e){
    // ganti url di button export
    var exportUrl = "{{ URL::to('pemasukan/report/pdf') }}?start_date="+startDate+"&end_date="+endDate;
    $('#periode').attr('href', exportUrl);
    console.log(exportUrl);

    e.preventDefault();
    $('.datatable-button-init-custom').DataTable().ajax.url(url+"?api_token="+token+"&start_date="+startDate+"&end_date="+endDate).load();
    var block = $('.datatable-button-init-custom');
    $(block).block({ 
        message: '<i class="icon-spinner4 spinner"></i>',
	    timeout: 1000, //unblock after 1 seconds
	    overlayCSS: {
	        backgroundColor: '#fff',
	        opacity: 0.8,
	        cursor: 'wait'
	    },
	    css: {
	        border: 0,
	        padding: 0,
	        backgroundColor: 'transparent'
	    }
    });
});

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
                    url: "{{ URL::to('pemasukan/delete') }}/"+id,
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
            url: "{{ URL::to('pemasukan/edit') }}/"+id,
            method: 'GET',
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function(response){
                var data = response.data;
                if (response.status == 200) {
                    $("#modal").modal('show');
                    $(".modal-title").text("Edit Pemasukan");
                    $('#id_form').val("1");
                    $('#pemasukan_id').val(data.id);
                    $('#tanggal').val(data.tanggal);
                    $('#nominal').val(data.nominal);
                    $('#status').val(data.status);
                    $('#jenis_pemasukan').val(data.jenis_pemasukan);
                    $('select[name=status] option').filter(':selected').val(data.status);
                    $('textarea#keterangan').val(data.keterangan);
                }
            }, 
        });
});

var url         = "{{ route ('api.pemasukan') }}";
var token       = "{{Auth::user()->api_token}}";
var can_create  = "{{ Auth::user()->can('pemasukan-create') }}";
var can_edit    = "{{ Auth::user()->can('pemasukan-list') }}";
var can_delete  = "{{ Auth::user()->can('pemasukan-delete') }}";
var columns, center, button;

// jika user bisa edit atau delete maka tampilkan row aksi
if(can_edit==="1" || can_delete==="1"){
    columns = [
        {"data":"DT_RowIndex", orderable: false, searchable: false},
        {"data":"tanggal"},
        {"data":"nominal"},
        {"data":"status"},
        {"data":"jenis_pemasukan"},
        {"data":"keterangan"},
        {"data":"action"},
    ];
    center = 6;
}else{
    columns = [
        {"data":"DT_RowIndex", orderable: false, searchable: false},
        {"data":"tanggal"},
        {"data":"nominal"},
        {"data":"status"},
        {"data":"jenis_pemasukan"},
        {"data":"keterangan"},
    ];
    center = 5;
}

// jika user bisa tambah data maka generate button
if(can_create=='1'){
    button = {
                text: 'Tambah Pemasukan',
                className: 'btn bg-teal-400',
                action: function(e, dt, node, config) {
                    document.getElementById("modal_form").reset();
                    $("#modal").modal('show');
                    $('#id_form').val("0");
                    $(".modal-title").text("Tambah Pemasukan");
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
$('#modal_form').submit(function(e){
    e.preventDefault();
    var id_form      = $('#id_form').val();
    var pemasukan_id = $('#pemasukan_id').val();
    var url_store    = "{{ URL::to('pemasukan/store') }}";
    var url_update   = "{{ URL::to('pemasukan/update') }}/"+pemasukan_id;

    var url      = id_form=="1" ? url_update : url_store; 
    var tanggal  = $('input[name="tanggal"]').val();
    var nominal  = $('input[name="nominal"]').val();
    var status   =  $('select[name=status] option').filter(':selected').val();
    var jenis    =  $('input[name=jenis_pemasukan]').val();
    var keterangan = $('textarea#keterangan').val();

    // console.log(jenis);

    var formData = new FormData();
    formData.append('tanggal', tanggal);
    formData.append('nominal', nominal);
    formData.append('status', status);
    formData.append('jenis_pemasukan', jenis);
    formData.append('keterangan', keterangan);
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
                $("#modal").modal('hide');
                new PNotify({
                    title: 'Sukses !',
                    text: data.message,
                    addclass: 'alert bg-success border-success alert-styled-right',
                    type: 'success'
                });
                $('.datatable-button-init-custom').DataTable().ajax.reload();
                document.getElementById("modal_form").reset();
            }, 
            error: function (xhr) {
                $("#modal").modal('hide');
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
<div class="d-flex align-items-start flex-column flex-md-row">
<div class="w-100 overflow-auto order-2 order-md-1">
<!-- Custom button -->
<div class="card">
<div class="card-header bg-transparent header-elements-inline">
        <div class="card-title">
        <a href="#" class="btn bg-primary ml-sm-2 mb-sm-0 sidebar-right-main-toggle sidebar-component-toggle"> <i class="icon-filter4 mr-2"></i> Filter </a>
        <a href="{{ URL::to('pemasukan/report/pdf') }}" target="_blank" id="periode"  class="btn bg-success ml-sm-2 mb-sm-0 mr-2 filter"> <i class="icon-file-pdf mr-2"></i> Download PDF</a>
        </div>
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
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Jenis Pemasukan</th>
                <th>Keterangan</th>
                @if(Gate::check('pemasukan-edit') || Gate::check('pemasukan-delete'))
                <th width="10%" class="text-center">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- /custom button -->
</div>

<!-- Right sidebar component -->
<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

<!-- Sidebar content -->
<div class="sidebar-content">

    <!-- Search -->
    <div class="card">
        <div class="card-header bg-transparent header-elements-inline">
            <span class="card-title font-weight-semibold">Filter Laporan</span>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
        <mark><i class="text-danger">* Rentang tanggal harus diisi.......</i></mark>
            <div class="form-group row mt-2">
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                    </span>
                    <input type="text" class="form-control picker_from" placeholder="Dari Tanggal">
                </div>
            </div>
            <div class="form-group row">
                <div class="input-group">
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                    </span>
                    <input type="text" class="form-control picker_to" placeholder="Sampai Tanggal">
                </div>
            </div>
            <a href="#" id="filter" class="btn bg-slate-600 btn-block">Terapkan</a>
        </div>
        <!-- /search -->
</div>
<!-- /sidebar content -->

</div>
<!-- /right sidebar component -->
</div>
</div>

@include('module.pemasukan.modal')
</div>



@endsection
