<?php

namespace App\Http\Controllers;

use App\Models\TemplateEmails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SebastianBergmann\Template\Template;
use Yajra\DataTables\Facades\DataTables;


class UploadDataController extends Controller
{
        public function uploadData(){
        if (request()->ajax()) {
            
            // $laporan = User::where('role', '=', 'USER');
            $laporan = TemplateEmails::all();


            return DataTables::of($laporan)
            ->addColumn('action', function ($item) {
                return '

                    <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete" onclick = "setParameter(' .  $item->id . ')" >
                                    Hapus
                    </a>

                    <a class="btn btn-primary" data-toggle="modal" data-target="#ModalEdit" onclick = "setParameterEdit(' .  $item->id . ', `'. $item->name .'` , `'. $item->email .'`)" >
                                    Edit
                    </a>



                    ';
            })
            ->editColumn('created_at', function ($query) {
                return [
                     Carbon::parse($query->created_at)->translatedFormat('d F Y'),
                    
                ];
            })
            ->rawColumns(['action'])
            ->make();
        }
        
        return view('upload-data');
    }
}
