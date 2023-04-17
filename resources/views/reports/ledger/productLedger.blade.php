<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        body{
            padding-top: 20px;
        }
        @page { size: a4 portrait; }
    </style>
</head>
<body>
    <div  style="width:700px; margin: 0 auto; font-size:18px; font-weight:600; margin-top:30px; overflow: hidden; height: 100px;">
        <div style="height: 1px; text-align:start; width:300px; font-family: Arial, Helvetica, sans-serif;">
            <img style="width: 85px; height: 85px;" src="https://admin2.finesselimited.com/img/admin_logo.png" alt="admin_logo">
            <!-- <img style="width: 85px; height:auto;"  src="{{ public_path('img/admin_logo.png') }}" alt="admin_logo"> -->
        </div>
        <div style="width:300px; height:100px; float:right; text-align:right; font-family: Arial, Helvetica, sans-serif;">
            <h2 style="font-weight:400; font-size:17px; color:#5f5959;">{{$setting['companyName']}}</h2>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['address']}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['supportContact']}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;"> {{$setting['supportEmail']}} </p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['websiteLink']}}</p>
        </div>
    </div>
        <br>

    <div style="width:700px; margin:0px auto 30px auto; border:1px solid #949494; font-family: Arial, Helvetica, sans-serif;">
        <h2 style="font-weight:400; font-size:18px; text-align:center; padding:7px;">Product Ladger Report</h2>
        <table style="width:700px; padding:5px;">
            <tr>
                <td style="display:inline-block; font-size: 10px; width:100%;">
                    <span style="display:inline-block; width: 500px; color:#5f5959;">Product Name: {{ $product['productName'] }}</span>
                    <span style="width: 300px; float: right; margin-right:20px;"></span>
                </td>
            </tr>
            <tr>
                <td style="display:inline-block; font-size: 10px; width:100%;">
                    <span style="display:inline-block; width: 500px; color:#5f5959;">Product Model : {{$product['model']}}</span>
                    <span style="width: 300px; float: right; margin-right:20px;"></span>
                </td>
            </tr>
            <tr>
                <td style="display:inline-block; font-size: 10px; width:100%; color:#5f5959;">
                    <span>Product Variation :
                        @if ($product['variation'])
                            @foreach ($product['variation'] as $key => $node)
                                {{ $key }}: {{ $node }} &nbsp;
                            @endforeach
                        @endif
                    </span>
                    <span style="display: inline-block; float: right; margin-right:20px;"> Date : </span>
                </td>
            </tr>
        </table>
    </div>

    <table table style="width:700px;font-size: 10px; margin:0 auto 0 auto; border:0.5px solid #949494; border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
        <thead style="width:700px;">
            <tr style="width:100%; color:#5f5959">
                <th style="padding:4px 4px 4px 4px; font-weight:normal; border-top:0.5px solid #949494;   border-right:0.5px solid #5f5959; font-weight:400;"><h2 style="font-size:11px;">Date</h2> </th>
                <th style="padding:4px 4px 4px 8px; text-align:left;  border-top:0.5px solid #949494; font-weight:normal; width:100px;  border-right:0.5px solid #5f5959; font-weight:400;"> <h2 style="font-size:11px;">Particulars</h2></th>
                <th style="padding:4px 4px 4px 0; font-weight:normal; border-top:0.5px solid #949494;  border-bottom:0.5px solid #5f5959; border-right:0.5px solid #5f5959; font-weight:400;" colspan="2"><h2 style="font-size:11px;">Debit</h2></th>
                <th style="padding:4px 4px 4px 0; font-weight:normal; border-top:0.5px solid #949494; border-bottom:0.5px solid #5f5959; border-right:0.5px solid #5f5959; font-weight:400;" colspan="2"><h2 style="font-size:11px;;">Credit</h2></th>
                <th style="padding:4px 4px 4px 0; font-weight:normal; border-top:0.5px solid #949494; border-bottom:0.5px solid #5f5959; font-weight:400;" colspan="2"><h2 style="font-size:11px;">Balance</h2></th>
            </tr>
            <tr style="width: 100%; font-size: 10px; color:#5f5959; border-bottom:0.5px solid #5f5959;">
                <th style="text-align:center; padding:4px 4px 4px 0; border-right:0.5px solid #5f5959;"></th>
                <th style="padding: 4px 4px 4px 0;"></th>
                <th style="text-align:center; padding:4px 4px 4px 0; border-left:0.5px solid #5f5959; border-right:0.5px solid #5f5959; font-weight:400;"><h2 style="font-size:11px;">Qutantity </h2></th>
                <th style="text-align:center; padding:4px 4px 4px 0; border-right:0.5px solid #5f5959; font-weight:400;"><h2 style="font-size:11px;">value</h2> </th>
                <th style="text-align:center; padding:4px 4px 4px 0; border-right:0.5px solid #5f5959; font-weight:400;"><h2 style="font-size:11px;">Qutantity</h2> </th>
                <th style="text-align:center; padding:4px 4px 4px 0; border-right:0.5px solid #5f5959; font-weight:400;"><h2 style="font-size:11px;">value </h2></th>
                <th style="text-align:center; padding:4px 4px 4px 0; border-right:0.5px solid #5f5959; font-weight:400;"><h2 style="font-size:11px;">Qutantity</h2></th>
                <th style="text-align:center; padding:4px 4px 4px 0; ">value</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $item )
                <tr style="width: 100%; font-size: 10px; color:#5f5959;">
                    <td style="text-align:center; padding:4px 4px 4px 4px;  border-right:0.5px solid #5f5959;">{{$item['date']}}</td>
                    <td  style="padding: 4px 4px 4px 8px;  border-right:0.5px solid #5f5959; width:200px;">
                        {{$item['invoice_id']}}
                    </td>
                    <td style="text-align:center; padding:4px 4px 4px 0; border-right:0.5px solid #5f5959;">
                        {{$item['debit_quantity']}}
                    </td>
                    <td style="text-align:center; padding:4px 4px 4px 0;  border-right:0.5px solid #5f5959;">
                        {{$item['debit_value']}}
                    </td>
                    <td style="text-align:center; padding:4px 4px 4px 0;  border-right:0.5px solid #5f5959;">
                        {{$item['credit_quantity']}}

                    </td>
                    <td style="text-align:center; padding:4px 4px 4px 0;  border-right:0.5px solid #5f5959;">
                        {{$item['credit_value']}}
                    </td>
                    <td style="text-align:center; padding:4px 4px 4px 0;  border-right:0.5px solid #5f5959;">
                        {{$item['totalQuantity']}}
                    </td>
                    <td style="text-align:center; padding:4px 4px 4px 0; ">
                        {{$item['balance']}}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div style="width:700px; margin:30px auto; font-family: Arial, Helvetica, sans-serif;">
        <div style="width: 300px; float:left; font-weight:500; margin-right:35px">
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Total Debit Quantity  :&nbsp; {{$d_quantity}} PCS</h2>
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Total Debit Amount :&nbsp; {{$debit}} BDT</h2>
        </div>

        <div style="width: 300px; float:left; font-weight:400;">
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Total Credit Quantity:&nbsp; {{$c_quantity}} PCS</h2>
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Total Credit Amount :&nbsp; {{$credit}} BDT</h2>
        </div>
    </div>
</body>
</html>