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
                    <th>Payment Method</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $i => $pro)
                  <tr>
                    <td>@if($pro->image)
                                  <img src="{{ URL::asset('assets/images/home/'.$pro->image) }}" width="80" height="100px;" alt="person">
                                  @endif</td>
                    <td>{{$pro->product_name}}</td>
                    <td>{{$pro->details}}</td>
                    <td>₹{{$pro->price}}</td>
                    <td>{{$pro->method}}</td>
                  </tr>
                  @endforeach
                  </tbody>
              </table>
            </div><!--features_items-->
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