<?php

namespace App\Models;
use App\Models\AttributeValues;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use HasFactory;
    public function attributeValues(){
        return $this->hasMany(AttributeValues::class,'product_id','id');
    }
    public static function getvalues(){
        $arr=AttributeValues->get('value'); 
        return $arr;
    }

    public function manage_product_process(Request $request)
    {
   // return $request->post();
       
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
        
    }
}

    public function status(Request $request,$status,$id){
        $model=self::find($id);
        $model->status=$status;
        $model->save();
        
    }   
}
