<?php

namespace App\Http\Controllers\Admin;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatatableController extends Controller
{
    public function masyarakatVerif(){
        $data = Masyarakat::where('status', 'aktif')->get();
        return datatables()->of($data)
        ->editColumn('created_at', function($row){
            return $row->created_at->diffForHumans();
        })
        ->make(true);
    }
}
