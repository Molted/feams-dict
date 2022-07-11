<?php
namespace Modules\ItemCategory\Controllers;

use App\Controllers\BaseController;
use Modules\ItemCategory\Models as CategoryModels;
use App\Models as AppModels;


class Categories extends BaseController
{
    public function __construct() {
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
        $data['categories'] = $this->categoryModel->findAll();
     
        $data['title'] = 'Categories';
        $data['active'] = 'categories';
        return view('Modules\ItemCategory\Views\index', $data); 
    }

    public function add() {
        helper('text');
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

        if($this->request->getMethod() == 'post') {
            if($this->validate('item_categories')){
                if($this->categoryModel->insert($_POST)) {
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Added a new Category';
                    $this->activityLogModel->save($activityLog);
                    $this->session->setFlashData('successMsg', 'Adding category successful');
                    return redirect()->to(base_url('admin/category'));
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
        $data['active'] = 'categories';
        $data['title'] = 'Add Categories';
        return view('Modules\ItemCategory\Views\form', $data);
    }

    public function delete($id) {
        $data['perm_id'] = check_role('45', 'INV', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        if($this->categoryModel->where('id', $id)->delete()) {
          $this->session->setFlashData('successMsg', 'Successfully deleted category');
        } else {
          $this->session->setFlashData('errorMsg', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/category'));
    }


}