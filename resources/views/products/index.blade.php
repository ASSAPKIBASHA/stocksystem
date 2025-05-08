@extends('layouts.navbar')
@section('title', 'Products')
@section('content')

<body>
              <h1>Products</h1>

              <div class="user">
                            <p>{{$user->username}}</p>
                            <p>{{$user->email}}</p>

              </div>
              <div class="main">
                            @if($products->count()== 0)
                            <p>No products yet</p>

                            @else
                            <table border="1">
                                          <thead>
                                          <tr>
                                               <th>Name</th>
                                               <th>quantity</th>         
                                               <th>price</th>
                                               <th>category</th>
                                               <th>actions</th>
                                          </tr>
                                          
                                          </thead>
                                          <tbody>
                                                        @foreach ($products as $product)
                                                        <tr>
                                                                      <td>{{$product->pname}}</td>
                                                                      <td>{{$product->quantity}}</td>
                                                                      <td>{{$product->price}}</td>
                                                                      <td>{{$product->category}}</td>
                                                                      <td class="actions">
                                                                                    <a href="{{route('products.edit', $product->id)}}">Edit</a>
                                                                                    <form action="{{route('products.destroy', $product->id)}}" method="post">
                                                                                                  @method('DELETE')
                                                                                                  @csrf
                                                                                                  <button type="submit">Delete</button>
                                                                                    </form> </td>

                                                        </tr>
                                                            
                                                        @endforeach
                                                        
                                          </tbody>
                            </table>
                            @endif    
              </div>
              <div class="form-container">
                            <h2>Create New product</h2>

                            @if(session('success'))
                            <div class="success">
                                          {{session('success')}}
                            </div>
                            @endif
                            
                            @if($errors ->any())
                            <p>{{$errors}}</p>
                            @endif
                            <form action="{{route('products.store')}}" method="post">
                                          @csrf
                                          <label for="name">Product Name</label>
                                          <input type="text" name="pname" id="" value="{{old('pname')}}"><br>

                                          <label for="Product Price">Product Price</label>
                                          <input type="number" name="price" id="" value="{{old('price')}}"><br>



                                          <label for="Product Category">Product Category</label>
                                          <input type="text" name="category" id="" value="{{old('category')}}"><br>

                                          <button type="submit">create</button>
                            </form>
              </div>
</body>



@endsection