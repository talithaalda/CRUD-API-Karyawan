<?php

namespace Database\Seeders;
use App\Models\Cuti;
use Illuminate\Database\Seeder;

class CutiSeeder extends Seeder
{
    public function run()
    {
        $cutis = [
            [
                'nomor_induk' => 'IP06001',
                'tanggal_cuti' => '2020-08-02',
                'lama_cuti' => 2,
                'keterangan' => 'Acara Keluarga',
            ],
            [
                'nomor_induk' => 'IP06001',
                'tanggal_cuti' => '2020-08-18',
                'lama_cuti' => 2,
                'keterangan' => 'Anak Sakit',
            ],
            [
                'nomor_induk' => 'IP06006',
                'tanggal_cuti' => '2020-08-19',
                'lama_cuti' => 1,
                'keterangan' => 'Nenek Sakit',
            ],
            [
                'nomor_induk' => 'IP06007',
                'tanggal_cuti' => '2020-08-23',
                'lama_cuti' => 1,
                'keterangan' => 'Sakit',
            ],
            [
                'nomor_induk' => 'IP06004',
                'tanggal_cuti' => '2020-08-29',
                'lama_cuti' => 5,
                'keterangan' => 'Menikah',
            ],
            [
                'nomor_induk' => 'IP06003',
                'tanggal_cuti' => '2020-08-30',
                'lama_cuti' => 2,
                'keterangan' => 'Acara Keluarga',
            ],
        ];

        foreach ($cutis as $cuti) {
            Cuti::create($cuti);
        }

    }
}
