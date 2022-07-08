<?php
namespace Modules\Reports\Controllers;

use App\Controllers\BaseController;
use App\Models as Models;
use App\Libraries as Libraries;
use CodeIgniter\I18n\Time;

class LoginReport extends BaseController
{
    public function __construct() {
        $this->loginModel = new Models\LoginModel();
        $this->pdf = new Libraries\Pdf();
    }

    public function index() {
        // checking roles and permissions
        $data['perm_id'] = check_role('37', 'REPO', $this->session->get('role'));
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
                $this->generatePDF();                    
        }
        $data['logins'] = $this->loginModel->withRole();

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'login_repo';
        $data['title'] = 'Login Reports';
        return view('Modules\Reports\Views\login\index', $data);
    }

    // MAG DADAGDAG NG ANOTHER ELSEIF PARA SA CUSTOM RANGE TABLE
    public function changeTable($id) {
        if($id == '1') {
            $data['logins'] = $this->loginModel->withRole();
            return view('Modules\Reports\Views\login\table', $data);
        } elseif($id === '2') {
            $data['logins'] = $this->loginModel->thisDay();
            return view('Modules\Reports\Views\login\table', $data);
        } elseif($id == '3') {
            $data['logins'] = $this->loginModel->weekly();
            return view('Modules\Reports\Views\login\table', $data);
        } elseif($id == '4') {
            $data['logins'] = $this->loginModel->monthly();
            return view('Modules\Reports\Views\login\table', $data);
        }
        elseif($id == '5') {    
            $this->customRange($id);
        }
    }

    public function customRange($id){    
        if($this->request->getMethod() == 'post') {
            $data = $_POST;
            $data['logins'] = array();
            // RETRIEVING EACH DATA THAT FOUND IN DATABASE
            foreach ($this->loginModel->withRole() as $login) {
                $conv_loginDate = date('Y-m-d', strtotime($login['login_date']));
                // IF CONDITION FOR CUSTOM DATE RANGE
                if($conv_loginDate >= $data['start'] && $conv_loginDate <= $data['end']){
                    $loginDetails['first_name'] = ucwords(strtolower($login['first_name']));
                    $loginDetails['last_name'] = ucwords(strtolower($login['last_name']));
                    $loginDetails['username'] = $login['username'];
                    $loginDetails['role_name'] = $login['role_name'];
                    $login_date = date_format(date_create($login['login_date']), 'F d, Y H:ia');
                    $loginDetails['login_date'] = $login_date;
                    array_push($data['logins'], $loginDetails);
                }
            }
        }
        return view('Modules\Reports\Views\login\table', $data);
    }

    public function generatePDF() {
        if($this->request->getMethod() == 'post') {
            $records = $this->request->getVar('records');
            $dateRange = $this->request->getVar(['start', 'end']);

            if($records == '1') {
                $details = $this->loginModel->withRole();
            } elseif($records === '2') {
                $details = $this->loginModel->thisDay();
            } elseif($records == '3') {
                $details = $this->loginModel->weekly();
            } elseif($records == '4') {
                $details = $this->loginModel->monthly();
            } 
            elseif($records == '5') {
                $details = array();
                // RETRIEVING EACH DATA THAT FOUND IN DATABASE
                foreach ($this->loginModel->withRole() as $login) {
                    // echo '<pre>';
                    // print_r($login);
                    // die();
                    $conv_loginDate = date('Y-m-d', strtotime($login['login_date']));
                    // IF CONDITION FOR CUSTOM DATE RANGE
                    if($conv_loginDate >= $dateRange['start'] && $conv_loginDate <= $dateRange['end']){
                        $loginDetails['first_name'] = ucwords(strtolower($login['first_name']));
                        $loginDetails['last_name'] = ucwords(strtolower($login['last_name']));
                        $loginDetails['username'] = $login['username'];
                        $loginDetails['role_name'] = $login['role_name'];
                        $loginDetails['login_date'] = $login['login_date'];
                        array_push($details, $loginDetails);
                    }
                }
            }
        }
		$this->pdf->AliasNbPages();
		// $details = $this->loginModel->withRole();
		$dt   = new Time('now');
		$date = date('F d,Y');
        $week = date_sub($dt,date_interval_create_from_date_string("7 days"));
        $month = new Time('-1 month');
        
        $start = date_format(date_create($dateRange['start']), 'F d, Y');
        $end = date_format(date_create($dateRange['end']), 'F d, Y');

        // echo '<pre>';
        // print_r($start);
        // die();

		$this->pdf->AddPage('l', 'Legal');
		$this->pdf->SetFont('Arial','B',12);
        if($records == '1') {
            $this->pdf->Cell(0,10,'Daily Login Reports',0,0,'C');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->Cell(0,10,'All logins up to: '.$date,0,0,'C');
        } elseif($records === '2') {
            $this->pdf->Cell(0,10,'Today Login Reports  ['.$date.']',0,0,'C');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->Cell(0,10,'Date: '.$date,0,0,'C');
        } elseif($records == '3') {
            $this->pdf->Cell(0,10,'Weekly Login Reports',0,0,'C');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->Cell(0,10,'Dates: '.date_format($week,"F d,Y").' - '.$date,0,0,'C');
        } elseif($records == '4') {
            $this->pdf->Cell(0,10,'Monthly Login Reports  ['.$date.']',0,0,'C');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->Cell(0,10,'Dates: '.date_format($month,"F d,Y").' - '.$date,0,0,'C');
        } elseif($records == '5') {
            $this->pdf->Cell(0,10,'Custom Date Login Reports: '.$start.' - '.$end,0,0,'C');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial','B',10);
            $this->pdf->Cell(0,10,'Dates: '.$start.' - '.$end,0,0,'C');
        }
		// $this->pdf->Cell(70,10,'Login Reports  ['.$date.']');

        $this->pdf->Ln();
		$this->pdf->SetFont('Helvetica', 'B' ,8);
		$this->pdf->SetX(55);
		$this->pdf->Cell(10,10,'#',1);
		$this->pdf->Cell(50,10,'First Name',1);
		$this->pdf->Cell(40,10,'Last Name',1);
		$this->pdf->Cell(30,10,'Username',1);
		$this->pdf->Cell(50,10,'Role',1);
		$this->pdf->Cell(60,10,'Login Date',1);
		$this->pdf->Ln();
        $ctr = 1;
		foreach($details as $detail) {
			$this->pdf->SetX(55);
            $this->pdf->SetFont('Helvetica', '' ,8);
			$date = date_create($detail['login_date']);
			$datelogged = date_format($date, 'F d, Y H:i:s');

			$this->pdf->Cell(10,8,$ctr,1);
			$this->pdf->Cell(50,8,$detail['first_name'],1);
			$this->pdf->Cell(40,8,$detail['last_name'],1);
			$this->pdf->Cell(30,8,$detail['username'],1);
			$this->pdf->Cell(50,8,$detail['role_name'],1);
			$this->pdf->Cell(60,8,$datelogged,1);
			$this->pdf->Ln();
            $ctr++;
		}
		$date = date('F d,Y');
        $this->response->setHeader('Content-Type', 'application/pdf');
		// $this->pdf->Output('D', 'Login Report ['.$date.'].pdf'); 
        return redirect()->to($this->pdf->Output('Login Report ['.$date.'].pdf', 'I'));
    }
}