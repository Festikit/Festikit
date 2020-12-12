<div class="row">
    <div class="col s12 m4 l2">
    </div>
    <div class="col s12 m4 l8">
        <form method="post" action="index.php?action=connected" enctype="multipart/form-data" class="col s12">

            <div class="card-panel grey lighten-4">
                <h5>Connexion</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input name="user_mail" id="user_mail" type="email" class="validate" value='<?php if(isset($_GET['mail'])){echo $_GET['mail'];}?>' required>
                        <label for="user_mail">Email<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input name="user_password" id="user_password" type="password" class="validate" required>
                        <label for="user_password">Mot de passe<span class="flow-text red-text" title="Ce champ est obligatoire ">*</span></label>
                    </div>
                </div>
                <input class="btn waves-effect waves-light" type="submit" value="Se connecter" />
            </div>
        </form>
    </div>
</div>