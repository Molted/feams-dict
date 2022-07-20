<?php namespace App\Controllers;

use DateTime;
use DateInterval;
use App\Models as Models;
use Modules\NewsEvents\Models as NewsModels;

class Login extends BaseController {
    public function __construct() {
        $this->userModel = new Models\UserModel();
        $this->loginModel = new Models\LoginModel();
        $this->newsModel = new NewsModels\NewsModel();
        $this->resetPasswordModel = new Models\ResetPasswordModel();
    }

    public function index() {
        // $this->session->remove(['failMsg', 'successMsg']);
        if($this->request->getMethod() === 'post') {
            helper(['form']);
            //set rules validation form
            $rules = [
                'username'      => 'required|min_length[3]|max_length[50]',
                'password'      => 'required|min_length[3]|max_length[200]|validateUser[username,password]',
            ];

            if(!$this->validate($rules)) {
                $this->session->setFlashData('failMsg', 'Incorrect username or password');
                return redirect()->back()->withInput(); 
            } else {
                $user = $this->userModel->where('username', $this->request->getVar('username'))
                    ->first();
                if($user['status'] == '0') {
                    $data = [
                        'user_id' => $user['id'],
                        "role" => $user['role'],
                        "notPaid" => true,
                    ];
                    $this->session->setFlashData($data);
                    return redirect()->back()->withInput(); 
                }
                if($user['status'] == '2') {
                    $this->session->setFlashData('failMsg', 'Account deactivated, please contact admin');
                    return redirect()->back()->withInput(); 
                }
                if($user['status'] == '3') {
                    $this->session->setFlashData('successMsg', 'Currently paid, wait for the admin approval to be sent in your email');
                    return redirect()->back()->withInput(); 
                }
                if($user['status'] == '4') {
                    $this->session->setFlashData('failMsg', 'Email not verified, please verify it first before logging back in');
                    return redirect()->back()->withInput(); 
                }
                $this->setUserSession($user);
                $data['firstNews'] = $this->newsModel->orderBy('created_at', 'DESC')->first();
                // echo "<pre>";
                // die(print_r($data));
                if($user['role'] == '1'){
                    if(!empty($data['firstNews'])){
                        $this->session->setFlashData('Featured', $data['firstNews']['image']);
                        $this->session->setFlashData('Content', 
                            $data['firstNews']['title'] .'<br><br>'.
                            $data['firstNews']['content'].'<br><a href="'.
                            base_url().'">See more...</a>'
                        );
                    }
                    
                    $this->session->setFlashData('NoNews', 'No Latest News!');
                    return redirect()->withInput()->to(base_url('admin/dashboard'));
                } else {
                    if(!empty($data['firstNews'])){
                        $this->session->setFlashData('Featured', $data['firstNews']['image']);
                        $this->session->setFlashData('Content', 
                            $data['firstNews']['title'] .'<br><br>'.
                            $data['firstNews']['content'].'<br><a href="'.
                            base_url().'">See more...</a>'
                        );
                    }
                    $this->session->setFlashData('NoNews', 'No Latest News!');
                    return redirect()->withInput()->to(base_url('user/'.$user['username']));
                }
            }
        }
        return view('login');
    }

    private function setUserSession($user) {
        $this->session->stop();
        $data = [
            'user_id' => $user['id'],
            'isLoggedIn' => true,
            "role" => $user['role'],
        ];

        $this->session->set($data);
        $this->addLoginRecord($user);
        return true;
    }

    // Function that add login details to the database
    // parameters: whole row of the user data
    private function addLoginRecord($user) {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s', time());
        $loginDetails = [
            'user_id' => $user['id'],
            'role_id' => $user['role'],
            'login_date' => $date,
            'created_at' => $date,
        ];

        if ($this->loginModel->save($loginDetails)) {
            return true;
        } else {
            die('there\'s an error');
        }
    }
    
    public function activate($code) {
        $user = $this->userModel->where('email_code', $code)->first();
        $this->session->remove(['failMsg', 'successMsg']);
        if(empty($user)) {
            $this->session->set('failMsg', 'Code error, please try again.');
            // $this->session->setFlashdata('failMsg', 'Code error, please try again.');
            return redirect()->to(base_url());
        }
        
        $data = [
            'id' => $user['id'],
            'email_code' => null,
            'status' => 'i',
        ];
        if($this->userModel->save($data)) {
            $this->session->set('successMsg', 'Account successfully activated');
            // $this->session->setFlashdata('successMsg', 'Account successfully activated');
            return redirect()->to(base_url());
        } else {
            $this->session->setFlashdata('failMsg', 'Account not activated, please try again');
            return redirect()->to(base_url());
        }
    }

    public function forgot_password(){
        if($this->request->getMethod() === 'post') {
            $email = $this->request->getVar('email');
            $user = $this->userModel->where('email', $email)->first();
            if(empty($user)) {
                $this->session->setFlashdata('failMsg', 'Email do not exists!');
                return redirect()->back()->withInput(); 
            }
            $token = md5( microtime() );
            $expiration_date = new DateTime("NOW");
            $expiration_date->add(new DateInterval('PT30M'));
            $this->resetPasswordModel->insert([
                'id' => $token,
                'email' => $email,
                'expiration_date' => $expiration_date->format("Y-m-d H:i:s")
            ]);
            $userData = [
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'], 
                'email' => $user['email'],
                'token' =>  $token,
            ];
            $this->email->setTo($email);
            $this->email->setFrom('feamsystem@gmail.com', 'Faculty and Employees Association');
            $this->email->setSubject('Reset Password');
            $message = view('resetEmail', $userData);
            $this->email->setMessage($message);
            if ($this->email->send()) {
                $this->session->setFlashdata('successMsg', 'Email sent! Please check your email.');
                return redirect()->back(); 
            }
            else {
                $this->session->setFlashdata('failMsg', 'Email not sent.');
                return redirect()->back(); 
            }

        }
        return view('forgotPassword');
    }

    public function reset_password($token){
        $resetData = $this->resetPasswordModel->find($token);
        $regex = "/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,30}$/";

        if($this->request->getMethod() == "post"){
            if($this->request->getVar('password') != $this->request->getVar('confirm_password')){
                $this->session->setFlashdata('failMsg', 'Passwords Do Not Match');
                return redirect()->back(); 
            }
            if(!preg_match($regex, $this->request->getVar('password'))){
                $this->session->setFlashdata('failMsg', ' 8-30 characters, One Uppercase, One Number, Special Characters (!@#$%^&*-)');
                return redirect()->back(); 
            }
            if($this->userModel->updatePasswordEmail($resetData['email'], $this->request->getVar('password'))){
                $this->session->setFlashdata('successMsg', 'Password reset successful. Login to continue.');
                return redirect()->to(base_url('login'));
            }
        }
        if(empty($resetData)){
            $this->session->setFlashdata('failMsg', 'Data not found.');
            return redirect()->to(base_url('login')); 
        }
        if(date('Y-m-d H:i:s') > $resetData['expiration_date']){
            $this->session->setFlashdata('failMsg', 'Link Expired.');
            return redirect()->to(base_url('login')); 
        }
        return view('resetPassword', [ 'token' => $token ]);
    }
}