<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index()
	{
		// Default Start Page is First Blog Page
		$this->page(0);
	}

	private function _pagination() {
		$pagination['base_url'] = '/page/';
		$pagination['total_rows'] = $this->database->getTotalPosts();
		$pagination['per_page'] = $this->config->item('posts_per_page');
		$pagination['first_url'] = '/';

		$this->pagination->initialize($pagination);

		$links = $this->pagination->create_links();
		$this->load->view('pagination', array('links' => $links));
	}

	public function page($num) {
		$this->load->model('blog_model', 'database');
		$this->load->library('pagination');

		$data = array(
			'blog_title' => $this->config->item('title'),
			'blog_subtitle' => $this->config->item('subtitle')
		);

		if ($num == 0) {
			$data['title'] = $this->config->item('title');
		}
		else {
			$data['title'] = 'Page ' . ceil(((int)$num + 1) / $this->config->item('posts_per_page')) . ' - ' . $this->config->item('title');
		}

		$this->load->view('bootstrap/header', $data);

		$entries = $this->database->getPageEntries($num);

		foreach($entries as $entry) {
			$post = array();
			$post['id'] = $entry->id;
			$post['author'] = $entry->name;
			$post['title'] = $entry->title;
			$post['date'] = $entry->date_created;
			$post['readon'] = $entry->readon;
			$post['teaser'] = $entry->text_teaser;

			$this->load->view('blog_teaser', $post);
		}

		$this->_pagination();

		$this->load->view('bootstrap/sidebar');
		$this->load->view('bootstrap/footer');
	}

	public function post($id) {
		$this->load->model('blog_model', 'database');
		$post = $this->database->getPost($id);

		// Send 404 if post does not exist
		if (!$post) {
			header('HTTP/1.1 404 Not found');
			header('Location: /');
			return;
		}

		$data = array(
			'blog_title' => $this->config->item('title'),
			'blog_subtitle' => $this->config->item('subtitle')
		);

		$data['title'] = $post->title . ' - ' . $this->config->item('title');

		$post_data = array();
		$post_data['id'] = $id;
		$post_data['author'] = $post->name;
		$post_data['title'] = $post->title;
		$post_data['date'] = $post->date_created;
		$post_data['teaser'] = $post->text_teaser;
		$post_data['text'] = $post->readon;

		$this->load->view('bootstrap/header', $data);
		$this->load->view('item', $post_data);
		$this->load->view('bootstrap/footer');
	}
}
