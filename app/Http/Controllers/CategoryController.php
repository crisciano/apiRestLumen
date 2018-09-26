<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(){
        $category = Category::all();
        return response()->json($category);
    }

    public function create(Request $request){
        // return $request;
        $category = new Category();
        $category->name = $request->name;

        $category->save();
        return response()->json('Categoria inserida com sucesso.');
    }
}
