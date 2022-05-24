@extends('layouts.dashboard.app')

@section('title')
    {{ $title }}
@endsection

@section('css')

@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ $title }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">{{ $title }}</li>
            </ol>
        </section>

{{--        <section class="content">--}}

{{--            <div class="box box-primary">--}}
{{--                <div class="box-header with-border">--}}

{{--                </div><!-- end of row -->--}}

{{--                <div class="box-body">--}}

{{--                    <div class="box-header">--}}
{{--                        <h3 class="box-title">Title Of Content Here</h3>--}}
{{--                    </div>--}}
{{--                    <div class="box-body border-radius-none ht-300">--}}
{{--                        <h3 class="box-body">Body Of Content Here</h3>--}}
{{--                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-body -->--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </section><!-- end of content -->--}}

        <section class="content">

            <div class="row">

                {{-- categories--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>10</h3>
                            <p>@lang('site.categories')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--products--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>100</h3>
                            <p>@lang('site.products')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--clients--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>30</h3>
                            <p>@lang('site.clients')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            @lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--users--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ App\Models\User::count() }}</h3>
                            <p>@lang('site.users')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">
                            @lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div><!-- end of row -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Title Of Content Here</h3>
                </div>
                <div class="box-body border-radius-none">
                    <h3 class="box-body">Body Of Content Here</h3>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
            </div><!-- /.box-body -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@section('js')

@endsection
