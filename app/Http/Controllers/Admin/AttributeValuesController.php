<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\AttributeValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class AttributeValuesController extends Controller
{
    public function home()
    {
        $result=AttributeValues::all();
        return view('admin/attribute_values',$result);        
    }

    
    public function manage_attribute_values(Request $request,$id='')
    {
        if($id>0){
           //return $request->post();
            $arr=AttributeValues::where(['id'=>$id])->get(); 
            $result['value']=$arr['0']->value; 
            $result['product_id']=$arr['0']->product_id;                        
            $result['p_attr_id']=$arr['0']->p_attr_id;          
            $result['id']=$arr['0']->id;

         $result['product']=DB::table('products')->where(['status'=>1])->where('id','!=',$id)->get();
         $result['attribute']=DB::table('product_attributes')->where(['status'=>1])->where('id','!=',$id)->get();
        }
        else{
            $result['value']='';
            $result['product_id']=''; 
            $result['p_attr_id']='';         
            $result['id']=0;

           $result['product']=DB::table('products')->where(['status'=>1])->get();
           $result['attribute']=DB::table('product_attributes')->where(['status'=>1])->get();
            
        }
        // echo '<pre>';       
        // print_r($result);
        // die();

        return view('admin/manage_attribute_values',$result);
        
    }

    public function manage_attribute_values_process(Request $request)
    {
      return $request->post();
      
       

        // if($request->post('id')>0){
        //     $model=AttributeValues::find($request->post('id'));
        //     $msg="AttributeValues updated";
        // }else{
        //     $model=new AttributeValues();
        //     $msg="AttributeValues inserted";
        // }

        if($request->attribute){
            foreach($request->attribute as $key=>$attributes){
                // $model->attributeValues()->createMany([
                //     'product_id'=>$request->product_id,
                //     'p_attr_id'=>$attributes,
                //     'value'=>$request->value[$key]??0
                // ]);
                  $model=new AttributeValues();
                  $model->product_id=$request['product_id'];
                  $model->p_attr_id=$request['p_attr_id'];
                  $model->value=$request['value[$key]'];
                  $model->save();
                
            }
        }
            
        
        
        //$p_attr_id=$attribute->id;
        //$model->product_id=$request->post('product_id');    
       // $model->value=$request->post('value');   
        //$model->p_attr_id=$p_attr_id;      
        //$model->status=1;
        //$model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/attribute_values');
    
    }

    public function delete(Request $request,$id){
        $model=AttributeValues::find($id);
        $model->delete();
        $request->session()->flash('message','attribute_values deleted');
        return redirect('admin/attribute_values');
    }    

    public function status(Request $request,$status,$id){
        $model=AttributeValues::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','attribute_values status updated');
        return redirect('admin/attribute_values');
    }   
    
}
