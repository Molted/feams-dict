<?php
namespace Modules\Contributions\Controllers;

use App\Controllers\BaseController;
use Modules\Contributions\Models as Models;
use App\Models as AppModels;
use App\Libraries as Libraries;
use CodeIgniter\I18n\Time;

class Contributions extends BaseController
{
    public function __construct() {
        $this->contribModel = new Models\ContributionModel();
        $this->activityLogModel = new AppModels\ActivityLogModel();
        $this->userModel = new AppModels\UserModel();
        $this->payModel = new \Modules\Payments\Models\PaymentsModel();
        $this->mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
        $this->tcpdf = new Libraries\Tcpdf();
        $this->pdf = new Libraries\Pdf();
    }

    public function index() {
        // checking roles and permissions
        $data['perm_id'] = check_role('39', 'CONT', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        $data['contributions']  = $this->contribModel->viewAll();

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'contributions';
        $data['title'] = 'Contributions';
        return view('Modules\Contributions\Views\index', $data);
    }

    public function add() {
        // checking roles and permissions
        $data['perm_id'] = check_role('39', 'CONT', $this->session->get('role'));
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
            if($this->validate('contributions')) {
                $_POST['created_by'] = $this->session->get('user_id');
                if($this->contribModel->insert($_POST)) {
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Added a new contribution';
                    $this->activityLogModel->save($activityLog);
                    $this->session->setFlashData('successMsg', 'Adding contribution successful');
                    return redirect()->to(base_url('admin/contributions'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on adding contribution. Please try again.');
                    return redirect()->back()->withInput();
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'contributions';
        $data['title'] = 'Contributions';
        return view('Modules\Contributions\Views\form', $data);
    }

    public function edit($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('17', 'SLID', $this->session->get('role'));
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
        $data['value'] = $this->sliderModel->where('id', $id)->first();
        $data['id'] = $data['value']['id'];
        if($this->request->getMethod() == 'post') {
            if($this->validate('payments')){
                $file = $this->request->getFile('image');
                $slider = $_POST;
                $slider['image'] = $file->getRandomName();
                $slider['uploader'] = $this->session->get('user_id');
                if($this->sliderModel->update($data['id'], $slider)) {
                    $file->move('uploads/sliders', $slider['image']);
                    if ($file->hasMoved()) {
                        $activityLog['user'] = $this->session->get('user_id');
                        $activityLog['description'] = 'Edited an slider';
                        $this->activityLogModel->save($activityLog);
                        $this->session->setFlashData('successMsg', 'Editing slider successful.');
                    } else {
                        $this->session->setFlashData('failMsg', 'There is an error on editing slider. Please try again.');
                    }
                    return redirect()->to(base_url('admin/sliders'));
                } else {
                    $this->session->setFlashData('failMsg', 'There is an error on editing slider. Please try again.');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'sliders';
        $data['title'] = 'Payments';
        return view('Modules\Payments\Views\form', $data);
    }

    public function delete($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('39', 'PAY', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        if($this->paymentModel->where('id', $id)->delete()) {
          $activityLog['user'] = $this->session->get('user_id');
          $activityLog['description'] = 'Deleted an payment';
          $this->activityLogModel->save($activityLog);
          $this->session->setFlashData('successMsg', 'Successfully deleted payment');
        } else {
          $this->session->setFlashData('errorMsg', 'Something went wrong!');
        }
        return redirect()->to(base_url('admin/payments'));
    }

    // tcpdf library
    public function print3($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('39', 'CONT', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }

        $pdf = new $this->tcpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        // die(PDF_HEADER_LOGO);
        $pdf->SetHeaderData('feamsheader.png', '130', '', '');
        $pdf->setPrintHeader(true);
        $pdf->setHeaderFont(Array('times', 'Times New Roman', PDF_FONT_SIZE_MAIN));
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        $data['cont'] = $this->contribModel->where('id', $id)->first();
        $time = Time::parse($data['cont']['created_at'], 'Asia/Manila');
        $data['contStart'] = $time->toLocalizedString('MMMM d, yyyy');
        $data['payments'] = $this->payModel->where('contri_id', $id)->findAll();
        $data['users'] = $this->userModel->findAll();

        
        $pdf->AddPage();
        $pdf->writeHTML(view('Modules\Contributions\Views\tcpdf', $data), true, false, true, false, '');
        $pdf->Ln(4);
        $pdf->Output('List of not paid for the contribution - '.$data['contriDetails']['name'].' - P.pdf', 'I');
    }

    // fpdf library
    public function print($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('39', 'CONT', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }

        $data['cont'] = $this->contribModel->where('id', $id)->first();
        $time = Time::parse($data['cont']['created_at'], 'Asia/Manila');
        $data['contStart'] = $time->toLocalizedString('MMMM d, yyyy');
        $data['payments'] = $this->payModel->where('contri_id', $id)->findAll();
        $data['users'] = $this->userModel->findAll();

		$this->pdf->AliasNbPages();
		$this->pdf->AddPage('l', 'Legal');
		$this->pdf->SetFont('Arial','B',12);
        $this->pdf->Cell(0,8,$data['cont']['name']. ' Contribution Report',0,0,'C');
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(0,10,'Date started: '.$data['contStart'],0,0,'C');
        $this->pdf->Ln();

		$this->pdf->SetX(60);
		$this->pdf->SetFont('Helvetica', 'B' ,8);
		$this->pdf->Cell(10,7,'#',1);
		$this->pdf->Cell(90,7,'Name',1);
		$this->pdf->Cell(40,7,'Amount Paid',1);
		$this->pdf->Cell(50,7,'Status',1);
		$this->pdf->Cell(60,7,'Date paid',1);
		$this->pdf->Ln();

		$this->pdf->SetFont('Helvetica', '' ,8);
        $ctr = 1;
        foreach($data['users'] as $user) {
            $this->pdf->SetX(60);
            if($user['status'] == '1') {
                $cost = 0; $amountPaid = 0;
                $datePaid = '';
                foreach($data['payments'] as $pay) {
                    if($pay['user_id'] == $user['id'] && $pay['is_approved'] == '1') {
                        $amountPaid += $pay['amount'];
                        $datePaid = $pay['created_at'];
                    }
                }
                if($amountPaid === 0) {   
                    $this->pdf->Cell(10,7,$ctr,1);
                    $this->pdf->Cell(90,7,ucwords(strtolower($user['first_name'])).' '.ucwords(strtolower($user['last_name'])),1);
                    $this->pdf->Cell(40,7,esc($amountPaid).'.00',1);
                    $this->pdf->Cell(50,7,'Not paid',1);
                    $this->pdf->Cell(60,7,'',1);
                } elseif($amountPaid == $data['cont']['cost']) {
                    $this->pdf->Cell(10,7,$ctr,1);
                    $this->pdf->Cell(90,7,ucwords(strtolower($user['first_name'])).' '.ucwords(strtolower($user['last_name'])),1);
                    $this->pdf->Cell(40,7,esc($amountPaid).'.00',1);
                    $this->pdf->Cell(50,7,'Fully paid',1);
                    $this->pdf->Cell(60,7,date('F d,Y H:ia', strtotime($datePaid)),1);
                }
            }
            $this->pdf->Ln();
            $ctr++;
        }
        
		$date = date('F d,Y');
        $this->response->setHeader('Content-Type', 'application/pdf');
		$this->pdf->Output('D', $data['cont']['name']. ' Contribution Report.pdf'); 
    } 

    // mpdf library
    public function print2($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('39', 'CONT', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }

        $data['cont'] = $this->contribModel->where('id', $id)->first();
        $data['payments'] = $this->payModel->where('contri_id', $id)->findAll();
        $data['users'] = $this->userModel->findAll();
        // pdf generation
        $view = view('Modules\Contributions\Views\pdf', $data);
        $this->mpdf->SetHTMLHeader('
        <div style="text-align: right; font-weight: bold;">
            '.$data['cont']['name'].' Contribution Report
        </div>');
        $this->mpdf->SetHTMLFooter('
        <table width="100%">
            <tr>
                <td width="33%"></td>
                <td width="33%" align="center">Page: {PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right;"><b>Date generated:</b> {DATE j-m-Y}</td>
            </tr>
        </table>');
        $this->mpdf->WriteHTML($view);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $this->mpdf->Output($data['cont']['name'].' Contribution Report.pdf','I');
        
        foreach($data['users'] as $user) {
            if($user['status'] == 'a') {
                $cost = 0;
                foreach($data['payments'] as $pay) {
                    if($pay['user_id'] == $user['id'] && $pay['is_approved'] == '1') {
                        $cost += $pay['amount'];
                    }
                }
                if($cost === 0) {   
                    echo 'not paid: '.$user['first_name'].' '.$user['last_name'].'<br>';
                } elseif($cost < $data['cont']['cost']) {
                    $total = $data['cont']['cost'] - $cost;
                    echo 'lack of payment('.$total.'): '.$user['first_name'].' '.$user['last_name'].'<br>';
                } elseif($cost == $data['cont']['cost']) {
                    echo 'complete payment: '.$user['first_name'].' '.$user['last_name'].'<br>';
                }
            }
        }
    }
}