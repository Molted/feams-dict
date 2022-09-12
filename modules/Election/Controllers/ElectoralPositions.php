<?php
namespace Modules\Election\Controllers;

use App\Controllers\BaseController;
use Modules\Election\Models as Models;
use App\Models as AppModels;

class ElectoralPositions extends BaseController
{
    public function __construct() {
        $this->electionModel = new Models\ElectionModel();
        $this->electoralPositionModel = new Models\ElectoralPositionModel();
        $this->candidateModel = new Models\CandidateModel();
        $this->activityLogModel = new AppModels\ActivityLogModel();
    }
    
    public function index() { 
        // checking roles and permissions
        $data['perm_id'] = check_role('23', 'POS', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        $data['elec_positions'] = $this->electoralPositionModel->findAll();

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'elec_positions';
        $data['title'] = 'Electoral Positions';
        return view('Modules\Election\Views\electoralPositions\index', $data);
    }

    public function add() {
        // checking roles and permissions
        $data['perm_id'] = check_role('24', 'POS', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        $data['edit'] = false;
        if($this->request->getMethod() == 'post') {
            if($this->validate('electoral_position')){
                // echo '<pre>';
                // print_r($_POST);
                // die();
                if($this->electoralPositionModel->save($_POST)) {
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Added an electoral position';
                    $this->activityLogModel->save($activityLog);
                    $this->session->setFlashdata('successMsg', 'Successfully added an electoral position');
                    return redirect()->to(base_url('admin/electoral-positions'));
                } else {
                    $this->session->setFlashdata('failMsg', 'Failed to add an electoral position');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'elec_positions';
        $data['title'] = 'Electoral Position';
        return view('Modules\Election\Views\electoralPositions\form', $data);
    }

    public function edit($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('24', 'POS', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }
        $data['id'] = $id;
        $data['value'] = $this->electoralPositionModel->find($id);
        $data['edit'] = true;
        if(empty($data['value'])){
            $this->session->setFlashdata('sweetalertfail', true);
            return redirect()->to(base_url());
        }
        if($this->request->getMethod() == 'post') {
            if($this->validate('electoral_position')){
                $_POST['id'] = $data['value']['id'];
                // echo '<pre>';
                // print_r($_POST);
                // die();
                if($this->electoralPositionModel->save($_POST)) {
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Edited an electoral position';
                    $this->activityLogModel->save($activityLog);
                    $this->session->setFlashdata('successMsg', 'Successfully edited an electoral position');
                    return redirect()->to(base_url('admin/electoral-positions'));
                } else {
                    $this->session->setFlashdata('failMsg', 'Failed to add an electoral position');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'elec_positions';
        $data['title'] = 'Electoral Position';
        return view('Modules\Elections\Views\electoralPositions\form', $data);
    }
    
    public function delete($id) {
        echo "<pre>";
        die(print_r($id));
        if($this->candidateModel->where('position_id', $id)->countAllResults(false) == 0 || $this->electoralPositionModel->where('id', $id)->countAllResults(false) == 0){
            if($this->electoralPositionModel->delete($id)) {
                $activityLog['user'] = $this->session->get('user_id');
                $activityLog['description'] = 'Deleted an electoral position';
                $this->activityLogModel->save($activityLog);
                $this->session->setFlashData('successMsg', 'Successfully deleted electoral position');
            } else {
                $this->session->setFlashData('failMsg', 'Something went wrong!');
            }
        } else {
            $this->session->setFlashData('failMsg', 'Cannot delete - position is still in use!');
        }
        
        return redirect()->to(base_url('admin/electoral-positions'));
    }
}