<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductoServicio;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

    for ( $i=0 ; $i<100 ; $i++){
        ProductoServicio::create([
            'id_categoria' => '1',
            'nombre_productoservicio' => 'admin@gmail.com',
            'descripcion' => 'admin@gmail.com',
            'precio' => 'admin@gmail.com',
            'estado' => 'admin@gmail.com',
        ]);
    }

       
    }
}
