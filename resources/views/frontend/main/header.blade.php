<header class="header-style-1">
   <!-- ============================================== TOP MENU ============================================== -->
   <div class="top-bar animate-dropdown">
      <div class="container">
         <div class="header-top-inner">
            <div class="cnt-account">
               <ul class="list-unstyled">
                  @if(Auth::check() && Auth::user()->admin == 1)
                  <li><a href="{{route('dashboard')}}"><i class="icon fa fa-user"></i>{{_TR_('Admin Panel')}}</a></li>
                  @endif
                  @if(!Auth::check())
                  <li><a href="{{route('login')}}"><i class="icon fa fa-lock"></i>{{_TR_('Login')}}</a></li>
                  <li><a href="{{route('register')}}"><i class="icon fa fa-lock"></i>{{_TR_('Register')}}</a></li>
                  @else
                  <li><a href="{{route('logout')}}"><i class="icon fa fa-lock"></i>{{_TR_('Logout')}}</a></li>
                  @endif
               </ul>
            </div>
            <!-- /.cnt-account -->
            <div class="cnt-block">
               <ul class="list-unstyled list-inline">
                  <!-- <li class="dropdown dropdown-small">
                     <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li><a href="#">USD</a></li>
                        <li><a href="#">INR</a></li>
                        <li><a href="#">GBP</a></li>
                     </ul>
                  </li> -->
                  <li class="dropdown dropdown-small">
                     <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">{{GetCurrentLang()}} </span><b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li><a href="{{route('update_lang','english')}}">English</a></li>
                        <li><a href="{{route('update_lang','arabic')}}">Arabic</a></li>
                     </ul>
                  </li>
               </ul>
               <!-- /.list-unstyled --> 
            </div>
            <!-- /.cnt-cart -->
            <div class="clearfix"></div>
         </div>
         <!-- /.header-top-inner --> 
      </div>
      <!-- /.container --> 
   </div>
   <!-- /.header-top --> 
   <!-- ============================================== TOP MENU : END ============================================== -->
   <div class="main-header">
      <div class="container">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
               <!-- ============================================================= LOGO ============================================================= -->
               <div class="logo"> <a href="home.html"> <img src="{{ asset('') }}frontend/assets/images/logo.png" alt="logo"> </a> </div>
               <!-- /.logo --> 
               <!-- ============================================================= LOGO : END ============================================================= --> 
            </div>
            <!-- /.logo-holder -->
            <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
               <!-- /.contact-row --> 
               <!-- ============================================================= SEARCH AREA ============================================================= -->
               <div class="search-area">
                  <form>
                     <div class="control-group">
                        <input class="search-field" placeholder="Search here..." />
                        <a class="search-button" href="javascript:void(0)" ></a> 
                     </div>
                  </form>
               </div>
               <!-- /.search-area --> 
               <!-- ============================================================= SEARCH AREA : END ============================================================= --> 
            </div>
            <!-- /.top-search-holder -->
            <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
               <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
               @if(Auth::check())
               <div class="dropdown dropdown-cart">
                  <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                     <div class="items-cart-inner">
                        <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                        <div class="basket-item-count"><span class="count total_count">0</span></div>
                        <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price"> <span class="value total_price">$0</span> </span> </div>
                     </div>
                  </a>
                  <ul class="dropdown-menu">
                     <li>
                        <div class="cart-item product-summary all_cart">
                           
                        </div>
                        <!-- /.cart-item -->
                        <div class="clearfix"></div>
                        <hr>
                        <div class="clearfix cart-total">
                           <div class="pull-right"> <span class="text">Sub Total :</span><span class='price total_price'>$0</span> </div>
                           <div class="clearfix"></div>
                           <a href="{{route('stripe_pay')}}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> 
                        </div>
                        <!-- /.cart-total--> 
                     </li>
                  </ul>
                  <!-- /.dropdown-menu--> 
               </div>
               @endif
               <!-- /.dropdown-cart --> 
               <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> 
            </div>
            <!-- /.top-cart-row --> 
         </div>
         <!-- /.row --> 
      </div>
      <!-- /.container --> 
   </div>
   <!-- /.main-header --> 
   <!-- ============================================== NAVBAR ============================================== -->
   
   <!-- /.header-nav --> 
   <!-- ============================================== NAVBAR : END ============================================== --> 
</header>