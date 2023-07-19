<!DOCTYPE html>
<html lang="pt-br">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=CONF_SITE_NAME?></title>

    <link rel="shortcut icon" href="<?=CONF_SITE_FAVICON?>" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="<?=url("assets/web/");?>css/_theme.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container">
            <img src="<?=CONF_SITE_LOGO?>" alt="Logo Nutri Chapeco">
            <nav>
                <a href="<?=url("app")?>">home</a>
                <a href="<?=url("app/sobre")?>">sobre</a>
                <a href="<?=url("app/receitas")?>">receitas</a>
                <a href="<?=url("app/perfil")?>">meu perfil</a>
            </nav>
            <a href="<?=url("app/logout")?>" class="button mt-1 mb-1 mx-auto">sair</a>
        </div>
    </header>

	<?= $this->section("content");?>

    <footer>
        <div class="container">
            <img src="<?=CONF_SITE_LOGO?>" alt="Logo Nutri Chapeco">
            <nav>
				<a href="<?=url("app/sobre")?>">sobre</a>
				<a href="<?=url("app/contato")?>">contato</a>
				<a href="<?=url("app/faq")?>">faq</a>
            </nav>
        </div>
    </footer>

</body>
</html>