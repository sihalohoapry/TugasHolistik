<?php

namespace App\Http\Controllers;

use App\Mail\SentEmail;
use App\Models\DataTransactions;
use App\Models\TemplateEmails;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Template\Template;
use Yajra\DataTables\Facades\DataTables;

class EmailController extends Controller
{
        public function email(){
        if (request()->ajax()) {
            
            $data = DataTransactions::where('isEmailed', '=', null
            )->where('email', '!=',null);
            // $data = User::all();


            return DataTables::of($data)
            ->editColumn('body', function ($item){
                return '
                    <p>'.   $item->body   .'</p>
                ';
            })
            ->addColumn('action', function ($item) {
                return '

                    <a class="btn btn-success" data-toggle="modal" data-target="#ModalSent" onclick = "setParameter(' .  $item->id . ')" >
                                    Sent
                    </a>



                    ';
            })
            ->editColumn('created_at', function ($query) {
                return [
                     Carbon::parse($query->created_at)->translatedFormat('d F Y'),
                    
                ];
            })
            ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
            ->rawColumns(['action','body','checkbox'])
            ->make();
        }

        $domisili = DB::table('data_transactions')
                 ->select('domisili')
                 ->groupBy('domisili')
                 ->get();
        return view('email',['domisili'=>$domisili]);
    }


    public function sentAll(Request $request){
        $data = DataTransactions::where('domisili', '=', $request->domisili)
            ->where('email', '!=', null)
            ->where('isEmailed', '=', null)
            ->get();

        $templateEmail = TemplateEmails::first();
        foreach( $data as $item){

                $body = $templateEmail->body;
                $dataEmail = [
                    'subject' => $templateEmail->subject,
                    'body' => $body,

                ];
            Mail::to($item->email)->send(new SentEmail($dataEmail));
            if(Mail::flushMacros()){
                continue;
            } 
            else{

                $updateData = DataTransactions::findOrFail($item->id);
                $updateData['isEmailed'] = true;
                $updateData['emailed_date'] = date('Y-m-d');
                $updateData->update();
            }
            
        }

        return redirect()->route('email')->with('status', 'Berhasil kirim email');

    }

    public function sentEmail(Request $request){
        $data = DataTransactions::findOrFail($request->idData);
        $templateEmail = TemplateEmails::first();
        $body = $templateEmail->body;
                $dataEmail = [
                    'subject' => $templateEmail->subject,
                    'body' => $body,

                ];
            Mail::to($data->email)->send(new SentEmail($dataEmail));
            if(Mail::flushMacros()){
            } 
            else{

                $data['isEmailed'] = true;
                $data['emailed_date'] = date('Y-m-d');
                $data->update();
            }
            

        return redirect()->route('email')->with('status', 'Berhasil kirim email');

    }


}
