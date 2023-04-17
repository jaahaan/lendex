<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}">
        <title></title>
       <link href={{ asset('css/all.css' ) }} rel="stylesheet">
        <!-- <script>
            (function () {
            window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };


                @if(Auth::check())
                window.authUser={!! Auth::user() !!}
                @else
                    window.authUser=false
                @endif
            })();
      </script> -->
      <style>
        *{
            padding: 0;
            margin: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            /* font-family: 'Times New Roman', Times, serif; */
        }
        @page { size: a4 landscape; }

      </style>
    </head>
    <body>
        <div style="width: 800px; margin: 0 auto; background-color: #c7c8c9; font-size:18px; font-weight:600; margin-top:20px; height: 50px;">
            <p style="display: inline-block; width:50%; float:left; padding-left:20px;">Loan Account Statement </p>
            <p style="display: inline-block; width:50%; float:left;">Date: 08-Aug-2022 : 16:53:29 PM <br>Page 1 of 1</p>
        </div>
        <!-- <div style="display:flex; flex-direction:row; width:800px; margin:0 auto; background-color: #c7c8c9;font-size:18px; font-weight:600; margin-top:20px">
            <p style="width:50%; margin-left:20px;">Loan Account Statement</p>
            <div style="width:50%; display:flex; flex-direction:column;">
                <p>Date: 08-Aug-2022 : 16:53:29 PM</p>
                <p>Page 1 of 1</p>
            </div>
        </div> -->
        <br>
        <br>
        <table style="width:800px;font-size:14px; border:1px solid #000; margin:0 auto;font-size:16px; font-weight:600;">
            <tr style="width:100%;">
                <td style="width: 50%; padding-left:20px;">
                    <span style=" display: inline-block; width:150px">Contact Ref no</span>
                    <span style="width:200px"> :&nbsp; 0910718000000054</span>
                </td> 
                <td style="width: 50%;">
                    <span style=" display: inline-block;  width: 200px;">Date From</span>
                    <span style="width:200px"> :&nbsp; 01-Jan-2022</span>
                </td>
            </tr>
            <tr style="width:100%;">
                <td style="width: 50%; padding-left:20px;">
                    <span style="display: inline-block; width:150px">Product Name</span>
                    <span style="width:200px"> :&nbsp; ASHA</span>
                </td>
                <td style="width: 50%;">
                    <span style="display: inline-block;  width: 200px;">Date To</span>
                    <span style="width:200px"> :&nbsp;  08-AUG-2022</span>
                </td>
            </tr>
            <tr style="width:100%;">
                <td style="width: 50%; padding-left:20px;">
                    <span style="display: inline-block; width:150px">Customer ID </span>
                    <span style="width:200px"> :&nbsp; 2466357</span>
                </td>
                <td style="width: 50%; ">
                    <span style="display: inline-block;  width: 200px;">Interest Rate</span>
                    <span style="width:200px"> :&nbsp;  9.00  %</span>
                </td>
            </tr>
            <tr style="width:100%;">
                <td style="width: 50%;  padding-left:20px;">
                    <span style="display: inline-block; width:150px">Customer Name  </span>
                    <span style="width:200px"> :&nbsp;  Dreams Gallary</span>
                </td>
                <td style="width: 50%;">
                    <span style="display: inline-block;  width: 200px;">Loan Currency</span>
                    <span style="width:200px"> :&nbsp;  BDT</span>
                </td>
            </tr>
            <tr style="width:100%;">
                <td style="width: 50%; padding-left:20px;">
                    <span style="display: inline-block; width:150px">Address</span>
                    <span style="width:200px;"> :&nbsp;  904 City Center 9th floor Zindabazar Sylhet</span>
                    
                </td>
                <td style="width: 50%;">
                    <span style="display: inline-block;  width: 200px;">Amount Sanctioned  </span>
                    <span style="width:200px"> :&nbsp;  1200000</span>
                </td>
            </tr>
            <tr style="width:100%;">
                <td style="width: 50%; padding-left:20px;">
                    
                </td>
                <td style="width: 50%;">
                    <span style="display: inline-block; width: 200px;">Loan Start Date  </span>
                    <span style="width:200px"> :&nbsp;  31-Mar-2022</span>
                </td>
            </tr>
            <tr style="width:100%;">
                <td style="width: 50%; padding-left:20px;">
                    <!-- <div style="width:150px">Linked Account</div>
                    <div style="width:200px"> :&nbsp;  0911070194105</div> -->
                </td>
                <td style="width: 50%;">
                    <span style="display: inline-block;  width: 200px;">Loan Expire Date  </span>
                    <span style="width:200px"> :&nbsp;  31-Aug-2022</span>
                </td>
            </tr>
            <tr style="width:100%;">
                <td style="width: 50%; padding-left:20px;">
                    <!-- <div style="width:150px">Linked Account</div>
                    <div style="width:200px"> :&nbsp;  0911070194105</div> -->
                </td>
                <td style="width: 50%;">
                    <span style="display: inline-block;  width: 200px;">Account Status  </span>
                    <span style="width:200px"> :&nbsp;  Active</span>
                </td>
            </tr>
            <tr style="width:100%;">
                <td style="width: 50%; padding-left:20px;">
                    <!-- <div style="width:150px">Linked Account</div>
                    <div style="width:200px"> :&nbsp;  0911070194105</div> -->
                    <span style="display: inline-block; width:150px">Linked Account</span>
                    <span style="width:200px"> :&nbsp;  0911070194105</span>
                </td>
                <td style="width: 50%;">
                    <span style="display: inline-block; width: 200px;">Reschedule/Restructure </span>
                    <span style="width:200px"> :&nbsp;  No</span>
                </td>
            </tr>
            <!-- <tr style="width:100%;">
                <td style="width: 50%;">
                    <span>Contact Ref  <br> no</span>
                    <span style=""> :&nbsp;0910718000000054</span>
                </td>
            </tr> -->
        </table>
        <!-- <div style="display: -webkit-box; display: -webkit-flex; display:flex; gap:40px; width:800px;   font-size:16px; font-weight:600; border:1px solid #000; margin:0 auto;"> 
            <div style="width:50%;display: -webkit-box; display: -webkit-flex; display:inline-block;  margin-left:20px; flex-direction:column;  ">
                <div style="display: -webkit-box; display: -webkit-flex; display:flex;">
                    <p style="width:150px">Contact Ref  <br> no   </p> :&nbsp;
                    <p style="width:200px"> 0910718000000054</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex;">
                    <p style="width:150px">Product  <br> Name  </p>  :&nbsp;
                    <p style="width:150px"> ASHA</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex;">
                    <p style="width:150px">Customer ID   </p>  :&nbsp;
                    <p style="width:150px"> 2466357</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex;">
                    <p style="width:150px">Customer Name    </p>  :&nbsp;
                    <p style="width:150px"> Dreams Gallary</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex;">
                    <p style="width:150px">Address  </p> :&nbsp;
                    <p style="width:150px"> 904 City Center 9th floor Zindabazar Sylhet</p>
                </div><br><br>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex;">
                    <p style="width:150px">Linked <br> Account    </p>  :&nbsp;
                    <p style="width:150px"> 0911070194105</p>
                </div>
            </div> 
            <div style="width:50%;display: -webkit-box; display: -webkit-flex; display: -webkit-box; display: -webkit-flex; display:inline-block; flex-direction:column;">
                <div style="display: -webkit-box; display: -webkit-flex;  display:flex; ">
                    <p style="width:200px">Date From  </p> :&nbsp;
                    <p style="width:150px;"> 01-Jan-2022</p>
                </div><br>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex; ">
                    <p style="width:200px">Date To</p>  : &nbsp;
                    <p style="width:150px;"> 08-AUG-2022</p>
                </div><br>
                <div style="display: -webkit-box; display: -webkit-flex;  display:flex; ">
                    <p style="width:200px">Interest Rate </p> : &nbsp;
                    <p style="width:150px;"> 9.00  %</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex;  display:flex; ">
                    <p style="width:200px">Loan Currency </p> : &nbsp;
                    <p style="width:150px;"> BDT</p>
                </div><br>
                <div style="display: -webkit-box; display: -webkit-flex;  display:flex; ">
                    <p style="width:200px">Amount Sanctioned </p> : &nbsp;
                    <p style="width:150px;"> 1200000</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex; ">
                    <p style="width:200px">Loan Start Date</p> : &nbsp;
                    <p style="width:150px;"> 31-Mar-2022</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex; ">
                    <p style="width:200px">Loan Expire Date</p> : &nbsp;
                    <p style="width:150px;"> 25-OCT-2024</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex; display:flex; ">
                    <p style="width:200px">Account Status</p> : &nbsp;
                    <p style="width:150px;">  Active</p>
                </div>
                <div style="display: -webkit-box; display: -webkit-flex;display:flex; ">
                    <p style="width:200px">Reschedule/Restructure</p> : &nbsp;
                    <p style="width:150px;">  No</p>
                </div>
            </div>
        </div> -->

                

        <table style="width:800px;font-size:14px; margin:40px auto 0 auto; border:1px solid gray; border-collapse:collapse;">
                <thead>
                    <tr style="background-color:#c7c8c9;">
                        <th style="border:1px solid gray; padding:1px 2px; text-align:center;">tran_date</th>
                        <th style="border:1px solid gray; padding:1px 2px; text-align:center;">Particular</th>
                        <th style="border:1px solid gray; padding:1px 2px; text-align:center;">Component</th>
                        <th style="border:1px solid gray; padding:1px 2px; text-align:center;">Debit</th>
                        <th style="border:1px solid gray; padding:1px 2px; text-align:center;">Credit</th>
                        <th style="border:1px solid gray; padding:1px 2px; text-align:center;">Running Balance</th>
                        <th style="border:1px solid gray; padding:1px 2px; text-align:center;">*** Other changes</th>
                    </tr>
                </thead>
                <tbody >
                    <tr>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">31-MAR-2022</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Vat on Management Fees</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Principle Amount</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                    </tr>
                    <tr>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">31-MAR-2022</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Disbursement</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Principle Amount</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                    </tr>
                    <tr>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">31-MAR-2022</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Disbursement</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Principle Amount</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                    </tr>
                    <tr>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">31-MAR-2022</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Disbursement</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Principle Amount</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                    </tr>
                    <tr>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">31-MAR-2022</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Disbursement</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Principle Amount</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                    </tr>
                    <tr>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">31-MAR-2022</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Disbursement</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">Principle Amount</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">1200000</td>
                        <td style="width:110px; border:1px solid gray; padding: 0 2px; text-align:center;">0.0</td>
                    </tr>
                </tbody>
        </table>
        <br>
        <br>
        <div>
            <p style="width:800px; margin:0 auto; border:1px solid black; padding:5px; text-align:center; font-size:16px; font-weight:500">
                *** This is system generated statement and Other charges was deducted from link account which is not included in the Running Balance
            </p>
        </div>

       <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>
