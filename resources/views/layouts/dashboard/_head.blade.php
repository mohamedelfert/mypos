<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        {{--<!-- Bootstrap 3.3.7 -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/skin-blue.min.css') }}">

        @if (app()->getLocale() == 'ar')
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE-rtl.min.css') }}">
            <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">
            <style>
                body, h1, h2, h3, h4, h5, h6 {
                    font-family: 'Cairo', sans-serif !important;
                }
            </style>
        @else
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}">
        @endif
        <style>
            /* loading number 1 */
            /*.mr-2{*/
            /*    margin-right: 5px;*/
            /*}*/
            /*.loader {*/
            /*    border: 5px solid #f3f3f3;*/
            /*    border-radius: 50%;*/
            /*    border-top: 5px solid #367FA9;*/
            /*    width: 60px;*/
            /*    height: 60px;*/
            /*    -webkit-animation: spin 1s linear infinite; !* Safari *!*/
            /*    animation: spin 1s linear infinite;*/
            /*}*/
            /*!* Safari *!*/
            /*@-webkit-keyframes spin {*/
            /*    0% {*/
            /*        -webkit-transform: rotate(0deg);*/
            /*    }*/
            /*    100% {*/
            /*        -webkit-transform: rotate(360deg);*/
            /*    }*/
            /*}*/
            /*@keyframes spin {*/
            /*    0% {*/
            /*        transform: rotate(0deg);*/
            /*    }*/
            /*    100% {*/
            /*        transform: rotate(360deg);*/
            /*    }*/
            /*}*/

            /* loading number 2 */
            .lds-facebook {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 80px;
            }
            .lds-facebook div {
                display: inline-block;
                position: absolute;
                left: 8px;
                width: 16px;
                background: #5ebfe8;
                animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
            }
            .lds-facebook div:nth-child(1) {
                left: 8px;
                animation-delay: -0.24s;
            }
            .lds-facebook div:nth-child(2) {
                left: 32px;
                animation-delay: -0.12s;
            }
            .lds-facebook div:nth-child(3) {
                left: 56px;
                animation-delay: 0;
            }
            @keyframes lds-facebook {
                0% {
                    top: 8px;
                    height: 64px;
                }
                50%, 100% {
                    top: 24px;
                    height: 32px;
                }
            }

            /*!* loading number 3 *!*/
            /*.lds-ellipsis {*/
            /*    display: inline-block;*/
            /*    position: relative;*/
            /*    width: 80px;*/
            /*    height: 80px;*/
            /*}*/
            /*.lds-ellipsis div {*/
            /*    position: absolute;*/
            /*    top: 33px;*/
            /*    width: 13px;*/
            /*    height: 13px;*/
            /*    border-radius: 50%;*/
            /*    background: #3d92da;*/
            /*    animation-timing-function: cubic-bezier(0, 1, 1, 0);*/
            /*}*/
            /*.lds-ellipsis div:nth-child(1) {*/
            /*    left: 8px;*/
            /*    animation: lds-ellipsis1 0.6s infinite;*/
            /*}*/
            /*.lds-ellipsis div:nth-child(2) {*/
            /*    left: 8px;*/
            /*    animation: lds-ellipsis2 0.6s infinite;*/
            /*}*/
            /*.lds-ellipsis div:nth-child(3) {*/
            /*    left: 32px;*/
            /*    animation: lds-ellipsis2 0.6s infinite;*/
            /*}*/
            /*.lds-ellipsis div:nth-child(4) {*/
            /*    left: 56px;*/
            /*    animation: lds-ellipsis3 0.6s infinite;*/
            /*}*/
            /*@keyframes lds-ellipsis1 {*/
            /*    0% {*/
            /*        transform: scale(0);*/
            /*    }*/
            /*    100% {*/
            /*        transform: scale(1);*/
            /*    }*/
            /*}*/
            /*@keyframes lds-ellipsis3 {*/
            /*    0% {*/
            /*        transform: scale(1);*/
            /*    }*/
            /*    100% {*/
            /*        transform: scale(0);*/
            /*    }*/
            /*}*/
            /*@keyframes lds-ellipsis2 {*/
            /*    0% {*/
            /*        transform: translate(0, 0);*/
            /*    }*/
            /*    100% {*/
            /*        transform: translate(24px, 0);*/
            /*    }*/
            /*}*/
        </style>
        {{--<!-- jQuery 3 -->--}}
        <script src="{{ asset('dashboard_files/js/jquery.min.js') }}"></script>

        {{--noty--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
        <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

        {{--morris--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/morris/morris.css') }}">

        {{--<!-- iCheck -->--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/icheck/all.css') }}">

        {{--html in  ie--}}
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        @stack('css')

    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">
