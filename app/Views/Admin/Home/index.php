<?php echo  $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<!-- enviamos os estilos para template principal-->

<?php echo $this->endSection(); ?>





<?php echo $this->section('conteudo'); ?>

<!-- enviamos o conteudo para template-->

<?php echo $titulo; ?>

<?php echo $this->endSection(); ?>






<?php echo $this->section('scripts'); ?>

<!-- enviamos os scripts para template principal-->

<?php echo $this->endSection(); ?>