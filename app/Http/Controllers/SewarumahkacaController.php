<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sewarumahkaca;
use App\Models\Masterrumahkaca;

class SewarumahkacaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $sewarumahkaca = Sewarumahkaca::where('namapenyewa', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $sewarumahkaca = Sewarumahkaca::paginate(10);
        }
        return view('sewarumahkaca.index',[
            'sewarumahkaca' => $sewarumahkaca
        ]);
    }


    public function create()
    {
        $masterrumahkaca = Masterrumahkaca::all();

        return view('sewarumahkaca.create', [
            'masterrumahkaca' => $masterrumahkaca,
        ]);
        return view('peminjaman.create')->with('success', 'Data Telah ditambahkan');
    }


    // return($request->all());
    public function store(Request $request)
{
    $request->validate([
        'masterrumahkaca_id' => 'required|exists:masterrumahkacas,id',
        'namapenyewa' => 'required|string|max:255',
        'keperluan' => 'required|string|max:255',
        'tanggal_start' => 'required|date|before_or_equal:tanggal_end',
        'tanggal_end' => 'required|date|after_or_equal:tanggal_start',
        'buktibayar' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $data = $request->only([
        'masterrumahkaca_id',
        'namapenyewa',
        'keperluan',
        'tanggal_start',
        'tanggal_end',
    ]);

    if ($request->hasFile('buktibayar')) {
        $file = $request->file('buktibayar');

        $fileName = time() . '_' . $file->getClientOriginalName();

        $filePath = $file->storeAs('public/buktibayar', $fileName);

        $data['buktibayar'] = $filePath;
    }

    Sewarumahkaca::create($data);

    // Redirect dengan pesan sukses
    return redirect()->route('sewarumahkaca.index')->with('success', 'Data Sewa Rumah Kaca berhasil ditambahkan');
}




    public function show($id)
    {

    }


    public function edit(Sewarumahkaca $sewarumahkaca)
    {
        $masterrumahkaca = Masterrumahkaca::all();

        return view('sewarumahkaca.edit', [
            'item' => $sewarumahkaca,
            'masterrumahkaca' => $masterrumahkaca,
        ]);
    }


    public function update(Request $request, Sewarumahkaca $sewarumahkaca)
    {
        $data = $request->all();

        $sewarumahkaca->update($data);

        //dd($data);

        return redirect()->route('sewarumahkaca.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Sewarumahkaca $sewarumahkaca)
    {
        $sewarumahkaca->delete();
        return redirect()->route('sewarumahkaca.index')->with('success', 'Data Telah dihapus');
    }

    public function sewarumahkacapdf() {
        $data = Sewarumahkaca::all();

        $pdf = PDF::loadview('sewarumahkaca/sewarumahkacapdf', ['sewarumahkaca' => $data]);
        return $pdf->download('laporan_sewarumahkaca.pdf');
    }
}
