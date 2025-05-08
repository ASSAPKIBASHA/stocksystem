@extends('layouts.navbar')
@section('title', 'Dashboard')
@section('content')

<body>
              <div class="main">
                            <div class="cards">
                                          <h2>Total products</h2>
                                          <p>{{$productCount}}</p>
                            </div>

                            <div class="cards">
                                          <h3>{{$stockInCount}}</h3>
                                          <p>In</p>
                             </div>
                            <div class="cards">
                                          <h3>{{$stockOutCount}}</h3>
                                          <p>Out</p>
                            </div>
              </div>
              
              
</body>
@endsection