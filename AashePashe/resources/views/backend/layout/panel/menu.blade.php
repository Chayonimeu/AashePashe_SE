<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview" id="dashoard_active">
                <a href="{{ URL::to('portal/merchant/dashboard') }}">
                    <i class="fa fa-circle"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="treeview" id="branch_active">
                <a href="{{ URL::to('portal/merchant/branch') }}">
                    <i class="fa fa-circle"></i><span>Branch Settings</span>
                </a>
            </li>
            <li class="treeview" id="merchant_user_active">
                <a href="{{ URL::to('portal/merchant/user') }}">
                    <i class="fa fa-circle"></i><span>User Settings</span>
                </a>
            </li>
            <li class="treeview" id="hotel_active">
                <a href="{{ URL::to('portal/merchant/hotel') }}">
                    <i class="fa fa-circle"></i><span>Hotel Settings</span>
                </a>
            </li>
            <li class="treeview" id="order_active">
                <a href="">
                    <i class="fa fa-circle"></i><span>Order History</span>
                </a>
            </li>
        </ul>
    </section>
</aside>