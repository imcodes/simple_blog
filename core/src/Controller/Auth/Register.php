<?php
namespace Controller\Auth;
use Model\User;

class Register{
    function validate($data):Array{
        $output['status'] = true;
        $errors = [];

        //Check required fields
        if(empty($data['fname']) || 
            empty($data['lname']) ||
            empty($data['email']) ||
            empty($data['username']) ||
            empty($data['password'])
            ){
                $output =[
                    'status'=> false,
                    'msg'=> ['required'=> 'Please fill all required fileds']
                ];
                return $output;
            }


        $User = new User();
        //Check if the username exists
        if($User->exists('username',$data['username'])){
            $output =['status' => false];
            $errors['username'] ='Username already taken';
        }
        //Check if the email exists
        if($User->exists('email',$data['email'])){
            $output =[ 'status'=> false];
            $errors['email'] = 'Email already taken';
        }

        //If the the confirm password matched with the password
        if($data['password'] != $data['c-password']){
            $output =['status'=> false];
            $errors['password'] = 'Password Mismatch';
        }

        if(!$output['status']){
            $output['msg'] = $errors;
            return $output;
        }

        $output['data'] = array_map(fn($d) => strip_tags(html_entity_decode($d)) ,$data);
        return $output;
        
    }

    function register(Array $request){
        if(count($request) ==0){
            return false;
        }

        $data = $this->validate($request);
        if(!$data['status']){ //return the data with error messages
            return $data;
        }

        $user = new User();
        $data = $data['data'];
            $Data = [
                'username'=> $data['username'],
                'password'=> password_hash($data['password'],PASSWORD_BCRYPT),
                'email'=> $data['email'],
                'first_name'=> $data['fname'],
                'middle_name'=> $data['mname'],
                'last_name'=> $data['lname'],
            ];
            $user_data = $user->create($Data);
            if(!$user){
                log_error($user->db->errorInfo());
                return ['status' => false];
            }

            return ['status' => true, 'data' => ['user_info'=>$user_data]];
           

    }
}