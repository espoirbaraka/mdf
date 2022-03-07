<body>

<div id="layout" class="theme-orange">
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="d-flex h100vh align-items-center auth-main w-100">
            <div class="auth-box">
                <div class="top mb-4">
                    <div class="logo">
                        
                    </div>
                </div>
                <div class="card shadow p-lg-4">
                    <div class="card-header">
                        <p class="fs-5 mb-0">Créer un compte</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="verify.php">
                            <div class="form-floating mb-1">
                                <input type="email" class="form-control" name="email" placeholder="name@example.com">
                                <label>Adresse e-mail</label>
                            </div>
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="username" placeholder="Nom">
                                <label>Nom d'utilisateur</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <label>Password</label>
                            </div>Mot de passe
                            <div class="my-3">
                                <button type="submit" class="btn btn-primary w-100 px-3 py-2 mb-2" name="create">S'INSCRIRE</button>
                                <span>Vous avez déjà un compte ? <a href="index.php">Connexion</a></span>
                            </div>
                        </form>
                        <div class="d-grid gap-2 mt-3 pt-3">
                            <div class="text-center"><span>OU</span></div>
                            <button class="btn btn-light"><i class="fa fa-facebook-official"></i> Sign in with Facebook</button>
                            <button class="btn btn-light"><i class="fa fa-twitter"></i> Connectez-vous avec Twitter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</div>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/bs5/dist/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Dec 2021 14:01:58 GMT -->
</html>