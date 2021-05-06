<?php require 'inc/header.php' ?>
<?php

if (!empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['password2_signup']) && !empty($_POST['username_signup']) &&  isset($_POST['submit_signup'])) {
    $email = htmlspecialchars($_POST['email_signup']);
    $password1 = htmlspecialchars($_POST['password1_signup']);
    $password2 = htmlspecialchars($_POST['password2_signup']);
    $username = htmlspecialchars($_POST['username_signup']);

    try {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sqlMail = "SELECT * FROM users WHERE email = '{$email}'";
            $resultMail = $connect->query($sqlMail);
            $countMail = $resultMail->fetchColumn();
            if (!$countMail) {
                $sqlUsername = "SELECT * FROM users WHERE username = '{$username}'";
                $resultUsername = $connect->query($sqlUsername);
                $countUsername = $resultUsername->fetchColumn();
                if (!$countUsername) {

                    if ($password1 === $password2) {
                        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                        $sth = $connect->prepare("INSERT INTO users (email,username,password) VALUES (:email,:username,:password)");
                        $sth->bindValue(':email', $email);
                        $sth->bindValue(':username', $username);
                        $sth->bindValue(':password', $hashedPassword);
                        $sth->execute();
                        echo "L'utilisateur a bien été enregistré !";
                    } else {
                        echo "Les mots de passe ne sont pas concordants.";
                        unset($_POST);
                    }
                } else {
                    echo " Ce nom d'utilisateur existe déja";
                    unset($_POST);
                }
            } else {
                echo "Un compte existe déja pour cette adresse mail";
                unset($_POST);
            }
        } else {
            echo "L'adresse email saisie n'est pas valide";
            unset($_POST);
        }
    } catch (PDOException $error) {
        echo 'Error: ' . $error->getMessage();
    }
}



?>
<main class="px-3">
    <div class="row">
        <div class="col">
            <h3>S'inscrire</h3>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="InputEmail1">Adresse mail</label>
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" name="email_signup" required>
                    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email avec qui que
                        ce soit.</small>
                </div>
                <div class="form-group">
                    <label for="InputUsername1">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="InputUsername1" aria-describedby="userHelp" name="username_signup" required>
                    <small id="userHelp" class="form-text text-muted">Choisissez un nom d'utilisateur, il doit être unique
                        !</small>
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Choisissez un mot de passe</label>
                    <input type="password" class="form-control" id="InputPassword1" name="password1_signup" required>
                </div>
                <div class="form-group">
                    <label for="InputPassword2">Entrez votre mot de passe de nouveau</label>
                    <input type="password" class="form-control" id="InputPassword2" name="password2_signup" required>
                </div>
                <hr>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="Check1" required>
                    <label class="form-check-label" for="Check1">Accepter les <a href="#">termes et conditions</a></label>
                </div>
                <hr>
                <div class="form-group form-check">
                    <button type="submit" class="btn btn-primary" name="submit_signup" value="inscription">S'inscrire</button>
                </div>
            </form>
            <hr>
            <div class="row">
                <div class="col">
                    <p>Déja inscrits ? <a href="./login.php">Connectez-vous ici </a></p>
                </div>
            </div>
        </div>
    </div>
</main>


