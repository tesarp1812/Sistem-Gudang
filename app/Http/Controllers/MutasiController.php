<?php

namespace App\Http\Controllers;

use App\Helpers\JwtHelper;
use App\Models\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MutasiController extends Controller
{
    /**
     * Mengambil semua data mutasi .
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllMutasi(Request $request)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $mutasi = Mutasi::all();

        return response()->json($mutasi);
    }

    public function store(Request $request)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $validator = Validator::make($request->all(), [
            'm_barang_id' => 'required|string|exists:m_barang,id', // Pastikan id barang ada di tabel m_barang
            'm_users_id' => 'required|string|exists:m_user,id', // Pastikan id user ada di tabel m_user
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Menyimpan data mutasi
        $mutasi = Mutasi::create([
            'id' => (string) Str::uuid(),
            'm_barang_id' => $request->input('m_barang_id'),
            'm_users_id' => $request->input('m_users_id'),
            'jenis_mutasi' => $request->input('jenis_mutasi'),
            'jumlah' => $request->input('jumlah'),
        ]);

        return response()->json($mutasi, 201); // 201 Created
    }

    public function show(Request $request, $id)
    {
        // Memeriksa token JWT
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken, 401);
        }

        // Mencari mutasi berdasarkan ID
        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'mutasi not found'], 404);
        }

        return response()->json($mutasi);
    }

    public function update(Request $request, $id)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $validator = Validator::make($request->all(), [
            'm_barang_id' => 'required|string|exists:m_barang,id', // Pastikan id barang ada di tabel m_barang
            'm_users_id' => 'required|string|exists:m_user,id', // Pastikan id user ada di tabel m_user
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Mencari Mutasi berdasarkan ID
        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'mutasi not found'], 404);
        }

        $mutasi->update([
            'm_barang_id' => $request->input('m_barang_id'),
            'm_users_id' => $request->input('m_users_id'),
            'jenis_mutasi' => $request->input('jenis_mutasi'),
            'jumlah' => $request->input('jumlah'),
        ]);

        return response()->json($mutasi, 201); // 201 Created
    }

    public function destroy(Request $request, $id)
    {
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken);
        }

        $mutasi = Mutasi::find($id);

        if (!$mutasi) {
            return response()->json(['message' => 'mutasi not found'], 404);
        }

        $mutasi->delete();

        return response()->json(['message' => 'mutasi deleted successfully']);
    }

    public function mutasiBarang(Request $request, $id)
    {
        // Memeriksa token JWT
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken, 401);
        }

        $mutasi = Mutasi::where('m_barang_id', $id)->get();

        return response()->json($mutasi);
    }

    public function mutasiUser(Request $request, $id)
    {
        // Memeriksa token JWT
        $decodedToken = (array)JwtHelper::checkID($request);
        if (isset($decodedToken['error'])) {
            return response()->json($decodedToken, 401);
        }

        $mutasi = Mutasi::where('m_users_id', $id)->get();

        return response()->json($mutasi);
    }
}
