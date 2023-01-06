@extends('admin/layout')
@section('page_title','Manage Category')
@section('category_select','active')
@section('container')
    <h1 class="mb10">Manage Category</h1>
    <a href="{{url('admin/category')}}">
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
                            <form action="{{route('category.manageCategoryProcess')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">                                     
   
                                            <label for="category_name" class="control-label mb-1">Category Name</label>
                                            <input id="category_name" value="{{ $category_name }}" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            
                                     
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