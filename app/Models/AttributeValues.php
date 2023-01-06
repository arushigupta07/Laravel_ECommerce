<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValues extends Model
{
    use HasFactory;
    protected $table='attribute_values';
    protected $fillable = [
        'product_id',
        'p_attr_id',
        'value',
        
    ];
    // public function attributeValues(){
    //     return $this->hasMany(AttributeValues::class,'product_id','id');
    // }
    // public function attribute_value_process(Request $request)
    // {
    //    //return $request->post();
       

    //     if($request->post('id')>0){
    //         $model=ProductAttribute::find($request->post('id'));
    //         $msg="ProductAttribute updated";
    //     }else{
    //         $model=new AttributeValue();
    //         $msg="Attribute value inserted";
    //     }
    //     $result['attribute']=DB::table('product_attributes')->where(['status'=>1])->get();
    //     $pid=$attribute->$id
    //    // $attribute_id->$attribute_value
    //     @foreach($attribute as $list)  
    //     $arr[]=['$attribute->$id' => '$model->$attribute_value']
    //     $model->attr_values()->createMany($arr);              
    //     $request->session()->flash('message',$msg);
    //      return redirect('admin/attribute');
        
    // }


}
