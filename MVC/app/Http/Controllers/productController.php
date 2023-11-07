<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    function get(){
        $product = Product::get();
        return view('productlist',['product' => $product]);
    }

    public function add(request $request){
        $product=new Product();
        $product->Product_name=$request->Product_name;
        $product->Product_type=$request->Product_type;
        $product->Price=$request->Price;
        $product->save();
        return "Data is Saved";
    }
    public function delete($id){
        $product1=Product::find($id);
        $product1->delete();
        return back();
    }
    public function update($id){
        $product2=Product::find($id);
        return view('updateproduct',compact('product2'));
    }
    public function update_data(request $request,$id){
        $products=Product::find($id);
        $products->Product_name=$request->Product_name;
        $products->Product_type=$request->Product_type;
        $products->Price=$request->Price;
        $products->save();
        return $this->get();
    }
}
