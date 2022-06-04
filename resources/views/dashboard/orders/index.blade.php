@extends('layouts.dashboard.app')

@section('title')
    {{ $title }}
@endsection

@push('css')
    <style>
        @media print {
            .print_btn {display: none}
        }
    </style>
@endpush

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

            @include('partials._errors')

            <div class="row">
                <!-- Start Orders -->
                <div class="col-md-8">
                    <div class="box box-primary">

                        <div class="box-header with-border">

                            <h4 class="box-title" style="margin-bottom: 15px;">@lang('site.orders')</h4>
                            <span><small>( {{ $orders->total() }} )</small></span>

                            <form action="{{ route('dashboard.orders.index') }}" method="get">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="search" class="form-control"
                                               value="{{ request()->search }}"
                                               placeholder="@lang('site.search')">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary btn-sm" title="@lang('site.search')">
                                            <i class="fa fa-search"></i></button>
                                        <a class="btn btn-danger btn-sm" href="{{ route('dashboard.orders.index') }}"
                                           title="@lang('site.clear')">
                                            <i class="fa fa-eraser"></i></a>
                                    </div>
                                </div>
                            </form>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @if($orders->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.client_name')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.order_status')</th>
                                        <th>@lang('site.add_date')</th>
                                        <th>@lang('site.show')</th>
                                        <th>@lang('site.control')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->client->name }}</td>
                                            <td>{{ number_format($order->total_price , 2) }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <button
                                                    data-url="{{ route('dashboard.orders.products', $order->id) }}"
                                                    data-method="get" class="btn btn-info btn-sm order_products">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                            <td>
                                                @if(auth()->user()->hasPermission('orders_update'))
                                                    <a href="{{ route('dashboard.clients.orders.edit',['client' => $order->client->id , 'order' => $order->id]) }}"
                                                       class="btn btn-primary btn-sm" title="@lang('site.edit')">
                                                        <i class="fa fa-edit"></i></a>
                                                @else
                                                    <a href="#" class="btn btn-primary btn-sm disabled"
                                                       title="@lang('site.edit')"><i class="fa fa-edit"></i></a>
                                                @endif

                                                @if(auth()->user()->hasPermission('orders_delete'))
                                                    <a class="modal-effect btn btn-sm btn-danger"
                                                       data-effect="effect-scale" data-toggle="modal"
                                                       href="#delete{{ $order->id }}" title="@lang('site.delete')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm disabled"
                                                       title="@lang('site.edit')"><i class="fa fa-edit"></i></a>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Delete -->
                                        <div class="modal fade" id="delete{{ $order->id }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">@lang('site.delete')</h6>
                                                        <button aria-label="Close" class="close" data-dismiss="modal"
                                                                type="button"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('dashboard.orders.destroy',$order->id) }}"
                                                          method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <p>@lang('site.msg_delete')</p><br>
                                                            <input type="hidden" name="id" id="id"
                                                                   value="{{ $order->id }}">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="control-label">@lang('site.order_number')</label>
                                                                    <input class="form-control" name="number" type="text"
                                                                           value="{{ $order->id }}" readonly>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label">@lang('site.client_name')</label>
                                                                    <input class="form-control" name="name" type="text"
                                                                           value="{{ $order->client->name }}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">@lang('site.cancel')</button>
                                                            <button type="submit" class="btn btn-danger">@lang('site.confirm')</button>
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
                                        <th>@lang('site.client_name')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.order_status')</th>
                                        <th>@lang('site.add_date')</th>
                                        <th>@lang('site.show')</th>
                                        <th>@lang('site.control')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="7" class="text-center text-danger">@lang('site.no_data_found')</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif

                        </div><!-- /.box-body -->

                    </div><!-- end of box primary -->

                    <ul class="pull-right">
                        {{ $orders->appends(request()->input())->links() }}
                    </ul>
                </div>
                <!-- End Orders -->

                <!-- Start Products -->
                <div class="col-md-4" id="print">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.show_products')</h3>
                        </div>

                        <div class="box-body">

                            <div class="text-center hidden" id="loading">
                                <div class="lds-facebook"><div></div><div></div><div></div></div>
{{--                                <div class="loader"><div>--}}
{{--                                <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>--}}
                                <p>@lang('site.loading')</p>
                            </div>

                            <div id="product_list">

                            </div>

                        </div><!-- /.box-body -->
                    </div>
                </div>
                <!-- End Products -->
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function () {

            // this for show order products
            $('.order_products').on('click', function (event) {
                event.preventDefault();

                $('#loading').removeClass('hidden');

                var url = $(this).data('url');
                var method = $(this).data('method');
                $.ajax({
                    url: url,
                    method: method,
                    // type: method,
                    success: function (data) {
                        $('#loading').addClass('hidden');
                        $('#product_list').empty();
                        $('#product_list').append(data);
                    }
                });
            });

        });

        function orderPrint(){
            var content = document.getElementById('print').innerHTML;
            document.body.innerHTML = content;
            window.print();
            location.reload();
        }
    </script>
@endpush
