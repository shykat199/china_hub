@extends('backend.layouts.app')

@section('content')

<div class="row m-2">
  <div class="col-lg-5 pt-3" style="background-color: white;border-radius: 7px;width: 40.5vw">
      <h4>
          Products
      </h3>

      <div style="background-color: white">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th style="font-weight: 800; width:14vw;">Name</th>
                      <th style="font-weight: 800;">Image</th>
                      <th style="font-weight: 800; width:7vw; text-align: center">Quantity</th>
                      <th style="font-weight: 800; width:7vw; text-align: center">Price</th>
                      <th style="font-weight: 800; width:7vw; text-align: center">Total</th>
                      <th style="font-weight: 800; width:3vw; text-align: center">Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($order->details as $order_details)
                      <tr>
                          <td>{{ $order_details->product->name }}</td>
                          <td>
                            @foreach ($order_details->product->images as $image)
                              <img src="{{ URL::to('uploads/products/galleries/' . $image->image) }}" width="45px" height="45px" alt="product">
                            @endforeach
                          </td>
                          <td>
                              <form action="{{ route('backend.order.product.qtyUpdate', $order_details->id) }}"
                                  method="POST">
                                  @csrf
                                  @method('put')
                                  <input type="number" min="1" name="qty"
                                      value="{{ $order_details->qty }}" style="width:4vw">
                                  <button class="btn btn-sm btn-success" style="color: white">
                                      <i class="fa fa-refresh"></i>
                                  </button>
                              </form>
                          </td>
                          <td>{{ $order_details->sale_price }}</td>
                          <td>{{ $order_details->sale_price*$order_details->qty  }}</td>
                          <td>
                              <form action="{{ route('backend.order.product.delete', $order_details->id) }}"
                                  method="POST">
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-sm btn-danger" type="submit" style="color: white">
                                      <i class="fa fa-trash"></i>
                                  </button>
                              </form>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>

  <div class="col-lg-5 pt-3" style="background-color: white;border-radius: 7px; width: 40.5vw; margin-left: 1.5vw;">
      <h4>
          Add Products
      </h3>

      <div style="background-color: white">
          <input class="form-control" type="text" name="name" id="search-product" placeholder="Search Product" style="width:39.5vw">
          <ul id="show-product" class="list-group" style="position: absolute;width: 39.5vw;overflow-y: auto;height: 20.5vh;padding: 2px;"></ul>
      </div>
  </div>

</div>


<form action="{{ route('backend.order.update') }}" method="POST" class="row mt-2 p-2">
    <input type="hidden" value="{{ $order->id }}" name="order_id">
    @csrf
    @method('put')
    <div class="col-lg-6">
        <div class="container-fluid" style="background-color: white; padding:20px; border-radius: 7px;">
            <!-- Discount -->
            <div class="form-group">
                <label for="exampleInputEmail1">Discount</label>
                <input type="number" name="discount" class="form-control" value="{{ $order->discount }}">
                @error('discount')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- Paid Amount -->
            <div class="form-group">
                <label>Paid Amount</label>
                <input type="number" name="paid_amount" class="form-control" value="{{ $order->paid_amount }}">
                @error('paid_amount')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- Payment Status -->
            <div class="form-group">
                <label>Payment Status</label>
                <input type="text" name="payment_status" class="form-control" value="{{ $order->payment_status }}">
                @error('payment_status')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- Coupon Discount -->
            <div class="form-group">
                <label>Coupon Discount</label>
                <input type="text" name="coupon_discount" class="form-control" value="{{ $order->coupon_discount }}">
                @error('coupon_discount')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- Vat -->
            <div class="form-group">
                <label>Vat</label>
                <input type="number" name="vat" class="form-control" value="{{ $order->vat }}">
                @error('vat')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- shipping_cost -->
            <div class="form-group">
                <label>Shipping Cost</label>
                <input type="number" name="shipping_cost" class="form-control" value="{{ $order->shipping_cost }}">
                @error('shipping_cost')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- total_price -->
            <div class="form-group">
                <label>Total Price</label>
                <input type="number" name="total_price" class="form-control" value="{{ $order->total_price }}">
                @error('total_price')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- exchange_rate -->
            <div class="form-group">
                <label>Exchange Rate</label>
                <input type="number" name="exchange_rate" class="form-control" value="{{ $order->exchange_rate }}">
                @error('exchange_rate')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- shipping_name -->
            <div class="form-group">
                <label>Shipping Name</label>
                <input type="text" name="shipping_name" class="form-control" value="{{ $order->shipping_name }}">
                @error('shipping_name')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>


            <button type="submit" class="btn btn-success mt-3" style="color: white;">Update</button>

        </div>
    </div>

    <div class="col-lg-6">
        <div class="container-fluid" style="background-color: white; padding:20px; border-radius: 7px;">
            <!-- shipping_address_1 -->
            <div class="form-group">
                <label>Shipping Address 1</label>
                <input type="text" name="shipping_address_1" class="form-control"
                    value="{{ $order->shipping_address_1 }}">
                @error('shipping_address_1')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- shipping_address_2 -->
            <div class="form-group">
                <label>Shipping Address 2</label>
                <input type="text" name="shipping_address_2" class="form-control"
                    value="{{ $order->shipping_address_2 }}">
                @error('shipping_address_2')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- shipping_mobile -->
            <div class="form-group">
                <label>Shipping Mobile</label>
                <input type="text" name="shipping_mobile" class="form-control"
                    value="{{ $order->shipping_mobile }}">
                @error('shipping_mobile')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- shipping_email -->
            <div class="form-group">
                <label>Shipping Email</label>
                <input type="email" name="shipping_email" class="form-control" value="{{ $order->shipping_email }}">
                @error('shipping_email')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>
            <!-- shipping_post -->
            <div class="form-group">
                <label>Shipping Post</label>
                <input type="text" name="shipping_post" class="form-control" value="{{ $order->shipping_post }}">
                @error('shipping_post')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- shipping_town -->
            <div class="form-group">
                <label>Shipping Town</label>
                <input type="text" name="shipping_town" class="form-control" value="{{ $order->shipping_town }}">
                @error('shipping_town')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- shipping_country_id -->
            <div class="form-group">
                <label>Shipping Country</label>
                <select type="text" name="shipping_country_id" class="form-control">
                    @foreach ($countries as $key => $country)
                        <option {{ strtolower($country->name) == 'bangladesh' ? 'selected' : '' }}
                            value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('shipping_country_id')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- shipping_note -->
            <div class="form-group">
                <label>Shipping Note</label>
                <input type="text" name="shipping_note" class="form-control"
                    value="{{ $order->shipping_note }}">
                @error('shipping_note')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- payment_by -->
            <div class="form-group">
                <label>Payment By</label>
                <select type="text" name="payment_by" class="form-control">
                    <option value="{{ $order->paym }}"></option>

                    <option {{ $order->payment_by == 'COD' ? 'selected' : null }} value="COD">COD</option>
                    <option {{ $order->payment_by == 'Mobile Banking' ? 'selected' : null }} value="COD">Mobile
                        Banking</option>

                </select>
                @error('payment_by')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>


            

        </div>
    </div>




</form>





@endsection

@section('script')
<script>
    $(document).ready(function() {
        var order_id = @json($order->id);
        let typingTimer;
        const typingDelay = 1000; // 1 second delay

        $('#search-product').on('input', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                var keyword = $('#search-product').val();
                $.ajax({
                    url: `{{ url('admin/order/add-product/search') }}`,
                    data: {
                        name: keyword
                    },
                    dataType: "JSON",
                    success: function(res) {
                        $('#show-product').html('');
                        res.forEach(element => {
                            $('#show-product').append(`
                                <a href="{{ url('admin/order/add-product/${order_id}/${element.id}') }}">
                                    <li class="list-group-item">
                                        <p style="display:block">${element.name}</p>
                                    </li>
                                </a>
                            `)
                        });

                        // console.log(res);
                    }
                });
            }, typingDelay);
        });

        // Clear the timeout if the user starts typing again before the delay is over
        $('#search-product').on('keydown', function() {
            clearTimeout(typingTimer);
        });
    });
</script>
@endsection