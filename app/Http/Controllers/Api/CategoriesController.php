<?php

namespace App\Http\Controllers\Api;


use App\Models\Category;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{


    use GeneralTrait; 
    public function index(){
        $categories=Category::select('id','name_'.  app()->getLocale() .' as name')->get();
        return response()->json($categories);
    }

    public function showCatgeory(Request $request){
   $category=Category::find($request->id);
   if(!$category)
return $this->returnError("202","هذا القسم غير  موجود");
   
 return $this->returnData("","Category",$category);
    }
}
