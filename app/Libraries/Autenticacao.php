<?php

namespace App\Libraries;

/*
 *@descricao essa biblioteca / classe cuidara da parte de autenticacao na minha aplicacao
 */

class Autenticacao{

	private $utilizador;

	/**
	 * @param string $email
	 * @param string $password
	 * @return boolean
	 */

	public function login(string $email, string $password) {

		$utilizadorModel = new \App\Models\UtilizadorModel();

		$utilizador = $utilizadorModel->buscaUtilizadorPorEmail($email);
        
        /* se nao encontrar utilizador por email retorna false */
		if($utilizador === null){

			return false;
		}
        /* se a senha combinar com o password_hash retorna false */
		if(!$utilizador->verificaPassword($password)){

			return false;
		}

		/* so permitiremos utilizadores ativos */
		if(!$utilizador->ativo){
			return false;
		}

		$this->logaUtilizador($utilizador);

		return true;


	}

	public function logout(){

		session()->destroy();
	}

	public function pegaUtilizadorLogado(){

		if($this->utilizador === null){

		   $this->utilizador = $this->pegaUtilizadorDaSessao();        

		}

		return $this->utilizador;
	}


	public function estaLogado(){

		return $this->pegaUtilizadorLogado() !==null;
	}



	private function pegaUtilizadorDaSessao(){

		if(!session()->has('utilizador_id')){

			return null;
		}

		$utilizadorModel = new \App\Models\UtilizadorModel();

        /* recupera utilizador deacordo com a chave da sessao 'utilizador_id' */
		$utilizador = $utilizadorModel->find(session()->get('utilizador_id'));
        
        /* só retorno o objeto se o mesmo for encontrado e estiver ativo*/
		if($utilizador && $utilizador->ativo){

			return $utilizador;
		}
	}

	private function logaUtilizador(object $utilizador){

		$session = session();
		$session->regenerate();
		$session->set('utilizador_id', $utilizador->id);
	}
}