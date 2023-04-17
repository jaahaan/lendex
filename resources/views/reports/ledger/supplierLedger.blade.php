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
    <div  style="width:700px; margin: 0 auto; font-size:18px; font-weight:600; margin-top:30px; overflow: hidden; height: 100px;">
        <div style="height: 1px; text-align:start; width:300px; font-family: Arial, Helvetica, sans-serif;">
            <img style="width: 85px; height: 85px;" src="https://admin2.finesselimited.com/img/admin_logo.png" alt="admin_logo">
        </div>
        <div style="width:300px; height:100px; float:right; text-align:right; font-family: Arial, Helvetica, sans-serif;">
            <h2 style="font-weight:400; font-size:17px; color:#5f5959; margin-bottom: 2px;">{{$setting['companyName']}}</h2>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['address']}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['supportContact']}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['supportEmail']}}</p>
            <p style="font-size: 10px; font-weight:400; color:#5f5959; margin-bottom: 2px;">{{$setting['websiteLink']}}</p>
        </div>
    </div>
        <br>

    <div style="width:700px; margin:0px auto 30px auto; border:1px solid #949494;  font-family: Arial, Helvetica, sans-serif;">
        <h2 style="font-weight:400; font-size:18px; text-align:center; padding:7px;">Supplier Ladger Report</h2>
        <table style="width:700px; padding:5px;">
            <tr>
                <td style="display:inline-block; font-size: 10px; width:100%;">
                    <span style="display:inline-block; width: 500px; color:#5f5959;">Supplier Name: {{$supplier['supplierName']}}</span>
                    <span style="width: 300px; float: right; margin-right:20px;"></span>
                </td>
            </tr>
            <tr>
                <td style="display:inline-block; font-size: 10px; width:100%;">
                    <span style="display:inline-block; width: 500px; color:#5f5959;">Address: {{$supplier['address']}}</span>
                    <span style="width: 300px; float: right; margin-right:20px;"></span>
                </td>
            </tr>
            <tr>
                <td style="display:inline-block; font-size: 10px; width:100%; color:#5f5959;">
                    <span>Mobile: {{$supplier['contact']}}</span>
                    @if ($start_date && $end_date )
                        <span style="display: inline-block; float: right; margin-right:20px;"> Date : {{$start_date}} - {{$end_date}}</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <table table style="width:700px;font-size: 10px; margin:40px auto 0 auto; border:1px solid  #949494; border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
        <thead style="width:700px;">
            <tr style="background-color: #5e5c5c; width:100%; color:white">
                <th style="padding:4px 4px 4px 15px; text-align:left; font-weight:300; font-weight:normal;">Date</th>
                <th style="padding-left:15px; text-align:left; font-weight:300; font-weight:normal;" colspan="2"> Particulars</th>
                <th style="padding-left:15px; text-align:left; font-weight:300; font-weight:normal;" colspan="2"> Branch</th>
                <th style="padding:4px 4px 4px 0; font-weight:300; font-weight:normal;">Debit</th>
                <th style="padding:4px 4px 4px 0; font-weight:300; font-weight:normal;">Credit</th>
                <th style="padding:4px 4px 4px 0; font-weight:300; font-weight:normal;">Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr style="width: 100%; font-size: 10px; color:#5f5959;">
                    <td style="text-align:left; padding:4px 4px 4px 15px ; width: 100px">{{$item['date']}}</td>
                    <td colspan="2" style="padding: 4px 4px 4px 15px; margin-right:5px;">{{$item['particulars']}}</td>
                    <td colspan="2" style="padding: 4px 4px 4px 15px; margin-right:5px;">{{$item['branch']}}</td>
                    <td style="text-align:center; padding:4px 4px 4px 0">{{$item['debit']}}</td>
                    <td style="text-align:center; padding:4px 4px 4px 0">{{$item['credit']}}</td>
                    <td style="text-align:center; padding:4px 4px 4px 0">{{$item['balance']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="width:700px; margin:30px auto; font-family: Arial, Helvetica, sans-serif;">
        <div style="width: 300px; float:left; font-weight:500; margin-right:35px">
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Total Debit Amount  :&nbsp; {{$debit}} BDT</h2>
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Total Credit Amount   :&nbsp; {{$credit}} BDT</h2>
        </div>

        <div style="width: 300px; float:left; font-weight:400;">
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Opening Balance :&nbsp; {{$opening}} BDT</h2>
            <h2 style="margin-bottom: 15px; font-size: 12px; font-weight:400;">Outstanding :&nbsp; {{$outstanding}} BDT</h2>
        </div>
    </div>
</body>
</html>
