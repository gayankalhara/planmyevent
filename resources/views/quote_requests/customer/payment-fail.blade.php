@extends('master')

        <!-- Header CSS -->
@section('header-css')

@endsection

        <!-- Header JavaScript -->
@section('header-js')

@endsection

@section('content')


@endsection

        <!-- Footer JavaScript -->
@section('footer-js')

    <script type="text/javascript">

        swal({
                    title: 'Failed',
                    text: 'Payment Failed',
                    type: 'error',
                    showConfirmButton: true,
                    confirmButtonText: 'Return to Dashboard'
                },

                function(isConfirm){
                    if (isConfirm) {
                        window.location.href = "http://www.planmyevent.me/";
                    }
                });

    </script>

@endsection