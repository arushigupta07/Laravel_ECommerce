@extends('admin/layout')
@section('page_title','Manage Attribute')
@section('attribute_select','active')
@section('container')
    <h1 class="mb10">Manage Attribute</h1>
    <a href="{{url('admin/attribute')}}">
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
                                        <form action="{{route('attribute.manageAttributeProcess')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="attribute" class="control-label mb-1">Attribute Name</label>
                                                <input id="attribute" value="{{$attribute_name}}" name="attribute_name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                @error('attribute')
                                                <div class="alert alert-danger" role="alert">
                                                    {{$message}}		
                                                </div>
                                                @enderror
                                            </div>
                                            
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    Submit
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" value="{{$id}}"/>
                                        </form>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                        
        </div>
    </div>
                        
@endsection