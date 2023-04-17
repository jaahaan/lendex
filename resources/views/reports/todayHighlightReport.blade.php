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
<div style="color:black">
                <h3 style="text-align:center; width:100%; font-weight: 400; margin-bottom: 25px; font-family: Arial, Helvetica, sans-serif;">Todays Highlights Report</h3>

                <div span="24" style="margin-bottom: 15px; margin-left: 40px; font-family: Arial, Helvetica, sans-serif;">
                    <h3 style="font-size: 20px; margin-bottom: 5px; font-family: Arial, Helvetica, sans-serif;">Purchase</h3>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;  font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Purchase Amount</span> : &nbsp;{{ $puchaseSubTotal }} {{$setting['currencyType']}} </p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;  font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Purchase QTY</span> :&nbsp; {{$purchasetotalQuantity}} PCS</p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;  font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Payment Amount</span> :&nbsp; {{$paymentTotal}} {{$setting['currencyType']}} </p>
                    <!-- <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400; "><span style="font-weight: bold;">Cash</span> 1000$ | <span style="font-weight: bold;">BKASH</span> 500 $ | <span style="font-weight: bold;">City</span> POS 660 $</p> -->
                    @foreach($paymentObj as $payment)
                    <span  style="font-weight: bold; margin-bottom:2px; font-weight: 400;  font-family: Arial, Helvetica, sans-serif;" ><span style="font-weight: bold;">{{$payment['name']}} - </span> {{$payment['amount']}} {{$setting['currencyType']}} | &nbsp;</span>
                    @endforeach
                </div>
                <div span="24" style="margin-bottom: 15px; margin-left: 40px;  font-family: Arial, Helvetica, sans-serif;">
                    <h3 style="font-size: 20px; margin-bottom: 5px;  font-family: Arial, Helvetica, sans-serif;">Sales</h3>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Sales Amount</span> : &nbsp; {{$saleSubTotal}} {{$setting['currencyType']}} </p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Sales QTY</span> :&nbsp; {{$saleTotalQuantity}} PCS</p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Collection Amount</span> :&nbsp; {{$collectionTotal}} {{$setting['currencyType']}} </p>
                    @foreach($collectionObj as $collection)
                    <span  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">{{$collection['name']}} - </span> {{$collection['amount']}} {{$setting['currencyType']}} | &nbsp;</span>
                    @endforeach
                    <!-- <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400; "><span style="font-weight: bold;">Cash</span> 1000$ | <span style="font-weight: bold;">BKASH</span> 500 $ | <span style="font-weight: bold;">City</span> POS 660 $</p> -->
                </div>
                <div span="24" style="margin-bottom: 15px; margin-left: 40px;  font-family: Arial, Helvetica, sans-serif;">
                    <h3 style="font-size: 20px; margin-bottom: 5px; font-family: Arial, Helvetica, sans-serif;">Return & Exchange</h3>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Return Amount</span> : &nbsp; {{$returnSubTotal}} {{$setting['currencyType']}} </p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Return QTY</span> :&nbsp; {{$returnTotalQuantity}} PCS</p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Exchane Amount</span> :&nbsp; {{$exchangeSubTotal}} {{$setting['currencyType']}} </p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Exchange QTY</span>:&nbsp; {{$exchangeTotalQuantity}} PCS </p>
                </div>
                <div span="24" style="margin-bottom: 15px; margin-left: 40px;  font-family: Arial, Helvetica, sans-serif;">
                    <h3 style="font-size: 20px; margin-bottom: 5px; font-family: Arial, Helvetica, sans-serif;">Expense | Investment | Income | Withdraw</h3>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Expense Amount</span> : &nbsp; {{$expense_voucher}} {{$setting['currencyType']}}</p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;    font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Investment Amount</span> :&nbsp; {{$investment_voucher}} {{$setting['currencyType']}} </p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Income Amount</span> :&nbsp; {{$income_voucher}} {{$setting['currencyType']}} </p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Withdraw Amount </span>:&nbsp; {{$withdraw_voucher}} {{$setting['currencyType']}}</p>
                </div>
                <div span="24" style="margin-bottom: 15px; margin-left: 40px;  font-family: Arial, Helvetica, sans-serif;">
                    <h3 style="font-size: 20px; margin-bottom: 5px; font-family: Arial, Helvetica, sans-serif;">Profit & Loss</h3>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Today’s Gross Profit</span> : &nbsp; {{$gross_profit}} {{$setting['currencyType']}}</p>
                    <p  style="font-weight: bold; margin-bottom:2px; font-weight: 400;   font-family: Arial, Helvetica, sans-serif;"><span style="font-weight: bold;">Today’s Net Profit</span> : &nbsp; {{$net_profit}} {{$setting['currencyType']}}</p>
                </div>

        </div>
</body>
</html>