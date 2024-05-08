<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product: Index</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- to use Datatable -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.jqueryui.js"></script>
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.jqueryui.css">
    
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.jqueryui.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.pdf.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">

</head>
<body>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
        </div>
    @endif

    <div class="container my-3">
        <h1>Product</h1>
    </div>

    <div class="container my-3 d-flex flex-row-reverse">
        <div class="p2">
            <a href="{{route('product.create')}}" class="btn btn-primary">Add Product</a>
        </div>
    </div>

    <div class="container">
        <table id="myTable" class="display table table-border table-striped-columns text-center justify-center">
            <tr class="table-dark">
                <th>No</th>
                <th>Product</th>
                <!-- <th>ID</th> -->
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Description</th>
                <td>Edit</td>
                <td>Delete</td>
            </tr>

            
            @foreach($products as $product)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->name}}</td>
                <!-- <td>{{$product->id}}</td> -->
                <td>{{$product->qnt}}</td>
                <td>{{$product->price}}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('Products/' . $product->image) }}" alt="Uploaded Image" width="150" height="150">
                    @endif
                </td>
                <!-- <td> <a class="btn btn-primary" href="{{ \Illuminate\Support\Facades\Storage::url($products) }}" download>Download</a></td> -->
                <td>{{$product->description}}</td>
                <td><a href="{{route('product.edit', ['product' => $product])}}" class="btn btn-primary">Edit</a></td>
                <td>
                <a onclick="return confirm('Are you sure?')" href="{{route('product.destroy', ['product' => $product])}}" class="btn btn-danger">Delete</a>

                </td>
            </tr>
            @endforeach
        </table>   
    </div>

    <script>
       $('#mytable').DataTable( {
            layout: {
                topStart: {
                    buttons: ['print','pdf','csv']
                }
            }
        } );
    </script>


</body>
</html>         
