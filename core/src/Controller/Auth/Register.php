<?php
namespace Controller\Auth;
use Model\User;

class Register{
    function validate($data):Array{
        $output['status'] = true;

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
            $output =[
                'status' => false,
                'msg'=> ['Username' =>'Username already taken']
            ];
        }
        //Check if the email exists
        if($User->exists('email',$data['email'])){
            $output =[
                'status'=> false,
                'msg' => ['email'=> 'Email already taken']
            ];
        }

        //If the the confirm password matched with the password
        if($data['password'] != $data['c-password']){
            $output =[
                'status'=> false,
                'msg'=> ['password'=> 'Password Mismatch']
            ];
        }

        if(!$output['status']){
            return $output;
        }

        $output['data'] = $data;
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
                'password'=> $data['password'],
                'email'=> $data['email'],
                'first_name'=> $data['fname'],
                'middle_name'=> $data['mname'],
                'last_name'=> $data['lname'],
            ];
            $user->create($Data);
            if(!$user){
                log_error($user->db->errorInfo());
                return false;
            }

            return true;
           

    }
}