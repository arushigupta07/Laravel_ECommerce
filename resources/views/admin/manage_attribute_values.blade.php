@extends('admin/layout')
@section('page_title','Manage Product')
@section('attribute_values_select','active')
@section('container')

    <h1 class="mb10">Manage Values</h1>
    <a href="{{url('admin/attribute_values')}}">
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
                            <form action="{{route('attribute_values.manage_attribute_values_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">  
                                    <label for="product_id" class="control-label mb-1"> Product</label>
                              <select id="product_id" name="product_id" class="form-control" required>
                                 <option value="">Select Product</option>
                                 @foreach($product as $list)
                                 @if($product_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->product_name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>    
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
                                        <input type="checkbox" name="attribute[$attributes->id]" value="{{$attributes->id}}"> {{$attributes->attribute_name}}</input>
   <input id="value" value="{{ $value }}" name="value[$attributes->id]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>

   
   @endforeach
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