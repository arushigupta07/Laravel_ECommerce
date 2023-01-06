<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute_name',
        
    ];
public function postAttribute(Request $request)
    {
       //return $request->post();       
       

        if($request->post('id')>0){
            $model=ProductAttribute::find($request->post('id'));
            $msg="ProductAttribute updated";
        }else{
            $model=new ProductAttribute();
            $msg="ProductAttribute inserted";
        }             
        $model->attribute_name=$request->post('attribute_name');       
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);         
        
    }

public function deleteData($id){        
        $model=self::find($id);
        $model->delete();        
    }    
public function statusData(Request $request,$status,$id){
        $model=self::find($id);
        $model->status=$status;
        $model->save();       
    }   
}
