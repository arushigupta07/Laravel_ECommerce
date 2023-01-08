@extends('front/layout')
@section('page_title',$product[0]->product_name)
@section('container')

   
<!-- Start header section -->
<header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                <div class="account-dropdown__footer">
                                            <a class="dropdown-item" href="{{url('/home')}}">
                                       Home
                                    </a>                                   
                                            </div>               

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(session()->has('message'))
<div class="alert alert-danger" style="mb-2">
  <button type="button" class="close" data-dismiss="alert">x</button>
    {{session()->get('message')}};
</div>
@endif
    <!-- / header top  -->
  <!-- catg header banner section -->
  <!--<section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>T-Shirt</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li><a href="#">Product</a></li>
          <li class="active">T-shirt</li>
        </ol>
      </div>
     </div>
   </div>
  </section>-->
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                          <a data-big-image="{{asset('storage/media/'.$product[0]->image)}}" data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#"><img src="{{asset('storage/media/'.$product[0]->image)}}" width="70px">
                          </a>   

                          @if(isset($product_images[$product[0]->id][0]))

                            @foreach($product_images[$product[0]->id] as $list)
                            
                            <a data-big-image="{{asset('storage/media/'.$list->images)}}" data-lens-image="{{asset('storage/media/'.$list->images)}}" class="simpleLens-thumbnail-wrapper" href="#"><img src="{{asset('storage/media/'.$list->images)}}" width="70px">
                            </a>  
                            
                            @endforeach

                          @endif
                                                   
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                  @foreach($product as $productArr)
                  <span style="color:red"><h1>{{$productArr->product_name}}</h1></span>
                    <div class="aa-price-block">
                    <!-- <h3>Rs {{$product_attr[$productArr->id][0]->value}}</h3>
                    </div>
                    <div class="aa-price-block">
                    <h3>Color: {{$product_attr[$productArr->id][1]->value}}</h3>
                    </div>
                    @if($product_attr[$productArr->id][2]->value!='')
                    <div class="aa-price-block">
                    <h3>Size: {{$product_attr[$productArr->id][2]->value}}</h3>
                    </div>      
                    @endif               -->
               @endforeach                  
                  
                  </div>
                  
                  @if($product_attr[$product[0]->id][0]->p_attr_id>0)                   
                   
                    <div class="aa-color-tag">
                      @foreach($product_attr[$product[0]->id] as $attr)  
                      
                      @if($attr->value!='')
                     {{$attr->attribute_name}}:
                     <span style="color:red">{{$attr->value}}</span>
                      <br>
                      @endif 

                      @endforeach  
                    </div>
                    @endif    
                    <div class="aa-prod-view-bottom">
                     <form action="{{url('addToCart',$product[0]->id)}}" method="POST">

                     @csrf 
                     <input type="number" value="1"  class="form-control" name="quantity"
                      placeholder="quantity" style="width:50px">
                      <br>
                      <input class="btn btn-danger" type="submit" value="Add to Cart">
                    </div>
                    <div id="add_to_cart_msg"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>                
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
               
                 
                   <!-- <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <select class="form-control" name="rating" required>
                      <option value="">Select Rating</option>
                      <option>Worst</option>
                      <option>Bad</option>
                      <option>Good</option>
                      <option>Very Good</option>
                      <option>Fantastic</option>
                     </select>
                   </div> -->
                   <!-- review form -->
                   
                      <!-- <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3"  name="review" required></textarea>
                      </div>
                      
                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                      <input type="hidden" name="product_id" value="{{$product[0]->id}}"/>
                      @csrf
                   </form>
                   <div class="review_msg"></div>
                 </div>
                </div>            
              </div>
            </div> -->
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
               
              @if(isset($related_product[0]))
                    @foreach($related_product as $productArr)
                    <li>
                        <figure>
                        <a class="aa-product-img" href="{{url('product/'.$productArr->id)}}"><img src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->product_name}}" width="120px"></a>                        
                        <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->id)}}">{{$productArr->product_name}}</a></h4>
                            <span class="aa-product-price">Rs {{$related_product_attr[$productArr->id][0]->value}}</span><span class="aa-product-price">
                        </figure>                          
                    </li>  
                    @endforeach    
                    @else
                    <li>
                        <figure>
                        No data found
                        <figure>
                    <li>
                    @endif      
                
                                 
              </ul>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <form id="frmAddToCart">
   
    <input type="hidden" id="pqty" name="pqty"/>
    <input type="hidden" id="product_id" name="product_id"/>           
    @csrf
  </form>
@endsection