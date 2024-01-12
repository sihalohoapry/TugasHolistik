<?php

namespace App\Http\Controllers;

use App\Mail\SentEmail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class EmailController extends Controller
{
        public function email(){
        if (request()->ajax()) {
            
            $data = User::where(
                [
                    ['role', '=', 'USER'],
                    ['is_emailed', '=', null]
                ]
            );
            // $data = User::all();


            return DataTables::of($data)
            ->editColumn('body', function ($item){
                return '
                    <p>'.   $item->body   .'</p>
                ';
            })
            ->addColumn('action', function ($item) {
                return '

                    <a class="btn btn-success" data-toggle="modal" data-target="#ModalDelete" onclick = "setParameter(' .  $item->id . ')" >
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
        
        return view('email');
    }


    public function sentAll(Request $request){
        $array = array_map('intval', json_decode($request->idTemplate, true));
        $users = User::whereIn('id', $array)->get();
        foreach( $users as $user){

            $data = User::findOrFail($user->id);
                $body = 'Dear Ibu/bapak';
                $dataEmail = [
                    'subject' => 'Testing Email',
                    'body' => $body,

                ];
            Mail::to($user->email)->send(new SentEmail($dataEmail));
            if(Mail::flushMacros()){
                continue;
            } 
            else{

                $data['is_emailed'] = true;
                $data['emailed_date'] = date('Y-m-d');
                $data->update();
            }
            
        }

        return redirect()->route('email')->with('status', 'Berhasil kirim email');

    }


}
