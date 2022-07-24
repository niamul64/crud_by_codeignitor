<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->database();
		$this->load->model("Members");
		$data['members'] = $this->Members->getMembers();

		$this->load->view('base/head');
		$this->load->view('members/view', $data);
		$this->load->view('base/tail');
	}
	public function delete($id)
	{
		$this->load->model("Members");
		$this->Members->deleteMember($id);

		echo "success";
	}
	public function addMember()
	{
		$data = [
			'firstName' => $this->input->post('first'),
			'lastName' => $this->input->post('last'),
		];

		$this->load->model("Members");
		$this->Members->addMember($data);

		echo "success";
	}
	public function edit($id)
	{
		$data = [
			'firstName' => $this->input->post('firstname'),
			'lastName' => $this->input->post('lastname'),
		];
		$this->load->model("Members");
		$this->Members->editMember($data, $id);

		echo "success";
	}
}
