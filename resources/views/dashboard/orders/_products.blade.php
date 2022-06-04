<table class="table table-hover">
    <thead>
        <tr>
            <th>@lang('site.name')</th>
            <th>@lang('site.quantity')</th>
            <th>@lang('site.price')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ number_format($product->pivot->quantity * $product->sale_price, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<h4>@lang('site.total') : <span class="total_price"> {{ number_format($order->total_price, 2) }} </span></h4>
<hr>
<button type="submit" id="order_print_btn"
        class="btn btn-primary btn-block print_btn" onclick="orderPrint()">
    <i class="fa fa-print"></i> @lang('site.print')
</button>
