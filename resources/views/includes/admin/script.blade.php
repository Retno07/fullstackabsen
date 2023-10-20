{{--  <!-- Bootstrap core JavaScript-->  --}}
<script src="{{ url('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{--  <!-- Core plugin JavaScript-->  --}}
<script src="{{ url('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

{{--  <!-- Custom scripts for all pages-->  --}}
<script src="{{ url('backend/js/sb-admin-2.min.js') }}"></script>

{{--  <!-- Page level plugins -->  --}}
<script src="{{ url('backend/vendor/chart.js/Chart.min.js') }}"></script>

{{--  <!-- Page level custom scripts -->  --}}
<script src="{{ url('backend/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ url('backend/js/demo/chart-pie-demo.js') }}"></script>

{{--  select2  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- alert --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Apakah Anda yakin ingin menghapus data ini?",
            // text: "Jika Anda menghapus ini, itu akan hilang selamanya.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
