@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')
@if($id>0)
   @php
      $image_required="";
   @endphp
   @else
   @php
      $image_required="required";
   @endphp
@endif

    <h1 class="mb10">Manage Product</h1>
    <a href="{{url('admin/product')}}">
        <button type="button" class="btn btn-success">
            Back
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">                                  
   
                                            <label for="product_name" class="control-label mb-1">Product Name</label>
                                            <input id="product_name" value="{{ $product_name }}" name="product_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        </div>                                      
                                     
                                    </div>
                                    
                                </div>    
                                <div class="form-group">
                        <label for="image" class="control-label mb-1">Product Image</label>
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}		
                        </div>
                        @enderror
                        @if($image!='')
                           <a href="{{asset('storage/media/'.$image)}}" target="_blank"><img width="100px" src="{{asset('storage/media/'.$image)}}"/></a>
                        @endif
                     </div>
                        <div class="row">
                             <div class="col-md-4">
                              <label for="category_id" class="control-label mb-1"> Category</label>
                              <select id="category_id" name="category_id" class="form-control" required>
                                 <option value="">Select Categories</option>
                                 @foreach($category as $list)
                                 @if($category_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->category_name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>                  

                        
                                     
                                    </div>
                                    <div class="row m-t-30">
        <div class="col-md-12">

        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                            
                                <div class="form-group">
                               
                                        <b>Product Attributes</b>
                                        <hr>
                                        <div class="row">
                                        <div class="col-md-4">   
                                        
                                        @foreach($attribute as $attributes)                                        

                                        <input type="checkbox" name="attribute" value="{{$attributes->id}}"> {{$attributes->attribute_name}}</input>
   <input id="value" name="value[{{$attributes->id}}]"  type="text" class="form-control" aria-required="true" aria-invalid="false">

</input>

   @endforeach
                                        </div>                                      
                                     
                                    </div>
   
                                          
                                    
                                </div>                          
                                    

                        
          
                              
                                </div>        


       
                                </div>                          
                                
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        Submit
                                    </button>
                                </div>
                                
                                <input type="hidden" name="id" value="{{ $id }}" />
                            </form>

                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
                        
@endsection