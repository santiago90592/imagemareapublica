
<div class="form-row">

 <div class="form-group col-md-4">
     <label for="nome">Nome</label>
     <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($utilizador->nome)); ?>">
 </div>

 <div class="form-group col-md-2">
     <label for="nif">Nif</label>
     <input type="text" class="form-control" name="nif" id="nif" value="<?php echo old('nif', esc($utilizador->nif)); ?>">
 </div>

 <div class="form-group col-md-3">
     <label for="telefone">Telefone</label>
     <input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo old('telefone', esc($utilizador->telefone)); ?>">
 </div>

 <div class="form-group col-md-3">
     <label for="email">Email</label>
     <input type="text" class="form-control" name="email" id="email" value="<?php echo old('email', esc($utilizador->email)); ?>">
 </div>


</div> 


<div class="form-row">

 <div class="form-group col-md-3">
     <label for="password">Password</label>
     <input type="password" class="form-control" name="password" id="password" >
 </div>


 <div class="form-group col-md-3">
     <label for="password_confirmation">Confirmar Password</label>
     <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
 </div>

</div>



<div class="form-check form-check-flat form-check-primary mb-2">
    <label for="ativo" class="form-check-label">


        <input type="hidden" name="ativo" value="0">


        <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $utilizador->ativo)) : ?> checked="" <?php endif; ?> >
        Ativo
    </label>
</div>


<div class="form-check form-check-flat form-check-primary mb-4">
    <label for="is_admin" class="form-check-label">


        <input type="hidden" name="is_admin" value="0">


        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" <?php if(old('is_admin', $utilizador->is_admin)) : ?> checked="" <?php endif; ?> >
        Administrador
    </label>
</div>



                    
<button type="submit" class="btn btn-primary mr-2 btn-sm">
  <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
    Guardar
</button>

