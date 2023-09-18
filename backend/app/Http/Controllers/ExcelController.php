<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailCsv;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class ExcelController extends Controller
{
    public function index()
    {
        $batch = Bus::batch([])->dispatch();
        $data = [];

        DB::table('products')->orderBy('id')->chunk(500, function ($products) use (&$data) {
            foreach ($products as $p) {
                $data[] = [
                    'name'     => $p->name,
                    'kategori' => $p->kategori
                ];
            }
        });

        $batch->add(new SendEmailCsv($data));
    }
}
