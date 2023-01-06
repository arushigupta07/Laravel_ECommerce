<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Validator;

class ProductAttributeController extends Controller
{
    public function index()
    {
        $result['data']=ProductAttribute::all();
        return view('admin/attribute',$result);
    }    
    public function manageAttribute(Request $request,$id='')
    {
        if($id>0){
            $arr=ProductAttribute::where(['id'=>$id])->get(); 
            $result['attribute_name']=$arr['0']->attribute_name;           
            $result['id']=$arr['0']->id;

         $result['attribute']=DB::table('product_attributes')->where(['status'=>1])->where('id','!=',$id)->get();
        }
        else{
            $result['attribute_name']='';
            $result['id']=0;
           $result['attribute']=DB::table('product_attributes')->where(['status'=>1])->get();
            
        }
        // echo '<pre>';       
        // print_r($result);
        // die();
        return view('admin/manage_attribute',$result);     
      
    }

    public function manageAttributeProcess(Request $request)
    {
       //return $request->post();       
        $request->validate([
            'attribute_name'=>'required'     
            
        ]);
        $attr=new ProductAttribute();
        $attr->postAttribute($request);
         return redirect('admin/attribute');
        
    }    
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     * Delete Attribute
     */
    public function delete(Request $request, $id){
        $att=new ProductAttribute();
       // $delData=$request->get();
        $att->deleteData($id);
        $request->session()->flash('message','ProductAttribute deleted');
        return redirect('admin/attribute');
    }  
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $status
     * @param [type] $id
     * @return void
     * 
     * attribute status 0-deactive 1-active
     */
    public function status(Request $request,$status,$id){
        $att=new ProductAttribute();
        $att->statusData($request,$status,$id);
        $request->session()->flash('message','ProductAttribute status updated');
        return redirect('admin/attribute');
    }   
    
    
}
