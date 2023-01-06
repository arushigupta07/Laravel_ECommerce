<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use App\Models\Front;
use Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $result['home_categories']=DB::table('categories')
        ->where(['status'=>1])        
        ->get();
        //dd($result['home_categories']);

        foreach($result['home_categories'] as $list){
            $result['home_categories_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['category_id'=>$list->id])
                ->get();
        }
               //dd($result['home_categories_product']);


        return view('front/index',$result);
    }
    public function category(Request $request, $id){
        $sort='';
        $sort_txt='';
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
        }  
        $query=DB::table('products');
        $query=$query->leftJoin('categories','categories.id','=','products.category_id');
        $query=$query->leftJoin('attribute_values','products.id','=','attribute_values.product_id');
        $query=$query->where(['products.status'=>1]);
        $query=$query->where(['categories.id'=>$id]);
        if($sort=='name'){
            $query=$query->orderBy('products.product_name','asc');
            $sort_txt="Product Name";
        }
        if($sort=='date'){
            $query=$query->orderBy('products.id','desc');
            $sort_txt="Date";
        }        
        $query=$query->distinct()->select('products.*');
        $query=$query->get();
        $result['product']=$query;
        //      echo '<pre>';       
        // print_r($result['product']);
        // die();
        $i=0;
        foreach($result['product'] as $list1){
           
            $query1=DB::table('attribute_values');           
            $query1=$query1->where(['attribute_values.product_id'=>$list1->id]);
            $query1=$query1->get();
            $result['product_attr'][$list1->id]=$query1;
            $result['i']=$i;
            // foreach($result['product_attr'] as $count ){
            //     $i++;
            // }
           // 
        //     echo '<pre>';       
        // print_r($result['product_attr']);
        // die();
            //dd($result['product_attr']);
        }
        
        $result['sort']=$sort;

        
       $result['categories_left']=DB::table('categories')
       ->where(['status'=>1])
       ->get();
      //dd($product_attr[$productArr->id][]->p_attr_id);

        return view('front/category',$result);
    }

    public function product(Request $request, $id){
        $result['product']=DB::table('products')        
        ->where(['products.status'=>1])  
        ->where(['id'=>$id])      
        ->get();
        foreach($result['product'] as $list1){
            $result['product_attr'][$list1->id]=
            DB::table('attribute_values')
            ->leftJoin('product_attributes','product_attributes.id','=','attribute_values.p_attr_id') 
            ->where(['attribute_values.product_id'=>$list1->id])  
            ->get();
        }
        // echo '<pre>';       
        // print_r( $result['product_attr'][$id]);
        // die();
        $result['related_product']=
        DB::table('products')
        ->where(['status'=>1])
        ->where('id','!=',$id)
        ->where(['category_id'=>$result['product'][0]->category_id])
        ->get();
    foreach($result['related_product'] as $list1){
        $result['related_product_attr'][$list1->id]=
            DB::table('attribute_values')
            ->leftJoin('product_attributes','product_attributes.id','=','attribute_values.p_attr_id')           
            ->where(['attribute_values.product_id'=>$list1->id])
            ->get();
    }   
        return view('front/product', $result);
    }
    public function adminHome()
    {
        return view('admin/adminDashboard');
    }

   
}
