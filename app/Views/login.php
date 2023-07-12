<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="/">TODOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/login">Войти</a>
            </li>
        </ul>
    </header>
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong">
                    <div class="card-body p-5">
                        <h1 class="card-title text-center mb-5">Log In</h1>
                        <form method="post" action="/login">
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input class="form-control"
                                       placeholder="admin"
                                       type="text"
                                       name="login"
                                       id="login"
                                >
                                <?php if ($errors['login']): ?>
                                    <div id="error-login" class="form-text text-danger">
                                        <?php echo $errors['login'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control"
                                       type="password"
                                       name="password"
                                       id="password"
                                >
                                <?php if ($errors['password']): ?>
                                    <div id="error-password" class="form-text text-danger">
                                        <?php echo $errors['password'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
