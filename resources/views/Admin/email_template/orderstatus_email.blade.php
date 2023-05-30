<html>
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  </head>
  <body style="font-family:'open Sans';font-size: 14px; line-height:20px;">
    <div style="padding: 0 10px;max-width: 600px;margin: 0 auto;">
      <div style="max-width:550px;width:85%;padding:30px;margin:30px auto 0;border:1px solid #e2e2e2;overflow:hidden;background: url(http://heymobie.com/design/front/img/resto.jpg);background-position:center;background-size:cover;text-align: center;color: #fff;">
        <div style="padding:30px;border:1px solid #fff;background:rgba(31, 0, 0, 0.72);">
          <div style="text-align:center">
            <a href="https://votiveinfo.in/Birthdaycards/" style="display: block;overflow:hidden;padding: 0 0 0 0;">
              <img style="max-width:160px;width: 100%;" src="https://votiveinfo.in/Birthdaycards/public/images/logo.png">
            </a>
          </div>
          <div style="border-bottom:2px solid #d2d2d2;margin:15px auto 15px;padding:10px;display:block;overflow:hidden;max-width: 400px;">
            <h2 style="margin:0 0;">Hi,{{ $user_name}}</h2>
          </div>
          <div style=" display:block; overflow:hidden">
            <p style=" margin:0 0 8px 0">&nbsp;</p>
            <p>{{$email_content}}</p>
          </div>
          <div>
            <a href="https://votiveinfo.in/Birthdaycards/" style="text-decoration:none;color:#dad9d9;padding-bottom:2px;display:inline-block;border-bottom:1px solid #d0cfcf;">Visit site : - Birthdaystore</a>
          </div>
        </div>
      </div>
      <div style="max-width:550px;width:85%;padding:30px;margin:0 auto 30px;border:1px solid #e81e2a;background: #e81e2a">
        <div style="background: #fff;padding: 15px;">
          <!--<p style="text-align:center;">Your food should arrive around 7:05 - 8:00</p>-->
          <!-- <h2 style="text-align:center;">test</h2> -->
          @if(!empty($order_dtl[0]->cancel_reason && $order_dtl[0]->order_status == 2 ))
          <p style="padding:0px 5px 5px 5px; margin-bottom:0px !important; margin-top: 5px;">

                    <strong>Cancel Reason: </strong>

                    <span style="margin-left:10px;">{{$order_dtl[0]->cancel_reason}}</span>

                </p>
        @endif
          

          @if(!empty($order_dtl[0]->order_status && $order_dtl[0]->order_status == 1 ))
          <p>

          <strong>Order No</strong><span style="float:right;"><?php echo  $order_dtl[0]->order_id;?></span>

          </p>


          <p>

          <strong>Name</strong><span style="float:right;"><?php echo $order_dtl[0]->fname." ".$order_dtl[0]->lname ;?></span>

          </p>

          <p>

          <strong>Email Id</strong><span style="float:right;"><?php if(isset($order_dtl[0]->email)){echo $order_dtl[0]->email;}else{}?></span>

          </p>

          <p><strong>Contact Number</strong><span style="float:right;"><?php if(isset($order_dtl[0]->phone_no)){echo $order_dtl[0]->phone_no;}else{}?></span>

          </p>

          <p>

          <strong>Order Address</strong><span style="float:right;"><?php if(isset($order_dtl[0]->address)){echo $order_dtl[0]->address.','.$order_dtl[0]->city.','.$order_dtl[0]->state."".$order_dtl[0]->postal_code ;}else{}?></span>

          </p>
          @endif
          

          <p>
            <strong>Payment Method <br>
            </strong>
            <span>{{$order_dtl[0]->payment_method}}</span>
          </p>
          @if(isset($card_data) && (count($card_data)))

				

				 @foreach($card_data as $item)			

				<p>

						<strong>{{$item->qty}}x</strong> {{$item->card_title}} </strong>

						<span style="float:right;">${{number_format($item->card_price,2)}}</span>

				</p>
                <!-- @endforeach
                @endif	
                @if(!empty($card_data)&&(count($card_data)>0))

                    @foreach($card_data as $item)

                    <p>

                        <strong>{{$item->card_title}}</strong>

                        <span style="float:right;">@if($item->card_price>0)${{number_format($item->card_price,2)}}@endif</span>

                    </p>



                    @endforeach

                    @endif  -->
            <strong> Subtotal </strong>
            <span style="float:right;">${{number_format($order_dtl[0]->sub_total,2)}}</span>
          </p>
          <p>
            <strong>Tax(%)</strong>
            <span style="float:right;">$0.00</span>
          </p>
          <p>
            <strong> TOTAL</strong>
            <span style="float:right;">${{number_format($order_dtl[0]->total,2)}}</span>
          </p>
            <strong> GRAND TOTAL</strong>
            <span style="float:right;">${{number_format($order_dtl[0]->total,2)}}</span>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>