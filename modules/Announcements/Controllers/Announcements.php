<?php
namespace Modules\Announcements\Controllers;

use App\Controllers\BaseController;
use Modules\Announcements\Models as Models;
use App\Models as UserModels;

class Announcements extends BaseController
{
    public function __construct() {
        $this->announceModel = new Models\AnnouncementModel();
        $this->userModel = new UserModels\UserModel();
        $this->activityLogModel = new UserModels\ActivityLogModel();
        $this->mpdf = new \Mpdf\Mpdf();
    }

    public function index() {
        // checking roles and permissions
        $data['perm_id'] = check_role('11', 'ANN', $this->session->get('role'));
        // if(!$data['perm_id']['perm_access']) {
        //     $this->session->setFlashdata('sweetalertfail', true);
        //     return redirect()->to(base_url());
        // }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        $data['announcements'] = $this->announceModel->viewUploader();
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'announcements';
        $data['title'] = 'Announcements';
        
        $adminAccess = false;
        foreach($data['perm_id']['perm_id'] as $perms) {
            if($perms == '11') {
                $adminAccess = true;
            }
        }
        if($adminAccess) {
            return view('Modules\Announcements\Views\index', $data);
        } else {
            // return view('Modules\Announcements\Views\member', $data);
            return redirect()->to(base_url('announcements'));
        }
    }

    public function forMembers() {
        if($this->session->get('isLoggedIn')) {
            // checking roles and permissions
            $data['perm_id'] = check_role('', '', $this->session->get('role'));
            // if(!$data['perm_id']['perm_access']) {
            //     $this->session->setFlashdata('sweetalertfail', true);
            //     return redirect()->to(base_url());
            // }
            $data['rolePermission'] = $data['perm_id']['rolePermission'];
            $data['perms'] = array();
            foreach($data['rolePermission'] as $rolePerms) {
                array_push($data['perms'], $rolePerms['perm_mod']);
            }
        }

        $data['announcements'] = $this->announceModel->viewUploader();

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'announcements';
        $data['title'] = 'Latest Announcement';
        if($this->session->get('isLoggedIn')) {
            return view('Modules\Announcements\Views\member', $data);
        } else {
            return view('Modules\Announcements\Views\noLoggedList', $data);
        }
    }

    public function add() {
        // checking roles and permissions
        $data['perm_id'] = check_role('12', 'ANN', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        helper('text');
        $data['edit'] = false;
        if($this->request->getMethod() == 'post') {
            // echo "<pre>";
            // die(print_r($_POST));

            if($_POST['description'] == "<p><br></p>"){
                $_POST['description'] = "";
            }
            if($this->validate('announcements')){
                $file = $this->request->getFile('image');
                $ann = $_POST;
                
                if(is_uploaded_file($file)){
                    $ann['image'] = $file->getRandomName();
                }
                else{
                    $ann['image'] = '';
                }
                
                $ann['link'] = random_string('alnum', 5);
                $ann['uploader'] = $this->session->get('user_id');
                if($this->announceModel->insert($ann)) {
                    if(!empty($ann['image'])){
                        $file->move('public/uploads/announcements', $ann['image']);
                    }                    
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Added a new Announcement';
                    $this->activityLogModel->save($activityLog);
                    if(is_uploaded_file($file)){
                        if ($file->hasMoved()) {                            
                            $this->sendMail($ann);
                        }
                        else {
                            $this->session->setFlashData('failMsg', 'There is an error on adding announcement. Please try again.');
                        }
                    } else {
                        // Dito mapupunta kapag walang photo attachment
                        $this->sendMail($ann);
                    }
                    return redirect()->to(base_url('admin/announcements'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on adding announcement. Please try again.');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'announcements';
        $data['title'] = 'Announcements';
        return view('Modules\Announcements\Views\form', $data);
    }

    public function edit($link) {
        // checking roles and permissions
        $data['perm_id'] = check_role('13', 'ANN', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }


        helper('text');
        $data['edit'] = true;
        $data['link'] = $link;
        $data['value'] = $this->announceModel->where('link', $link)->first();
        $data['id'] = $data['value']['id'];
        if($this->request->getMethod() == 'post') {
            if($this->validate('announcements')){
                $file = $this->request->getFile('image');
                $ann = $_POST;

               
                if(!empty($_FILES['image']['name'])){
                    $ann['image'] = $file->getRandomName();
                }
                else{
                    $ann['image'] = '';
                }
                
                $ann['link'] = random_string('alnum', 5);
                $ann['uploader'] = $this->session->get('user_id');
                if($this->announceModel->update($data['id'], $ann)) {
                    if(!empty($_FILES['image']['name'])){
                        $file->move('public/uploads/announcements', $ann['image']);
                        if ($file->hasMoved()) {
                            $activityLog['user'] = $this->session->get('user_id');
                            $activityLog['description'] = 'Edited an announcement';
                            $this->activityLogModel->save($activityLog);
                            $this->session->setFlashData('successMsg', 'Editing announcement successful.');
                        }
                        else {
                            $this->session->setFlashData('failMsg', 'There is an error on editing announcement. Please try again.');
                        }
                    }
                    else{
                        $activityLog['user'] = $this->session->get('user_id');
                        $activityLog['description'] = 'Edited an announcement';
                        $this->activityLogModel->save($activityLog);
                        $this->session->setFlashData('successMsg', 'Editing annoucement successful.');
                    }
                    
                    return redirect()->to(base_url('admin/announcements'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on editing announcement. Please try again.');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'announcements';
        $data['title'] = 'Announcements';
        return view('Modules\Announcements\Views\form', $data);
    }

    public function delete($link) {
        // checking roles and permissions
        $data['perm_id'] = check_role('13', 'ANN', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        if($this->announceModel->where('link', $link)->delete()) {
            $activityLog['user'] = $this->session->get('user_id');
            $activityLog['description'] = 'Deleted an announcement';
            $this->activityLogModel->save($activityLog);
          $this->session->setFlashData('successMsg', 'Successfully deleted announcement');
        } else {
          $this->session->setFlashData('errorMsg', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/announcements'));
    }

    public function info($link) {

        $data['announce'] = $this->announceModel->where('link', $link)->first();
        if(empty($data['announce'])) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['announces'] = $this->announceModel->orderBy('created_at', 'DESC')->findAll();
        $data['active'] = 'announcements';
        $data['title'] = $data['announce']['title'];

        if($this->session->get('isLoggedIn')) {
            // checking roles and permissions
            $data['perm_id'] = check_role('', '', $this->session->get('role'));
            $data['rolePermission'] = $data['perm_id']['rolePermission'];
            $data['perms'] = array();
            foreach($data['rolePermission'] as $rolePerms) {
                array_push($data['perms'], $rolePerms['perm_mod']);
            }
            
            $data['user_details'] = user_details($this->session->get('user_id'));
            return view('Modules\Announcements\Views\info', $data);
        } else {
            return view('Modules\Announcements\Views\noLoggedInfo', $data);
        }
    }

    private function sendMail($data) {
        $mails = $this->userModel
                ->where('id !=', $this->session->get('user_id'))
                ->where('status =', 1 )
                ->findColumn('email');
        // echo "<pre>";
        // die(print_r($mails));

        foreach($mails as $mail) {
            $this->email->clear();
            $this->email->setFrom('feamsystem@gmail.com', 'Faculty and Employees Association');
            $this->email->setTo($mails);
            $this->email->setSubject($_POST['title']);
            $content = view('Modules\Announcements\Views\email', $_POST);
            $this->email->setMessage($content);
            $filename = 'public/uploads/announcements/'. $data['image']; //you can use the App patch 
            $this->email->attach($filename);
            if($this->email->send()) {
                $this->session->setFlashData('successMsg', 'Successfully emailed members and added announcement');
                return redirect()->to(base_url('admin/announcements'));
            }
            else {
                $data = $this->email->printDebugger(['headers']);
                print_r($data);
                die();
            }
        }
    }

    public function generatePDF() {
        // checking roles and permissions
        $data['perm_id'] = check_role('37', 'REPO', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }

        $data['announcements'] = $this->announceModel->findAll();
        $html = view('Modules\Announcements\Views\pdf', $data);
        $this->mpdf->SetFooter('Monthly Announcement Reports');
        $this->mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $this->mpdf->Output('Monthly Announcement Reports.pdf','I');
    }
}