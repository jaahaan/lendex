<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            padding: 20px;
        }
        @page { size: a4 portrait; }
    </style>
</head>
<body>
    <div  style="width:700px; margin: 0 auto; font-size:18px; font-weight:600; margin-top:30px; overflow: hidden; height: 100px;">
        <div style="height: 1px; text-align:left; width:300px; font-family: Arial, Helvetica, sans-serif;">
            <!-- <img style="width: 85px; height: 85px;" src="https://admin2.finesselimited.com/img/admin_logo.png" alt="admin_logo"> -->
            <img style="width: 85px; height:auto;"  src="{{ $setting->companyLogo}}" alt="admin_logo">
        </div>
        <div style="width:300px; height:100px; margin-top: 10px; float:right; text-align:right; font-family: Arial, Helvetica, sans-serif;">
            <h2 style="font-weight:400; font-size:17px; color:#5f5959;"> {{$setting->companyName}} </h2>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting->address}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting->supportContact}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting->supportEmail}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting->websiteLink}}</p>
        </div>
    </div>

    <div style="width:700px; margin:15px auto 0 auto; border:1px solid #949494; font-family: Arial, Helvetica, sans-serif;">
        <h2 style="font-weight:400; font-size:16px; text-align:center; padding:8px 0 10px 0;  font-family: Arial, Helvetica, sans-serif;">Return Purchase Report</h2>
        <table style="width: 700px; padding:5px;">
            <tr>
                <td style="display:inline-block; font-size: 10px; width:100%;  font-family: Arial, Helvetica, sans-serif;">
                    <span style="display:inline-block;  color:#5f5959;">Total Purchase Amount : {{abs($totalPurchaseAmount)}}</span>
                    <span style="width: 300px; float: right; margin-right:20px;"></span>
                </td>
            </tr>
            <tr>
                <td style="display:inline-block; font-size: 10px;  color:#5f5959;  font-family: Arial, Helvetica, sans-serif;">
                    <span>Date :{{$from}} - {{$to}}</span>
                    <span style="display: inline-block; float: right; margin-right:20px;"> </span>
                </td>
            </tr>
        </table>
    </div>

    @foreach ($data as $item)
    <div style="width: 700px; margin:30px auto 0 auto; font-family: Arial, Helvetica, sans-serif;">
        <div style="width: 700px;">
            <div style="display:inline-block; width: 700px;  text-align:left; height:20px; font-size: 10px; width:100%; color:#5f5959; margin-bottom: 5px;">
                <p style="display: inline-block; float: left; width: 300px;">
                    Customer Name : {{$item['supplierName']}}
                </p>

                <p style="display: inline-block; float: left; text-align:left;">
                    Admin : {{$item['adminName']}}
                </p>
            </div>
            <div style="display:inline-block; width: 700px;  text-align:left; height:20px; font-size: 10px; width:100%; color:#5f5959; margin-bottom: 5px;">
                <p  style="display: inline-block; float: left; width: 300px;">
                    Invoice No : {{$item['invoice_id']}}
                </p>
                <p style="display: inline-block; float: left; text-align:left;">
                    @if ($item['store'])
                    Branch Name : {{$item['store']['branch_name']}}
                    @else
                    Branch Name :
                    @endif
                </p>
            </div>
            <div style="display:inline-block; width: 700px;  text-align:left; height:20px; font-size: 10px; width:100%; color:#5f5959; margin-bottom: 5px;">
                <p  style="display: inline-block; float: left; width: 300px;">
                    Date : {{$item['date']}}
                </p>
                @if ($item['account'])
                    <p style="display: inline-block; float: left; text-align:left;">
                        Account : {{$item['account']['account_name']}}
                    </p>
                @else
                    <p style="display: inline-block; float: left; text-align:left;">
                        Account :
                    </p>
                @endif
            </div>
        </div>
        <table table style="width:700px;font-size: 10px; margin:10px auto 0 auto; border:1px solid  #949494; border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
            <thead style="width:700px;">
                <tr style="background-color: #5e5c5c; width:700px; color:white">
                    <th style="padding:4px 4px 4px 20px; text-align:left; font-weight:normal;" colspan="4">Product Name</th>
                    <th style="padding:4px 4px 4px 0; text-align:left; font-weight:normal; width:100px;"> Sales Quantity</th>
                    <th style="padding:4px 4px 4px 0;text-align:left; font-weight:normal; width:100px;">Unit Price</th>
                    <th style="padding:4px 4px 4px 0;text-align:left; font-weight:normal; width:120px;">Total Sales Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item['returnPurchase'] as $purchase)
                <tr style="width: 100%; font-size: 10px; color:#3c3636; ">
                    <td style="text-align:left; padding:4px 4px 4px 20px;" colspan="4"> {{$purchase['product']['productName']}} </td>
                    <td  style="padding: 4px 4px 4px 0; margin-right:5px; width:100px;">{{abs($purchase['product']['totalQuantity'])}}</td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:100px;">{{abs($purchase['unitPrice'])}} </td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:120px;">{{abs($purchase['quantity'] * $purchase['unitPrice'])}}  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
    <!-- <div style="width: 700px; margin:30px auto 0 auto; font-family: Arial, Helvetica, sans-serif;">
        <div style="display:inline-block; font-size: 10px; width:100%; color:#5f5959;">
            <p style="display: inline-block;float: left; width: 340px;  ">
                Customer Name :
            </p>

            <p style="display: inline-block; float: left; text-align:left; margin-right:20px; margin-left:20px;">
                Admin :
            </p>
        </div>
        <div style="display:inline-block; font-size: 10px; width:100%; color:#5f5959; ">
            <p  style="display: inline-block; float: left; width: 340px; ">
                Invoice No :
            </p>
            <p style="display: inline-block; float: left; text-align:left; margin-right:20px; margin-left:20px;">
                Branch Name :
            </p>
        </div>
        <div style="display:inline-block; font-size: 10px; width:100%; color:#5f5959; ">
            <p  style="display: inline-block;float: left; width: 340px; ">
                Date :
            </p>
            <p style="display: inline-block; float: left; text-align:left; margin-right:20px; margin-left:20px;">
                Account :
            </p>
        </div>
        <table  style="width:700px;font-size: 10px; margin:10px auto 0 auto; border:1px solid  #949494; border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
            <thead style="width:700px;">
                <tr style="background-color: #5e5c5c; width:700px; color:white">
                    <th style="padding:4px 4px 4px 20px; text-align:left; font-weight:normal;" colspan="4">Product Name</th>
                    <th style="padding:4px 4px 4px 0; text-align:left; font-weight:normal; width:100px;"> Sales Unit</th>
                    <th style="padding:4px 4px 4px 0;text-align:left; font-weight:normal; width:100px;">Unit Price</th>
                    <th style="padding:4px 4px 4px 0;text-align:left; font-weight:normal; width:120px;">Total Sales Price</th>
                </tr>
            </thead>
            <tbody>
                <tr style="width: 100%; font-size: 10px; color:#3c3636; ">
                    <td style="text-align:left; padding:4px 4px 4px 20px;" colspan="4">Product Name</td>
                    <td  style="padding: 4px 4px 4px 0; margin-right:5px; width:100px;">Sales Unit</td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:100px;">Unit Price </td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:120px;">Total Sales Price </td>
                </tr>
                <tr style="width: 100%; font-size: 10px; color:#3c3636; ">
                    <td style="text-align:left; padding:4px 4px 4px 20px;" colspan="4">Product Name</td>
                    <td  style="padding: 4px 4px 4px 0; margin-right:5px; width:100px;">Sales Unit</td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:100px;">Unit Price </td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:120px;">Total Sales Price </td>
                </tr>
                <tr style="width: 100%; font-size: 10px; color:#3c3636; ">
                    <td style="text-align:left; padding:4px 4px 4px 20px;" colspan="4">Product Name</td>
                    <td  style="padding: 4px 4px 4px 0; margin-right:5px; width:100px;">Sales Unit</td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:100px;">Unit Price </td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:120px;">Total Sales Price </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div style="width: 700px; margin:30px auto 0 auto; font-family: Arial, Helvetica, sans-serif;">
        <div style="display:inline-block; font-size: 10px; width:100%; color:#5f5959; ">
            <p style="display: inline-block;float: left; width: 340px;">
                Customer Name :
            </p>

            <p style="display: inline-block; float: left; text-align:left; margin-right:20px; margin-left:20px;">
                Admin :
            </p>
        </div>
        <div style="display:inline-block; font-size: 10px; width:100%; color:#5f5959; ">
            <p  style="display: inline-block; float: left; width: 340px;">
                Invoice No :
            </p>
            <p style="display: inline-block; float: left; text-align:left; margin-right:20px; margin-left:20px;">
                Branch Name :
            </p>
        </div>
        <div style="display:inline-block; font-size: 10px; width:100%; color:#5f5959; ">
            <p  style="display: inline-block;float: left; width: 340px;">
                Date :
            </p>
            <p style="display: inline-block; float: left; text-align:left; margin-right:20px; margin-left:20px;">
                Account :
            </p>
        </div>
        <table table style="width:700px;font-size: 10px; margin:10px auto 0 auto; border:1px solid  #949494; border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
            <thead style="width:700px;">
                <tr style="background-color: #5e5c5c; width:700px; color:white">
                    <th style="padding:4px 4px 4px 20px; text-align:left; font-weight:normal;" colspan="4">Product Name</th>
                    <th style="padding:4px 4px 4px 0; text-align:left; font-weight:normal; width:100px;"> Sales Unit</th>
                    <th style="padding:4px 4px 4px 0;text-align:left; font-weight:normal; width:100px;">Unit Price</th>
                    <th style="padding:4px 4px 4px 0;text-align:left; font-weight:normal; width:120px;">Total Sales Price</th>
                </tr>
            </thead>
            <tbody>
                <tr style="width: 100%; font-size: 10px; color:#3c3636; ">
                    <td style="text-align:left; padding:4px 4px 4px 20px;" colspan="4">Product Name</td>
                    <td  style="padding: 4px 4px 4px 0; margin-right:5px; width:100px;">Sales Unit</td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:100px;">Unit Price </td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:120px;">Total Sales Price </td>
                </tr>
                <tr style="width: 100%; font-size: 10px; color:#3c3636; ">
                    <td style="text-align:left; padding:4px 4px 4px 20px;" colspan="4">Product Name</td>
                    <td  style="padding: 4px 4px 4px 0; margin-right:5px; width:100px;">Sales Unit</td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:100px;">Unit Price </td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:120px;">Total Sales Price </td>
                </tr>
                <tr style="width: 100%; font-size: 10px; color:#3c3636; ">
                    <td style="text-align:left; padding:4px 4px 4px 20px;" colspan="4">Product Name</td>
                    <td  style="padding: 4px 4px 4px 0; margin-right:5px; width:100px;">Sales Unit</td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:100px;">Unit Price </td>
                    <td style="text-align:left; width:110px; padding:4px 4px 4px 0; width:120px;">Total Sales Price </td>
                </tr>
            </tbody>
        </table>
    </div> -->
</body>
</html>
