<h5><?php echo esc($usuario->nome) ?>, agora falta muito pouco!</h5>

<p>
  Clique no link abaixo para ativar sua conta e aproveitar as delícias que a Food Delivery tem para oferecer.
</p>

<p>
  <a href="<?php echo site_url('registrar/ativar/' . $usuario->token); ?>">Quero ativar minha conta</a>
</p>