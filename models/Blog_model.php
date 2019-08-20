<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Blog_model
 *
 * This is demo from blog table
 * You can use on your tales
 */
class Blog_model
{
    /**
     * @return mixed
     */
    public function countBlog()
    {
        $this->db->from('blog')->where(array('blog.active' => 1));
        return $this->ci->db->get()->num_rows();
    }

    /**
     * @param null $limit
     * @param null $start
     * @return mixed
     */
    public function getBlog($limit = NULL, $start = NULL)
    {
        $this->ci->db->from('blog')->select('blog.*')->where(array('blog.active' => 1))->order_by('blog.added', 'DESC');

        if ($limit) $this->ci->db->limit($limit, $start);

        return $this->ci->db->get()->result();
    }
}