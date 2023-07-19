<?php $this->layout("_theme");?>
<link rel="stylesheet" href="<?=url("assets/web/");?>css/faq.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<main>
  <div class="container">
  <h1>Perguntas Frequentes</h1>
  
  <?php
    if(!empty($faqs)){
        foreach ($faqs as $faq){
            ?>
              <div class="faq">
                <h3 class="question"><?=$faq->question?><i class="fas fa-chevron-down" id="arrow"></i></h3>
                <p class="answer"><?=$faq->answer?></p>
              </div>
            <?php
        }
    }
    
    ?>
  </div>
  <script src="<?=url("assets/web/");?>js/faq.js"></script>
</main>
