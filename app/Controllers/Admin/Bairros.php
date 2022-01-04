<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\bairro;

class Bairros extends BaseController{

    private $bairroModel;

    public function __construct(){

        $this->bairroModel = new \App\Models\bairroModel();
    }

    public function index(){

        $data = [

            'titulo' => "listando os bairros atendidos",
            'bairros' => $this->bairroModel->withDeleted(true)->orderBy('nome', 'ASC')->paginate(10),
            'pager' => $this->bairroModel->pager,
        ];

        return view('Admin/Bairros/index', $data);
    }

    public function procurar(){

        if(!$this->request->isAJAX()){

            exit('Pagina não encontrada');
        }

        $bairros = $this->bairroModel->procurar($this->request->getGet('term'));

        $retorno = [];

        foreach ($bairros as $bairro){

            $data['id'] = $bairro->id;
            $data['value'] = $bairro->nome;

            $retorno[] = $data;
        }

        return $this->response->setJSON($retorno);
    }

    public function criar(){

        $bairro = new Bairro();

        $data = [
            'titulo' => "Registando novo Bairro",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/criar', $data);
    }

    public function registar(){

        if($this->request->getMethod() === 'post'){
            
            $bairro = new Bairro($this->request->getPost());

            

            if($this->bairroModel->save($bairro)){

               return redirect()->to(site_url("admin/bairros/show/".$this->bairroModel->getInsertID()))
                                ->with('sucesso', "Bairro $bairro->nome registrado com sucesso");
            }else{

               return redirect()->back()
                                ->with('errors_model', $this->bairroModel->errors())
                                ->with('atencão', 'Dados inválidos')
                                ->withInput();
            }

        }else{

            return redirect()->back();
        }
    }

    public function show($id = null){

        $bairro = $this->buscaBairroOu404($id);

        $data = [
            'titulo' => "Detalhando o Bairro $bairro->nome",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/show', $data);
    }

    public function editar($id = null){

        $bairro = $this->buscaBairroOu404($id);

         if($bairro->deletado_em != null) {

          return redirect()->back()->with('info', "O bairro $bairro->nome foi apagada. Não é possivel edita-lo!");
         }

        $data = [
            'titulo' => "Editando o Bairro $bairro->nome",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/editar', $data);
    }

    public function atualizar($id = null){

        if($this->request->getMethod() === 'post'){

            $bairro = $this->buscaBairroOu404($id);

            if($bairro->deletado_em != null) {

             return redirect()->back()->with('info', "O bairro $bairro->nome foi apagada. Não é possivel edita-lo!");
            }

            $bairro->fill($this->request->getPost());

            if(!$bairro->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar');
            }

            if($this->bairroModel->save($bairro)){

               return redirect()->to(site_url("admin/bairros/show/$bairro->id"))
                                ->with('sucesso', "Bairro $bairro->nome atualizado com sucesso");
            }else{

               return redirect()->back()
                                ->with('errors_model', $this->bairroModel->errors())
                                ->with('atencão', 'Dados inválidos')
                                ->withInput();
            }

        }else{

            return redirect()->back();
        }
    }

    public function excluir($id = null){                         

   $bairro = $this->buscaBairroOu404($id);

   if($bairro->deletado_em != null) {

    return redirect()->back()->with('info', "O bairro $bairro->nome já foi apagado!");
   }


   if($this->request->getMethod() === 'post'){

    $this->bairroModel->delete($id);
    return redirect()->to(site_url('admin/bairros'))->with('sucesso', " Bairro $bairro->nome apagado com sucesso!");
    }

   $data = [
      'titulo' => "Excluindo o bairro $bairro->nome",
      'bairro' => $bairro,
    ];

      return view('Admin/Bairros/excluir', $data);
    }

    public function desfazerExclusao($id = null){

        $bairro = $this->buscaBairroOu404($id);
   
        if ($bairro->deletado_em == null){

         return redirect()->back()->with('info', 'Apenas bairros apagadas podem ser recuperados');
        }
  
        if($this->bairroModel->desfazerExclusao($id)){

            return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso!');
         }else{

            return redirect()->back()
            ->with('errors_model', $this->bairroModel->errors())
            ->with('atenção', 'Dados inválidos')
            ->withInput();
        }
    }



    /**
     * 
     * @param int $id
     * @return objeto bairro
     */
    private function buscaBairroOu404(int $id = null){

        if (!$id || !$bairro = $this->bairroModel->withDeleted(true)->where('id', $id)->first()) {
            
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o bairro $id");
        }

        return $bairro;

    }

}
