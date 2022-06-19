<style>
    body.swal2-toast-shown .swal2-container.swal2-top-end,
    body.swal2-toast-shown .swal2-container.swal2-top-right {
        top: 0;
        right: 0;
        bottom: auto;
        left: auto;
        margin-top: 75px;
    }
    .swal2-popup.swal2-toast {
        flex-direction: row;
        align-items: center;
        width: auto;
        padding: 0.625em;
        overflow-y: hidden;
        background: #fff2f2;
        box-shadow: 0 0 0.625em #1a1a1a;
    }
</style>

@if ($message = Session::get('success'))
<script type="text/javascript">
    Swal.fire({
        toast: true,
        icon: 'success',
        title: '{{ $message }}',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
</script>
@endif

@if ($message = Session::get('error'))
<script type="text/javascript">
    Swal.fire({
        toast: true,
        icon: 'error',
        title: '{{ $message }}',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
</script>
@endif
{{-- <script type="text/javascript">
    var toastMixin = Swal.mixin({
        toast: true,
        icon: 'success',
        title: 'General Title',
        animation: false,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
       
    document.querySelector(".second").addEventListener('click', function(){
      toastMixin.fire({
        animation: true,
        title: 'Signed in Successfully'
      });
    });
     
    document.querySelector(".third").addEventListener('click', function(){
      toastMixin.fire({
        title: 'Wrong Password',
        icon: 'error'
      });
    });
    
</script> --}}