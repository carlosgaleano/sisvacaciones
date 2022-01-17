<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        
        DB::table('areas')->insert([
            [
             'name' => 'Informatica',
             'description' => 'Area de Informatica',
            
            ],
            [
             'name' => 'Recursos Humanos',
             'description' => 'Area de Recursos Humanos',
            
            ],
            [
             'name' => 'Contabilidad',
             'description' => 'Area de Contabilidad',
            
            ],
            [
             'name' => 'Ventas',
             'description' => 'Area de Ventas',
            
            ],
            [
             'name' => 'Compras',
             'description' => 'Area de Compras',
            
            ],
            [
             'name' => 'Almacen',
             'description' => 'Area de Almacen',
            
            ],
            [
             'name' => 'Produccion',
             'description' => 'Area de Produccion',
            
            ],
            [
             'name' => 'Finanzas',
             'description' => 'Area de Finanzas',
            
            ],
            [
             'name' => 'Gerencia',
             'description' => 'Area de Gerencia',
            
            ],
            [
             'name' => 'Direccion',
             'description' => 'Area de Direccion',
            
            ],
            [
             'name' => 'Sistemas',
             'description' => 'Area de Sistemas',
            
            ],
            [
             'name' => 'Comercial',
             'description' => 'Area de Comercial',
            
            ],
            [
             'name' => 'Produccion',
             'description' => 'Area de Produccion',
            
            ],
            [
             'name' => 'Finanzas',
             'description' => 'Area de Finanzas',
            
            ],
            [
             'name' => 'Gerencia',
             'description' => 'Area de Gerencia',
            
            ],
            [
             'name' => 'Direccion',
             'description' => 'Area de Direccion',
            
            ]
        ]);
        
    }
}
