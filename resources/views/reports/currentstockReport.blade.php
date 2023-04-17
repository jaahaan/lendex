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
            padding: 20px;
        }
        @page { size: a4 portrait; }
    </style>
</head>
<body>
    <div style="width:700px; margin: 0 auto; font-size:18px; font-weight:600; margin-top:30px; overflow: hidden; height: 100px;">
        <div style="height: 1px; text-align:left; width:300px; font-family: Arial, Helvetica, sans-serif;">
            <img style="width: 85px; height: 85px;" src="https://admin2.finesselimited.com/img/admin_logo.png" alt="admin_logo">
             <!-- <img style="width: 85px; height:auto;"  src="{{ $setting['companyLogo']}}" alt="admin_logo"> -->
        </div>
        <div style="width:300px; height:100px; float:right; margin-top:10px; text-align:right; font-family: Arial, Helvetica, sans-serif;">
            <h2 style="font-weight:400; font-size:17px; color:#5f5959;">{{$setting['companyName']}}</h2>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['address']}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['supportContact']}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['supportEmail']}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['websiteLink']}}</p>
        </div>
    </div>

    <div style="width:700px; margin:15px auto 30px auto; border:1px solid #949494; font-family: Arial, Helvetica, sans-serif;">
        <h2 style="font-weight:400; font-size:16px; text-align:center; padding:8px 0 10px 0;">Current Stock Report</h2>
    </div>

    <table table style="width:700px;font-size: 10px; margin:0 auto 0 auto; border:1px solid  #949494; border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
        <thead>
            <tr style="background-color: #5e5c5c; width: 700px; color:white">
                <th style="padding:4px 4px 4px 2px; text-align:center; font-weight:normal; ">ID</th>
                <th style="padding: 4px 4px 4px 10px; text-align:left; font-weight:normal; "> Product Name</th>
                <th style="padding:4px 4px 4px 0;text-align:left; font-weight:normal; ">Product Model</th>
                <th style="padding:4px 4px 4px 0;text-align:left; font-weight:normal; ">Category</th>
                <th style="padding:4px 4px 4px 0; text-align:left; font-weight:normal; ">Subcategory</th>
                <th style="padding:4px 4px 4px 0; text-align:left; font-weight:normal; ">Variant</th>
                <th style="padding:4px 4px 4px 0; text-align:left; font-weight:normal; ">Stock</th>
                <th style="padding:4px 4px 4px 0; text-align:left; font-weight:normal; ">Unit Cost</th>
                <th style="padding:4px 4px 4px 0; text-align:left; font-weight:normal;">Total Cost</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr style="width: 100%; font-size: 10px; color:#5f5959;">
                    <td style="text-align:center; padding:4px 4px 4px 2px; min-width:30px;">{{$item['id']}}</td>
                    <td style="text-align:left; padding: 4px 4px 4px 10px; min-width:130.24px"> {{$item['productName']}}</td>
                    <td style="text-align:left; width:90px; padding:4px 4px 4px 0; max-width:80.03px;">{{$item['model']}}</td>
                    <td style="text-align:left; width:90px; padding:4px 4px 4px 0; max-width:71.16px;">
                        @if($item['group'])
                            {{$item['group']}}
                        @endif
                    </td>
                    <td style="text-align:left; width:80px; padding:4px 4px 4px 0; max-width:71.13px;">
                        @if($item['category'])
                            {{$item['category']}}
                        @endif
                    </td>
                    <td style="text-align:left; width:80px; padding:4px 4px 4px 0; max-width:71.22px;">
                        @if($item['variation'])
                            @foreach ($item['variation'] as $node)
                                {{ $node }} | &nbsp;
                            @endforeach
                        @endif
                    </td>
                    <td style="text-align:left; width:80px; padding:4px 4px 4px 0; max-width:65.01px;">
                        {{$item['currentStock']}}
                    </td>
                    <td style="text-align:left; width:80px; padding:4px 4px 4px 0; max-width:65.21px;">
                        {{$item['averageBuyingPrice']}}
                    </td>
                    <td style="text-align:left; width:90px; padding:4px 4px 4px 0;  max-width:70.51px;">
                        {{$item['totalCost']}}
                    </td>
                </tr>

            @endforeach


        </tbody>
    </table>
    <div style="width:700px; margin:30px auto; font-family: Arial, Helvetica, sans-serif;">
        <div style="width: 300px; float:left; font-weight:500; margin-right:35px">
            <h2 style="margin-bottom: 5px; font-size: 12px; font-weight:400;">Total Stock Quantity :&nbsp; {{$totalStock}} PCS</h2>
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Total Stock Amount :&nbsp;  {{$totalCost}} BDT </h2>
        </div>

    </div>
</body>
</html>
