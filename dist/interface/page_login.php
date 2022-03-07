<body>

<div id="layout" class="theme-orange">
    <div id="wrapper">
        <div class="d-flex h100vh align-items-center auth-main w-100">
            <div class="auth-box">
                <div class="top mb-4">
                    <div class="logo">
                        
                    </div>
                </div>
                <div class="card shadow p-lg-4">
                    <div class="card-header">
                        <p class="fs-5 mb-0" style="text-align: center;">Connectez-vous</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="verify.php">
                            <?php
                                if(isset($_SESSION['error'])){
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    <i class='fa fa-check-circle'></i> ".$_SESSION['error']."
                                </div>
                                ";
                                unset($_SESSION['error']);
                                }
                                if(isset($_SESSION['success'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        <i class='fa fa-times-circle'></i> ".$_SESSION['success']."
                                    </div>
                                ";
                                unset($_SESSION['success']);
                                }
                            ?>
                            <div class="form-floating mb-1">
                                <input name="email" type="email" class="form-control" placeholder="name@example.com" required>
                                <label>Adresse e-mail</label>
                            </div>
                            <div class="form-floating">
                                <input name="password" type="password" class="form-control" placeholder="Password" required>
                                <label>Mot de passe</label>
                            </div>
                            <div class="form-check my-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                Souviens-toi de moi
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 px-3 py-2" name="login">CONNEXION</button>
                        </form>
                        <div class="mt-3 pt-3 border-top">
                            <p class="mb-1"><a href="page-forgot-password.html"><i class="fa fa-lock me-2"></i>Mot de passe oublié?</a></p>
                            <span>Vous n'avez pas de compte ? <a href="register.php">S'inscrire</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>