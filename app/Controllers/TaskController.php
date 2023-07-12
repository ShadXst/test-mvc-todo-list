<?php

namespace App\Controllers;

use App\Models\Task;
use App\Validation\TaskStoreValidator;
use App\Validation\TaskUpdateValidator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Контроллер задач.
 *
 * @package App\Controllers
 */
class TaskController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Render the task list page.
     *
     * @return void
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(): void
    {
        $taskRepository = $this->entityManager->getRepository(Task::class);
        $totalTasksCount = $taskRepository->createQueryBuilder('t')
            ->select('COUNT(t.id)')
            ->getQuery()
            ->getSingleScalarResult();
        $tasksPerPage = 3;
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $totalPages = ceil($totalTasksCount / $tasksPerPage);
        $offset = ($currentPage - 1) * $tasksPerPage;
        $orderableFields = ['username', 'email', 'status'];
        $orderBy = $_GET['order_by'] ?? 'id';
        $order = $_GET['order'] ? strtoupper($_GET['order']) : 'ASC';
        $orderBy = in_array($orderBy, $orderableFields, true) ? $orderBy : 'id';
        // Get the tasks for the current page
        $query = $taskRepository->createQueryBuilder('t')
            ->orderBy('t.' . $orderBy, $order)
            ->setFirstResult($offset)
            ->setMaxResults($tasksPerPage)
            ->getQuery();
        $paginator = new Paginator($query);
        $tasks = $paginator->getIterator();
        session_start();
        $data = [
            'auth' => [
                'isLoggedIn' => isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true,
            ],
            'tasks' => $tasks,
            'meta' => [
                'order' => $order,
                'orderBy' => $orderBy,
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
            ],
        ];
        $successMessage = $_SESSION['success_message'] ?? null;
        unset($_SESSION['success_message']);
        include_once __DIR__ . '/../Views/main.php';
    }

    /**
     * Render the task creation page.
     *
     * @return void
     */
    public function create(): void
    {
        include_once __DIR__ . '/../Views/task/create.php';
    }

    /**
     * Create a new task.
     *
     * @return void
     */
    public function store(): void
    {
        $validator = new TaskStoreValidator();
        $errors = $validator->validate($_POST);
        if (empty($errors)) {
            $task = new Task();
            $task->setUsername($_POST['username']);
            $task->setEmail($_POST['email']);

            // character escape example for task_text
            $taskText = htmlentities($_POST['task_text']);
            $task->setTaskText($taskText);

            // if no default values set in DB
            $task->setIsComplete(false);
            $task->setIsTextEditedByAdmin(false);

            $this->entityManager->persist($task);
            $this->entityManager->flush();
            session_start();
            $_SESSION['success_message'] = 'The task has been successfully created.';
            header('Location: /');
            exit;
        }
        include_once __DIR__ . '/../Views/task/create.php';
    }

    /**
     * Render the task edit page.
     *
     * @param int $taskId
     * @return void
     */
    public function edit(int $taskId): void
    {
        $taskRepository = $this->entityManager->getRepository(Task::class);
        $task = $taskRepository->find($taskId);
        if (!$task) {
            exit('Task not found');
        }
        require_once __DIR__ . '/../Views/task/edit.php';
    }

    /**
     * Update the task data.
     *
     * @param int $taskId
     * @return void
     */
    public function update(int $taskId): void
    {
        session_start();
        if (!$_SESSION['isLoggedIn']) {
            header('Location: /login');
            exit;
        }
        $taskRepository = $this->entityManager->getRepository(Task::class);
        $task = $taskRepository->find($taskId);
        if (!$task) {
            exit('Task not found');
        }
        $validator = new TaskUpdateValidator();
        $errors = $validator->validate($_POST);
        if (empty($errors)) {
            $task->setUsername($_POST['username']);
            $task->setEmail($_POST['email']);
            if ($task->getTaskText() !== $_POST['task_text']) {
                $task->setIsTextEditedByAdmin(true);
            }
            $task->setTaskText(htmlentities($_POST['task_text']));
            $isComplete = isset($_POST['is_complete']) && $_POST['is_complete'] === 'on';
            $task->setIsComplete($isComplete);
            $this->entityManager->flush();
            $_SESSION['success_message'] = 'The task is successfully edited.';
            header('Location: /');
            exit;
        }
        require_once __DIR__ . '/../Views/task/edit.php';
    }
}
