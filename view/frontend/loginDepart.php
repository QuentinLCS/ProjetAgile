<div id="login" >
    <div class="center">
        <h4>Connexion</h4>

        <form action="../../controller/identification.php" method="post">

            <div class="input-field">
                <i class="material-icons prefix">person</i>
                <input autofocus type="text" id="name" data-length="20" name="mail">
                <label for="name">Mail</label>
            </div>
            <br>

            <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <input type="password" id="pass" data-length="40" name="mdp">
                <label for="pass">Mot de passe</label>
            </div>
            <br>

            <div class="center">
                <label for="check">
                    <input type="checkbox" id="check">
                    <span>Se souvenir de moi</span>
                </label>
            </div>

            <input type="submit" value="Login" class="btn btn-large blue">

        </form>
    </div>
</div>