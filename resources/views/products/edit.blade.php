<!doctype html>
<html lang="en">
  <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product: Edit </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-3">
        <h1>Edit Product</h1>
    </div>

    <div class="container">
        @if ($errors->any()) 
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="container">
        <form action="{{route('product.update', ['product' => $product])}}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name:<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="{{$product->name}}">
            </div>
            <div class="mb-3">
                <label for="qnt" class="form-label">Quantity:<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="qnt" name="qnt" placeholder="Product Quantity" value="{{$product->qnt}}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:<span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Product Price" value="{{$product->price}}">
            </div>
            <div class="mb-3">
                <label for="document" class="form-label">Upload document:</label>
                <input type="file" class="form-control" id="document" name="document" placeholder="Upload document"></input>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <!-- <textarea type="text" class="form-control" id="description" name="description" placeholder="Product Description" value="{{$product->description}}"></textarea> -->

                <!-- while doing edit textarea creating issue -->
                <input type="text" class="form-control" id="description" name="description" placeholder="Product Description" value="{{$product->description}}"></input>
            </div>

            <div class="mb-3">
                <!-- <button type="button" class="btn btn-primary">Submit</button> -->
                <input type="submit" class="btn btn-primary" value="Update Product">
            </div>

        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>