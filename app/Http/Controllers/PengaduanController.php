<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index(){
        $pengaduan = Pengaduan::where('nik', Auth::user()->nik)->count();
        return view('masyarakat.pengaduan.index', compact('pengaduan'));
    }

    public function getPengaduan(){
        $data = Pengaduan::where('nik', Auth::user()->nik)->get();
        return datatables()->of($data)
        ->editColumn('foto', function($row){
            $foto = asset("img/pengaduan/{$row->foto}");
            $output = '<img class="rounded" style="width:70%; height:100px;" src="'.$foto.'">';
            return $output;
        })
        ->editColumn('tgl_pengaduan', function($row){
            $output = date('d F Y' ,strtotime($row->tgl_pengaduan));
            return $output;
        })
        ->editColumn('status', function($row){
            if ($row->status == 'proses') {
                return 'Sedang DIproses';
            }else{
                return 'Selesai';
            }
        })
        ->rawColumns(['foto'])
        ->make(true);
    }

    public function create(){
        return view('masyarakat.pengaduan.create');
    }

    public function store(Request $request){
        $request->validate([
            'isi_laporan' => 'required',
            'gambar' => 'required|mimes:png,jpg'
        ]);

        if ($request->hasFile('gambar')) {
            $file_name = time() . '_' . $request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('img/pengaduan'), $file_name);
            Pengaduan::insert([
                'nik' => Auth::user()->nik,
                'tgl_pengaduan' => Carbon::now(),
                'isi_laporan' => $request->isi_laporan,
                'foto' => $file_name
            ]);

            return redirect()->route('masyarakat.pengaduan.index')->with('success' , 'Berhasil mengupload pengaduan');
        }
    }
}
