@include('header')
<section>
    <div class="container">
      <br>
      <div class="row">
        <div class="col-sm-12 padding-right">
          <div class="features_items"><!--features_items-->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Detail</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($product as $i => $pro)
                  <tr>
                    <td>@if($pro->image)
                                  <img src="{{ URL::asset('assets/images/home/'.$pro->image) }}" width="80" height="100px;" alt="person">
                                  @endif</td>
                    <td>{{$pro->product_name}}</td>
                    <td>{{$pro->details}}</td>
                    <td>₹{{$pro->price}}</td>
                  </tr>
                  
                  </tbody>
              </table>
            </div><!--features_items-->
            <form method="post" action="{{route('order')}}">
              {{ csrf_field() }}
              <input type="radio" name="method" value="Shipping">Shipping
              <input type="radio" name="method" value="Payment">Payment
              <input type="hidden" name="product_id" value="{{$pro->id}}">
              <input type="hidden" name="total_price" value="{{$pro->price}}">
              <input type="submit" name="submit" value="Order Now" class="btn btn-default add-to-cart" style="margin-left: 320px; margin-top: 40px; background-color: orange;">
            </form>
              @endforeach
        </div>
      </div>
    </div>
  </section>
  
  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery.scrollUp.min.js')}}"></script>
  <script src="{{asset('assets/js/price-range.js')}}"></script>
    <script src="{{asset('assets/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>