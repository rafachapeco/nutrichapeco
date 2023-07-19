<?php $this->layout("_theme");?>
<link rel="stylesheet" href="<?=url("assets/web/");?>css/faq.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<main>
  <div class="container">
  <h1>Receitas Gratuitas</h1>
  
  <?php
    if(!empty($recipes)){
        foreach ($recipes as $recipe){
            ?>
              <div class="recipe">
                <h3 class="question"><?=$recipe->name?><i class="fas fa-chevron-down" id="arrow"></i></h3>
                <p class="answer"><?=$recipe->description?></p>
              </div>
            <?php
        }
    }
    ?>
  </div>
  <script src="<?=url("assets/web/");?>js/faq.js"></script>
</main>
