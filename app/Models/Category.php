<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',        
    ];   
  
    public function postCategory(Request $request)
    {
       //return $request->post();        
        if($request->post('id')>0){
            $model=self::find($request->post('id'));
             $msg="Category updated";
        }else{
            $model=new Category();
            $msg="Category inserted";
        }             
        $model->category_name=$request->post('category_name');       
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
    // public function manage_category(Request $request,$id='')
    // {
        
    //     if($id>0){
    //         $arr=Category::where(['id'=>$id])->get(); 
    //         $result['category_name']=$arr['0']->category_name;           
    //         $result['id']=$arr['0']->id;
    //         $result['category']=DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get();
    //     }
    //     else{
    //         $result['category_name']='';
    //         $result['id']=0;
    //         $result['category']=DB::table('categories')->where(['status'=>1])->get();            
    //     }       
    //     // echo '<pre>';       
    //     // print_r($result);
    //     // die();   
    //     return $result;          
    //     }
}
