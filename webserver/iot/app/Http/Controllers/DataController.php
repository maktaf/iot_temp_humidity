<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Validator;
use App\Data;
use Mail;
use App\System;
class DataController extends Controller
{
    //---------------new-data-------------------------------
        // sample:
        // {
        //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
        //      "type": "temp",
        //      "data": 23
        // }
    public function new_data(Request $request){
        $validator = Validator::make($request->all(),[
            'token' => 'required',
            'type' => 'required',
            'data' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
        }
        $username = $this->encrypt_decrypt('decrypt',$request->token);
        $type = $request->type;
        $system = System::where('username',$username)->first();
        $id = $system->id;
        $temp_min  = $system->temp_min;
        $temp_max  = $system->temp_max;
        $humidity_min = $system->humidity_min;
        error_log($humidity_min);
        $humidity_max = $system->humidity_max;
        error_log($humidity_max );        
        $email = $system->email;

        $data = new Data;
        $data->systems_id = $id;
        $data->data = $request->data;
        $data->type = $request->type;
     
        if ($data->save()) {    
            if($type == "temp"){//-----check-min-max-temp-------------------
                if($request->data < $temp_min || $temp_max < $request->data){
                    //email the System admin
                    
                    $data = 'ERROR: Temerature out of range!';
                    $email = Mail::send('emails.mail', ['data' => $data], function($message) use($email){
                    $message->to($email)->subject('WARNING!');
                                        });
                }
            }
            if($type == "humidity"){//-----check-min-max-humidty-------------------
                if($request->data < $humidity_min || $humidity_max < $request->data){
                    //email the System admin
                    
                    $data = 'ERROR: Humidity out of range!';
                    $email = Mail::send('emails.mail', ['data' => $data], function($message) use($email){
                    $message->to($email)->subject('WARNING!');
                                        });
                }
            }
            return response()->json(['success'=>'true','message'=>'adding data was successful.'],200);
        }
        else{
            $response = ['success' => 'false',
                        'message' => 'adding data was unsuccessfull.Please try again.'];
            return response()->json($response, 500);
        }
        // error_log((string)$datas);
    }
    //---------------retrieve-temp---------------------------
    public function retrieve_temp(Request $request){
        // sample:
        // {
        //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
        // }
    $validator = Validator::make($request->all(),[
        'token' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
    }
    $username = $this->encrypt_decrypt('decrypt',$request->token);
    $system = System::where('username',$username)->first();
    $id = $system->id;
    $datas = Data::where('systems_id',$id)->where('type','temp')->get();
    // error_log((string)$datas);
   
    return response()->json(['success'=>'true','temps'=>$datas],200);
    }
    //---------------retrieve-humidity-----------------------
    public function retrieve_humidity(Request $request){
        // sample:
        // {
        //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
        // }
    $validator = Validator::make($request->all(),[
        'token' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
    }
    $username = $this->encrypt_decrypt('decrypt',$request->token);
    $system = System::where('username',$username)->first();
    $id = $system->id;
    $datas = Data::where('systems_id',$id)->where('type','humidity')->get();
    // error_log((string)$datas);
    
    return response()->json(['success'=>'true','humidity'=>$datas],200);
    }
    //---------------retrieve-both humidity and temp-----------------------
    public function retrieve_data(Request $request){
        // sample:
        // {
        //     "token": "ekJaU2JCYzJGK3V5cUwvSjEvTTNMUT09",
        // }
    $validator = Validator::make($request->all(),[
        'token' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json(['success'=> "false" ,'messages'=>$validator->errors() ],400);   
    }
    $username = $this->encrypt_decrypt('decrypt',$request->token);
    $system = System::where('username',$username)->first();
    $id = $system->id;
    $datas = Data::where('systems_id',$id)->get();
    // error_log((string)$datas);
    
    return response()->json(['success'=>'true','data'=>$datas],200);
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
}
