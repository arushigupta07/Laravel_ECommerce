<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Front extends Model
{
    use HasFactory;   
  
   
    public function indexData(Request $request,$status,$id){
        $model=DB::table('products')
        ->where(['status'=>1])
        ->where(['category_id'=>$list->id])
        ->get(); 
        return $model;    

    }   
    
}
