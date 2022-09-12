<?php
namespace Modules\Election\Controllers;

use App\Controllers\BaseController;
use Modules\Election\Models as Models;
use App\Models as AppModels;

class Positions extends BaseController
{
    public function __construct() {
        $this->electionModel = new Models\ElectionModel();
        $this->positionModel = new Models\PositionModel();
        $this->electoralPositionModel = new Models\ElectoralPositionModel();
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

        $data['elections'] = $this->electionModel->where(['status' => 'Application', 'type' => '1'])->findAll();
        if(empty($data['elections'])) {
            $this->session->setFlashdata('activeElec', 'No elections for parties, please add first');
            return redirect()->to(base_url('admin/election'));
        }
        $data['positions'] = $this->electoralPositionModel->viewPosName();
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'positions';
        $data['title'] = 'Positions';
        return view('Modules\Elections\Views\positions\index3', $data);
    }

    public function edit($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('25', 'POS', $this->session->get('role'));
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
        $data['election'] = $this->electionModel->where(['id' => $id])->first();
        $data['electoralPosition'] = $this->electoralPositionModel->findAll();
        // echo '<pre>';
        // print_r($data['electoralPosition']);
        // die();
        $data['positions'] = $this->positionModel->where(['election_id' => $id])->findAll();
        if($this->request->getMethod() == 'post') {
            if($this->validate('positions2')) {
                // echo '<pre>';
                // print_r($_POST);
                // die();
                $this->electoralPositionModel->deleteAll($id);
                foreach($_POST['position_id'] as $positions) {
                    $value = [
                        'election_id' => $_POST['election_id'],
                        'elec_position_id' => $positions
                    ];
                    $this->positionModel->save($value);
                }
                $activityLog['user'] = $this->session->get('user_id');
                $activityLog['description'] = 'Edited positions for election '.$data['election']['title'];
                $this->activityLogModel->save($activityLog);
                $this->session->setFlashData('successMsg', 'Edit position successful');
                return redirect()->to(base_url('admin/positions'));
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'positions';
        $data['title'] = 'Positions';
        return view('Modules\Elections\Views\positions\formelectoral', $data);
    }
}