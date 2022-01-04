<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{

    protected $table                = 'produtos';
    
    protected $returnType           = 'App\Entities\Produto';
    protected $useSoftDeletes       = true;

    protected $allowedFields        = [

        'categoria_id',
        'nome',
        'slug',
        'ingredientes',
        'ativo',
        'imagem',
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'criado_em';
    protected $updatedField         = 'atualizado_em';
    protected $deletedField         = 'deletado_em';

    // Validation
    protected $validationRules    = [
        'nome'     => 'required|min_length[4]|max_length[120]|is_unique[produtos.nome,id,{id}]',
        'categoria_id'     => 'required|integer',
        'ingredientes'     => 'required|min_length[10]|max_length[1000]',
    ];

    protected $validationMessages = [
        'nome'        => [
            'required' => 'Campo nome é obrigatório.',
            'is_unique' => 'Esse produto já existe.',
        ],
        'categoria_id'        => [
            'required' => 'Campo Categoria é obrigatório.',
        ],

    ];
    //evento callback
    protected $beforeInsert = ['criaSlug'];
    protected $beforeUpdate = ['criaSlug'];

    protected function criaSlug(array $data) {

        if (isset($data['data']['nome'])) {

            $data['data']['slug'] = mb_url_title($data['data']['nome'], '-', TRUE);

        }
        
        return $data;
    }

     /**
     * @uso controller categorias no metodo procurar com o autocomplete 
     * @param sring $term
     * @return array categorias
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

    public function BuscaProdutosWebHome(){

        return $this->select([
            'produtos.id',
            'produtos.nome',
            'produtos.slug',
            'produtos.ingredientes',
            'produtos.imagem',
            'categorias.id AS categoria_id',
            'categorias.nome AS categoria',
            'categorias.slug AS categoria_slug',
        ])
        ->selectMin('produtos_especificacoes.preco')
        ->join('categorias', 'categorias.id = produtos.categoria_id')
        ->join('produtos_especificacoes', 'produtos_especificacoes.produto_id = produtos.id')
        ->where('produtos.ativo', true)
        ->groupBy('produtos.nome')
        ->orderBy('categorias.nome', 'ASC')
        ->findAll();
    }
}
