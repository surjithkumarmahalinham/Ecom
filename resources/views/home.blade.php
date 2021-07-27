@include('header')
<section>
    <div class="container">
      <br>
      <div class="row">
        <span id="status"></span>
        <div class="col-sm-12 padding-right">
          <div class="features_items"><!--features_items-->
            @foreach($product as $i => $pro)
             <div class="col-sm-3">
              <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                      @if($pro->image)
                      <img src="{{ URL::asset('assets/images/home/'.$pro->image) }}" width="80" height="280px;" alt="person">
                      @endif
                      <h2>₹{{$pro->price}}</h2>
                      <p>{{$pro->product_name}}</p>
                      <p class="btn-holder"><a href="javascript:void(0);" data-id="{{ $pro->id }}" class="btn btn-warning btn-block text-center add-to-cart" role="button" id="cartid">Add to cart</a>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                            </p>
                    </div>
                    <div class="product-overlay">
                      <div class="overlay-content">
                        <h2>₹{{$pro->price}}</h2>
                        <p>{{$pro->product_name}}</p>
                        <p class="btn-holder"><a href="javascript:void(0);" data-id="{{ $pro->id }}" class="btn btn-warning btn-block text-center add-to-cart" role="button" id="cartid">Add to cart</a>
                                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                            </p>
                      </div>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
            </div><!--features_items-->

        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            ele.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ url('addtocart') }}' + '/' + ele.attr("data-id"),
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });
    </script>
  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery.scrollUp.min.js')}}"></script>
  <script src="{{asset('assets/js/price-range.js')}}"></script>
    <script src="{{asset('assets/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>