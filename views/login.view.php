<?php require __DIR__ . '/layouts/header.view.php'?>

<style>
    body {
        background-color: #384b6d;
    }
</style>

<section style="background-color: #384b6d;height: 80vh">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 ">

                        <h3 class="mb-5 text-center">Sign in</h3>
                        <form method="post">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="typeEmailX-2">Email</label>
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="email" />
                                <strong>
                                    <span class="text-danger">
                                        <?= error('email')?>
                                    </span>
                                </strong>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="typePasswordX-2">Password</label>
                                <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password"/>
                                <strong>
                                    <span class="text-danger">
                                        <?= error('password')?>
                                    </span>
                                </strong>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input class="form-check-input" type="checkbox" value="" name="remember" id="form1Example3" />
                                <label class="form-check-label" for="form1Example3"> Remember password </label>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                            <hr class="my-4">
                            <p class="text-center">
                                Don't have Account?
                                <a href="/register" class="ml-1" type="submit">Create now</a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/layouts/footer.view.php'?>
