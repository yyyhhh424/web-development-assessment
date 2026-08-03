<section class="hero">
    <div>
        <p class="eyebrow">CRUD ASSESSMENT</p>
        <h1>To-do Task List</h1>
        <p>Create, review, update, complete, and delete tasks.</p>
    </div>
</section>

<nav class="filters" aria-label="Task filters">
    <a href="/" class="<?= empty($_GET['status']) ? 'active' : '' ?>">All</a>
    <a href="/?status=pending" class="<?= ($_GET['status'] ?? '') === 'pending' ? 'active' : '' ?>">Pending</a>
    <a href="/?status=completed" class="<?= ($_GET['status'] ?? '') === 'completed' ? 'active' : '' ?>">Completed</a>
</nav>

<?php if (!$tasks): ?>
    <div class="empty-state">
        <h2>No tasks found</h2>
        <p>Create your first task to get started.</p>
    </div>
<?php else: ?>
    <div class="task-grid">
        <?php foreach ($tasks as $task): ?>
            <article class="task-card <?= $task['status'] === 'completed' ? 'is-completed' : '' ?>">
                <div class="task-meta">
                    <span class="badge priority-<?= e($task['priority']) ?>"><?= e(ucfirst($task['priority'])) ?></span>
                    <span class="badge status-<?= e($task['status']) ?>"><?= e(ucfirst($task['status'])) ?></span>
                </div>
                <h2><?= e($task['title']) ?></h2>
                <?php if ($task['description']): ?><p><?= nl2br(e($task['description'])) ?></p><?php endif; ?>
                <div class="task-date">Due: <?= $task['due_date'] ? e($task['due_date']) : 'No due date' ?></div>
                <div class="actions">
                    <form method="post" action="/?action=toggle&id=<?= (int) $task['id'] ?>">
                        <input type="hidden" name="_token" value="<?= e(csrf_token()) ?>">
                        <button class="button secondary" type="submit"><?= $task['status'] === 'completed' ? 'Reopen' : 'Complete' ?></button>
                    </form>
                    <a class="button secondary" href="/?action=edit&id=<?= (int) $task['id'] ?>">Edit</a>
                    <form method="post" action="/?action=delete&id=<?= (int) $task['id'] ?>" onsubmit="return confirm('Delete this task permanently?')">
                        <input type="hidden" name="_token" value="<?= e(csrf_token()) ?>">
                        <button class="button danger" type="submit">Delete</button>
                    </form>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
