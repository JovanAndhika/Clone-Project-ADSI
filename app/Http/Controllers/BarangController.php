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
         return view('wirausaha.barangView', [
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
        // return $request;
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric|max:999',
            'jenis_barang_id' => 'required|numeric',
            'fotoBarang' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail' => ''
        ]);
        // Handle the image file upload
        if ($request->hasFile('fotoBarang')) {
            $file = $request->file('fotoBarang');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $originalName . '_' . time() . '_' . uniqid() . '.' . $extension;
            $filePath = $file->storeAs('public/ProdukJual', $fileNameToStore);
            $validatedData['fotoBarang'] = str_replace('public/', '', $filePath);

        }
        $finalData = [
            'nama' => $validatedData['nama'],
            'harga' => $validatedData['harga'],
            'stock' => $validatedData['stock'],
            'wirausaha_id' => auth()->guard('wirausaha')->user()->id,
            'jenis_barang_id' => $validatedData['jenis_barang_id'],
            'foto' => $validatedData['fotoBarang'],
            'detail' => $validatedData['detail']
        ];

      
        Barang::create($finalData);
        return redirect()->route('wirausaha.barang')->with('success', 'New item has been added');
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
            'jenis_barang_id' => 'required|numeric',
            'fotoBarang' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail' => ''
        ]);
    
        $barang = Barang::findOrFail($request->barang_id); // Retrieve the barang with the given ID
    
        // Update the barang's properties with the validated data
        $barang->nama = $validatedData['nama'];
        $barang->harga = $validatedData['harga'];
        $barang->stock = $validatedData['stock'];
        $barang->jenis_barang_id = $validatedData['jenis_barang_id'];
        $barang->detail = $validatedData['detail'];
        
        if ($request->hasFile('fotoBarang')) {
            // Delete the old image
            $oldImage = public_path("storage/".$barang->foto);
            if (file_exists($oldImage)) {
                @unlink($oldImage);
            }
            $file = $request->file('fotoBarang');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $originalName . '_' . time() . '_' . uniqid() . '.' . $extension;
            $filePath= $file->storeAs('public/ProdukJual', $fileNameToStore);
                        
            $validatedData['fotoBarang'] = str_replace('public/', '', $filePath);
            $barang->foto = $validatedData['fotoBarang'];
        }

        $barang->save(); // Save the barang back to the database
    
        return redirect()->route('wirausaha.barang')->with('success', 'Item has been updated');
        

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
        $barang = \App\Models\Barang::where('id', $validatedData['barang_id'])->first();
        
        $oldImage = public_path("storage/".$barang->foto);
        if (file_exists($oldImage)) {
            @unlink($oldImage);
        }
    
        $barang->delete();
        // $prop->delete();
        return redirect()->route('wirausaha.barang')->with('success', 'Your item has been deleted');
    }


}
