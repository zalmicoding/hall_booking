<main>
    <aside class="offcanvas-collapse">
        <div class="avatar-wrap">
            <!-- <img src="assets/images/dashboard/avatar_img.jpg" alt="">
            <h3>Hitesh Mahavar</h3> -->
            <h2>Hall Dashbaord</h2>
        </div>
        <div class="sidebar-nav">
            <ul class="list-unstyled">
                <!-- <li>
                    <a href="vendor-dashboard.html"><i class="weddingdir_dashboard"></i> Dashboard</a>
                </li> -->
                <li class="">
                    <a href="vendor-dashboard-quote.html"><i class="weddingdir_request_quote"></i> Manage Users</a>

              {{--sad  <li>
                    <a href="vendor-dashboard-profile.html"><i class="weddingdir_my_profile"></i> My Profile</a>
                </li>--}}
                <!-- <li>
                    <a href="vendor-dashboard-pricing.html"><i class="weddingdir_pricing_plans"></i> Pricing Table</a>
                </li>

                <li>
                    <a href="vendor-dashboard-reviews.html"><i class="weddingdir_reviews"></i> Reviews</a>
                </li>
                <li>
                    <a href="vendor-dashboard-invoice.html"><i class="weddingdir_invoice"></i> Invoice</a>
                </li> -->
                <li>
                    <a href="chat-hall.html"><i class="weddingdir_chat"></i> Chat</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 <i class="weddingdir_logout"></i> {{ __('Logout') }}
             </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
                </li>

            </ul>
        </div>
    </aside>

