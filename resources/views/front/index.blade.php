@extends('front/layout')
@section('page_title','Home Page')
@section('container')


  <!-- / slider -->
  <!-- Start Promo section -->    
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
          <div class="row">
  <div class="col-12 col-sm-6 col-md-8">
                <div class="aa-promo-right">
                  @foreach($home_categories as $list)
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                     <img src="{{asset('storage/media/1673004793.jpg')}}" alt="logo img" width="10%">
                      <div class="aa-prom-content">
                        <h4><a href="{{url('category/'.$list->id)}}">{{$list->category_name}}</a></h4>                        
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
   <!-- Products section -->
   <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                 @foreach($home_categories as $list)
                    <li class=""><a href="#cat{{$list->id}}" in active data-toggle="tab">{{$list->category_name}}</a></li>
                 @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    @php
                    $loop_count=1;
                    @endphp
                    @foreach($home_categories as $list)
                    @php
                    $cat_class="";
                    if($loop_count==1){
                      $cat_class="in active"; 
                      $loop_count++;
                    }
                    @endphp    
                    <div class="tab-pane fade {{$cat_class}}" id="cat{{$list->id}}">
                      <ul class="aa-product-catg">
                      @if(isset($home_categories_product[$list->id][0]))
                       @foreach($home_categories_product[$list->id] as $productArr)
                        <li>
                          <figure>                           
                          <a class="aa-product-img" href="{{url('product/'.$productArr->id)}}"><img src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->product_name}}" style="width:10%"></a>
                            <figcaption>
                              <h4 ><a href="{{url('product/'.$productArr->id)}}">{{$productArr->product_name}}</a></h4>                            
                            </figcaption>
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
                    @endforeach
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
               
@endsection
