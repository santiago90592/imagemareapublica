<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Password extends BaseController
{
    private $utilizadorModel;

    public function __construct()
    {
        $this->utilizadorModel = new \App\Models\UtilizadorModel();
    }

    public function esqueci(){

        $data = [
            'titulo' => 'Esqueci a minha password',
        ];

        return view('Password/esqueci', $data);
    }

    public function processaEsqueci(){

        if($this->request->getMethod() === 'post'){

            $utilizador = $this->utilizadorModel->buscaUtilizadorPorEmail($this->request->getPost('email'));

            if($utilizador === null || !$utilizador->ativo){

                return redirect()->to(site_url('password/esqueci'))
                                 ->with('atencao', 'Nao encontramos uma conta valida com esse email')
                                 ->withInput();
            }

            $utilizador->iniciaPasswordReset();


            $this->utilizadorModel->save($utilizador);


            $this->enviaEmailRedefinicaoPassword($utilizador);


            return redirect()->to(site_url('login'))->with('sucesso', 'E-mail de redefinição de password enviado para a sua caixa de entrada');

        }else{

            return redirect()->back();
        }
    }

    public function reset($token = null){

        if($token === null){

            return redirect()->to(site_url('password/esqueci'))->with('atencao','Link inválido ou expirado');
        }

        $utilizador = $this->utilizadorModel->buscaUtilizadorParaResetarPassword($token);

        if($utilizador != null){

            $data = [
                'titulo' => 'Redefina sua password',
                'token' => $token,
            ];

            return view('Password/reset', $data);

        }else{

            return redirect()->to(site_url('passowrd/esqueci'))->with('atencao', 'Link inválido ou expirado');
        }
    }

    public function processaReset($token = null){

        if($token === null){

            return redirect()->to(site_url('password/esqueci'))->with('atencao','Link inválido ou expirado');
        }


        $utilizador = $this->utilizadorModel->buscaUtilizadorParaResetarPassword($token);

        if($utilizador != null){
            

            $utilizador->fill($this->request->getPost());

            if($this->utilizadorModel->save($utilizador)){

                $utilizador->completaPasswordReset();

                $this->utilizadorModel->save($utilizador);


                return redirect()->to(site_url("login"))->with('sucesso','Nova password registado com sucesso!');
            }else{

                return redirect()->to(site_url("password/reset/$token"))
                       ->with('errors_model', $this->utilizadorModel->errors())
                       ->with('atenção', 'Dados inválidos')
                       ->withInput();
            }

            
        }else{

            return redirect()->to(site_url('passowrd/esqueci'))->with('atencao', 'Link inválido ou expirado');
        }
    }


    private function enviaEmailRedefinicaoPassword(object $utilizador){

        $email = service('email');

        $email->setFrom('no-reply@fooddelivery.com', 'Food Delivery');
        $email->setTo($utilizador->email);
       

        $email->setSubject('Redefinição de password');

        $mensagem = view('Password/reset_email', ['token' => $utilizador->reset_token]);

        $email->setMessage($mensagem);

        $email->send();

    }
}
