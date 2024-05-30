<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\NotaBeli;
use Illuminate\Http\Request;

class NotaBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.nota_beli.barang', [
            'barang' => Barang::where('stock', '>', '0')->filter(request('search'))->paginate(8)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.nota_beli.keranjang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang' => 'required',
            'alamatCustomer' => 'required',
        ]);

        $notaBeli = NotaBeli::create([
            'alamat_customer' => $request->alamatCustomer,
            'customer_id' => auth()->guard('customer')->id(),
        ]);

        $barang = json_decode($request->barang);

        foreach ($barang as $item) {
            $temp = Barang::find($item->id);
            $temp->stock -= $item->quantity;
            $temp->save();
            $notaBeli->barang()->attach($temp, [
                'jumlah' => $item->quantity
            ]);
        }

        return to_route('customer.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(NotaBeli $notaBeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaBeli $notaBeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaBeli $notaBeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaBeli $notaBeli)
    {
        //
    }
}
