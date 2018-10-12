<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use GuzzleHttp\Client;

class EditInfo extends CI_Controller {

	public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			// Your own constructor code
	}
	public function index(){
        // echo "we are in the dashboard.";
        //connect to webserver and get the datas
        // echo $_SESSION['name'] ;
        
		$this->form_validation->set_rules('name', 'System name', 'trim');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('min_temp','minimum temperature', 'trim|required');
		$this->form_validation->set_rules('max_temp', 'maximum temerature', 'trim|required');
		$this->form_validation->set_rules('min_humidity', 'minimum humidity ', 'trim|required');
		$this->form_validation->set_rules('max_humidity', 'maximum humidity', 'trim|required');

		if ($this->form_validation->run() == FALSE) //age ghalat bod
		{
			$this->form_validation->set_error_delimiters('<div dir="rtl" class="alert-box error"><span>error:&nbsp;&nbsp;</span>','</div>');
			$this->load->view('edit_info_view',$_SESSION);
		}
		else //age doros bod
		{
			$data["name"]=  $this->input->post("name",'true');
			$data["email"]= $this->input->post("email",'true');
			$data["min_temp"]= $this->input->post("min_temp",'true');
			$data["max_temp"]= $this->input->post("max_temp",'true');
			$data["min_humidity"]= $this->input->post("min_humidity",'true');
			$data["max_humidity"]= $this->input->post("max_humidity",'true');
			$this->session->set_userdata($data);
			$client = new \GuzzleHttp\Client([
				//Base URI is used with relative requests
				'base_uri' => 'http://example.com/iot/public/api/v1/'
			]);
			//define what the client will be doing
			try {
				$response = $client->request(
					'POST',
					'editSystemInformation',
					[
						'json'=> [
							'token'=>$_SESSION['token'],
							'name'=> $data["name"],
							'email'=> $data["email"],						
							'min_temp'=> $data["min_temp"],						
							'max_temp'=> $data["max_temp"],						
							'min_humidity'=> $data["min_humidity"],						
							'max_humidity'=> $data["max_humidity"],						
						]
					]
				);
				echo "<pre>";
				$json =  (string) $response->getBody();
				$array = json_decode($json, true);

				$_SESSION['infosuc'] = 'system information updated sucessfully';
				redirect('Dashboard','refresh');
			}
			 //catch exception
			catch(Exception $e) {
				echo 'Message: ' .$e->getMessage();
				$wrong["login_wrong"]="Something went wrong in editing system info. try again";
				$this->load->view('dashboard_view',$wrong);
			}




			
		}        
    }
}