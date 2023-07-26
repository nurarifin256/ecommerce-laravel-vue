<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Barangs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    // $pageLength = request('limit') ?? 10;
    // $barangs = Barangs::get();
    // return response()->json($barangs, 200);
    // $barangs = Barangs::paginate(10);
    // $barangs = Barangs::latest()->paginate(10);
    public function getBarangs()
    {
        $barangs = Barangs::all();
        return $barangs;
    }

    public function cari($seacrh)
    {
        $barangs = Barangs::where('name', 'LIKE', "%$seacrh%")
            ->orWhere('price', 'LIKE', "%$seacrh%")
            ->select('name', 'id', 'price')
            ->get();

        return response()->json($barangs);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = Barangs::where('name', 'LIKE', "%$keyword%")
            ->orWhere('price', 'LIKE', "%$keyword%")
            ->paginate(10);

        return response()->json($users);
    }

    function data_list(Request $req)
    {
        $list      = $this->get_list($req);
        $data      = array();
        $no        = $req['start'];
        foreach ($list as $field) {
            // $btn_edit = '';
            // $btn_delete = '';
            // if (cekAkses(Auth::user()->id, "Supplier", "ubah") == TRUE) {
            //     $btn_edit   = '<button type="button" data-id=' . $field->id_barang . ' data-jenis="edit" class="btn btn-warning btn-sm action"><i class="ti-pencil"></i></button>';
            // }
            // if (cekAkses(Auth::user()->id, "Supplier", "hapus") == TRUE) {
            //     $btn_delete = '<button type="button" data-id=' . $field->id_barang . ' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="ti-trash"></i></button>';
            // }

            // $btn        = $btn_edit . ' ' . $btn_delete;

            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $field->name;
            $row[] = $field->price;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $req['draw'],
            "recordsTotal"    => 0,
            "recordsFiltered" => $this->count_filtered($req, 'filter'),
            "data"            => $data,
        );
        return response()->json($output);
    }

    function get_list(Request $req)
    {
        $query = $this->sql_list($req);

        if ($req['length'] != -1)
            $query->offset($req['start'])
                ->limit($req['length']);
        $query->orderBy("id", "DESC");
        return $query->get();
    }


    function sql_list(Request $request)
    {
        $seacrh    = $request->search;
        $where  = (strlen($seacrh) > 0) ? " AND A.name ILIKE '%$seacrh%'" : "";
        $sql = "(SELECT A.id, A.name, A.price 
                    FROM  barangs AS A 
                    WHERE 1=1
                    $where 
                    ) AS A1";

        $sqls = DB::table(DB::raw($sql));
        return $sqls;
    }

    function count_filtered($req, $filter = '')
    {
        $query = $this->sql_list($req, $filter);
        $query = $query->get();
        return $query->count();
    }
}
