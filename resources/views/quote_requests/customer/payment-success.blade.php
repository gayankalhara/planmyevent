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
                    title: 'Success',
                    text: 'Payment Successful',
                    type: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'View Event'
                },

                function(isConfirm){
                    if (isConfirm) {
                        window.location.href = "http://www.planmyevent.me/view-all-events";
                    }
                });

    </script>

@endsection