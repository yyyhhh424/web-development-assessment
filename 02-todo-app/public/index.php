<?php

declare(strict_types=1);

session_start();

require_once dirname(__DIR__) . '/src/helpers.php';
require_once dirname(__DIR__) . '/src/Database.php';
require_once dirname(__DIR__) . '/src/TaskRepository.php';

use App\Database;
use App\TaskRepository;

$config = require dirname(__DIR__) . '/config/config.php';
$repository = new TaskRepository((new Database($config['db']))->connection());

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'index';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: null;
$errors = [];

function taskData(array $input): array
{
    return [
        'title' => trim((string) ($input['title'] ?? '')),
        'description' => trim((string) ($input['description'] ?? '')) ?: null,
        'priority' => in_array($input['priority'] ?? '', ['low', 'medium', 'high'], true) ? $input['priority'] : 'medium',
        'status' => in_array($input['status'] ?? '', ['pending', 'completed'], true) ? $input['status'] : 'pending',
        'due_date' => trim((string) ($input['due_date'] ?? '')) ?: null,
    ];
}

function validateTask(array $data): array
{
    $errors = [];
    if ($data['title'] === '') {
        $errors['title'] = 'Title is required.';
    } elseif (mb_strlen($data['title']) > 190) {
        $errors['title'] = 'Title must be 190 characters or fewer.';
    }
    if ($data['due_date'] && !DateTime::createFromFormat('Y-m-d', $data['due_date'])) {
        $errors['due_date'] = 'Due date must be valid.';
    }
    return $errors;
}

if ($method === 'POST') {
    verify_csrf();

    if ($action === 'store') {
        $task = taskData($_POST);
        $errors = validateTask($task);
        if (!$errors) {
            $repository->create($task);
            flash('success', 'Task created successfully.');
            redirect('/');
        }
        $view = 'form';
        $pageTitle = 'Create Task';
    } elseif ($action === 'update' && $id) {
        $task = taskData($_POST);
        $errors = validateTask($task);
        $task['id'] = $id;
        if (!$errors) {
            $repository->update($id, array_diff_key($task, ['id' => true]));
            flash('success', 'Task updated successfully.');
            redirect('/');
        }
        $view = 'form';
        $pageTitle = 'Edit Task';
    } elseif ($action === 'toggle' && $id) {
        $repository->toggle($id);
        flash('success', 'Task status updated.');
        redirect('/');
    } elseif ($action === 'delete' && $id) {
        $repository->delete($id);
        flash('success', 'Task deleted.');
        redirect('/');
    }
}

if (!isset($view)) {
    if ($action === 'create') {
        $view = 'form';
        $pageTitle = 'Create Task';
        $task = ['title' => '', 'description' => '', 'priority' => 'medium', 'status' => 'pending', 'due_date' => ''];
    } elseif ($action === 'edit' && $id) {
        $task = $repository->find($id);
        if (!$task) {
            http_response_code(404);
            exit('Task not found.');
        }
        $view = 'form';
        $pageTitle = 'Edit Task';
    } else {
        $status = $_GET['status'] ?? null;
        $tasks = $repository->all($status);
        $view = 'index';
        $pageTitle = 'To-do Task List';
    }
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
require dirname(__DIR__) . '/views/layout.php';
