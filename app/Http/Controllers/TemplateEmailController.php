<?php

namespace App\Http\Controllers;

use App\Models\TemplateEmails;
use Carbon\Carbon;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use File;
use SebastianBergmann\Template\Template;

class TemplateEmailController extends Controller
{
    public function templateEmail(){
        if (request()->ajax()) {
            
            // $laporan = User::where('role', '=', 'USER');
            $data = TemplateEmails::all();


            return DataTables::of($data)
            ->editColumn('body', function ($item){
                return '
                    <p>'.   $item->body   .'</p>
                ';
            })
            ->addColumn('action', function ($item) {
                return '

                    <a class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete" onclick = "setParameter(' .  $item->id . ')" >
                                    Hapus
                    </a>

                    <a class="btn btn-primary" href="' . route('detail-template', $item->id) . '" >
                                    Detail
                    </a>



                    ';
            })
            ->editColumn('created_at', function ($query) {
                return [
                     Carbon::parse($query->created_at)->translatedFormat('d F Y'),
                    
                ];
            })
            ->rawColumns(['action','body'])
            ->make();
        }
        
        $count = TemplateEmails::all()->count();
        return view('template-email',[
            'count' => $count,
        ]);
    }

    public function addAttachment(Request $request){
        $validator = Validator::make($request->all(), [
           'file' => 'max:20000|required|file|mimes:pdf',
       ]);
        if ($validator->fails()) {
            return redirect()->route('template-email')->with('fail', 'file pdf terlalu besar, mohon upload dengan size lebih kecil');
       }
        $file = $request->file('file');
        $naming = $file->getClientOriginalName();

        if(Storage::disk('public')->exists('assets/attachment/'.$file->getClientOriginalName())){
            $files = File::files(public_path('storage/assets/attachment'));
            $namingWithhoutExtention = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $naming = $namingWithhoutExtention.'_'.count($files).'.pdf';
            $file->move(public_path('storage/assets/attachment'),$naming);
        }else{
            $file->move(public_path('storage/assets/attachment'),$naming);
        }
        $data['name_attachment'] = $naming;
        $data['body'] = $request->body;
        $data['subject'] = $request->subject;
        $data['user_id'] = Auth::user()->id;
        TemplateEmails::create($data);
        return redirect()->route('template-email')->with('status', 'Data acara berhasil ditambah');
    }

    
    public function deleteTemplate(Request $request){
        $data = TemplateEmails::findOrFail($request->idTemplate);
        Storage::disk('public')->delete('assets/attachment/'.$data->name_attachment);
        $data->delete();
        return redirect()->route('template-email')->with('status', 'Berhasil menghapus template email');



    }

    public function detail($id){
        $data = TemplateEmails::findOrFail($id);
        $pdf = Storage::url('assets/attachment/'.$data->name_attachment);
        return view('detail-template',['data' => $data , 'pdf' => $pdf]);
    }

    public function updateTemplate(Request $request, $id){
        $data = TemplateEmails::findOrFail($id);

        if ($request->hasFile('file')) {
            $validator = Validator::make($request->all(), [
                'file' => 'max:20000|file|mimes:pdf',
            ]);
            if ($validator->fails()) {
                return redirect()->route('template-email')->with('fail', 'file pdf terlalu besar, mohon upload dengan size lebih kecil');
            }
                 Storage::disk('public')->delete('assets/attachment/'.$data->name_attachment);

                $file = $request->file('file');
                $naming = $file->getClientOriginalName();

                if(Storage::disk('public')->exists('assets/attachment/'.$file->getClientOriginalName())){
                    $files = File::files(public_path('storage/assets/attachment'));
                    $namingWithhoutExtention = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $naming = $namingWithhoutExtention.'_'.count($files).'.pdf';
                    $file->move(public_path('storage/assets/attachment'),$naming);
                }else{
                    $file->move(public_path('storage/assets/attachment'),$naming);
                }       
                $data['name_attachment'] = $naming;
        }

         
        $data['body'] = $request->body;
        $data['category'] = $request->category;
        $data->update();
        return redirect()->route('template-email')->with('status', 'Berhasil update template email');
    }

}
