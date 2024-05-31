<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function lihatBarang()
    {
        //show all barang that belongs to wirausaha
        // $barang = auth()->guard('wirausaha')->user()->barang->get();
        // return view('wirausaha.index', compact('barang'));
         // login as wirausaha
         auth()->guard('wirausaha')->loginUsingId(1);
         $wirausaha = auth()->guard('wirausaha')->user();
         $barang = $wirausaha->barang()->with('jenisbarang')->get();
         $jenis = JenisBarang::all();
         return view('wirausaha.index', [
             'wirausaha' => $wirausaha,
             'barang' => $barang,
             'jenis' => $jenis
         ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahBarang(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric|max:999',
            'jenis_barang_id' => 'required|numeric'
        ]);
        $finalData = [
            'nama' => $validatedData['nama'],
            'harga' => $validatedData['harga'],
            'stock' => $validatedData['stock'],
            'wirausaha_id' => auth()->guard('wirausaha')->user()->id,
            'jenis_barang_id' => $validatedData['jenis_barang_id']
        ];

        Barang::create($finalData);
        return redirect()->route('wirausaha.index')->with('success', 'New item has been added');
        // return $request;
    }


  
    /**
     * Show the form for editing the specified resource.
     */
    public function editBarang(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric|max:999',
            'jenis_barang_id' => 'required|numeric'
        ]);
    
        $barang = Barang::findOrFail($request->barang_id); // Retrieve the barang with the given ID
    
        // Update the barang's properties with the validated data
        $barang->nama = $validatedData['nama'];
        $barang->harga = $validatedData['harga'];
        $barang->stock = $validatedData['stock'];
        $barang->jenis_barang_id = $validatedData['jenis_barang_id'];
    
        $barang->save(); // Save the barang back to the database
    
        return redirect()->route('wirausaha.index')->with('success', 'Item has been updated');
        

    }


    /**
     * Remove the specified resource from storage.
     */
    public function hapusBarang(Request $request)
    {
        //
        $validatedData = $request->validate([
            'barang_id' => 'required|max:255'
        ]);    
        \App\Models\Barang::where('id', $validatedData['barang_id'])->delete();
        // $prop->delete();
        return redirect()->route('wirausaha.index')->with('success', 'Your item has been deleted');
    }


}
