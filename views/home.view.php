<?php require __DIR__ . '/layouts/header.view.php'?>

<div class="100-vh text-center">
<h1>
    Hello <?= auth()['username'] ?>
</h1>
<br>
<a class="btn btn-danger" href="/logout">
Logout
</a>
</div>

<?php require __DIR__ . '/layouts/footer.view.php'?>
