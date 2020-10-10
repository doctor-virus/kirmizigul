<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left">
        <i class="ion-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <br>
        <br>
        <div class="text-center">
            <a href="/" class="logo">
                <h5>{{auth()->user()->name}}</h5>
            </a>
        </div>
        <br>

    </div>


    <div class="sidebar-inner slimscrollleft" id="sidebar-main">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Overview
                </li>
                <li>
                    <a href="{{route('home.index')}}" class="waves-effect ">
                        <i data-feather="clock"></i>
                        <span>Order Pending</span></a>
                </li>
                <li>
                    <a href="{{route('selling.index')}}" class="waves-effect ">
                        <i data-feather="shopping-cart"></i>
                        <span>
                            Order</span></a>
                </li>
                <li>
                    <a href="{{route('note.index')}}" class="waves-effect ">
                        <i data-feather="bookmark"></i>
                        <span>
                            Note</span></a>
                </li>
                <li>
                    <a href="{{route('product.index')}}" class="waves-effect "><i data-feather="package"></i><span>
                            Product</span></a>
                </li>
                <li>
                    <a href="{{route('buying.index')}}" class="waves-effect "><i data-feather="dollar-sign"></i><span>
                            Buying</span></a>
                </li>
                <li>
                    <a href="{{route('city.index')}}" class="waves-effect "><i data-feather="map-pin"></i><span>
                            City</span></a>
                </li>
                <li>
                    <a href="{{route('taxi.index')}}" class="waves-effect "><i data-feather="truck"></i><span>
                            Taxi</span></a>
                </li>
                <li>
                    <a href="{{route('selling.income')}}" class="waves-effect "><i data-feather="trending-up"></i><span>
                            Income</span></a>
                </li>
                <li>
                    <a href="{{route('outcome.index')}}" class="waves-effect "><i
                            data-feather="trending-down"></i><span>
                            Outcome</span></a>
                </li>
                <li>
                    <a href="{{route('report.index')}}" class="waves-effect "><i
                            data-feather="book-open"></i><span>
                            Reports</span></a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>