<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $Products = Product::all();
        return view("products.index", ["products"=> $Products]);
    }

    public function create() {
        return view("products.create");
    }

    public function store (Request $request) {
        // dd($request -> all());   

        $data = $request -> validate([
            "name"=>"required",
            "qnt"=> "required|numeric",
            "price"=> "required|decimal:0,2",
            "document"=>"required|mimes:jpg,png",
            "description"=> "nullable"
        ]);


        $name = $request -> input("name");
        $qnt = $request -> input("qnt");
        $price = $request -> input("price");
        // store file in : storage/app/public folder
        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');
        $description = $request -> input('description');

        // store file information in database
        $uploadedData = new Product() ;
        $uploadedData -> name = $name;
        $uploadedData -> qnt = $qnt;
        $uploadedData -> price = $price;
        $uploadedData->filename = $fileName;
        $uploadedData->original_name = $file->getClientOriginalName();
        $uploadedData->file_path = $filePath;
        $uploadedData -> description = $description;
        $uploadedData->save();

        return redirect(route('product.index'))->with('success','Product added successfully!');
        // return redirect()->with('success','Product added successfully');

    }

    public function edit(Product $product) {
        // dd($product);
        return view('products.edit', ['product'=>$product]);
    }

    public function update(Request $request, Product $product) {
        $data = $request -> validate([
            "name"=>"required",
            "qnt"=> "required|numeric",
            "price"=> "required|decimal:0,2",
            "document"=>"required|mimes:jpg,png",
            "description"=> "nullable"
        ]);

        $name = $request -> input("name");
        $qnt = $request -> input("qnt");
        $price = $request -> input("price");
        // store file in : storage/app/public folder
        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');
        $description = $request -> input('description');

        // store file information in database
        $uploadedData = new Product() ;
        $uploadedData -> name = $name;
        $uploadedData -> qnt = $qnt;
        $uploadedData -> price = $price;
        $uploadedData->filename = $fileName;
        $uploadedData->original_name = $file->getClientOriginalName();
        $uploadedData->file_path = $filePath;
        $uploadedData -> description = $description;
        $uploadedData->update();

        return redirect(route("product.index"))->with("success","Product Updated Successfully!");
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect(route("product.index"))->with("success", "Product Deleted Successfully!");
    }
}
