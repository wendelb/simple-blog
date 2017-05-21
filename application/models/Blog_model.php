<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Blog_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

		public function getPageEntries($start) {
			$this->db->select("article.id, date_created, date_last_modified, title, text_teaser, text_read_more <> '' as readon, author.name");
			$this->db->from('article');
			$this->db->join('author', 'author.id = article.author', 'left');
			$this->db->where('published', 1);
			$this->db->order_by('date_created', 'DESC');
			$this->db->limit($this->config->item('posts_per_page'), $start);

			$query = $this->db->get();
			return $query->result();
		}

		public function getTotalPosts() {
			$this->db->from('article')
				->where('published', 1);

			return $this->db->count_all_results();
		}

		public function getPost($id) {
			$this->db->where('article.id', $id);
			$this->db->where('published', 1);
			$this->db->from('article');
			$this->db->join('author', 'author.id = article.author', 'left');
			$this->db->select("date_created, date_last_modified, title, text_teaser, text_read_more as readon, author.name");

			$query = $this->db->get();
			$result = $query->result();
			if (sizeof($result) === 1) {
				return $result[0];
			}

			return null;
		}

}