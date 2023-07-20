<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Barangs;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $posts = Barangs::latest()->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'List data barang',
            'data' => $posts
        ]);
    }

    public function getBarangs()
    {
        $barangs = Barangs::paginate(10); // Menggunakan pagination dengan 10 data per halaman
        return response()->json([
            'status' => true,
            'message' => 'List data barang',
            'data' => $barangs
        ]);

        // return response()->json($barangs);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = Barangs::where('name', 'LIKE', "%$keyword%")
            ->orWhere('price', 'LIKE', "%$keyword%")
            ->paginate(10);

        return response()->json($users);
    }
}
