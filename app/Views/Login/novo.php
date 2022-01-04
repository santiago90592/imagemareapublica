

<?php echo  $this->extend('Admin/layout/principal_autenticacao'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<!-- enviamos os estilos para template principal-->

<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo'); ?>


<div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">

              <?php if(session()->has('sucesso')): ?>

          <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>Perfeito!</strong> <?php echo session('sucesso'); ?>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
          </div>


          <?php endif; ?>

          <?php if($mensagem = session()-> has('info')): ?>

          <div class="alert alert-info alert-dismissible fade show" role="alert">
           <strong>Informacão!</strong> <?php echo session('info'); ?>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
          </div>


          <?php endif; ?>

          <?php if(session()-> has('atencao')): ?>

          <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Informacão!</strong> <?php echo session('atencao'); ?>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
          </div>


          <?php endif; ?>
          
          <!-- captura os erros de csrf - acao nao permitida -->
          <?php if(session()-> has('error')): ?>

          <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Erro!</strong> <?php echo session('error'); ?>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
          </div>


          <?php endif; ?>



              <div class="brand-logo">
                <img src="<?php echo site_url('admin/'); ?>images/logo.svg" alt="logo">
              </div>
              <h4>Olá, Seja bem vindo(a)!</h4>
              <h6 class="font-weight-light mb-3">Faça o login para continuar.</h6>

              <?php echo form_open('login/criar'); ?>


                <div class="form-group">
                  <input type="email" name="email" value="<?php echo old('email'); ?>" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Digite seu email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Digite sua password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn ">Entrar</button>
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">

                      <a href="<?php echo site_url('password/esqueci'); ?>" class="auth-link text-black">Esqueci minha password</a>
                </div>
               
                
                <div class="text-center mt-4 font-weight-light">
                  Ainda não tem uma conta? <a href="<?php echo site_url('registrar'); ?>" class="text-primary">Criar conta</a>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->


<?php echo $this->endSection(); ?>






<?php echo $this->section('scripts'); ?>

<!-- enviamos os scripts para template principal-->

<?php echo $this->endSection(); ?>

