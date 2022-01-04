<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UtilizadorSeeder extends Seeder
{
    public function run()
    {
        $utilizadorModel = new \App\Models\UtilizadorModel;

        $utilizador = [

            'nome' => 'Paulo Santiago',
            'email' => 'paulosantiago9@gmail.com',
            'nif' => '130116939',
            'telefone' => '9774578', 
        ];

        $utilizadorModel->skipValidation(true)->protect(false)->insert($utilizador); 


        $utilizador = [ 

            'nome' => 'Deolinda Ramos',
            'email' => 'deolassramos@gmail.com', 
            'nif' => '116397630',
            'telefone' => '9944891',
        ]; 

        $utilizadorModel->skipValidation(true)->protect(false)->insert($utilizador);

        dd($utilizadorModel->errors());  
    }
}
