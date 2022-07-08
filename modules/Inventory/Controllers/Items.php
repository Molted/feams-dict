<?php
namespace Modules\Inventory\Controllers;

use App\Controllers\BaseController;
use Modules\Inventory\Models as ItemModels;


class Items extends BaseController
{
    public function __construct() {
        $this->itemModel = new ItemModels\ItemModel();
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
        $data['items'] = $this->itemModel->get();
     
        $data['title'] = 'Inventory';
        $data['active'] = 'items';
        return view('Modules\Inventory\Views\Items\index', $data); 
    }



    // public function delete($id) {
    //     $data['perm_id'] = check_role('45', 'INV', $this->session->get('role'));
    //     if(!$data['perm_id']['perm_access']) {
    //         $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
    //         return redirect()->to(base_url());
    //     }
    //     $data['rolePermission'] = $data['perm_id']['rolePermission'];
    //     if($this->userModel->where('id', $id)->delete()) {
    //       $this->session->setFlashData('successMsg', 'Successfully deleted user');
    //     } else {
    //       $this->session->setFlashData('errorMsg', 'Something went wrong!');
    //     }
    //     return redirect()->to(base_url('admin/users'));
    // }


}