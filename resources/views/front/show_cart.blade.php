@extends('front/layout')
@section('page_title','My Cart')
@section('container')
<div class="aa-product-catg-body">
                  <ul class="aa-product-catg">
                     <!-- start single product item -->
                     
                     @if(isset($product[0]))
                     
                       @foreach($product as $productArr)                       
                        <li>
                          <figure>                           
                          <a class="aa-product-img" href="{{url('product/'.$productArr->id)}}"><img src="{{asset('storage/media/'.$productArr->image)}}" alt="{{$productArr->product_name}}" style="width:90%"></a>
                            <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->id)}}">{{$productArr->product_name}}</a></h4>     
                              <span class="aa-product-price">Rs {{$product_attr[$productArr->id][$i]->value}}</span>
                              
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
                  <!-- quick view modal -->                  
               </div>
            </div>
         </div>