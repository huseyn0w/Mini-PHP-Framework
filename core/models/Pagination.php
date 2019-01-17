<?php


class Pagination extends config\HWF_Model
{
    public function pageCount()
    {
        $user_id = get_current_user_id();
        if (!$user_id) return false;
        $sql = "SELECT count(*) FROM `tasks` WHERE author_id = ?";
        $result = $this->db->prepare($sql);
        $result->execute([$user_id]);
        $number_of_rows = $result->fetchColumn(); 
        $pagecounts = ceil($number_of_rows / POSTS_PER_PAGE);
        return $pagecounts;
    }
} 