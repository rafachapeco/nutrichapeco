<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title><?= CONF_SITE_NAME ?></title>
    <link rel="icon" href="<?= CONF_SITE_FAVICON ?>">
    <link rel="stylesheet" href="<?= url("assets/web/css/"); ?>login.css">
</head>

<body>
    <div id="box">
        <a href="<?= url("") ?>"><img src="<?=CONF_SITE_LOGO?>" alt="Logo Nutri Chapeco"></a>
        <form method="post" id="formRegisterUser">
            <div class="words"> Email: </div> <br> <input type="email" name="login-email" class="input-data" id="register-email" value="<?php if (isset($_POST['register-email'])) echo $_POST['register-email']; ?>">
            <br> <br>
            <div class="words"> Senha: </div> <br> 
            <div>
            <input type="password" name="login-password" id="register-password" class="input-data">
            <button id="btn-eye" type="button"><i class="fas fa-eye" id="eye" onclick="eye()"></i></button>
            <br><br><br>
            </div>

            <a href="<?=url("cadastro")?>">Não tem uma conta? Registre-se aqui!</a>

            <input type="submit" value="Logar" id="send" class="send">
        </form>
    </div>
</body>

<script>
    function eye() {
        password = document.querySelector('#register-password');
        if (password.type == "password") {
            document.querySelector('button').addEventListener('click', () => {
                password.type = "text";
            });
        } else {
            document.querySelector('button').addEventListener('click', () => {
                password.type = "password";
            });
        }
    }
    
    const form = document.querySelector("#formRegisterUser");
    const send = document.querySelector("#send");

    form.addEventListener("submit", async (e) => {
        e.preventDefault(); //nao faz reload 
        const dataRegisterUser = new FormData(form);
        const data = await fetch("<?= url("login"); ?>", {
            method: "POST",
            body: dataRegisterUser,
        });

        const user = await data.json();
        console.log(user);

        if (user) {
            if (user.type == "success") {
                send.classList.remove("send");
                send.classList.remove("send-error");

                send.classList.add("send-success");

                send.value = user.message;
                setTimeout(() => {
                    window.location.href = '<?= url("app"); ?>'
                }, 2000);

            } else {
                send.classList.remove("send");
                send.classList.add("send-error");
                send.value = user.message;
            }

        }
    });
</script>

</html>