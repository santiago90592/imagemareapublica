<?php

namespace App\Models;

use CodeIgniter\Model;

class FormaPagamentoModel extends Model
{
    
    protected $table                = 'formas_pagamento';
    protected $returnType           = 'App\Entities\FormaPagamento';
    protected $useSoftDeletes       = true;
    protected $allowedFields        = ['nome','ativo'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'criado_em';
    protected $updatedField         = 'atualizado_em';
    protected $deletedField         = 'deletado_em';

    // Validation
    protected $validationRules    = [
        'nome'     => 'required|min_length[4]|max_length[120]|is_unique[formas_pagamento.nome]',
    ];

    protected $validationMessages = [
        'nome'        => [
            'required' => 'Campo nome é obrigatório.',
            'is_unique' => 'Esse nome já existe.',
        ],
                
    ];


     /**
     * @uso controller FormaPagamento no metodo procurar com o autocomplete 
     * @param sring $term
     * @return array objecto
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
