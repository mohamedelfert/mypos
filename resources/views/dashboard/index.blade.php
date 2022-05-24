@extends('layouts.dashboard.app')

@section('title')
    Title Here
@endsection

@push('css')
    <link rel="stylesheet" href="">
@endpush

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Title Of Page Here</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Title Of Page</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

            </div><!-- end of row -->

            <div class="box box-solid">

                <div class="box-header">
                    <h3 class="box-title">Title Of Content Here</h3>
                </div>
                <div class="box-body border-radius-none ht-300">
                    <h3 class="box-body">Body Of Content Here</h3>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
                <!-- /.box-body -->
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@push('js')
    <script>js</script>
@endpush
