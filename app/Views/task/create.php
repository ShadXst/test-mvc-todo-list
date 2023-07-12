<!DOCTYPE html>
<html>
<head>
    <title>New TODO</title>
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
                <a class="nav-link active mx-2" aria-current="page" href="/">TODOS</a>
            </li>
        </ul>
    </header>
    <div>
        <h1 class="text-center">New Task</h1>
        <div class="card my-2">
            <div class="card-body">
                <form method="POST" action="/tasks/create">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input class="form-control"
                               placeholder="username"
                               name="username"
                               id="username"
                               type="text"
                        >
                        <?php if ($errors['username']): ?>
                            <div id="error-username" class="text-danger">
                                <?php echo $errors['username'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control"
                               placeholder="user@example.com"
                               type="text"
                               name="email"
                               id="email"
                        >
                        <?php if ($errors['email']): ?>
                            <div id="error-email" class="text-danger">
                                <?php echo $errors['email'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="task-text" class="form-label">Task text</label>
                        <input class="form-control"
                               placeholder="To-do.."
                               name="task_text"
                               id="task-text"
                               type="text"
                        >
                        <?php if ($errors['task_text']): ?>
                            <div id="error-task_text" class="text-danger">
                                <?php echo $errors['task_text'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
