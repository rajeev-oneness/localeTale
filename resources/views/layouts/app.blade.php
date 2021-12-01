<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'localTale') }} - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('design/css/bootstrap-4.6.0.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('design/css/custom.css')}}">
</head>
<body>
    <!-- loader -->
    <div class="loading-data" style="display:block; color: #fff;">Loading&#8230;</div>

    <!-- Header Content -->
    @include('layouts.header')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer Content -->
    @include('layouts.footer')

    <script src="{{asset('design/js/jquery-3.6.0.js')}}"></script>
    <script src="{{asset('design/js/bootstrap4.6.1.bundle.min.js')}}"></script>
    <script src="{{asset('design/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('design/js/jquery.sumoselect.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.loading-data').hide();
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
                $('.loading-data').show();
            });

            @if(Session::has('Success'))
                toastFire('success', '{{Session::get('success')}}');
            @elseif(Session::has('Errors'))
                toastFire('danger', '{{Session::get('success')}}');
            @endif
        });

        // toast fires | type = success, info, danger, warning
        function toastFire(type='success', title, body='') {
            $icon = 'check';
            if (type == 'info') {
                $icon = 'info-circle';
            } else if (type == 'danger') {
                $icon = 'times';
            } else if (type == 'warning') {
                $icon = 'exclamation';
            }

            $(document).Toasts('create', {
                class: 'bg-'+type,
                title: title,
                autohide: true,
                delay: 3000,
                icon: 'fas fa-'+$icon+' fa-lg',
                // body: body
            });
        }

        
        function isNumberKey(evt){
            if(evt.charCode >= 48 && evt.charCode <= 57 || evt.charCode <= 43){  
                return true;  
            }  
            return false;  
        }
    </script>
</body>
</html>
