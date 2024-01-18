<?php

namespace App\Http\Controllers;

use App\Models\DataTransactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\List_;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $year = date('Y');
        $month = date('m');

        $data = DB::table('data_transactions')
            ->select(DB::raw('YEAR(transaction_date) year, MONTH(transaction_date) month, SUM(qty) as total' ),'name_product')
            ->where('deleted_at', '=', null)
            ->whereMonth('transaction_date','=',$month)
            ->whereYear('transaction_date', '=', $year)
            ->groupby('year','month','name_product')
            ->get();
        
        $dataSetahun = DB::table('data_transactions')
            ->select(DB::raw('SUM(qty) as total' ),'name_product')
            ->where('deleted_at', '=', null)
            ->whereYear('transaction_date', '=', $year)
            ->groupby('name_product')
            ->pluck('total','name_product');
        $labels = $dataSetahun->keys();
        $dataChart = $dataSetahun->values();


        $totalProductBulan  = DB::table('data_transactions')
            ->select(DB::raw('SUM(qty) as total' ))
            ->where('deleted_at', '=', null)
            ->whereMonth('transaction_date','=',$month)
            ->whereYear('transaction_date', '=', $year)
            ->first();

        $totalProductTahun  = DB::table('data_transactions')
            ->select(DB::raw('SUM(qty) as total' ))
            ->where('deleted_at', '=', null)
            ->whereYear('transaction_date', '=', $year)
            ->first();


        return view('home',[
            'datas' => $data,
            'labels' => $labels,
            'dataChart' => $dataChart,
            'totalProductBulan' => $totalProductBulan,
            'totalProductTahun' => $totalProductTahun,



        ]);
    }
}
