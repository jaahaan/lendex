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

    <div style="width:700px; margin:15px auto 0 auto; border:1px solid #949494; font-family: Arial, Helvetica, sans-serif;">
        <h2 style="font-weight:400; font-size:16px; text-align:center; padding:7px;">Membership Report</h2>
        <table style="width:700px; padding:5px;">
            <tr>
                <td style="display:inline-block; font-size: 10px; width:100%;">
                    <span style="display:inline-block; width: 500px; color:#5f5959;">Total Member : {{$total_member}}</span>
                    <span style="width: 300px; float: right; margin-right:20px;"></span>
                </td>
            </tr>

        </table>
    </div>

    <table table style="width:700px;font-size: 10px; margin:40px auto 0 auto; border:1px solid  #949494; border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
        <thead style="width:700px;">
            <tr style="background-color: #5e5c5c; width:100%; color:white">
                <th style="padding:4px 4px 4px 15px; text-align:left; font-weight:300; font-weight:normal;">Member Name</th>
                <th style="text-align:center; font-weight:300; font-weight:normal;"> Mobile</th>
                <th style="padding:4px 4px 4px 0; font-weight:300; font-weight:normal;">Address</th>
                <th style="padding:4px 4px 4px 0; font-weight:300; font-weight:normal;">City</th>
                <th style="padding:4px 4px 4px 0; font-weight:300; font-weight:normal; ">Zone</th>
                <th style="padding:4px 4px 4px 0; font-weight:300; font-weight:normal;">Membership Code</th>
                <th style="padding:4px 4px 4px 0; font-weight:300; font-weight:normal;">Bonus Point</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr style="width: 100%; font-size: 10px; color:#5f5959;">
                    <td style="text-align:left; padding:4px 4px 4px 15px ; min-width: 100px">{{$item['customerName']}}</td>
                    <td  style="padding: 4px 4px 4px 4px; text-align:center; min-width: 60px;">{{$item['contact']}}</td>
                    <td style="text-align:center; padding:4px 4px 4px 0; min-width: 60px;">{{$item['address']}} </td>
                    <td style="text-align:center; padding:4px 4px 4px 0; min-width: 60px;">
                            {{$item['city'] ? $item['city']['name'] : ''}}
                    </td>

                    <td style="text-align:center; padding:4px 4px 4px 0; min-width: 60px;">{{$item['zone']}}</td>
                    <td style="text-align:center; padding:4px 4px 4px 0; min-width: 80px;">{{$item['barcode']}}</td>
                    <td style="text-align:center; padding:4px 4px 4px 0; min-width: 60px;">
                            {{$item['bonusAmount'] ? $item['bonusAmount']['totalAmount'] : ''}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
