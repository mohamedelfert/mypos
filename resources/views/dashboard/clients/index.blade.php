@extends('layouts.dashboard.app')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ $title }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">{{ $title }}</li>
            </ol>

        </section><!-- end of content header -->

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h4 class="box-title" style="margin-bottom: 15px;">@lang('site.clients')</h4>
                    <span><small>( {{ $clients->total() }} )</small></span>

                    <form action="{{ route('dashboard.clients.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                                       placeholder="@lang('site.search')">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-sm" title="@lang('site.search')">
                                    <i class="fa fa-search"></i></button>
                                <a class="btn btn-danger btn-sm" href="{{ route('dashboard.clients.index') }}"
                                   title="@lang('site.clear')">
                                    <i class="fa fa-eraser"></i></a>
                                @if(auth()->user()->hasPermission('clients_create'))
                                    <a href="{{ route('dashboard.clients.create')}}"
                                       class="btn btn-success btn-sm" title="@lang('site.add')">
                                        <i class="fa fa-plus-square"></i> / <i class="fa fa-user"></i>
                                    </a>
                                @else
                                    <a href="#"
                                       class="btn btn-success btn-sm disabled" title="@lang('site.add')">
                                        <i class="fa fa-plus-square"></i> / <i class="fa fa-user"></i></a>
                                @endif
                            </div>
                        </div>
                    </form>

                </div><!-- end of box header -->

                <div class="box-body">

                    @if($clients->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.address')</th>
                                <th>@lang('site.orders')</th>
                                <th>@lang('site.control')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $index => $client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ is_array($client->phone) ? implode(' / ', $client->phone) : $client->phone }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('orders_create'))
                                            <a href="{{ route('dashboard.clients.orders.create',$client->id)}}"
                                               class="btn btn-info btn-sm" title="@lang('site.add_order')">
                                                @lang('site.add_order') <i class="fa fa-plus"></i></a>
                                        @else
                                            <a href="#"
                                               class="btn btn-info btn-sm disabled" title="@lang('site.add_order')">
                                                @lang('site.add_order') <i class="fa fa-plus"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(auth()->user()->hasPermission('clients_update'))
                                            <a href="{{ route('dashboard.clients.edit',$client->id)}}"
                                               class="btn btn-primary btn-sm" title="@lang('site.edit')">
                                                <i class="fa fa-edit"></i></a>
                                        @else
                                            <a href="#"
                                               class="btn btn-primary btn-sm disabled" title="@lang('site.edit')">
                                                <i class="fa fa-edit"></i></a>
                                        @endif

                                        @if(auth()->user()->hasPermission('clients_delete'))
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                               data-toggle="modal" href="#delete{{ $client->id }}"
                                               title="@lang('site.delete')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @else
                                            <a href="#"
                                               class="btn btn-danger btn-sm disabled" title="@lang('site.edit')">
                                                <i class="fa fa-edit"></i></a>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Delete -->
                                <div class="modal fade" id="delete{{ $client->id }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">@lang('site.delete')</h6>
                                                <button aria-label="Close" class="close" data-dismiss="modal"
                                                        type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ route('dashboard.clients.destroy',$client->id) }}"
                                                  method="post">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <p>@lang('site.msg_delete')</p><br>
                                                    <input type="hidden" name="id" id="id" value="{{ $client->id }}">
                                                    <input class="form-control" name="name" id="name" type="text"
                                                           value="{{ $client->name }}" readonly>
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
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.address')</th>
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

            <ul class="pull-right">
                {{ $clients->appends(request()->input())->links() }}
            </ul>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
