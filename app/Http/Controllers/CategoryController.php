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

    public function show($id){
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);

        $category->name = $request->name;

        $category->save();
        return response()->json('Categoria alterada com sucesso.');

    }

    public function destroy($id){
        $category = Category::find($id);

        $category->delete();
        return response()->json('Categoria removido com sucesso.');

    }
}
