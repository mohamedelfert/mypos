@extends('layouts.dashboard.app')

@section('title')
    Page Title Here
@endsection

@section('css')

@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Title Here</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard Title Here</a></li>
                <li class="active">Page Title</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">

                </div><!-- end of row -->

                <div class="box-body">

                    <div class="box-header">
                        <h3 class="box-title">Title Of Content Here</h3>
                    </div>
                    <div class="box-body border-radius-none ht-300">
                        <h3 class="box-body">Body Of Content Here</h3>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@section('js')

@endsection
