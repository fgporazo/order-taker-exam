 <div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                Order Taker
            </a>
        </li>
        <li>
            <a href="{{ route('customer.index') }}"  @if(request()->routeIs('customer.*')) class="active" @endif>Customers</a>
            <a href="{{ route('sku.index') }}"  @if(request()->routeIs('sku.*')) class="active" @endif>SKU</a>
            <a href="{{ route('order.index') }}"  @if(request()->routeIs('order.*')) class="active" @endif>Orders</a>
        </li>
    </ul>
</div>