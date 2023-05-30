@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')


<div class="container">
  <div class="row user_profile_div">
    <div class="col-md-3">
      @include('Front.user_header')
    </div>
    <div class="col-md-9">
      <div class="user-profile-tab">
        <h2>My Orders</h2>
        <div class="order-details-div">

          @if(count($order_data))
            <table style="width:100%" class="table table-bordered">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Date</th>
                  <th>Order Status</th>
                  <th>No of items</th>
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order_data as $o_data)
                  <tr>
                    <td><a href="{{ url('user/order_detail') }}/{{ $o_data->order_id }}">{{ $o_data->order_id }}</a></td>
                    <td>
                      <?php
                        $date=date_create($o_data->created_at);
                        echo date_format($date,"d/m/Y");
                      ?>
                    </td>
                    <td>
                      <?php
                        $order_status = $o_data->order_status;

                        if($order_status == '0'){
                          echo "pending";
                        }
                        if($order_status == '1'){
                          echo "Accept";
                        }
                        if($order_status == '2'){
                          echo "Cancelled";
                        }
                        if($order_status == '3'){
                          echo "On the way";
                        }
                        if($order_status == '4'){
                          echo "Delivered";
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                        $order_detail = DB::table('order_details')->where(['order_id' => $o_data->order_id])->get();
                        echo count($order_detail);
                      ?>
                    </td>
                    <td>
                      <?php
                        $order_total = $o_data->total;  
                        echo "$".number_format((float)$order_total, 2, '.', '');
                      ?>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
          <p>No orders yet</p>
          <a href="{{ url('birthday-cards') }}">Make your first order</a>
          @endif
        </div>
      </div>
    </div>
  </div>
  
</div>  
@endsection
