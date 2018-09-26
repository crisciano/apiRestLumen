<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(){
        $products = Product::all();
        return response()->json($products);
    }

    public function create(Request $request){
        
        $product = new Product;
        $product->name= $request->name;
        $product->price = $request->price;
        $product->description= $request->description;
       
        $product->save();
        return response()->json('Produto inserido com sucesso.');
        // return response()->json($product);
    }

    public function show($id){
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id){ 
        $product= Product::find($id);
        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        $product->save();
        return response()->json($product);
    }
    public function destroy($id){
        $product = Product::find($id);

        $product->delete();
        return response()->json('Produto removido com sucesso.');
    }
}