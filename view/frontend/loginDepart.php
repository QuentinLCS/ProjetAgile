<main style="background-color: #c6e6fe">
    <div id="login" class="row" style="margin-top: 8%">
        <div class="card-panel col s12 offset-m3 m6 offset-l3 l6 z-depth-6" style="padding: 50px;">
            <div class="center row">
                <h4>Connexion</h4>

                <form action="../../controller/identification.php" method="post">

                    <div class="input-field">
                        <i class="material-icons prefix">person</i>
                        <input autofocus type="text" id="name" data-length="20" name="mail">
                        <label for="name">Mail</label>
                    </div>
                    <br>

                    <div class="input-field row">
                        <i class="material-icons prefix">lock</i>
                        <input type="password" id="pass" data-length="40" name="mdp">
                        <label for="pass">Mot de passe</label>
                    </div>
                    <br>

                    <div class="cente rowr">
                        <label for="check">
                            <input type="checkbox" id="check">
                            <span>Se souvenir de moi</span>
                        </label>
                    </div>
                    <div class="row"></div>

                    <input type="submit" value="Connexion" class="btn btn-large blue">

                </form>
            </div>
        </div>
    </div>
</main>