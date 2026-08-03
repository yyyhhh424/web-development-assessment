<?php

declare(strict_types=1);

namespace App;

use PDO;

final class TaskRepository
{
    public function __construct(private PDO $db)
    {
    }

    public function all(?string $status = null): array
    {
        if ($status && in_array($status, ['pending', 'completed'], true)) {
            $statement = $this->db->prepare('SELECT * FROM tasks WHERE status = :status ORDER BY created_at DESC');
            $statement->execute(['status' => $status]);
            return $statement->fetchAll();
        }

        return $this->db->query('SELECT * FROM tasks ORDER BY status ASC, created_at DESC')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM tasks WHERE id = :id');
        $statement->execute(['id' => $id]);
        $task = $statement->fetch();

        return $task ?: null;
    }

    public function create(array $data): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO tasks (title, description, priority, status, due_date)
             VALUES (:title, :description, :priority, :status, :due_date)'
        );
        $statement->execute($data);

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $statement = $this->db->prepare(
            'UPDATE tasks
             SET title = :title, description = :description, priority = :priority,
                 status = :status, due_date = :due_date
             WHERE id = :id'
        );

        return $statement->execute($data);
    }

    public function toggle(int $id): bool
    {
        $statement = $this->db->prepare(
            "UPDATE tasks SET status = IF(status = 'pending', 'completed', 'pending') WHERE id = :id"
        );

        return $statement->execute(['id' => $id]);
    }

    public function delete(int $id): bool
    {
        $statement = $this->db->prepare('DELETE FROM tasks WHERE id = :id');
        return $statement->execute(['id' => $id]);
    }
}
