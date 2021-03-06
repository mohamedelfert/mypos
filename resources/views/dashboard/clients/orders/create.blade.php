@extends('layouts.dashboard.app')
@section('title')
    {{ $title }}
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ $title }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i>
                        @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
                <li class="active">@lang('site.add_order')</li>
            </ol>
        </section><!-- end of content header -->

        <section class="content">

            @include('partials._errors')

            <div class="row">
                <!-- Start Categories -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.categories')</h3>
                        </div>

                        <div class="box-body">
                            @foreach($categories as $category)
                                <div class="panel-group">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse"
                                                   href="#{{ str_replace(' ', '-' ,$category->name) }}">{{ $category->name }}</a>
                                            </h4>
                                        </div>
                                        <div id="{{ str_replace(' ', '-' ,$category->name) }}"
                                             class="panel-collapse collapse">
                                            <div class="panel-body">
                                                @if($category->products->count() > 0)
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.stock')</th>
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.add')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($category->products as $index => $product)
                                                            <tr>
                                                                <td>{{ $index++ }}</td>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ number_format($product->sale_price, 2) }}</td>
                                                                <td>
                                                                    <a href="#"
                                                                       id="product-{{ $product->id }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-price="{{ $product->sale_price }}"
                                                                       class="btn btn-success btn-sm add_product_btn">
                                                                        <i class="fa fa-plus-circle"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.stock')</th>
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.add')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-danger">
                                                                @lang('site.no_data_found')
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- /.box-body -->
                    </div>
                </div>
                <!-- End Categories -->

                <!-- Start Orders -->
                <div class="col-md-6">
                    <!-- Start Orders -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.orders')</h3>
                        </div>

                        <div class="box-body">
                            <form class="form-horizontal"
                                  action="{{ route('dashboard.clients.orders.store',$client->id) }}" method="post">
                                @csrf

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody class="order_list">
                                    <tr class="data_not_found">
                                        <td colspan="4" class="text-center text-danger">
                                            @lang('site.no_data_found')
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h4>@lang('site.total') : <span class="total_price"> 0 EGP</span></h4>
                                <hr>
                                <button type="submit" id="add_order_product_btn"
                                        class="btn btn-primary btn-block disabled">
                                    <i class="fa fa-plus"></i> @lang('site.add_order')
                                </button>
                            </form>
                        </div><!-- /.box-body -->
                    </div>
                    <!-- Start Orders -->

                    <!-- Start Previous Orders -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.previous_orders')</h3>
                        </div>

                        <div class="box-body">
                            @if($client->orders->count() > 0)
                                @foreach($orders as $order)
                                    <div class="panel-group">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse"
                                                       href="#{{ $order->id }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                </h4>
                                            </div>
                                            <div id="{{ $order->id }}"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.quantity')</th>
                                                            <th>@lang('site.total')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($order->products as $index => $product)
                                                            <tr>
                                                                <th>{{ $index++ }}</th>
                                                                <th>{{ $product->name }}</th>
                                                                <th>{{ $product->sale_price }}</th>
                                                                <th>{{ $product->pivot->quantity }}</th>
                                                                <th>{{ $product->pivot->quantity * $product->sale_price }}</th>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <hr>
                                                    <h4>@lang('site.total') : <span>{{ $order->total_price }} EGP</span></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.total')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">
                                            @lang('site.no_data_found')
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h4>@lang('site.total') : <span>0 EGP</span></h4>
                            @endif
                        </div><!-- /.box-body -->
                    </div>
                    <!-- Start Previous Orders -->
                </div>
                <!-- End Orders -->
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function () {

            // this for add product btn
            $('.add_product_btn').on('click', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $.number($(this).data('price'), 2);

                $(this).removeClass('btn-success').addClass('btn-default disabled');

                $('.data_not_found').addClass('hidden');

                //$('#add_order_product_btn').removeClass('disabled');

                // var html =
                //     '<tr>' +
                //         '<td>' + name + '</td>' +
                //         '<td><input type="hidden" name="product_ids[]" value="'+ id +'"></td>' +
                //         '<td><input type="number" name="quantities[]" data-price="'+ price +'" class="form-control product_quantity" value="1" min="1"></td>' +
                //         '<td class="product_price">' + price + '</td>' +
                //         '<td><button class="btn btn-danger btn-sm remove_product_btn" data-id="'+ id +'"><i class="fa fa-trash"></i></button></td>' +
                //     '</tr>'
                // ;

                // or use this
                var html =
                    `<tr>
                        <td>${name}</td>
                        <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control product_quantity" value="1" min="1"></td>
                        <td class="product_price">${price}</td>
                        <td><button class="btn btn-danger btn-sm remove_product_btn" data-id="${id}"><i class="fa fa-trash"></i></button></td>
                    </tr>`;

                $('.order_list').append(html);

                calculateTotal();
            })

            // this for disabled btn
            $('body').on('click', '.disabled', function (event) {
                event.preventDefault();
            });

            // this for remove product btn
            $(document).on('click', '.remove_product_btn', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();

                $('.data_not_found').removeClass('hidden');

                //$('#add_order_product_btn').addClass('disabled');

                var id = $(this).data('id');
                $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

                calculateTotal()
            });

            // this for change product quantity
            $(document).on('keyup change', '.product_quantity', function () {
                var quantity = parseInt($(this).val());
                var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));
                $(this).closest('tr').find('.product_price').html($.number(quantity * unitPrice, 2));
                calculateTotal();
            });

        });

        // this for calculate total price
        function calculateTotal() {

            var price = 0;

            $('.order_list .product_price').each(function () {
                price += parseFloat($(this).html().replace(/,/g, ''));
            })

            $('.total_price').html($.number(price, 2));

            if (price > 0) {
                $('#add_order_product_btn').removeClass('disabled');
            } else {
                $('#add_order_product_btn').addClass('disabled');
            }

        }
    </script>
@endpush
