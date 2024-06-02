<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Customer;
use App\Models\NotaJual;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotaJualRequest;
use App\Http\Requests\UpdateNotaJualRequest;

class NotaJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.nota_jual.index');
    }

    public function indexAdmin()
    {
        $notaJual = auth()->guard('wirausaha')->user()->notajual()->get();
        return view('wirausaha.nota_jual.index', [
            'notaJual' => $notaJual
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotaJualRequest $request)
    {
        // Validate the data
        @dd($request->fotoBarang);
        $validatedData = $request->validate([
            'namaBarang' => 'required|string|max:255',
            'alamatAmbil' => 'required|string|max:255',
            'hargaJual' => 'required|numeric',
            'fotoBarang' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the image file upload
        if ($request->hasFile('fotoBarang')) {
            $imagePath = $request->file('fotoBarang')->store('foto_barang', 'public');
            $validatedData['fotoBarang'] = $imagePath;
        }
        $validatedData['customer_id'] = auth()->guard('customer')->id();

        // dd($validatedData);

        // Create the object with the validated data
        $notaJual = NotaJual::create([
            'nama' => $validatedData['namaBarang'],
            'harga' => $validatedData['hargaJual'],
            'foto' => $validatedData['fotoBarang'],
            'alamat' => $validatedData['alamatAmbil'],
            'customer_id' => $validatedData['customer_id'],
        ]);


        // Create Tugas bagian Jovan
        $id_nota = NotaJual::select('id')
        ->where('nama', $validatedData['namaBarang'])
        ->where('customer_id', $validatedData['customer_id'])
        ->orderByDesc('created_at')
        ->limit(1)
        ->value('id');
        $nama_customer = Customer::select('name')
        ->where('id', auth()->guard('customer')->id())
        ->limit(1)
        ->value('name');
        $create_tugas = Tugas::create([
            'jenis_tugas' => 'Penjemputan',
            'nota_jual_id' => $id_nota,
            'nama_penerima' => $nama_customer,
            'status' => 'belum_diambil'
        ]);

        return to_route('customer.index')->with('success', 'Berhasil menjual barang!');
    }

    public function konfirmasiHarga(UpdateNotaJualRequest $request)
    {
        NotaJual::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if ($request->status == 1) {
            return to_route('wirausaha.offer')->with('success', 'Berhasil approve barang!');
        } else {
            return to_route('wirausaha.offer')->with('success', 'Berhasil reject barang!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(NotaJual $notaJual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaJual $notaJual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotaJualRequest $request, NotaJual $notaJual)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaJual $notaJual)
    {
        //
    }
}
