<?php echo  $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<!-- enviamos os estilos para template principal-->

<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>"/>

<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo'); ?>


<div class="row">
  
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><?php echo $titulo;?> </h4>


        <div class="ui-widget">
          <input id="query" name="query" placeholder="Pesquise por um utilizador" class="form-control bg-light mb-5">
        </div>


        <a href="<?php echo site_url("admin/utilizadores/criar"); ?>" class="btn btn-success float-right mb-5">
         <i class="mdi mdi-plus btn-icon-prepend"></i>
         Registar
       </a>
       
       <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Nif</th>
              <th>Ativo</th>
              <th>Situação</th>
            </tr>
          </thead>
          <tbody>




           <?php foreach ($utilizadores as $utilizador) : ?>

            <tr>

              <td>
                <a href="<?php echo site_url("admin/utilizadores/show/$utilizador->id"); ?>"><?php echo $utilizador->nome; ?></a>
                
              </td>
              <td><?php echo $utilizador->email; ?></td>
              <td><?php echo $utilizador->nif; ?></td>
              
              <td><?php echo ($utilizador->ativo && $utilizador->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Nao</label>'); ?></td>

              <td>
               <?php echo ($utilizador->deletado_em == null ? '<label class="badge badge-primary">Disponivel</label>' : '<label class="badge badge-danger">Excluido</label>'); ?>

               <?php if($utilizador->deletado_em != null) : ?>

                <a href="<?php echo site_url("admin/utilizadores/desfazerexclusao/$utilizador->id"); ?>" class="badge badge-dark ml-2">
                  <i class="mdi mdi-undo btn-icon-prepend"></i>
                  Desfazer
                </a>

              <?php endif; ?>
              
            </td>
          </tr>
          
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <div class="mt-3">
    <?php echo $pager->links() ?>
  </div>
</div>
</div>
</div>


</div>





<?php echo $this->endSection(); ?>






<?php echo $this->section('scripts'); ?>

<!-- enviamos os scripts para template principal-->

<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>

<script>
  
  $(function (){

    $( "#query" ).autocomplete({


      source: function (request, response){

        $.ajax({

          url: "<?php echo site_url('admin/utilizadores/procurar'); ?>",
          dataType: "json",
          data:{
           term: request.term
         },
         success: function (data){

          if(data.length < 1){

            var data = [
            {
              label: 'Utilizador nao encontrado',
              value: -1
            }
            ];

          }
            response(data); // aqui tem valor no data
          },    


        }); // fim ajax

      },
      minLenght: 1,
      select: function (event, ui){

        if(ui.item.value == -1){

          $(this).val("");
          return false;

        }else{

          window.location.href = '<?php echo site_url('admin/utilizadores/show/'); ?>' + ui.item.id;
        }



      }
    }); // fim auto complete



  });

</script>

<?php echo $this->endSection(); ?>