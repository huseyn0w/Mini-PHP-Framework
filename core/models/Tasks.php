<?php


class Tasks extends config\HWF_Model
{
    public function all_tasks($currentPage = 1, $order = 'date')
    {
        $startPoint = (int) ($currentPage - 1) * POSTS_PER_PAGE;

        $posts_per_page = POSTS_PER_PAGE;

        $user_id = get_current_user_id();
        if(!$user_id) return false;
        $query = $this->db->prepare("SELECT t.id as task_id, u.id as user_id, u.name as user_name, u.email as user_email, t.header,t.text, t.author_id as task_author_ID, t.date, t.status FROM `tasks` t LEFT JOIN `users` u ON t.author_id = u.id WHERE u.id = ? ORDER BY $order DESC LIMIT $startPoint, $posts_per_page");
        $query->execute([$user_id]);
        if(!$result = $query->fetchAll(PDO::FETCH_ASSOC)) return false;
        return $result;
    }

    public function createTask($header,$desc)
    {
        $user_id = get_current_user_id();
        $userStatus = get_current_user_status();
        if (!$user_id) return false;
        $query = $this->db->prepare('INSERT INTO `tasks` (`header`,`text`,`author_id`, `status`) VALUES (?,?,?,?)');
        if (!$query->execute([$header, $desc, $user_id, 0])) return false;
        return true;
    }

    public function updateTask($id, $header, $desc, $status)
    {
        $user_id = get_current_user_id();
        if (!$user_id) return false;
        $query = $this->db->prepare('UPDATE `tasks` SET `header`= ? , `text`= ?, `author_id`= ?, `status`= ? WHERE `id` = ?');
        if (!$query->execute([$header, $desc, $user_id, $status, $id])) return false;
        return true;
    }

    public function deleteTask($task_id)
    {
        $user_id = get_current_user_id();
        if (!$user_id) return false;
        $query = $this->db->prepare('DELETE FROM `tasks` WHERE id = ? AND author_id = ?');
        if (!$query->execute([$task_id, $user_id])) return false;
        return true;
    }

    public function deleteSelectedTask($taskArray)
    {
        $arraysString = implode(',', $taskArray);
        $user_id = get_current_user_id();
        if (!$user_id) return false;
        $query = $this->db->prepare("DELETE FROM `tasks` WHERE id IN (".$arraysString.")");
        if (!$query->execute()) return false;
        return true;
    }

    public function showTask($task_id)
    {
        $user_id = get_current_user_id();
        if (!$user_id) return false;
        $query = $this->db->prepare('SELECT * FROM `tasks` WHERE id = ? AND author_id = ?');
        $query->execute([$task_id, $user_id]);
        if (!$result = $query->fetch(PDO::FETCH_ASSOC)) return false;
        return $result;
    }
} 