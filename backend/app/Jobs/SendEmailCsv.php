<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SendEmailCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Kategori');

        $rowCount = 2;

        // Isi data dari $this->data ke spreadsheet
        foreach ($this->data as $d) {
            $sheet->setCellValue('A' . $rowCount, $d['name']);
            $sheet->setCellValue('B' . $rowCount, $d['kategori']);
            $rowCount++;
        }

        // Simpan spreadsheet ke file Excel
        $writer = new Xlsx($spreadsheet);
        $excelFileName = 'your_excel_file.xlsx'; // Ganti dengan nama file yang Anda inginkan
        $writer->save(storage_path('app/public' . $excelFileName));
    }
}
