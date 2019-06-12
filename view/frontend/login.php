<div id="login" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Connexion</h4>

        <form action="#">

            <div class="input-field">
                <i class="material-icons prefix">person</i>
                <input autofocus type="text" id="name" data-length="20">
                <label for="name">Pseudonyme</label>
            </div>
            <br>

            <div class="input-field">
                <i class="material-icons prefix">lock</i>
                <input type="password" id="pass" data-length="40">
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

<script>
    $(document).ready(function(){
        $('.modal').modal();
    });

    $(document).ready(function() {
        $('input#name, input#pass').characterCounter();
    });
</script>