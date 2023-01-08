<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $result['data']=Category::all();
        return view('admin/category',$result);
    }    
    /**
     * manageCategory function
     *
     * @param Request $request
     * @param string $id
     * @return void
     * 
     * get category details and pass to view
     */
    public function manageCategory(Request $request,$id='')
    {
        //route: add validation for id , required, integer data type
        if($id>0){
            $arr=Category::where(['id'=>$id])->get(); 
            $result['category_name']=$arr['0']->category_name;           
            $result['id']=$arr['0']->id;
            $result['category']=DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get();
        }
        else{
            $result['category_name']='';
            $result['id']=0;
            $result['category']=DB::table('categories')
                                    ->where(['status'=>1])
                                    ->get();
        }   
        return view('admin/manage_category',$result);
        // echo '<pre>';       
        // print_r($result);
        // die();
    }
/**
 * manageCategoryProcess function
 *
 * 
 * @param Request $request
 * @return void 
 * post data for insertion and updation
 */
    public function manageCategoryProcess(Request $request)
    {
       //return $request->post();        
        $request->validate([
            'category_name'=>'required'    
           ]);       
           $catm=new Category();
           $catm->postCategory($request);     
           return redirect('admin/category');        
    }
  
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     * 
     * delete category
     */
    public function delete(Request $request, $id){
       // $delData=$request->get();
        $cat=new Category();
        $cat->deleteData($id);
        $request->session()->flash('message','Category deleted');
        return redirect('admin/category');
    }  
    /**
     * category status 1-active 0-deactive
     */

    public function status(Request $request,$status,$id){
        $cats=new Category();
        $cats->statusData($request,$status,$id);
        $request->session()->flash('message','Category status updated');
        return redirect('admin/category');
    }   
    
}
