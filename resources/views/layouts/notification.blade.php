<script>
document.addEventListener("DOMContentLoaded", function(event) { 

  @if(Session::get('success'))
      new PNotify({
          title: 'Sukses !',
          text: '{{ Session::get("success") }}',
          addclass: 'alert bg-success border-success alert-styled-right',
          type: 'success'
      });
     @php
       Session::forget('success');
     @endphp
  @endif


  @if(Session::has('info'))
      new PNotify({
          title: 'Info !',
          text: '{{ Session::get("info") }}',
          addclass: 'alert bg-primary border-primary alert-styled-right',
          type: 'info'
      });
      @php
        Session::forget('primary');
      @endphp
  @endif


  @if(Session::has('warning'))
      new PNotify({
          title: 'Perhatian !',
          text: '{{ Session::get("warning") }}',
          addclass: 'alert bg-warning border-warning alert-styled-right',
          type: 'warning'
      });
      @php
        Session::forget('warning');
      @endphp
  @endif


  @if(Session::has('error'))
      new PNotify({
          title: 'Gagal !',
          text: '{{ Session::get("error") }}',
          addclass: 'alert bg-danger border-danger alert-styled-right',
          type: 'danger'
      });
      @php
        Session::forget('error');
      @endphp
  @endif

});
</script>