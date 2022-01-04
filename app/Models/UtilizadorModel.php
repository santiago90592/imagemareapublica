<?php
namespace App\Models;

use CodeIgniter\Model;

use App\Libraries\Token;

class UtilizadorModel extends Model
{
    
    protected $table = 'utilizadores';    
    protected $returnType = 'App\Entities\Utilizador'; 
    protected $allowedFields = ['nome','email','nif','telefone','password','reset_hash','reset_expira_em'];

    //datas
     
    protected $useTimestamps = true;
    protected $createdField = 'criado_em';
    protected $updatedField = 'atualizado_em';
    protected $dateFormat = 'datetime'; // para usar com $usesoftdeletes
    protected $useSoftDeletes = true;
    protected $deletedField = 'deletado_em';
    //validacoes
    protected $validationRules    = [
        'nome'     => 'required|min_length[4]|max_length[120]',
        'email'        => 'required|valid_email|is_unique[utilizadores.email]',
        'nif'        => 'required|exact_length[9]|is_unique[utilizadores.nif]',
        'telefone' => 'required',
        'password'     => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]'
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

    //evento callback
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data){

        if (isset($data['data']['password'])){

            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }
        
        return $data;
    }

    /**
     * @uso controller utilizadores no metodo procurar com o autocomplete 
     * @param sring $term
     * @return array utilizadores
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

    public function desabilitaValidacaoSenha(){

        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }

    public function desfazerExclusao(int $id) {

        return $this->protect(false)
                    ->where('id', $id)
                    ->set('deletado_em', null)
                    ->update();

    }

    public function buscaUtilizadorPorEmail(string $email){
        return $this->where('email', $email)->first();
    }

    public function buscaUtilizadorParaResetarPassword(string $token){

        $token = new Token($token);

        $tokenHash = $token->getHash();

        $utilizador = $this->where('reset_hash', $tokenHash)->first();


        if($utilizador != null){
            
            //verificamos se o token nao esta expirado deacordo com data e hora atual;

            if($utilizador->reset_expira_em < date('Y-m-d H:i:s')){
                
                //token esta expirado setamos o $utilizador = null;
                $utilizador = null;
            }

            return $utilizador;
        }
    }

        
}
