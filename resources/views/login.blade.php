<!DOCTYPE html>
<html>
 <head>
  <title>Ecom</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Login</h3><br />
   @if ( session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif
  <form method="post" action="{{route('login.user')}}">
    {{ csrf_field() }}
    <div class="form-group">
     <label>Email</label>
     <input type="email" name="email" class="form-control" />
    </div>
    <div class="form-group">
     <label>Password</label>
     <input type="password" name="password" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="login" class="btn btn-primary" value="Login" />
     <a href="{{route('register')}}" class="btn btn-success">Register</a>
    </div>
   </form>
  </div>
 </body>
</html>