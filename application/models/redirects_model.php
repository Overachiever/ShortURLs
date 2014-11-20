<?php
/**
 * Created by PhpStorm.
 * User: sjohnson
 * Date: 9/18/2014
 * Time: 9:48 PM
 */

class Redirects_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Inserts or Updates a row in the redirects table.  Records stats on how many redirects have been made on a per day basis
     * @param array $data
     * @return int
     */
    public function create($data)
    {
        $data['redirected_on'] = date('Y-m-d');
        $data['redirects'] = 1;
        $data['created_on'] = $data['updated_on'] = date('Y-m-d H:i:s');

        //codeigniter doesn't support on duplicate key update so build it manually.
        $sql = $this->db->insert_string('redirects', $data) . ' ON DUPLICATE KEY UPDATE redirects=redirects+1, updated_on = "' . $data['updated_on'] . '"';

        $this->db->query($sql);

        return $this->db->insert_id();
    }

    /**
     * Report for redirects by date.  Specifying no date gives most redirects from any time period.
     * @param string $date
     * @param int $limit
     * @return array
     */
    public function redirects_by_date($date = '', $limit = 5)
    {
        $this->db->select_sum('redirects')->select('links.url_code, links.url, links.created_on')->from('redirects')
                 ->join('links', 'redirects.link_id = links.link_id', 'left')
                 ->group_by('redirects.link_id')
                 ->order_by('redirects.redirects', 'DESC')
                 ->limit($limit);

        if($date)
        {
            $this->db->where('redirects.redirected_on', $date);
        }

        return $this->process_results($this->db->get()->result());
    }

    /**
     * Report for newly inserted links.
     * @param int $limit
     * @return array
     */
    public function newly_created_links($limit = 5)
    {
        $this->db->select('links.url_code, links.url, links.created_on, (SELECT SUM(redirects) FROM redirects WHERE redirects.link_id = links.link_id) as redirects')->from('links')
                 ->order_by('links.created_on', 'DESC')
                 ->limit($limit);

        return $this->process_results($this->db->get()->result());
    }

    /**
     * Converts short url code into a link
     * @param array $results
     * @return array
     */
    private function process_results($results)
    {
        foreach($results as &$result)
        {
            $result->redirects = $result->redirects ?: 0;
            $result->new_url = site_url('/' . $result->url_code);
        }

        return $results;
    }
}