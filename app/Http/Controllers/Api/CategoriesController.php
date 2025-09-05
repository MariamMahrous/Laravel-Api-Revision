<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index(){
        $categories=Category::select('id','name_'.  app()->getLocale() .' as name')->get();
        return response()->json($categories);
    }
}
