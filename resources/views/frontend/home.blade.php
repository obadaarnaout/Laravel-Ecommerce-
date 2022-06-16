@extends('frontend.index')
@section('frontend')
<div class="body-content outer-top-xs" id="top-banner-and-menu">
   <div class="container">
      <div class="row">
         <!-- ============================================== SIDEBAR ============================================== -->
         <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
            <!-- ================================== TOP NAVIGATION ================================== -->
            <div class="side-menu animate-dropdown outer-bottom-xs">
               <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> {{_TR_('Categories')}}</div>
               <nav class="yamm megamenu-horizontal">
                  <ul class="nav">
                     @foreach($categories as $key => $category)
                     <li class="dropdown menu-item">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">{{$category->name}}</a>
                        @if(!empty($category->sub_category))
                        <ul class="dropdown-menu mega-menu">
                           <li class="yamm-content">
                              <div class="row">
                                 <div class="col-sm-12 col-md-3">
                                    <ul class="links list-unstyled">
                                       @foreach($category->sub_category as $sub)
                                       <li><a href="javascript:void(0)">{{$sub->name}}</a></li>
                                       @endforeach
                                    </ul>
                                 </div>
                              </div>
                              <!-- /.row --> 
                           </li>
                           <!-- /.yamm-content -->
                        </ul>
                        @endif
                        <!-- /.dropdown-menu --> 
                     </li>
                     @endforeach
                     <!-- /.menu-item -->
                  </ul>
                  <!-- /.nav --> 
               </nav>
               <!-- /.megamenu-horizontal --> 
            </div>
         </div>
         <!-- /.sidemenu-holder --> 
         <!-- ============================================== SIDEBAR : END ============================================== --> 
         <!-- ============================================== CONTENT ============================================== -->
         <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
            <!-- ========================================== SECTION – HERO ========================================= -->
            <div id="hero">
               <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                  @foreach($sliders as $key => $slider)
                  <div class="item" style="background-image: url({{url($slider->image)}});">
                     <div class="container-fluid">
                        <div class="caption bg-color vertical-center text-left">
                           <div class="slider-header fadeInDown-1"></div>
                           <div class="big-text fadeInDown-1"> {{$slider->title}} </div>
                           <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{$slider->description}}</span> </div>
                        </div>
                        <!-- /.caption --> 
                     </div>
                     <!-- /.container-fluid --> 
                  </div>
                  @endforeach
                  <!-- /.item -->
                  <!-- /.item --> 
               </div>
               <!-- /.owl-carousel --> 
            </div>
            <!-- ========================================= SECTION – HERO : END ========================================= --> 
            <!-- ============================================== INFO BOXES ============================================== -->
            <div class="info-boxes wow fadeInUp">
               <div class="info-boxes-inner">
                  <div class="row">
                     <div class="col-md-6 col-sm-4 col-lg-4">
                        <div class="info-box">
                           <div class="row">
                              <div class="col-xs-12">
                                 <h4 class="info-box-heading green">money back</h4>
                              </div>
                           </div>
                           <h6 class="text">30 Days Money Back Guarantee</h6>
                        </div>
                     </div>
                     <!-- .col -->
                     <div class="hidden-md col-sm-4 col-lg-4">
                        <div class="info-box">
                           <div class="row">
                              <div class="col-xs-12">
                                 <h4 class="info-box-heading green">free shipping</h4>
                              </div>
                           </div>
                           <h6 class="text">Shipping on orders over $99</h6>
                        </div>
                     </div>
                     <!-- .col -->
                     <div class="col-md-6 col-sm-4 col-lg-4">
                        <div class="info-box">
                           <div class="row">
                              <div class="col-xs-12">
                                 <h4 class="info-box-heading green">Special Sale</h4>
                              </div>
                           </div>
                           <h6 class="text">Extra $5 off on all items </h6>
                        </div>
                     </div>
                     <!-- .col --> 
                  </div>
                  <!-- /.row --> 
               </div>
               <!-- /.info-boxes-inner --> 
            </div>
            <!-- /.info-boxes --> 
            <!-- ============================================== INFO BOXES : END ============================================== --> 
            <!-- ============================================== SCROLL TABS ============================================== -->
            <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
               <div class="more-info-tab clearfix ">
                  <h3 class="new-product-title pull-left">{{_TR_('Products')}}</h3>
                  <!-- /.nav-tabs --> 
               </div>
               <div class="tab-content outer-top-xs">
                  <div class="tab-pane in active" id="all">
                     <div class="product-slider">
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                           @foreach($products as $key => $product)
                           <div class="item item-carousel">
                              <div class="products">
                                 <div class="product">
                                    <div class="product-image">
                                       <div class="image"> <a href="{{route('show_product',$product->id)}}"><img  src="{{url($product->thumb)}}" alt=""></a> </div>
                                       <!-- /.image -->
                                       <!-- <div class="tag new"><span>new</span></div> -->
                                    </div>
                                    <!-- /.product-image -->
                                    <div class="product-info text-left">
                                       <h3 class="name"><a href="{{route('show_product',$product->id)}}">{{$product->name}}</a></h3>
                                       <div class="rating rateit-small"></div>
                                       <div class="description"></div>
                                       <div class="product-price"> <span class="price"> ${{$product->price}} </span> <!-- <span class="price-before-discount">$ 800</span> --> </div>
                                       <!-- /.product-price --> 
                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                       <div class="action">
                                          <ul class="list-unstyled">
                                             @if(Auth::check())
                                             <li class="add-cart-button btn-group">
                                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart" onclick="AddToCard('{{$product->id}}')"> <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button" onclick="AddToCard('{{$product->id}}')">{{_TR_('Add to cart')}}</button>
                                             </li>
                                             @endif
                                             <!-- <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                             <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li> -->
                                          </ul>
                                       </div>
                                       <!-- /.action --> 
                                    </div>
                                    <!-- /.cart --> 
                                 </div>
                                 <!-- /.product --> 

                              </div>
                              <!-- /.products --> 
                           </div>
                           @endforeach
                           <!-- /.item -->
                        </div>
                        <!-- /.home-owl-carousel --> 
                     </div>
                     <!-- /.product-slider --> 
                  </div>
               </div>
               <!-- /.tab-content --> 
            </div>
         </div>
         <!-- /.homebanner-holder --> 
         <!-- ============================================== CONTENT : END ============================================== --> 
      </div>
      <!-- /.row --> 
      <!-- ============================================== BRANDS CAROUSEL ============================================== -->
      <div id="brands-carousel" class="logo-slider wow fadeInUp">
         <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
               @foreach($brands as $brand)
               <div class="item m-t-15"> <a href="javascript:void(0)" class="image"> <img data-echo="{{ url($brand->image) }}" src="{{ url($brand->image) }}" alt=""> </a> </div>
               @endforeach
            </div>
            <!-- /.owl-carousel #logo-slider --> 
         </div>
         <!-- /.logo-slider-inner --> 
      </div>
      <!-- /.logo-slider --> 
      <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> 
   </div>
   <!-- /.container --> 
</div>
@endsection