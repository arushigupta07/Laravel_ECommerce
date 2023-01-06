<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\AttributeValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;


class ProductController extends Controller
{
    public function index()
    {
        $result=Product::all();
        $pattributes=ProductAttribute::all();
        $attribute_values=AttributeValues::all();
        //return view('admin/product',[$result,$attributes]);
        return view('admin/product',['result'=>$result,'pattributes'=>$pattributes,'attribute_values'=>$attribute_values]);
    }

    
    public function manage_product(Request $request,$id='')
    {
        if($id>0){
           // return $request->post();
            $arr=Product::where(['id'=>$id])->get(); 
            $result['product_name']=$arr['0']->product_name; 
            $result['category_id']=$arr['0']->category_id;                        
            $result['image']=$arr['0']->image;          
            $result['id']=$arr['0']->id;

         $result['category']=DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get();
         $result['attribute']=DB::table('product_attributes')->where(['status'=>1])->where('id','!=',$id)->get();
         $result['attribute_values']=DB::table('attribute_values')->where(['status'=>1])->first();
        }
        else{
            $result['product_name']='';
            $result['category_id']='';            
            $result['image']='';
            $result['id']=0;

           $result['category']=DB::table('categories')->where(['status'=>1])->get();
           $result['attribute']=DB::table('product_attributes')->where(['status'=>1])->get();
           $result['attribute_values']=DB::table('attribute_values')->where(['status'=>1])->get(); 
        }
       // dd($result['category']);
        // echo '<pre>';       
        // print_r($result);
        // die();

        return view('admin/manage_product',$result);
        
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function manage_product_process(Request $request)
    {
   // return $request->post();
       if($request->post('id')>0){
        $image_validation="mimes:jpeg,jpg,png";
    }else{
        $image_validation="required|mimes:jpeg,jpg,png";
    }
        
        $request->validate([
            'product_name'=>'required'  ,
            'image'=>$image_validation    
            
        ]);

        if($request->post('id')>0){
            $model=Product::find($request->post('id'));
            $msg="Product updated";
        }else{
            $model=new Product();
            $msg="Product inserted";
        }
        if($request->hasfile('image')){           
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }
        $model->category_id=$request->post('category_id');    
        $model->product_name=$request->post('product_name');       
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);

       if($request->value){
       
        //dd($request);
        foreach($request->value as $key=>$attributes){
           //dd($request->value);
            $valuesArray[]=array(                
                    'product_id'=>$model->id,
                    'p_attr_id'=>$key,                    
                    'value'=>$request->value[$key]
            );            
            }
           // dd( $valuesArray);
            $model->attributeValues()->createMany(
                $valuesArray  
            );       
        
        
           // foreach($request->attribute as $key=>$attributes){
               // $valueRes=$request->value[$attributes][$i];
                //dd($request->value[$key][$i] );          
                             // for ($i = 1; $i < count($request->attribute); $i++) {
                //     $values[] = [
                //         'product_id' => $model->id,
                //         'p_attr_id' => $request->attribute[$i],
                //         'value' => $request->value[$i]
                //     ];
                // }
            
                // AttributeValues::insert($values);
                
         return redirect('admin/product');
            
              //}
    }
}
    public function delete(Request $request,$id){
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('message','Product deleted');
        return redirect('admin/product');
    }    

   
    public function status(Request $request,$status,$id){
        $prod=new Product();
        $prod->status($request,$status,$id);
        $request->session()->flash('message','Product status updated');
        return redirect('admin/product');
    }   
    
}
// value="{{ App\Models\Product::getvalues()}}"
