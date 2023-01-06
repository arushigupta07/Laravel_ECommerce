@extends('admin/layout')
@section('page_title','Attribute')
@section('attribute_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif                     
    <h1 class="mb10">Attributes</h1>
    <a href="{{url('admin/attribute/manage_attribute')}}">
        <button type="button" class="btn btn-success">
            Add Attribute
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
                            <th>Attribute Name</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->attribute_name}}</td>
                           <td>
                                <a href="{{url('admin/attribute/manage_attribute/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>
                                <a href="{{url('admin/attribute/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>

                                @if($list->status==1)
                                    <a href="{{url('admin/attribute/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Deactivate</button></a>
                                 @elseif($list->status==0)
                                    <a href="{{url('admin/attribute/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Activate</button></a>
                                @endif 

                                
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