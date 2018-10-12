<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use GuzzleHttp\Client;

class Login extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			// Your own constructor code
	}
	public function index()
	{
		// url for this function is: http://localhost/iot_website/index.php/login/
			$this->form_validation->set_rules('username', 'نام کاربری', 'trim|required' ,
			array('required' => 'لطفا نام کاربری خود را وارد کنید.'));
			$this->form_validation->set_rules('password', 'رمز عبور', 'trim|required',
			array('required' => 'لطفا رمز عبور خود را وارد کنید.'));

		
		if ($this->form_validation->run() == FALSE) //age ghalat bod
		{
			$this->form_validation->set_error_delimiters('<div dir="rtl" class="alert-box error"><span>error:&nbsp;&nbsp;</span>','</div>');
			$this->load->view('login_view');
		}
		else //age doros bod
		{
			$data["username"]=  $this->input->post("username",'true');
			$data["password"]= $this->input->post("password",'true');
			$client = new \GuzzleHttp\Client([
				//Base URI is used with relative requests
				'base_uri' => 'http://example.com/iot/public/api/v1/'
			]);
			//define what the client will be doing
			try {
				$response = $client->request(
					'POST',
					'signin',
					[
						'json'=> [
							'username'=> $data["username"],
							'password'=> $data["password"],						
						]
					]
				);
				$json =  (string) $response->getBody();
				$array = json_decode($json, true);
				$user_data = array(
					'username'  => $data["username"],
					'token'  => $array['token'],
					"email" =>  $array['system_info']['email'],
					"name" => $array['system_info']['name'],
					"min_temp" => $array['system_info']['temp_min'],
					"max_temp" =>$array['system_info']['temp_max'],
					"min_humidity"=>$array['system_info']['humidity_min'],
					"max_humidity"=>$array['system_info']['humidity_max'],
					);
				$this->session->set_userdata($user_data);
				redirect('Dashboard','refresh');
			}
			 //catch exception
			catch(Exception $e) {
				echo 'Message: ' .$e->getMessage();
				$wrong["login_wrong"]="Username or password was incorrect!";
				$this->load->view('login_view',$wrong);
			}
			
			// if correct username and password: 200
			//if any thing goes wrong: 400

		}
	}
	public function comments()
	{
		// url for this function is: http://localhost/iot_website/index.php/login/comments
			echo 'Look at this!';
	}
}
