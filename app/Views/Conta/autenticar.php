<?php echo $this->extend('layout/principal_web'); ?>


<?php echo $this->section('titulo'); ?>  <?php echo $titulo; ?>  <?php echo $this->endSection(); ?>



<?php echo $this->section('estilos'); ?>

<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/conta.css") ?>"/>

<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo'); ?>

<div class="container" style="margin-top: 2em;">
<?php if(session()->has('sucesso')): ?>
    <div class="alert alert-success" role="alert"><?php echo session('sucesso'); ?></div>
<?php endif; ?>

<?php if(session()->has('info')): ?>
    <div class="alert alert-info" role="alert"><?php echo session('info'); ?></div>
<?php endif; ?>

<?php if(session()->has('atencao')): ?>
    <div class="alert alert-danger" role="alert"><?php echo session('atencao'); ?></div>
<?php endif; ?>

<?php if(session()->has('fraude')): ?>
    <div class="alert alert-warning" role="alert"><?php echo session('fraude'); ?></div>
<?php endif; ?>

<!-- Captura os erros de CSFR - Ação não permitida -->
<?php if(session()->has('error')): ?>
    <div class="alert alert-danger" role="alert"><?php echo session('error'); ?></div>
<?php endif; ?>
</div>


<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em; min-height: 300px;">
        <?php echo $this->include("conta/sidebar"); ?>
    <div class="row" style="margin-top: 2em;">
        <div class="col-md-12 col-xs-12">
    
            <h2 class="section-title pull-left"><?php echo esc($titulo); ?></h2>

        </div>

        <div class="col-md-6">

            <?php echo form_open('conta/processaautenticacao'); ?>

        <div class="panel panel-info">

            <div class="panel-body">
                
                
                <div>

                    <label>Insira sua senha</label>
                    <input type="password" class="form-control" name="password">
                
                </div>
                               

            </div>
            <div class="panel-footer">

                <button type="submit" class="btn btn-primary">Autenticar</button>

                <a href="<?php echo site_url('conta/show') ?>" class="btn btn-default">Cancelar</a>

            </div>
            </div>

        </div>
            <?php echo form_close(); ?>
    </div>
</div>


    
<?php echo $this->endSection(); ?>




<?php echo $this->section('scripts'); ?>

  <script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
  <script src="<?php echo site_url('admin/vendors/mask/app.js'); ?>"></script>

  <script>

    /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}

  </script>

<?php echo $this->endSection(); ?>


