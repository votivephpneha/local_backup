<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{{$email_subject}} Email</title>
        
        <!-- Start Common CSS -->
        <style type="text/css">
            #outlook a {padding:0;}
            body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; font-family: Helvetica, arial, sans-serif;}
            .ExternalClass {width:100%;}
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
            .backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
            .main-temp table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; font-family: Helvetica, arial, sans-serif;}
            .main-temp table td {border-collapse: collapse;}
        </style>
        <!-- End Common CSS -->
    </head>
    <body>
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp" style="background-color: #d5d5d5;">
            <tbody>
                <tr>
                    <td>
                        <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth" style="background-color: #ffffff;">
                            <tbody>
                                <!-- Start header Section -->
                                <tr>
                                    <td style="padding-top: 30px;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #eeeeee; text-align: center;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding-bottom: 10px;">
                                                        <a href="https://votiveinfo.in/Birthdaycards/"><img src="https://votiveinfo.in/Birthdaycards/public/images/logo.png"  /></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                       <h1>Hi,{{ $user_name}}<h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                        <span>{{$email_content}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 25px;">
                                                        <strong>Order Number:</strong> {{$order_dtl[0]->order_id
                                                        
                                                        }} | <strong>Order Date:</strong> {{ date('d/m/Y', strtotime($order_dtl[0]->created_at))}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 25px;">
                                                    <a href="https://votiveinfo.in/Birthdaycards/" style="">Visit site : - Birthdaystore</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- End header Section -->
                               
                                <!-- Start address Section -->
                                <tr>
                                @if(!empty($order_dtl[0]->order_status && $order_dtl[0]->order_status == 1 ))
                                    <td style="padding-top: 0;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #bbbbbb;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 55%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                        Delivery Adderss
                                                    </td>
                                                    <td style="width: 45%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                        Billing Address
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 55%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{$order_dtl[0]->fname." ".$order_dtl[0]->lname}}
                                                    </td>
                                                    <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                    {{$order_dtl[0]->fname." ".$order_dtl[0]->lname}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 55%; font-size: 14px; line-height: 25px; color: #666666;">
                                                    {{$order_dtl[0]->email}}
                                                    </td>
                                                    <td style="width: 45%; font-size: 14px; line-height: 25px; color: #666666;">
                                                    {{$order_dtl[0]->email}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 55%; font-size: 14px; line-height: 25px; color: #666666;">
                                                    {{$order_dtl[0]->phone_no}}
                                                    </td>
                                                    <td style="width: 45%; font-size: 14px; line-height: 25px; color: #666666;">
                                                    {{$order_dtl[0]->phone_no}}
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td style="width: 55%; font-size: 14px; line-height: 25px; color: #666666;">
                                                    {{$order_dtl[0]->address.','.$order_dtl[0]->city}}
                                                    </td>
                                                    <td style="width: 45%; font-size: 14px; line-height: 25px; color: #666666;">
                                                    {{$order_dtl[0]->address.','.$order_dtl[0]->city}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                        {{$order_dtl[0]->state.",".$order_dtl[0]->postal_code}}
                                                    </td>
                                                    <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{$order_dtl[0]->state.",".$order_dtl[0]->postal_code}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    @endif
                                </tr>
                                <!-- End address Section -->
                              
                                 <tr>
                                    <td style="padding: 0 10px;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"  class="devicewidthinner" style="border-bottom: 1px solid #bbbbbb;">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                        Payment Method 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{$order_dtl[0]->payment_method}}
                                                    </td>
                                                   
                                                </tr>
                                                @if(!empty($order_dtl[0]->order_notes ))
                                                <tr>
                                                    <td colspan="2" style="font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                      Order Note
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                    {{$order_dtl[0]->order_notes}}
                                                    </td>
                                                   
                                                </tr>
                                                @endif
                                                @if(!empty($order_dtl[0]->cancel_reason && $order_dtl[0]->order_status == 2 ))
                                                <tr>
                                                    <td colspan="2" style="font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                       Cancel reason
                                                    </td>
                                                </tr>
                                               
                                                <tr>
                                                    <td style="width: 55%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                   {{ $order_dtl[0]->cancel_reason}}
                                                    </td>
                                                   
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- Start product Section -->
                                @if(isset($card_data) && (count($card_data)))				

				                       
                                <tr>
                                    <td style="padding-top: 0 0 10px;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                            <tbody>
                                            @foreach($card_data as $item)	
                                                <tr>
                                                    <!-- <td rowspan="4" style="padding-right: 10px; padding-bottom: 10px;">
                                                        <img style="height: 80px;" src="images/product-1.jpg" alt="Product Image" />
                                                    </td> -->
                                                    <td colspan="2" style="font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                      {{$item->card_title}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                        Quantity:{{$item->qty}} 
                                                    </td>
                                                    <td style="width: 130px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575;">
                                                        Card Type: {{$item->card_type}}
                                                    </td>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; text-align: right;">
                                                    ${{number_format($item->price,2)}} Per Unit
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;">
                                                        Size: {{$item->card_size}}
                                                    </td>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                                        <b style="color: #666666;">${{number_format($item->card_price,2)}}</b> Total
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                

                             @endif  
                             
                                
                                <!-- End product Section -->
                                
                                <!-- Start calculation Section -->
                                <tr>
                                    <td style="padding-top: 0;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #bbbbbb; margin-top: -5px;">
                                            <tbody>
                                                <tr>
                                                    <td rowspan="5" style="width: 55%;"></td>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                        Sub-Total:
                                                    </td>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666; width: 130px; text-align: right;">
                                                    ${{number_format($order_dtl[0]->sub_total,2)}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee;">
                                                        Tax(%):
                                                    </td>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px; border-bottom: 1px solid #eeeeee; text-align: right;">
                                                        $0.00
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px;">
                                                        Order Total
                                                    </td>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px; text-align: right;">
                                                    ${{number_format($order_dtl[0]->total,2)}}
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666;">
                                                        Payment Term:
                                                    </td>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right;">
                                                        100%
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                        Deposit Amount
                                                    </td>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right; padding-bottom: 10px;">
                                                        $1,234.50
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- End calculation Section -->
                                
                                <!-- Start payment method Section -->
                               
                                <!-- End payment method Section -->
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>