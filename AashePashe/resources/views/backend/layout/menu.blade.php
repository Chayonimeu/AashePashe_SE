<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview" id="dashboard_active">
                <a href="{{ URL::to('portal/dashboard') }}">
                    <i class="fa fa-circle"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="treeview" id="system_active">
                <a href="{{ URL::to('portal/system') }}">
                    <i class="fa fa-circle"></i><span>System Settings</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle"></i>
                    <span>General Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="country_active"><a href="{{ URL::to('portal/country') }}"><i class="fa fa-hand-o-right"></i> Business Area</a></li>
                    <li id="category_active"><a href="{{ URL::to('portal/category') }}"><i class="fa fa-hand-o-right"></i> Business Type</a></li>
                    <li id="property_active"><a href="{{ URL::to('portal/property') }}"><i class="fa fa-hand-o-right"></i> Property Category</a></li>
                    <li id="bedtype_active"><a href="{{ URL::to('portal/bedtype') }}"><i class="fa fa-hand-o-right"></i> Bed Type</a></li>
                    <li id="roomtype_active"><a href="{{ URL::to('portal/roomtype') }}"><i class="fa fa-hand-o-right"></i> Room Type</a></li>
                    <li id="hotel_facilities_active"><a href="{{ URL::to('portal/hotel/facility') }}"><i class="fa fa-hand-o-right"></i> Hotel Facilities</a></li>
                    <li id="activity_facilities_active"><a href="{{ URL::to('portal/activity/facility') }}"><i class="fa fa-hand-o-right"></i> Activity Facilities</a></li>
                    <li id="room_facilities_active"><a href="{{ URL::to('portal/room/facility') }}"><i class="fa fa-hand-o-right"></i> Room Facilities</a></li>
                    <li id="slider_active"><a href="{{ URL::to('portal/slider') }}"><i class="fa fa-hand-o-right"></i> Slider</a></li>
                    <li id="faq_active"><a href="{{ URL::to('portal/faq') }}"><i class="fa fa-hand-o-right"></i> Faq</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle"></i>
                    <span>User Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="admin_active"><a href="{{ URL::to('portal/admin') }}"><i class="fa fa-hand-o-right"></i> Portal Users</a></li>
                    <li id="user_active"><a href="{{ URL::to('portal/user') }}"><i class="fa fa-hand-o-right"></i> System Users</a></li>
                    <li id="merchant_active"><a href="{{ URL::to('portal/merchant') }}"><i class="fa fa-hand-o-right"></i> Merchant Users</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>