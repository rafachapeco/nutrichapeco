<?php $this->layout("_theme");?>
<link rel="stylesheet" href="<?=url("assets/app/");?>css/profile.css">

<div id="box">
        <a href="<?= url("app/perfil") ?>"><img src="<?=CONF_SITE_WPROFILEPIC?>" alt="Foto de perfil"></a>
        <form method="post" id="formProfile">
        <input type="hidden" name="edit-id" value="<?= $userLoged->id ?>">
            <div class="words"> Email: </div> 
            <br> 
            <input type="email" name="edit-email" class="input-data" id="register-email" value="<?= $userLoged->email ?>">
            <br> <br>
            <div class="words"> Nome completo: </div>
             <br> 
             <input type="text" name="edit-name" class="input-data" value="<?= $userLoged->name ?>">
            <br> <br>
            <div class="words"> Número de telefone: </div> 
            <br> 
            <input oninput="phone(this)" type="text" name="edit-phoneNumber" class="input-data" value="<?= $userLoged->phoneNumber ?>">
            <br> <br><br>

            <input type="submit" value="Atualizar meus dados" id="send" class="send">
        </form>
</div>
<script>

    function phone(i) {
        var v = i.value;

        i.setAttribute("maxlength", "19");
        if (v.length == 8) i.value += " ";
        if (v.length == 14) i.value += "-";
    }

    const form = document.querySelector("#formProfile");
    const send = document.querySelector("#send");

    form.addEventListener("submit", async (e) => {
        e.preventDefault(); //nao faz reload 
        const dataUser  = new FormData(form);
        const data = await fetch("<?= url("app/perfil"); ?>", {
            method: "POST",
            body: dataUser,
        });

        const user = await data.json();
        console.log(user);

        if (user) {
            if (user.type == "success") {
                send.classList.remove("send");
                send.classList.remove("send-error");

                send.classList.add("send-success");

                send.value = user.message;
                setTimeout(() => {location.reload()}, 1000);
            } else {
                send.classList.remove("send");
                send.classList.add("send-error");
                send.value = user.message;
                setTimeout(() => {location.reload()}, 1000);
            }

        }
    });
</script>