@extends('frontend.index')
@section('frontend')
<!-- ===== ======== HEADER : END ============================================== -->
<!-- <div class="breadcrumb">
   <div class="container">
      <div class="breadcrumb-inner">
         <ul class="list-inline list-unstyled">
            <li><a href="#">Home</a></li>
            <li><a href="#">Clothing</a></li>
            <li class='active'>Floral Print Buttoned</li>
         </ul>
      </div>
   </div>
</div> -->
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
   <div class='container'>
      <div class='row single-product'>
         <!-- /.sidebar -->
         <div class='col-md-12'>
            <div class="detail-block">
               <div class="row  wow fadeInUp">
                  <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                     <div class="product-item-holder size-big single-product-gallery small-gallery">
                        <div id="owl-single-product">
                        	@foreach($product->media as $key => $image)
                           <div class="single-product-gallery-item" id="slide1">
                              <a data-lightbox="image-1" data-title="Gallery" href="{{url($image->image)}}">
                              <img class="img-responsive" alt="" src="{{url($image->image)}}" data-echo="{{url($image->image)}}" />
                              </a>
                           </div>
                           @endforeach
                           <!-- /.single-product-gallery-item -->
                        </div>
                        <!-- /.single-product-slider -->
                        <div class="single-product-gallery-thumbs gallery-thumbs">
                           <div id="owl-single-product-thumbnails">
                           	@foreach($product->media as $key => $image)
                              <div class="item">
                                 <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
                                 <img class="img-responsive" width="85" alt="" src="{{url($image->image)}}" data-echo="{{url($image->image)}}" />
                                 </a>
                              </div>
                              @endforeach
                           </div>
                           <!-- /#owl-single-product-thumbnails -->
                        </div>
                        <!-- /.gallery-thumbs -->
                     </div>
                     <!-- /.single-product-gallery -->
                  </div>
                  <!-- /.gallery-holder -->        			
                  <div class='col-sm-6 col-md-7 product-info-block'>
                     <div class="product-info">
                        <h1 class="name">{{$product->name}}</h1>
                        <div class="rating-reviews m-t-20">
                           <div class="row">
                           </div>
                           <!-- /.row -->		
                        </div>
                        <!-- /.rating-reviews -->
                        <div class="stock-container info-container m-t-10">
                           <div class="row">
                              <div class="col-sm-2">
                                 <div class="stock-box">
                                    <span class="label">Availability :</span>
                                 </div>
                              </div>
                              <div class="col-sm-9">
                                 <div class="stock-box">
                                    <span class="value">In Stock</span>
                                 </div>
                              </div>
                           </div>
                           <!-- /.row -->	
                        </div>
                        <!-- /.stock-container -->
                        <div class="description-container m-t-20">
                           {{$product->description}}
                        </div>
                        <!-- /.description-container -->
                        <div class="price-container info-container m-t-20">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="price-box">
                                    <span class="price">${{$product->price}}</span>
                                    <!-- <span class="price-strike">$900.00</span> -->
                                 </div>
                              </div>
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- /.price-container -->
                        <div class="quantity-container info-container">
                           <div class="row">
                              <div class="col-sm-2">
                                 <!-- <span class="label">Qty :</span> -->
                              </div>
                              <div class="col-sm-2">
                                 <!-- <div class="cart-quantity">
                                    <div class="quant-input">
                                       <div class="arrows">
                                          <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                          <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                       </div>
                                       <input type="text" value="1">
                                    </div>
                                 </div> -->
                              </div>
                              <div class="col-sm-7">
                                 @if(Auth::check())
                                 <a href="javascript:void(0)" class="btn btn-primary" onclick="AddToCard('{{$product->id}}')"><i class="fa fa-shopping-cart inner-right-vs"></i> {{_TR_('Add to cart')}}</a>
                                 @endif
                              </div>
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- /.quantity-container -->
                     </div>
                     <!-- /.product-info -->
                  </div>
                  <!-- /.col-sm-7 -->
               </div>
               <!-- /.row -->
            </div>
            <div class="product-tabs inner-bottom-xs  wow fadeInUp">
               <div class="row">
                  <div class="col-sm-3">
                     <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                        <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                     </ul>
                     <!-- /.nav-tabs #product-tabs -->
                  </div>
                  <div class="col-sm-9">
                     <div class="tab-content">
                        <div id="description" class="tab-pane in active">
                           <div class="product-tab">
                              <p class="text">{{$product->description}}</p>
                           </div>
                        </div>
                     </div>
                     <!-- /.tab-content -->
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
         </div>
         <!-- /.col -->
         <div class="clearfix"></div>
      </div>
      <!-- /.row -->
      <!-- ==== ================== BRANDS CAROUSEL ============================================== -->
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
      <!-- == = BRANDS CAROUSEL : END = -->	
   </div>
   <!-- /.container -->
</div>
<!-- /.body-content -->
@endsection