<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function todayorder()
    {
$today=date('d-m-y');
$order=DB::table('orders')->where('status',0)->where('date',$today)->get();
return view('admin.report.todayorder',compact('order'));
    }
    public function todaydeliever()
    {
        $today=date('d-m-y');
$order=DB::table('orders')->where('status',3)->where('date',$today)->get();
        return view('admin.report.todaydelievery',compact('order'));
    }

    public function month()
    {
        $month=date('F');
        $order=DB::table('orders')->where('status',3)->where('month',$month)->get();
       return view('admin.report.month',compact('order'));
    }

    public function year()
    {
        $month=date('F');
        $order=DB::table('orders')->where('status',3)->where('year',$month)->get();
       return view('admin.report.year',compact('order'));
    }

    public function search()
    {
return view('admin.report.search');
    }

    public function searchbydate(Request $request)
    {
        $date=$request->date;
        $newDate=date('d-m-y',strtotime($date));
        $total=DB::table('orders')->where('status',3)->where('date',$newDate)->sum('total');
        $order=DB::table('orders')->where('status',3)->where('date',$newDate)->get();
        return view('admin.report.search_by_date',compact('order','total'));
    }

    public function searchbymonth(Request $request)
    {
        $month=$request->month;
        $total=DB::table('orders')->where('status',3)->where('month',$month)->sum('total');
        $order=DB::table('orders')->where('status',3)->where('month',$month)->get();
        return view('admin.report.search_by_month',compact('order','total'));
    }

    public function searchbyyear(Request $request)
    {
$year=$request->year;
$total=DB::table('orders')->where('status',3)->where('year',$year)->sum('total');
$order=DB::table('orders')->where('status',3)->where('year',$year)->get();
return view('admin.report.search_by_year',compact('order','total'));
    }


}
