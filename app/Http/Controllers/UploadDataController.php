<?php

namespace App\Http\Controllers;

use App\Imports\ImportTransaction;
use App\Imports\ImportTransactionOffline;
use App\Models\DataTransactions;
use App\Models\TemplateEmails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use SebastianBergmann\Template\Template;
use Yajra\DataTables\Facades\DataTables;


class UploadDataController extends Controller
{
    public function uploadData(){
        if (request()->ajax()) {
            
            // $laporan = User::where('role', '=', 'USER');
            $laporan = DataTransactions::all();


            return DataTables::of($laporan)
            ->addColumn('action', function ($item) {
                return '

                    <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete" onclick = "setParameter(' .  $item->id . ')" >
                                    Hapus
                    </a>

                    <a class="btn btn-primary" href="' . route('edit-data', $item->id) . '">
                                    Edit
                                </a>



                    ';
            })
            ->editColumn('transaction_date', function ($query) {
                return [
                     Carbon::parse($query->transaction_date)->translatedFormat('d F Y'),
                    
                ];
            })
            ->rawColumns(['action'])
            ->make();
        }
        
        return view('upload-data');
    }

    public function addTransaction(Request $request){

        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        if($nama_file == 'ExportOnlineStore.xlsx'){
            FacadesExcel::import(new ImportTransaction, $request->file);
        }
        if($nama_file == 'ExportOfflineStore.xlsx'){
            FacadesExcel::import(new ImportTransactionOffline, $request->file);
        }
        return redirect()->back()->with('status', "Berhasil Menambahkan Data");
    }

    public function delete(Request $request){
        $data = DataTransactions::findOrFail($request->idData);
        $data->delete();
        return redirect()->route('upload-data')->with('status', 'berhasil menghapus data');
    }

    public function postData(Request $request){
        $data = $request->all();
        DataTransactions::create($data);
        return redirect()->back()->with('status', "Berhasil Menambahkan Data");

    }

    public function editData($id){
        $data = DataTransactions::findOrFail($id);
        return view('edit-data',['data' => $data]);
    }

    public function updateData(Request $request, $id){
        $data = DataTransactions::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('upload-data')->with('status', 'Berhasil Edit Data');
    }

}
