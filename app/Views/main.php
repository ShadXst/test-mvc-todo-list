<!-- app/views/main.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>TODOS</title>
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
            <?php if (!$data['auth']['isLoggedIn']): ?>
            <li class="nav-item">
                <a class="btn btn-success" href="/login">LogIn</a>
            </li>
            <?php else: ?>
                <li class="nav-item">
                    <form method="POST" action="/logout">
                        <button type="submit" id="logout" class="btn btn-danger">Logout</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
    </header>
    <div>
        <h1 class="text-center mb-5">TO-DO Task List</h1>
        <?php if ($successMessage): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage ?>
            </div>
        <?php endif; ?>
        <div class="container">
            <form class="row align-items-start" method="GET" action="/">
                <select name="order_by" class="form-select col mx-3">
                    <option value <?php echo ($orderBy === 'id') ? 'selected' : ''; ?>
                    >Order by</option>
                    <option value="username"
                            <?php echo ($orderBy === 'username') ? 'selected' : ''; ?>
                    >Username</option>
                    <option value="email"
                            <?php echo ($orderBy === 'email') ? 'selected' : ''; ?>
                    >Email</option>
                    <option value="isComplete"
                            <?php echo ($orderBy === 'isComplete') ? 'selected' : ''; ?>
                    >Status</option>
                </select>
                <select name="order" class="form-select col">
                    <option value="ASC" <?php echo (!isset($order) || $order === 'ASC') ? 'selected' : ''; ?>>Ascending</option>
                    <option value="DESC" <?php echo ($order === 'DESC') ? 'selected' : ''; ?>>Descending</option>
                </select>
                <?php if (isset($_GET['page'])): ?>
                    <input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
                <?php endif ?>
                <button type="submit" class="col btn btn-warning mx-3">
                    Reorder
                </button>
            </form>
        </div>
        <div>
            <?php foreach ($data['tasks'] as $task): ?>
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $task->getTaskText(); ?>
                        </h5>
                        <p class="card-text">
                        <div>
                            <strong>Created by:</strong>
                            <?php echo $task->getUsername(); ?>
                            &lt;<?php echo $task->getEmail(); ?>&gt;
                        </div>
                        <div>
                            <strong>Status:</strong>
                            <?php echo($task->isComplete() ? 'complete' : 'not complete'); ?>
                        </div>
                        <?php if ($task->isTextEditedByAdmin()): ?>
                            <div class="text-body-secondary">
                                Edited by admin
                            </div>
                        <?php endif; ?>
                        <?php if ($data['auth']['isLoggedIn']): ?>
                        <a class="btn btn-secondary mt-2"
                           href="/tasks/update?taskId=<?php echo $task->getId() ?>"
                        >
                            Edit
                        </a>
                        <?php endif; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
            <a class="btn btn-secondary" href="/tasks/create">
                + New Task
            </a>
        </div>
        <nav aria-label="TODO pagination">
            <ul class="pagination justify-content-center">
                <?php if ($data['meta']['currentPage'] > 1): ?>
                    <li class="page-item">
                        <a class="page-link"
                           aria-label="Previous"
                           href="?page=<?php echo ($data['meta']['currentPage'] - 1); ?>&order_by=<?php echo $data['meta']['orderBy']; ?>&order=<?php echo $data['meta']['order']; ?>"
                        >
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $data['meta']['totalPages']; $i++): ?>
                    <li class="page-item">
                        <a class="page-link <?php echo $i == ($_GET['page'] ?? 1) ? 'active' : '' ?>"
                           href="?page=<?php echo $i; ?>&order_by=<?php echo $data['meta']['orderBy']; ?>&order=<?php echo $data['meta']['order']; ?>"
                        >
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <?php if ($data['meta']['currentPage'] < $data['meta']['totalPages']): ?>
                    <li class="page-item">
                        <a class="page-link"
                           aria-label="Next"
                           href="?page=<?php echo ($data['meta']['currentPage'] + 1); ?>&order_by=<?php echo $data['meta']['orderBy']; ?>&order=<?php echo $data['meta']['order']; ?>"
                        >
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
</body>
</html>
