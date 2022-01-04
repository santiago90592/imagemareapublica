<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\utilizador;

class Utilizadores extends BaseController
{
    private $utilizadorModel;

    public function __construct(){

        $this->utilizadorModel = new \App\Models\UtilizadorModel();
    }

    public function index() { 

    
        $data = [

            'titulo' => 'Listando os utilizadores',
            'utilizadores' => $this->utilizadorModel->withDeleted(true)->paginate(10),
            'pager' => $this->utilizadorModel->pager,
        ];

     
       return view('Admin/Utilizadores/index', $data);
    }

    public function procurar(){

        if(!$this->request->isAJAX()){

            exit('Pagina nao encontrada');
        }

        $utilizadores = $this->utilizadorModel->procurar($this->request->getGet('term'));

        $retorno = [];

        foreach ($utilizadores as $utilizador){

            $data['id'] = $utilizador->id;
            $data['value'] = $utilizador->nome;

            $retorno[] = $data;
        }

        return $this->response->setJSON($retorno);
    }

    public function criar(){


       $utilizador = new utilizador();
              
       $data = [
         'titulo' => "Criando novo Utilizador",
         'utilizador' => $utilizador,
        ];

        return view('Admin/Utilizadores/criar', $data);
    }

    public function registar(){

        if($this->request->getMethod() === 'post') {

            $utilizador = new Utilizador($this->request->getPost());

                      

            if($this->utilizadorModel->protect(false)->save($utilizador)){

                return redirect()->to(site_url("admin/utilizadores/show/".$this->utilizadorModel->getInsertID()))
                                ->with('sucesso', "Utilizador $utilizador->nome registado com sucesso");
            }else{

                return redirect()->back()
                       ->with('errors_model', $this->utilizadorModel->errors())
                       ->with('atenção', 'Dados inválidos')
                       ->withInput();
            }

        }else{

           return redirect()->back(); 
        }

    }

    public function show($id = null){

       $utilizador = $this->buscaUtilizadorOu404($id);
       
       $data = [
         'titulo' => "Detalhando o utilizador $utilizador->nome",
         'utilizador' => $utilizador,
        ];

        return view('Admin/Utilizadores/show', $data);
    }


    public function editar($id = null){

       $utilizador = $this->buscaUtilizadorOu404($id);

       if($utilizador->deletado_em != null) {

        return redirect()->back()->with('info', "O utilizador $utilizador->nome foi apagado. Não é possivel edita-lo!");
       }
       
       $data = [
         'titulo' => "Editando o utilizador $utilizador->nome",
         'utilizador' => $utilizador,
        ];

        return view('Admin/Utilizadores/editar', $data);
    }

    public function atualizar($id = null){

        if($this->request->getMethod() === 'post') {

            $utilizador = $this->buscaUtilizadorOu404($id);

            if($utilizador->deletado_em != null) {

               return redirect()->back()->with('info', "O utilizador $utilizador->nome foi apagado. Não é possivel edita-lo!");
            }

            $post = $this->request->getPost();


            if(empty($post['password'])){

                $this->utilizadorModel->desabilitaValidacaoSenha();
                unset($post['password']);
                unset($post['password_confirmation']);

            }

            
            $utilizador->fill($post);


            if(!$utilizador->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar');
            }

          

            if($this->utilizadorModel->protect(false)->save($utilizador)){

                return redirect()->to(site_url("admin/utilizadores/show/$utilizador->id"))
                                ->with('sucesso', "Utilizador $utilizador->nome atualizado com sucesso");
            }else{

                return redirect()->back()
                       ->with('errors_model', $this->utilizadorModel->errors())
                       ->with('atencão', 'Dados inválidos')
                       ->withInput();
            }

        }else{

           return redirect()->back(); 
        }

    }

    public function excluir($id = null){                         

       $utilizador = $this->buscaUtilizadorOu404($id);

       if($utilizador->deletado_em != null) {

        return redirect()->back()->with('info', "O utilizador $utilizador->nome já foi apagado!");
       }

       if($utilizador->is_admin){

         return redirect()->back()->with('info', 'Não é possível excluir um utilizador <b>Administrador</b>');
       }

       if($this->request->getMethod() === 'post'){

        $this->utilizadorModel->delete($id);
        return redirect()->to(site_url('admin/utilizadores'))->with('sucesso', "Utilizador $utilizador->nome excluído com sucesso!");
       }
       
       $data = [
         'titulo' => "Excluindo o utilizador $utilizador->nome",
         'utilizador' => $utilizador,
        ];

        return view('Admin/Utilizadores/excluir', $data);
    }

    public function desfazerExclusao($id = null){

       $utilizador = $this->buscaUtilizadorOu404($id);
       
       if ($utilizador->deletado_em == null){

         return redirect()->back()->with('info', 'Apenas utilizadores excluídos podem ser recuperados');
       }

       if($this->utilizadorModel->desfazerExclusao($id)){

         return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso!');
       }else{

        return redirect()->back()
                       ->with('errors_model', $this->utilizadorModel->errors())
                       ->with('atenção', 'Dados inválidos')
                       ->withInput();
       }
    }

    
    /**
     * 
     * @param int $id
     * @return objeto utilizador
     */
    private function buscaUtilizadorOu404(int $id = null){

        if (!$id || !$utilizador = $this->utilizadorModel->withDeleted(true)->where('id', $id)->first()) {
            
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o utilizador $id");
        }

        return $utilizador;

    }
}

