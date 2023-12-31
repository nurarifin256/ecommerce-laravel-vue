<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProductCSVData;
use Illuminate\Support\Facades\Bus;

class ProductImportController extends Controller
{
    public function index()
    {
        return view('productImport');
    }

    public function store(Request $request)
    {
        if ($request->has('csv')) {
            $csv = file($request->csv);

            $chunks = array_chunk($csv, 500);

            $header = [];

            $batch = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);

                if ($key == 0) {
                    $header = $data[0];
                    unset($data[0]);
                }

                $batch->add(new ProductCSVData($data, $header));
            }
        }
        return redirect()->route('products.import.index');
    }
}
