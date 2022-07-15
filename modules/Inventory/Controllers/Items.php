<?php
namespace Modules\Inventory\Controllers;

use App\Controllers\BaseController;
use Modules\Inventory\Models as ItemModels;
use Modules\ItemCategory\Models as CategoryModels;
use App\Models as AppModels;

class Items extends BaseController
{
    public function __construct() {
        $this->itemModel = new ItemModels\ItemModel();
        $this->categoryModel = new CategoryModels\CategoryModel();
        $this->activityLogModel = new AppModels\ActivityLogModel();
        helper('text');
    }

    public function index() {
        $data['perm_id'] = check_role('45', 'INV', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['items'] = $this->itemModel->findAll();
        $data['combineTables'] = $this->itemModel->viewItems();
        // echo "<pre>";
        // print_r($data['combineTables']);
        // die();
        $data['title'] = 'Items';
        $data['active'] = 'items';
        return view('Modules\Inventory\Views\Items\index', $data); 
    }

    public function add() {
        $data['perm_id'] = check_role('45', 'INV', $this->session->get('role'));
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
        $data['categories'] = $this->categoryModel->findAll();
        // echo "<pre>";
        // print_r($data['categories']);
        // die();
        if($this->request->getMethod() == 'post') {
            if($this->validate('inventory')){
                if($this->itemModel->insert($_POST)) {
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Added a new Item';
                    $this->activityLogModel->save($activityLog);
                    $this->session->setFlashData('successMsg', 'Adding item successful');
                    return redirect()->to(base_url('admin/inventory'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on adding category. Please try again.');
                    return redirect()->back()->withInput();
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }
        
        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'items';
        $data['title'] = 'Items';
        return view('Modules\Inventory\Views\Items\form', $data);
    }

    public function edit($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('45', 'INV', $this->session->get('role'));
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
        $data['categories'] = $this->categoryModel->findAll();
        $data['value'] = $this->itemModel->where('id', $id)->first();
        $data['id'] = $data['value']['id'];
        // echo "<pre>";
        // print_r($data['value']);
        // die();
        if($this->request->getMethod() == 'post') {
            if($this->validate('inventory')){
                if($this->itemModel->update($data['id'], $_POST)) {
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Edited an Item';
                    $this->activityLogModel->save($activityLog);
                    $this->session->setFlashData('successMsg', 'Editing item successful.');                    
                    return redirect()->to(base_url('admin/inventory'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on editing item. Please try again.');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'items';
        $data['title'] = 'Items';
        return view('Modules\Inventory\Views\Items\form', $data);
    }

    public function delete($id) {
        // echo "<pre>";
        // print_r($id);
        // die();
        $data['perm_id'] = check_role('45', 'INV', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        if($this->itemModel->where('id', $id)->delete()) {
          $this->session->setFlashData('successMsg', 'Successfully deleted item');
        } else {
          $this->session->setFlashData('errorMsg', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/inventory'));
    }


}