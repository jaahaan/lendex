<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Paymentsheet;
use App\Models\Invoice;
use App\Models\Selling;
Use Auth;
date_default_timezone_set('Asia/Dhaka');
class DashboardController extends Controller
{
    public function salesData($from,$to,Request $request){

        $store_id = $request->store_id;
        $date=date("Y-m-d");
        $user = Auth::user();
        if($user->store_id != 0 ) $store_id = $user->store_id;

        if($store_id){

            $pettycash=Paymentsheet::where('store_id',$store_id)->whereBetween('date', array('2010-02-19', $date))->whereIn('type',['incoming','dueincoming','outgoing','outgoingVoucher','incomingTransfer','outgoingTransfer','incomingVoucher','investmentVoucher','bonus'])->sum('amount');
            $accountCash=Paymentsheet::select('account_id',DB::raw('sum(amount) as amount'))
                ->with('account')
                ->where('store_id',$store_id)
                ->whereBetween('date', array('2010-02-19', $date))
                ->whereIn('type',['incoming','dueincoming','outgoing','outgoingVoucher','incomingTransfer','outgoingTransfer','incomingVoucher','investmentVoucher','bonus'])
                ->groupBy('account_id')
                ->get();
            $todayssale=Invoice::orderBy('id', 'desc')
                ->where('date',  $date)
                ->where('store_id',$store_id)
                ->where('type','sell')
                ->sum('subTotal');
            $todayPurchase=Invoice::orderBy('id', 'desc')
                ->where('date',  $date)
                ->where('store_id',$store_id)
                ->where('type','purchase')
                ->sum('subTotal');
            $todayscollection=Paymentsheet::orderBy('id', 'desc')
                ->where('date',  $date)
                ->where('store_id',$store_id)
                // ->whereIn('type',['incoming','dueincoming','incomingVoucher','bonus'])
                ->whereIn('type',['incoming','dueincoming','bonus'])
                ->sum('amount');
            $todayspayment=Paymentsheet::orderBy('id', 'desc')
                ->where('date',  $date)
                ->where('store_id',$store_id)
                ->where('type','outgoing')
                ->where('paymentMethod','cash')
                ->sum('amount');
            $customerOutstanding = Paymentsheet::orderBy('id', 'desc')
                ->whereIn('type',['due','opening','dueincoming'])
                ->where('store_id',$store_id)
                ->where('paymentFor','customer')
                ->sum('amount');
            $supplierOutstanding = Paymentsheet::orderBy('id', 'desc')
                ->whereIn('type',['due','opening','outgoing'])
                ->where('paymentFor','supplier')
                ->where('store_id',$store_id)
                ->where('uid',"!=",1)
                // ->where('paymentMethod','due')
                ->sum('amount');

            $sales = Selling::whereBetween('date', array($from, $to))
            ->where('store_id',$store_id)
            ->select('date', DB::raw('SUM(unitPrice) as total_sale'))
            ->groupBy('date')
            ->get();
            $quantity = Selling::whereBetween('date', array($from, $to))
            ->where('store_id',$store_id)
            ->select('date', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('date')
            ->get();
            $profit = Selling::whereBetween('date', array($from, $to))
            ->where('store_id',$store_id)
            ->select('date', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('date')
            ->get();

            $chart = Selling::whereBetween('date', array($from, $to))
            ->where('store_id',$store_id)
                    ->select('date', DB::raw('SUM(profit*quantity) as total_profit'),DB::raw('SUM(quantity*unitPrice) as total_cost'))
                    ->groupBy('date')
                    ->get();

            return response()->json([
                    'date' => $date,
                    'pettycash' => $pettycash,
                    'accountCash' => $accountCash,
                    'todayssale' => $todayssale,
                    'todayPurchase' => $todayPurchase,
                    'todayscollection' => $todayscollection,
                    'todayspayment' => $todayspayment,
                    'customerOutstanding' => $customerOutstanding,
                    'supplierOutstanding' => $supplierOutstanding,
                    'sales' => $sales,
                    'profit' => $profit,
                    'quantity' => $quantity,
                    'chart' => $chart,
                ],200);
        }

        $pettycash=Paymentsheet::whereBetween('date', array('2010-02-19', $date))->whereIn('type',['incoming','dueincoming','outgoing','outgoingVoucher','incomingTransfer','outgoingTransfer','incomingVoucher','investmentVoucher','bonus'])->sum('amount');
        $accountCash=Paymentsheet::select('account_id',DB::raw('sum(amount) as amount'))
            ->with('account')
            ->whereBetween('date', array('2010-02-19', $date))
            ->whereIn('type',['incoming','dueincoming','outgoing','outgoingVoucher','incomingTransfer','outgoingTransfer','incomingVoucher','investmentVoucher','bonus'])
            ->groupBy('account_id')
            ->get();
        $todayssale=Invoice::orderBy('id', 'desc')
            ->where('date',  $date)
            ->where('type','sell')
            ->sum('subTotal');
        $todayPurchase=Invoice::orderBy('id', 'desc')
            ->where('date',  $date)
            ->where('type','purchase')
            ->sum('subTotal');
        $todayscollection=Paymentsheet::orderBy('id', 'desc')
            ->where('date',  $date)
            // ->whereIn('type',['incoming','dueincoming','incomingVoucher','bonus'])
            ->whereIn('type',['incoming','dueincoming','bonus'])
            ->sum('amount');
        $todayspayment=Paymentsheet::orderBy('id', 'desc')
            ->where('date',  $date)
            ->where('type','outgoing')
            ->sum('amount');
        $customerOutstanding = Paymentsheet::orderBy('id', 'desc')
            ->whereIn('type',['due','opening','dueincoming'])
            ->where('paymentFor','customer')
            ->sum('amount');
        $supplierOutstanding = Paymentsheet::orderBy('id', 'desc')
            ->whereIn('type',['due','opening','outgoing'])
            ->where('paymentFor','supplier')
            ->where('uid',"!=",1)
            // ->where('paymentMethod','due')
            ->sum('amount');

        $sales = Selling::whereBetween('date', array($from, $to))
        ->select('date', DB::raw('SUM(unitPrice) as total_sale'))
        ->groupBy('date')
        ->get();
        $quantity = Selling::whereBetween('date', array($from, $to))
        ->select('date', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('date')
        ->get();
        $profit = Selling::whereBetween('date', array($from, $to))
        ->select('date', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('date')
        ->get();

        $chart = Selling::whereBetween('date', array($from, $to))
                ->select('date', DB::raw('SUM(profit*quantity) as total_profit'),DB::raw('SUM(quantity*unitPrice) as total_cost'))
                ->groupBy('date')
                ->get();

        return response()->json([
            'date' => $date,
            'pettycash' => $pettycash,
            'accountCash' => $accountCash,
            'todayssale' => $todayssale,
            'todayPurchase' => $todayPurchase,
            'todayscollection' => $todayscollection,
            'todayspayment' => $todayspayment,
            'customerOutstanding' => $customerOutstanding,
            'supplierOutstanding' => $supplierOutstanding,
            'sales' => $sales,
            'profit' => $profit,
            'quantity' => $quantity,
            'chart' => $chart,
        ],200);




    }
    public function allAccountCashReport(){

        $date=date("Y-m-d");
        $types = ['incoming','dueincoming','outgoing','outgoingVoucher','incomingTransfer','outgoingTransfer','incomingVoucher','investmentVoucher','bonus'];
        $pettycash=Paymentsheet::select('account_id','store_id',DB::raw('sum(amount) as amount'))
        ->with('account','store')
        ->whereBetween('date', array('2010-02-19', $date))
        ->where('account_id','!=',0)
        ->whereIn('type',$types)->groupBy('account_id')
        ->get();
        return response()->json([
            'cash' => $pettycash,

        ],200);

    }


}
