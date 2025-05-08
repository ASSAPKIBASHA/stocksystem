@extends('layouts.navbar')
@section('title', 'Stock in')
@section('content')

<div class="header">
              <h1>stock in</h1>
              <div>
                            <p>{{$user->username}}</p>
                            <P>{{$user->email}}</P>
              </div>
              <div>
                            @if($stockIns->count()==0 )
                            <p>No stock in yet! add some</p>
                            @else

                            @if($errors->any())
                            <p>{{$errors}}</p>
                            @endif
                            
                            <table>
                                          <thead>
                                                        <tr>
                                                                      <th>Name</th>
                                                                      <th>Total Price</th>
                                                                      <th>Quantity</th>
                                                                      <th>Date</th>
                                                                      <th>Action</th>
                                                        </tr>
                                          </thead>
                                          <tbody>
                                                        @foreach($stockIns as $stockIn)
                                                        <tr>
                                                             
                                                             <td>{{ $stockIn->product->pname ?? 'product not found' }}</td>
                                                             <td>{{ $stockIn->total_price }}</td>
                                                             <td>{{ $stockIn->quantity }}</td>    
                                                             <td>{{ $stockIn->created_at }}</td>
                                                             <td class="actions">
                                                                 <p>
                                                                     <a href="{{route('stockin.update', $stockIn->id)}} ">Edit</a></p>
                                                                 <p>
                                                                         <form action="{{route('stockin.destroy', $stockIn->id)}}" method="POST" style="display: inline">
                                                                             @csrf
                                                                             @method('DELETE')
                                                                             <button type="submit" class="delete" onclick="return confirm('Are you sure you want to delete this stockin?')">Delete</button>
                                                                         </form>
                                                                 </p>
                                                             </td>
                       
                                                        </tr>
                                                        @endforeach
                                          </tbody>
                            </table>
                                
                            @endif
              </div>
             
              <div class="form-container">
                            <h2>Add products</h2>
                            @if (session('success'))
                            <div class="success">
                                {{session('success')}}
                            </div>
                            
                        @endif
                        @if ($errors->any())
                            <ul class="errors">
                                @foreach ($errors as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{route('stockin.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="product">Product</label>
                                <select name="product_id" id="product_id">
                                        <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->pname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" min="0" required>
                            </div>
                            
                            <button type="submit">Add product In</button>
                        </form>
              </div>


</div>
@endsection