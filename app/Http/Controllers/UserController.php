<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user(){
        if (request()->ajax()) {
            
            $data = User::where('role', '=', 'USER');
            // $data = User::all();


            return DataTables::of($data)
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
        
        return view('user');
    }

    public function postUser(Request $request){
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = $request->role;
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('user')->with('status', 'Berhasil menambah user');
    }

    public function detailUser(){
        return view('add-user');
    }

    public function deleteUser(Request $request){
        $data = User::findOrFail($request->idData);
        $data->delete();
        return redirect()->route('user')->with('status', 'Berhasil menghapus user');
    }

    public function editUser(Request $request){
        $data = User::findOrFail($request->id);
        $data['name'] = $request->name_edit;
        $data['email'] = $request->email_edit;
        $data->update();
        return redirect()->route('user')->with('status', 'Berhasil edit data user');
    }
    

}
