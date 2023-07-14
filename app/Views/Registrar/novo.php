<?php echo $this->extend('layout/principal_web'); ?>


<?php echo $this->section('titulo'); ?>  <?php echo $titulo; ?>  <?php echo $this->endSection(); ?>



<?php echo $this->section('estilos'); ?>

<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css") ?>"/>

<?php echo $this->endSection(); ?>

<?php echo $this->section('conteudo'); ?>

<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil center-block" style="max-width: 40%;">
        <div class="row"> 
            
            <div class="col-md-12">

                <p><?php echo $titulo; ?></p>

                <?php if (session()->has('errors_model')): ?>

                    <ul style="margin-left: -1.6em !important; list-style: decimal">
                        <?php foreach (session('errors_model') as $error): ?>

                            <li class="text-danger"><?php echo $error; ?></li>

                        <?php endforeach; ?>
                    </ul>

                <?php endif; ?>

                <?php echo form_open("registrar/criar"); ?>

                <div class="form-group">
                    <label>Nome completo</label>
                    <input type="text" class="form-control" name="nome" value="<?php echo old('nome'); ?>">
                </div>

                <div class="form-group">
                    <label>E-mail válido</label>
                    <input type="email" class="form-control" name="email" value="<?php echo old('email'); ?>">
                </div>

                <div class="form-group">
                    <label>CPF válido</label>
                    <input type="text" class="cpf form-control" name="cpf" value="<?php echo old('cpf'); ?>">
                </div>

                <div class="form-group">
                    <label>Sua senha</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label>Confirme sua senha</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                
                <button type="submit" class="btn btn-block btn-food" style="margin-top: 3em;">Criar minha conta</button>

                <?php echo form_close(); ?>



            </div>

        </div>
    </div>
    <!-- end product -->
</div>


    
<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo site_url('admin/vendors/mask/app.js'); ?>"></script>

  <script>

                            $("[name=cep]").focusout(function (){

                                var cep = $(this).val();

                                if(cep.length === 9){

                                    $.ajax({

                                        type: 'get',
                                        url: '<?php echo site_url('carrinho/consultacep'); ?>',
                                        dataType: 'json',
                                        data:{ 
                                            cep: cep
                                        },
                                        beforeSend: function () {

                                            $("#cep").html('Consultando...');

                                            $("[name=cep]").val('');

                                        },
                                        success: function (response) {

                                        if(!response.erro){

                                            $("#cep").html('');

                                            $("#valor_entrega").html(response.valor_entrega);

                                            $("#total").html(response.total);

                                            $("#cep").html(response.bairro);

                                        }else{

                                            $("#cep").html(response.erro);

                                        }

                                        },
                                        error: function (){
                                            alert('Não foi possível consultar a taxa de entrega. Por favor entre em contato com a nossa equipe');
                                        }
                                        
                                    });

                                }

                            });




  </script>

<?php echo $this->endSection(); ?>


