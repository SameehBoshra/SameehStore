<div class="header-center hidden-sm-down">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div id="_desktop_logo"
                 class="contentsticky_logo d-flex align-items-center justify-content-start col-lg-3 col-md-3">
                <a href="">
                    <img class="logo img-fluid"
                    src="{{asset('assets/admin/logo2.jpg')}}" height="50" width="50"  alt=""
                    style="border-radius: 50%;"
                    >
                </a>
            </div>
            <div class="col-lg-9 col-md-9 header-menu d-flex align-items-center justify-content-end">
                <div class="data-contact d-flex align-items-center">
                    <div class="title-icon">support<i class="icon-support icon-address"></i></div>
                    <div class="content-data-contact">
                        <div class="support">{{ trans('msg.callcustomerservices') }}</div>
                        <div class="phone-support">
                            01284638552
                        </div>
                    </div>
                </div>
                <div class="contentsticky_group d-flex justify-content-end">
                    <div class="header_link_myaccount">
                        <a class="login" href="{{route('login')}}" rel="nofollow" title="Log in to your customer account"><i
                                class="header-icon-account"></i></a>
                    </div>
                    <div class="header_link_wishlist">
                        <a href="{{route('wishlist.products.index')}}" title="My Wishlists">
                            <i class="header-icon-wishlist"></i>
                        </a>
                    </div>
                   {{--  <div id="_desktop_cart">
                        <div class="blockcart cart-preview active" data-refresh-url="">
                            <div class="header-cart">
                                <div class="cart-left">
                                    <a href="{{route('site.cart.index')}}" title="My Shopping">
                                        <div class="shopping-cart">
                                            <i class="zmdi zmdi-shopping-cart"></i>

                                        </div>

                                    </a>
                                    <div class="cart-products-count">0</div>
                                </div>
                                <div class="cart-right d-flex flex-column align-self-end ml-13">
                                    <span class="title-cart">Cart</span>
                                    <span class="cart-item"> items</span>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

