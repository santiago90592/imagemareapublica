<?php

namespace App\Models;

use CodeIgniter\Model;

class EntregadorModel extends Model
{
    
    protected $table                = 'entregadores';
    
    
    protected $returnType           = 'App\Entities\Entregador';
    protected $useSoftDeletes       = true;

    protected $allowedFields        = [

        'nome',
        'nif',
        'cartadeconducao',
        'email',
        'telefone',
        'imagem',
        'ativo',
        'veiculo',
        'placa',
        'endereco',
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'criado_em';
    protected $updatedField         = 'atualizado_em';
    protected $deletedField         = 'deletado_em';

    // Validation
    protected $validationRules    = [
        'nome'     => 'required|min_length[4]|max_length[120]',
        'email'        => 'required|valid_email|is_unique[entregadores.email]',
        'nif'        => 'required|exact_length[9]|is_unique[entregadores.nif]',
        'cartadeconducao'        => 'required|exact_length[7]|is_unique[entregadores.cartadeconducao]',
        'telefone' => 'required|exact_length[7]|is_unique[entregadores.telefone]',
        'endereco' => 'required|max_length[230]',
        'veiculo' => 'required|max_length[230]',
        'placa' => 'required|min_length[8]|max_length[9]|is_unique[entregadores.placa]',
        
    ];

    protected $validationMessages = [
        'nome'        => [
            'required' => 'Campo nome é obrigatório.',
        ],
        'email'        => [
            'required' => 'Campo Email é obrigatório.',
            'is_unique' => 'Desculpe. Esse email já existe.',
        ],
        'nif'        => [
            'required' => 'Campo Nif é obrigatório.',
            'is_unique' => 'Desculpe. Esse nif já existe.',
        ],
        'telefone'        => [
            'required' => 'Campo telefone é obrigatório.',
            'is_unique' => 'Desculpe. Esse telefone já existe.',
        ],

    ];

     /**
     * @uso controller entregadores no metodo procurar com o autocomplete 
     * @param sring $term
     * @return array entregadores
     */

    public function procurar($term){

        if ($term === null){

            return [];
        }

        return $this->select('id, nome')
                    ->like('nome', $term)
                    ->withDeleted(true)
                    ->get()
                    ->getResult();
    }

    public function desfazerExclusao(int $id) {

        return $this->protect(false)
                    ->where('id', $id)
                    ->set('deletado_em', null)
                    ->update();

    }
}
