@extends('layouts.dashboard.app')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ $title }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">{{ $title }}</li>
            </ol>
        </section><!-- end of content header -->

        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">

                </div><!-- end of box header -->

                <div class="box-body">
                    @if($users->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.first_name')</th>
                                    <th>@lang('site.last_name')</th>
                                    <th>@lang('site.email')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.control')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->image }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.users.edit',$user->id)}}"
                                           class="btn btn-primary btn-sm" title="@lang('site.edit')">
                                            <i class="fa fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           data-toggle="modal" href="#delete{{ $user->id }}" title="@lang('site.delete')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Delete -->
                                <div class="modal fade" id="delete{{ $user->id }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">@lang('site.delete')</h6>
                                                <button aria-label="Close" class="close" data-dismiss="modal"
                                                        type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ route('dashboard.users.destroy','test') }}" method="post">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <p>@lang('site.msg_delete')</p><br>
                                                    <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                                    <input class="form-control" name="name" id="name" type="text"
                                                           value="{{ $user->first_name }} {{ $user->last_name }}" readonly>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">@lang('site.cancel')</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">@lang('site.confirm')</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete -->
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.first_name')</th>
                                    <th>@lang('site.last_name')</th>
                                    <th>@lang('site.email')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.control')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center text-danger">@lang('site.no_data_found')</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div><!-- /.box-body -->
            </div><!-- end of box primary -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
