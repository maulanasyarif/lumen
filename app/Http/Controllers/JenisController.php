<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;

class JenisController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jenis = Jenis::all();
        return response()->json($jenis);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_jenis'    => 'required|unique:jenis'
        ]);

        $data = $request->all();
        $jenis = Jenis::create($data);
        return response()->json($jenis);
    }

    public function show($id)
    {
        $jenis = Jenis::find($id);

        if(!$jenis)
        {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($jenis);
    }

    public function update(Request $request, $id)
    {
        $jenis = Jenis::find($id);
        if(!$jenis)
        {
            return response()->json(['message' => 'Data not found'], 404);
        }
        
        $this->validate($request, [
            'nama_jenis'    => 'required|unique:jenis'
        ]);

        $data = $request->all();
        $jenis->fill($data);
        $jenis->save($data);

        return response()->json($jenis);
    }

    public function destroy($id)
    {
        $jenis = Jenis::find($id);

        if(!$jenis)
        {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $jenis->delete();
        return response()->json(['message' => 'Jenis'.' '.$jenis->nama_jenis.' '. 'has been deleted']);
    }

}