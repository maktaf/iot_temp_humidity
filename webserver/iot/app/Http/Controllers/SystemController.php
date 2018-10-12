<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Validator;
use App\System;
use App\Service;

class SystemController extends Controller
{
    //----------------------------sign-up----------------------------
    public function signup(Request $request){
        
            $validator = Validator::make($request->all(),[
            'username' => 'required|unique:systems',
            'password' => 'required',
            'email'     => 'required|email',
            'name'     => 'nullable|max:30'
            ]);
            if ($validator->fails()) {
                return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
            }
            $system = new System;
            $system->username = $request->username;
            $system->password = $this->encrypt_decrypt('encrypt',$request->password);
            $system->email = $request->email;
            $system->name = $request->name;
         
            $encrypted_str = $this->encrypt_decrypt('encrypt', $request->input('username'));
            if ($system->save()) {    
                return response()->json(['success'=>'true','message'=>'Signup successful','token' => $encrypted_str],200);
            }
            else{
                $response = ['success' => 'false',
                            'message' => 'Signup unsuccessfull.Please try again'];
                return response()->json($response, 500);
            }
        }
    //---------------------sign-in-----------------------------------
    public function signin(Request $request){
        
             $validator = Validator::make($request->all(),[
             'username' => 'required',
             'password' => 'required',
             ]);
             if ($validator->fails()) {
                 return response()->json(['success'=>'false','messages'=>$validator->errors()],400);   
             }
 
            $system = System::where('username',$request->username)->first();            
            if ($system == null || ($this->encrypt_decrypt('decrypt',$system->password) != $request->input('password'))) {
                return response()->json(['success' => 'false',
                'message' => 'The username or password is incorrect','messages'=>$validator->errors()], 400);
            }
            $encrypted_str = $this->encrypt_decrypt('encrypt',$request->input('username'));   
            // error_log( $encrypted_str);
            return response()->json(['success'=>'true','message'=>'Login successful','token' => $encrypted_str, "system_info"=> $system],200);
        }
    //-------------------------------encrypt--------------------------
         /**
     * simple method to encrypt or decrypt a plain text string
     * initialization vector(IV) has to be the same when encrypting and decrypting
     * 
     * @param string $action: can be 'encrypt' or 'decrypt'
     * @param string $string: string to encrypt or decrypt
     *
     * @return string
     */
    function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = '0123456789abcdef';
        $secret_iv ='fedcba9876543210';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
    // example:
    // $encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
    // echo "Encrypted Text = " .$encrypted_txt. "\n";
    // $decrypted_txt = encrypt_decrypt('decrypt', $encrypted_txt);
    // echo "Decrypted Text =" .$decrypted_txt. "\n";
    // -------------------------set_min_temp------------------------
    public function set_min_temp(Request $request){
            // sample:
            // {
            //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
            //     "temp_min":"10"
            // }
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'temp_min' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
        }
        $username = $this->encrypt_decrypt('decrypt',$request->token);
        $system = System::where('username',$username)->first();

        $system->temp_min = $request->temp_min;
        if ($system->save()) {    
            return response()->json(['success'=>'true','message'=>'temp_min updated'],200);
        }
        else{
            $response = ['success' => 'false',
                         'message' => 'Updating temp_min was unsuccessfull.Please try again'];
            return response()->json($response, 500);
        }
        
    }
    //---------------------------set_max_temp-----------------------
    public function set_max_temp(Request $request){
        // sample input:
        // {
        //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
        //     "temp_max":"100"
        // }
    $validator = Validator::make($request->all(),[
        'token' => 'required',
        'temp_max' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
    }
    $username = $this->encrypt_decrypt('decrypt',$request->token);
    $system = System::where('username',$username)->first();

    $system->temp_max = $request->temp_max;
    if ($system->save()) {    
        return response()->json(['success'=>'true','message'=>'temp_max updated'],200);
    }
    else{
        $response = ['success' => 'false',
                     'message' => 'Updating temp_max was unsuccessfull.Please try again'];
        return response()->json($response, 500);
    }   
}
    //---------------------------set_min_humidity-------------------
    public function set_min_humidity(Request $request){
        // sample input:
        // {
        //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
        //     "humidity_min":"100"
        // }
    $validator = Validator::make($request->all(),[
        'token' => 'required',
        'humidity_min' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
    }
    $username = $this->encrypt_decrypt('decrypt',$request->token);
    $system = System::where('username',$username)->first();

    $system->humidity_min = $request->humidity_min;
    if ($system->save()) {    
        return response()->json(['success'=>'true','message'=>'humidity_min updated'],200);
    }
    else{
        $response = ['success' => 'false',
                     'message' => 'Updating humidity_min was unsuccessfull.Please try again'];
        return response()->json($response, 500);
    }   
}
    //---------------------------set_max_humidity-------------------
    public function set_max_humidity(Request $request){
        // sample input:
        // {
        //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
        //     "humidity_max":"100"
        // }
    $validator = Validator::make($request->all(),[
        'token' => 'required',
        'humidity_max' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
    }
    $username = $this->encrypt_decrypt('decrypt',$request->token);
    $system = System::where('username',$username)->first();

    $system->humidity_max = $request->humidity_max;
    if ($system->save()) {    
        return response()->json(['success'=>'true','message'=>'humidity_max updated'],200);
    }
    else{
        $response = ['success' => 'false',
                     'message' => 'Updating humidity_max was unsuccessfull.Please try again'];
        return response()->json($response, 500);
    }   
    }
    //---------------------------edit_system_info-------------------
    // sample input:
        // {
        //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
            // 'name' : 'Fateme Rahimi',
            // 'email' : 'maaktaf@gmail.com',
            // 'min_temp' : '0',
            // 'max_temp' : '100',
            // 'min_humidity' : '12',
            // 'max_humidity' : '87'

        // }
    public function edit_system_information(Request $request){
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'name' => 'nullable',
            'email' => 'required|email',
            'min_temp' => 'required',
            'max_temp' => 'required',
            'min_humidity' => 'required',
            'max_humidity' => 'required',  
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
        }
        $username = $this->encrypt_decrypt('decrypt',$request->token);
        $system = System::where('username',$username)->first();
    
        $system->name = $request->name;
        $system->email = $request->email;
        $system->temp_min  = $request->min_temp;
        $system->temp_max = $request->max_temp;
        $system->humidity_min = $request->min_humidity;
        $system->humidity_max = $request->max_humidity;

        if ($system->save()) {    
            return response()->json(['success'=>'true','message'=>'system info updated'],200);
        }
        else{
            $response = ['success' => 'false',
                         'message' => 'Updating system information was unsuccessfull.Please try again'];
            return response()->json($response, 500);
        }   
    }
}