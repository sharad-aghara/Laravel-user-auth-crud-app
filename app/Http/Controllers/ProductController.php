<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Type\Decimal;
class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view("products.index", ["products"=> $products]);
    }

    public function create() {
        return view("products.create");
    }

    public function store (Request $request) {
        // dd($request -> all());   

        $data = $request -> validate([
            "name"=>"required|regex:/^[A-Za-z][A-Za-z0-9\s-]{0,19}$/",
            "qnt"=> "required|numeric|between:1,999999999",
            "price" => "required|numeric|between:1,999999999",
            "image"=>"required|image|mimes:jpeg,png,jpg,gif|max:2048",
            "description"=> "nullable|regex:/^[A-Za-z][A-Za-z0-9\s-]{0,500}$/"
        ]);


        $name = $request -> input("name");
        $qnt = $request -> input("qnt");
        $price = $request -> input("price");
        // store file in : storage/app/public folder
        $filename = time().'.'.$request->image->extension();
        $request->file('image')->move('Products', $filename);
        
        $description = $request -> input('description');

        // store file information in database
        $uploadedData = new Product() ;
        $uploadedData -> name = $name;
        $uploadedData -> qnt = $qnt;
        $uploadedData -> price = $price;
        $uploadedData->image = $filename;
        $uploadedData -> description = $description;
        $uploadedData->save();

        // $image = asset('storage/' . $filename);

        return redirect(route('product.index'))->with('success','Product added successfully!');
        // return redirect()->with('success','Product added successfully');

    }

    public function edit(Product $product) {
        // dd($product);
        return view('products.edit', ['product'=>$product]);
    }

    public function update(Request $request, Product $product) {
        $data = $request -> validate([
            "name"=>"required|regex:/^[A-Za-z][A-Za-z0-9\s-]{0,19}$/",
            "qnt"=> "required|numeric|between:1,999999999",
            "price" => "required|numeric|between:1,999999999",
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            "description"=> "nullable|regex:/^[A-Za-z][A-Za-z0-9\s-]{0,500}$/"
        ]);

        $product = Product::find($product->id);
        $product->name = $data["name"];
        $product->qnt = $data["qnt"];
        $product->price = $data["price"];
        $product->description = $data["description"];


        if ($request->hasFile('image')) {
            File::delete(public_path('Products/'. $product->image));
            $filename = time().'.'.$request->image->extension();
            $request->file('image')->move('Products', $filename);
            $product->image = $filename;
        }

        $product->save();
        // $name = $request -> input("name");
        // $qnt = $request -> input("qnt");
        // $price = $request -> input("price");
        // // store file in : storage/app/public folder
        // $image = $request->file("image");
        // $description = $request -> input('description');

        // // store file information in database
        // $uploadedData = new Product() ;
        // $uploadedData -> name = $name;
        // $uploadedData -> qnt = $qnt;
        // $uploadedData -> price = $price;
        // $uploadedData -> image = $image;
        // $uploadedData -> description = $description;
        // $uploadedData -> update();

        // $image = asset('storage/image/' . $image);

        return redirect(route("product.index"))->with("success", "Product Updated Successfully!");
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect(route("product.index"))->with("success", "Product Deleted Successfully!");
    }
}
