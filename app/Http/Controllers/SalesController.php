<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SalesController extends Controller
{   

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
    	$order_date = date("d/m/y");

        $today = DB::table('orders')
           ->where('order_date', $order_date)

           ->get();
        return view('today_order', compact('today'));
    }

    public function DeleteOrder($id)
    {
        $dlt = DB::table('orders')
           ->where('id', $id)
           ->delete();
        if ($dlt) {
                 $notification=array(
                 'messege'=>'Successfully Order Deleted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             } 

    }

    public function YearlySale()
    {
        $order_year = date('Y');
        $yearly = DB::table('orders')->where('order_year', $order_year)->get();
        return view('yearly_report', compact('yearly'));
    }

    public function MonthlySale()
    {
        $order_month = date('F');
        $monthly = DB::table('orders')->where('order_month', $order_month)->get();
        return view('monthly_report', compact('monthly'));
    }
}
