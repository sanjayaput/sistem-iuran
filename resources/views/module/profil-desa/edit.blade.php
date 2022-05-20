@extends('layouts.app')

@section('title')
    Profil Desa
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
    <script src="{{ asset('assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/tinymce/js/tinymce/plugins/image/plugin.min.js') }}"></script>
@endsection

@section('init')
    <script></script>
@endsection

@section('content')
    <div class="d-flex align-items-start flex-column flex-md-row">
        <div class="w-100 overflow-auto order-2 order-md-1">
            <!-- Custom button -->
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <div class="card-title">
                    </div>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('/profil-desa/update-create') }}" method="post">
                        {{ csrf_field() }}
                        <label for="konten">Konten Profil Desa</label>
                        <textarea name="konten" id="konten" class="form-control">{{ $profil_desa->konten ?? '' }}</textarea>
                        <button class="btn btn-primary mt-3 float-right">Simpan</button>                        
                    </form>
                </div>
            </div>
            <!-- /custom button -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        tinymce.init({
            selector: 'textarea',
            height: "850",
            images_upload_url: "{!! url('tiny-image-upload') !!}",
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            plugins: 'preview autolink fullscreen image link media table anchor insertdatetime advlist lists wordcount',
            toolbar: 'undo redo | bold italic strikethrough underline numlist bullist removeformat | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | copy cut selectall | image | preview',
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
        });
    </script>
@endpush
