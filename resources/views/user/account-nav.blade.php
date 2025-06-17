<ul class="account-nav">
    
            <li><a href="{{route('user.index')}}" class="menu-link menu-link_us-s">Dashboard</a></li>
            <li><a href="{{route('user.account.orders')}}" class="menu-link menu-link_us-s {{Route::is('user.account.orders') ? 'menu-link_active':''}}">Orders</a></li>
            <!-- <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li> -->
             
            @auth
                                <li class="menu-item">
                                    <a href="{{ route('settings.index') }}" class="">
                                        <div class="icon"><i class="icon-settings"></i></div>
                                        <div class="text">Settings</div>
                                    </a>
                                </li>
                                @endauth
            <!-- <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Wishlist</a></li> -->

            <li>
                <form method="POST" action="{{route('logout')}}" id="logout-form">
                    @csrf   
                <a href="{{route('logout')}}" class="menu-link menu-link_us-s" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                </form>
            </li>

          </ul>