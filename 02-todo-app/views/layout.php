<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-content">
        <a class="brand" href="/">TaskFlow</a>
        <a class="button" href="/?action=create">+ New Task</a>
    </div>
</header>
<main class="container">
    <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
    <?php endif; ?>
    <?php require __DIR__ . '/' . $view . '.php'; ?>
</main>
<footer class="container footer">PHP 8.3 · MySQL 8 · PDO</footer>
</body>
</html>
