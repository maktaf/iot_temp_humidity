<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use GuzzleHttp\Client;

class Dashboard extends CI_Controller {
	public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			// Your own constructor code
	}
	public function index(){
        // echo "hello".$_SESSION["token"];
        //connect to webserver and get the datas
        //-----retrieve temp data and humidity--------------
        $client = new \GuzzleHttp\Client([
            //Base URI is used with relative requests
            'base_uri' => 'http://example.com/iot/public/api/v1/'
        ]);
        //define what the client will be doing
        try {
            $response = $client->request(
                'POST',
                'retrieve_data',
                [
                    'json'=> [
                        'token'=> $_SESSION["token"]
                    ]
                ]
            );
            // echo "<pre>";
            $json =  (string) $response->getBody();
            $array = json_decode($json, true);
            // print_r($array['temps']);
            // echo "<br>";
            // echo $array['system_info']['id'];
            // echo "<br>";
            // echo $response->getStatusCode();
            // echo "</pre>";
            $_SESSION['data'] = $array['data'];
            

            $this->load->view('dashboard_view',$_SESSION);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            $this->load->view('dashboard_view',$_SESSION);
        }
                 
    }
    public function temerature_chart(){
        //-----retrieve temp data and humidity--------------
        $client = new \GuzzleHttp\Client([
            //Base URI is used with relative requests
            'base_uri' => 'http://example.com/iot/public/api/v1/'
        ]);
        //define what the client will be doing
        try {
            $response = $client->request(
                'POST',
                'retrieve_temp',
                [
                    'json'=> [
                        'token'=> $_SESSION["token"]
                    ]
                ]
            );
            // echo "<pre>";
            $json =  (string) $response->getBody();
            $array = json_decode($json, true);
            // print_r($array['temps']);
            // echo "<br>";
            // echo $array['system_info']['id'];
            // echo "<br>";
            // echo $response->getStatusCode();
            // echo "</pre>";
            $_SESSION['temps'] = $array['temps'];
            

            $this->load->view('chart_temp_view',$_SESSION);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            $this->load->view('chart_temp_view',$_SESSION);
        }
    }
    public function temerature_table(){
        //-----retrieve temp data and humidity--------------
        $client = new \GuzzleHttp\Client([
            //Base URI is used with relative requests
            'base_uri' => 'http://example.com/iot/public/api/v1/'
        ]);
        //define what the client will be doing
        try {
            $response = $client->request(
                'POST',
                'retrieve_temp',
                [
                    'json'=> [
                        'token'=> $_SESSION["token"]
                    ]
                ]
            );
            // echo "<pre>";
            $json =  (string) $response->getBody();
            $array = json_decode($json, true);
            // print_r($array['temps']);
            // echo "<br>";
            // echo $array['system_info']['id'];
            // echo "<br>";
            // echo $response->getStatusCode();
            // echo "</pre>";
            $_SESSION['temps'] = $array['temps'];
            

            $this->load->view('table_temp',$_SESSION);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            $this->load->view('table_temp',$_SESSION);
        }
    }
    public function humidity_chart(){
        //-----retrieve temp data and humidity--------------
        $client = new \GuzzleHttp\Client([
            //Base URI is used with relative requests
            'base_uri' => 'http://example.com/iot/public/api/v1/'
        ]);
        //define what the client will be doing
        try {
            
            //---------humidity--------------
            $response = $client->request(
                'POST',
                'retrieve_humidity',
                [
                    'json'=> [
                        'token'=> $_SESSION["token"]
                    ]
                ]
            );
            // echo "<pre>";
            $json =  (string) $response->getBody();
            $array = json_decode($json, true);
            // print_r($array['temps']);
            // echo "<br>";
            // echo $array['system_info']['id'];
            // echo "<br>";
            // echo $response->getStatusCode();
            // echo "</pre>";
            $_SESSION['humidity'] = $array['humidity'];

            $this->load->view('chart_hum_view',$_SESSION);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            $this->load->view('chart_hum_view',$_SESSION);
        }
    }
    public function humidity_table(){
        //-----retrieve temp data and humidity--------------
        $client = new \GuzzleHttp\Client([
            //Base URI is used with relative requests
            'base_uri' => 'http://example.com/iot/public/api/v1/'
        ]);
        //define what the client will be doing
        try {
            //---------humidity--------------
            $response = $client->request(
                'POST',
                'retrieve_humidity',
                [
                    'json'=> [
                        'token'=> $_SESSION["token"]
                    ]
                ]
            );
            // echo "<pre>";
            $json =  (string) $response->getBody();
            $array = json_decode($json, true);
            // print_r($array['temps']);
            // echo "<br>";
            // echo $array['system_info']['id'];
            // echo "<br>";
            // echo $response->getStatusCode();
            // echo "</pre>";
            $_SESSION['humidity'] = $array['humidity'];

            $this->load->view('table_hum',$_SESSION);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
            $this->load->view('table_hum',$_SESSION);
        }
    }
    public function logout(){
        session_destroy();
        $msg['success_logout']="You logged out successfully";
        $this->load->view('login_view',$msg);
    }
}