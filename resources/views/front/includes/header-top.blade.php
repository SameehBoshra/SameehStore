<div class="header-top hidden-sm-down">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="header-top-left col-lg-6 col-md-6 d-flex justify-content-start align-items-center">
                    <div class="detail-email d-flex align-items-center justify-content-center">
                        <i class="icon-email"></i>
                        <p>{{trans('msg.email')}}</p>
                        <span>
                  sameehb65@gmail.com
                </span>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 d-flex justify-content-end align-items-center header-top-right">
                    <div class="register-out">
                        <i class="zmdi zmdi-account"></i>
                        @guest()
                            <a class="register" href="{{route('register')}}"
                               data-link-action="display-register-form">
                                {{trans('msg.register')}}
                            </a>
                            <span class="or-text"> {{trans('msg.or')}}</span>
                            <a class="login" href="{{route('login')}}" rel="nofollow" title="Log in to your customer account">
                               {{trans('msg.login')}}
                            </a>
                        @endguest
                        @auth()


                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{trans('msg.logout')}}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        @endauth
                    </div>
                   {{--  <div id="_desktop_currency_selector"
                         class="currency-selector groups-selector hidden-sm-down currentcy-selector-dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                             role="main">
                            <span class="expand-more">GBP</span>
                        </div>
                        <div class="currency-list dropdown-menu">
                            <div class="currency-list-content text-left">
                                <div class="currency-item current flex-first">
                                    <a title="British Pound" rel="nofollow"
                                       href="index-1.htm?home=home_3&amp;SubmitCurrency=1&amp;id_currency=1">£ GBP</a>
                                </div>
                                <div class="currency-item">
                                    <a title="US Dollar" rel="nofollow"
                                       href="index-2.htm?home=home_3&amp;SubmitCurrency=1&amp;id_currency=2">$ USD</a>
                                </div>
                            </div>
                        </div>
                    </div>
 --}}
                    <div id="_desktop_language_selector"
                         class="language-selector groups-selector hidden-sm-down language-selector-dropdown">
                         <div class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                        <span class="mr-1">
                            <span class="user-name text-bold-700">{{app()->getLocale()==='ar'?trans('msg.ar') : trans('msg.en')}}</span>
                        </span>
                            </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                            <div class="dropdown-divider"></div>

                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
