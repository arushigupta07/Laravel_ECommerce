@extends('admin/layout')
@section('page_title','Attribute Values')
@section('attribute_values_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif                     
    <h1 class="mb10">Product Attribute Values</h1>
    <a href="{{url('admin/attribute_values/manage_attribute_values')}}">
        <button type="button" class="btn btn-success">
            Add Values
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Attribute Value</th> 
                            <th>Product ID</th>
                            <th>Attribute ID</th>                            
                                                       
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->value}}</td>                                                      
                            <td>
                            {{$list->product_id}}
                            </td>
                            <td>
                            {{$list->p_attr_id}}
                            </td>
                            <td>
                                <a href="{{url('admin/attribute_values/manage_attribute_values/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>

                                @if($list->status==1)
                                    <a href="{{url('admin/attribute_values/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                                 @elseif($list->status==0)
                                    <a href="{{url('admin/attribute_values/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                                @endif

                                <a href="{{url('admin/attribute_values/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection