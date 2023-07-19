<?php $this->layout("_theme");?>
<link rel="stylesheet" href="<?=url("assets/web/");?>css/contact.css">
<script src="<?=url("assets/web/");?>js/contact.js""></script>
<div class="container-father">
    <div class="container-contact">
        <form action="#" method="POST">
          <label for="name">Nome:</label>
          <input type="text" id="name" name="name" required>
    
          <label for="email">E-mail:</label>
          <input type="email" id="email" name="email" required>
    
          <label for="message">Mensagem:</label>
          <textarea id="message" name="message" required></textarea>
    
          <input type="submit" value="Enviar">
        </form>
    </div>
    <img src="<?=CONF_SITE_LOGO?>" alt="Logo Nutri Chapeco">
</div>
  