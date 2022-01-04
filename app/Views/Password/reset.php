

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
              <h4>Recuperando a sua password!</h4>
              <h6 class="font-weight-light mb-3"><?php echo $titulo; ?></h6>

              <?php if (session()->has('errors_model')) : ?>

                   <ul>

                      <?php foreach (session('errors_model') as $error) : ?>

                          <li class="text-danger"><?php echo $error; ?></li>

                      <?php endforeach; ?>

                   </ul>

                   <?php endif; ?>

              <?php echo form_open("password/processareset/$token"); ?>


                <div class="form-group">
                    <label for="password"> Nova password</label>
                    <input type="password" class="form-control" name="password" id="password" >
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar nova password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>

               
                <div class="mt-3">
                    <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn " value="Redefinir password">
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

<?php echo $this->endSection(); ?>

