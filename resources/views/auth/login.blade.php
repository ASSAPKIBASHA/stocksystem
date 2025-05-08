<html lang="en">
<head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta http-equiv="X-UA-Compatible" content="ie=edge">
              <title>login</title>
</head>
<body>
              <form action="{{route('login.submit')}}" method="post">
              @csrf
              <label for="username">username</label>
              <input type="text" name="username" id="" value="{{old('username')}}"> <br>

              <label for="email">email</label>
              <input type="email" name="email" id="" value="{{old('email')}}"><br>

              <label for="password">password</label>
              <input type="password" name="password" id="" value="{{old('password')}}"> <br>

              <button type="submit">Submit</button>
              </form>
              <p>Have an account? <a href="{{route('register.show')}}">register</a></p>
</body>
</html>