<body>
              
              <nav>
                            <div>
                                          Stock system
                            </div>
                          <div>
                            <a href="{{route('dashboard')}}">dashboard</a>
                            <a href="{{route('products.index')}}">products</a>
                            <a href="{{route('stockin.index')}}">stockin</a>
                            <a href="{{route('stockout.index')}}">stockout</a>
                            <a href="{{route('report.page')}}">Reports</a>

                          </div>

              </nav>
              <body>
                            @yield('content')
              </body>
</body>