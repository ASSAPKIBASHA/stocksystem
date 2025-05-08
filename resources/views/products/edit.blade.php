@extends('layouts.navbar')
@section('title', 'Edit')
@section('content')

<body>
              
              <form action="{{route('products.update', $product->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div>
                                          @if($errors->any())
                                          <p>{{$errors}}</p>
                                          @endif
                            </div>
                            <label for="name">Product Name</label>
                                          <input type="text" name="pname" id="" value="{{old('pname',$product->pname)}}"><br>

                                          <label for="Product Price">Product Price</label>
                                          <input type="text" name="price" id="" value="{{old('price',$product->price)}}"><br>

                                          
                                          <label for="Product Category">Product Category</label>
                                          <input type="text" name="category" id="" value="{{old('category'), $product->category}}"><br>

                            

                                          <button type="submit">Update</button>
              </form>
</body>