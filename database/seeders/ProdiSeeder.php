<?php

namespace Database\Seeders;

use App\Models\prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodi = [
            ["nama" => "Teknologi Informasi"],
            ["nama" => "Sistem Informasi"],
            ["nama" => "Pendidikan Teknologi Informasi"],
            ["nama" => "Teknik Informatika"],
            ["nama" => "Teknik Komputer"],
        ];

        prodi::insert($prodi);
    }
}