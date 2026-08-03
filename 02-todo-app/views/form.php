<section class="form-page">
    <p class="eyebrow">TASK DETAILS</p>
    <h1><?= e($pageTitle) ?></h1>
    <form class="task-form" method="post" action="/?action=<?= isset($task['id']) ? 'update&id=' . (int) $task['id'] : 'store' ?>">
        <input type="hidden" name="_token" value="<?= e(csrf_token()) ?>">

        <label for="title">Title</label>
        <input id="title" name="title" maxlength="190" required value="<?= e($task['title'] ?? '') ?>">
        <?php if (isset($errors['title'])): ?><small class="error"><?= e($errors['title']) ?></small><?php endif; ?>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"><?= e($task['description'] ?? '') ?></textarea>

        <div class="form-row">
            <div>
                <label for="priority">Priority</label>
                <select id="priority" name="priority">
                    <?php foreach (['low', 'medium', 'high'] as $priority): ?>
                        <option value="<?= $priority ?>" <?= ($task['priority'] ?? '') === $priority ? 'selected' : '' ?>><?= ucfirst($priority) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="status">Status</label>
                <select id="status" name="status">
                    <?php foreach (['pending', 'completed'] as $status): ?>
                        <option value="<?= $status ?>" <?= ($task['status'] ?? '') === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="due_date">Due date</label>
                <input id="due_date" type="date" name="due_date" value="<?= e($task['due_date'] ?? '') ?>">
                <?php if (isset($errors['due_date'])): ?><small class="error"><?= e($errors['due_date']) ?></small><?php endif; ?>
            </div>
        </div>

        <div class="actions">
            <button class="button" type="submit">Save Task</button>
            <a class="button secondary" href="/">Cancel</a>
        </div>
    </form>
</section>
