<?php

namespace App\Http\Controllers;

use App\Helpers\JwtHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Mengambil semua data barang.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBarang(Request $request)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $barang = Barang::all();

        return response()->json($barang);
    }

    public function store(Request $request)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }
        // dd($decodedToken);
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:m_barang',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barang = Barang::create([
            'id' => (string) Str::uuid(),
            'nama_barang' => $request->input('nama_barang'),
            'kode' => $request->input('kode'),
            'kategori' => $request->input('kategori'),
            'lokasi' => $request->input('lokasi'),
            'deskripsi' => $request->input('deskripsi'),
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
        ]);

        return response()->json($barang, 201);
    }


    public function show(Request $request, $id)
    {
        // Memeriksa token JWT
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken, 401);
        }

        // Mencari barang berdasarkan ID
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        return response()->json($barang);
    }

    public function update(Request $request, $id)
    {
        // Memeriksa token JWT
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken, 401);
        }

        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:m_barang,kode,' . $id, // Ganti 'm_barang' dengan nama tabel yang sesuai
            'kategori' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mencari barang berdasarkan ID
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        // Memperbarui data barang
        $barang->update([
            'nama_barang' => $request->input('nama_barang'),
            'kode' => $request->input('kode'),
            'kategori' => $request->input('kategori'),
            'lokasi' => $request->input('lokasi'),
            'deskripsi' => $request->input('deskripsi'),
            'stok' => $request->input('stok'),
            'harga' => $request->input('harga'),
        ]);

        return response()->json($barang);
    }

    public function destroy(Request $request, $id)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->delete();

        return response()->json(['message' => 'Barang deleted successfully']);
    }
}
