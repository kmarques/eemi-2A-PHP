<?php require_once "./layouts/header.php"; ?>
    <h2>Register</h2>
    <form action="/register" method="post">
        <input name="email" placeholder="Type an email"/>
        <input name="password" placeholder="Type a password"/>
        <input type="submit" value="S'enregistrer"/>
    </form>
    <br/>
    <br/>
    <br/>
    <br/>
    <h2>Login</h2>
    <form action="/login" method="post">
        <input name="email" placeholder="Type an email"/>
        <input name="password" placeholder="Type a password"/>
        <input type="submit" value="Se connecter"/>
    </form>
<?php require_once "./layouts/footer.php"; ?>