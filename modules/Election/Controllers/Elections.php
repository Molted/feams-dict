<?php
namespace Modules\Election\Controllers;

use App\Controllers\BaseController;
use Modules\Election\Models as Models;
use Modules\Voting\Models as VotingModels;
use Modules\Voting2\Models as Voting2Models;
use App\Libraries as Libraries;
use App\Models as AppModels;

class Elections extends BaseController
{
    public function __construct() {
        $this->electionModel = new Models\ElectionModel();
        $this->positionModel = new Models\PositionModel();
        $this->candidateModel = new Models\CandidateModel();
        $this->voteModel = new VotingModels\VoteModel();
        $this->voteDetailModel = new VotingModels\VoteDetailModel();
        $this->pdf = new Libraries\Pdf();
        $this->mpdf = new \Mpdf\Mpdf();
        $this->tcpdf = new Libraries\Tcpdf();
        $this->electoralPositionModel = new Models\ElectoralPositionModel();
        $this->activityLogModel = new AppModels\ActivityLogModel();
        $this->userModel = new AppModels\UserModel();
        $this->vote2Model = new Voting2Models\VoteModel();
        $this->voteDetail2Model = new Voting2Models\VoteDetailModel();
        $this->officerModel = new Models\OfficerModel();

        $elections = $this->electionModel->findAll();
        foreach($this->electionModel->findAll() as $election) {
            if($election['status'] == 'Application') {
                if(strtotime($election['vote_start']) <= strtotime(date('Y-m-d H:i:s'))) {
                    $data = [
                        'id' => $election['id'],
                        'status' => 'Voting'
                    ];
                    if($this->electionModel->save($data)) {
                        // echo $election['title'].' starts now';
                    } else {
                        // echo $election['title'].' has an error starting';
                    }
                }
            } elseif($election['status'] == 'Voting') {
                if(strtotime($election['vote_end']) <= strtotime(date('Y-m-d'))) {
                    $data = [
                        'id' => $election['id'],
                        'status' => 'Finished'
                    ];
                    if($this->electionModel->save($data)) {
                        // echo $election['title'].' end now';
                    } else {
                        // echo $election['title'].' has an error starting';
                    }
                }
            }
        }
    }

    public function index() {
        // checking roles and permissions
        $data['perm_id'] = check_role('19', 'ELEC', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }
        
        // $data['elections'] = $this->electionModel->findAll();
        $data['elections'] = $this->electionModel->where('deleted_at', NULL)->orderBy('created_at', 'DESC')->get()->getResultArray();

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'elections';
        $data['title'] = 'Elections';
        return view('Modules\Election\Views\index', $data);
    }

    public function add() {
        // checking roles and permissions
        $data['perm_id'] = check_role('20', 'ELEC', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        $data['elecPositions'] = $this->electoralPositionModel->findAll();
        $data['positions'] = $this->positionModel->findAll();
        $data['edit'] = false;
        if($this->request->getMethod() == 'post') {
            // echo '<pre>';
            // print_r($_POST);
            // die();
            if($this->validate('elections')){
                if($this->electionModel->save($_POST)) {
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Added a new election named "' . $_POST['title'] . '".';
                    $this->activityLogModel->save($activityLog);
                    $this->session->setFlashdata('successMsg', 'Successfully started an election');
                    return redirect()->to(base_url('admin/election'));
                } else {
                    $this->session->setFlashdata('failMsg', 'Failed to start an election');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'elections';
        $data['title'] = 'Add Elections';
        // return view('Modules\Elections\Views\form', $data);
        return view('Modules\Election\Views\form', $data);
    }

    public function info($id) {
        // checking roles and permissions
        $data['perm_id'] = check_role('19', 'ELEC', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        $data['election'] = $this->electionModel->where(['id' => $id])->first();
        if(empty($data['election'])) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'elections';
        $data['title'] = 'Election Details';

        if($data['election']['type'] == '1') {
            $data['positions'] =  $this->electionModel->electionPositions($id);
            $data['candidates'] = $this->electionModel->electionCandidates($id);
            $data['voteCount'] = $this->vote2Model->where(['election_id' => $id])->countAllResults(false);
            $data['positionCount'] = $this->positionModel->where(['election_id' => $id])->countAllResults(false);
            $data['candidateCount'] = $this->candidateModel->where(['election_id' => $id])->countAllResults(false);
            // $data['perCandiCount'] = $this->voteDetailModel->joinVotes($id);
            $data['perCandiCount'] = $this->electionModel->voteCount($id);
            // echo '<pre>';
            // print_r($data['voteCount']);
            // die();
            return view('Modules\Election\Views\details', $data);
        } elseif($data['election']['type'] == '2') {
            $data['votes'] = $this->voteDetail2Model->voteCounts($id);
            $data['voteCount'] = $this->vote2Model->perUserVote($id);
            $data['voters'] = $this->vote2Model->elecVoter($id);
            $data['users'] = $this->userModel->forVoting();
    
            $data['noVotes'] = array();
            $data['votersID'] = array();
            foreach($data['voters'] as $voter) {
                array_push($data['votersID'], $voter['voter_id']);
            }
            foreach($data['users'] as $user) {
                if(!in_array($user['id'], $data['votersID'])) {
                    array_push($data['noVotes'], array('first_name' => $user['first_name'], 'last_name' => $user['last_name']));
                }
            }
            $data['hasOfficers'] = false;
            if(!empty($this->officerModel->viewing($id))) {
                $data['hasOfficers'] = true;
                $data['officers'] = $this->officerModel->viewing($id);
                // echo '<pre>';
                // print_r($data['officers']);
                // die();
            }
            return view('Modules\Election\Views\info', $data);
        }
    }

    public function deactivate($elecID) {
        $data = [
            'id' => $elecID,
            'status' => 'Finished',
        ];
        $election  = $this->electionModel->where('id', $elecID)->first();
        if($this->electionModel->save($data)) {
            $activityLog['user'] = $this->session->get('user_id');
            $activityLog['description'] = 'Finished an election: ' .$election['title'];
            $this->activityLogModel->save($activityLog);
            $this->session->setFlashdata('successMsg', 'Successfully finished an election');
            return redirect()->to(base_url('admin/election'));
        } else {
            $this->session->setFlashdata('failMsg', 'Failed to finished an election');
            return redirect()->to(base_url('admin/election'));
        }
    }

    public function saveOfficers($id) {
        if($this->request->getMethod() == 'post') {
            if($this->validate('officers')){
                $keys = array_keys($_POST);
                $data = array_map(null, $_POST,$keys);
                foreach($data as $data) {
                    $officers[] = [
                        'election_id' => $id,
                        'user_id' => $data[0], 
                        'position' => $data[1],
                        'status' => '1',
                    ];
                }
                if($this->officerModel->insertBatch($officers)) {
                    $this->session->setFlashdata('successMsg', 'Successfully elected new officers!');
                    return redirect()->to(base_url('admin/election/'.$id));
                } else {
                    $this->session->setFlashdata('failMsg', 'Failed to elect new officer, please try again');
                    return redirect()->to(base_url('admin/election/'.$id));
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
                $this->session->setFlashdata($data);
                return redirect()->to(base_url('admin/election/'.$id));
            }
        }
    }

    public function edit($id) {
        // return redirect()->to(current_url()); 
        // checking roles and permissions
        $data['perm_id'] = check_role('20', 'ELEC', $this->session->get('role'));
        if(!$data['perm_id']['perm_access']) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }
        $data['rolePermission'] = $data['perm_id']['rolePermission'];
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        $data['id'] = $id;
        $data['value'] = $this->electionModel->where('id', $id)->first();
        $data['elecPositions'] = $this->electoralPositionModel->findAll();
        $data['positions'] = $this->positionModel->findAll();
        $data['edit'] = true;
        if($this->request->getMethod() == 'post') {
            if($this->validate('edit_elec')){
                $_POST['id'] = $id;
                // echo '<pre>';
                // print_r($_POST);
                // die();
                if(strtotime($_POST['vote_start']) <= strtotime("now")) {
                    $_POST['status'] = 'Voting';
                } elseif(strtotime($_POST['vote_end']) <= strtotime("now")) {
                    $_POST['status'] = 'Finished';
                }
                if($this->electionModel->save($_POST)) {
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Added a new election';
                    $this->activityLogModel->save($activityLog);
                    $this->session->setFlashdata('successMsg', 'Successfully edited an election');
                    return redirect()->to(base_url('admin/election'));
                } else {
                    $this->session->setFlashdata('failMsg', 'Failed to start an election');
                }
            } else {
                $data['value'] = $_POST;
                $data['errors'] = $this->validation->getErrors();
            }
        }

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'elections';
        $data['title'] = 'Edit Elections';
        // return view('Modules\Elections\Views\form', $data);
        return view('Modules\Election\Views\formTime2', $data);
    }

    public function pdf($id) {
        $election = $this->electionModel->where(['id' => $id])->first();
        if(empty($election)) {
            $this->session->setFlashdata('sweetalertfail', 'Error accessing the page, please try again');
            return redirect()->to(base_url());
        }

        if($election['type'] == '1') {
            $data['positions'] =  $this->electionModel->electionPositions($id);
            $data['candidates'] = $this->electionModel->electionCandidates($id);
            $data['voteCount'] = $this->vote2Model->where(['election_id' => $id])->countAllResults(false);
            $data['positionCount'] = $this->positionModel->where(['election_id' => $id])->countAllResults(false);
            $data['candidateCount'] = $this->candidateModel->where(['election_id' => $id])->countAllResults(false);
            // $data['perCandiCount'] = $this->voteDetailModel->joinVotes($id);
            $data['perCandiCount'] = $this->electionModel->voteCount($id);
            $data['votes'] = $this->voteDetail2Model->findAll();
            // echo '<pre>';
            // print_r($data);
            // die();

            $data['type'] = 1;
            $data['electionName'] = $election['title'];
            $data['startDate'] = $election['vote_start'];
            $data['endDate'] = $election['vote_end'];
            $this->genPDF($data);

        } elseif($election['type'] == '2') {
            $data['votes'] = $this->voteDetail2Model->voteCounts($id);
            $data['voteCount'] = $this->vote2Model->perUserVote($id);
            $data['voters'] = $this->vote2Model->elecVoter($id);
            $data['users'] = $this->userModel->forVoting();
    
            $data['noVotes'] = array();
            $data['votersID'] = array();
            foreach($data['voters'] as $voter) {
                array_push($data['votersID'], $voter['voter_id']);
            }
            foreach($data['users'] as $user) {
                if(!in_array($user['id'], $data['votersID'])) {
                    array_push($data['noVotes'], array('first_name' => $user['first_name'], 'last_name' => $user['last_name']));
                }
            }
            $data['officers'] = $this->officerModel->viewing($id);
            $data['type'] = 2;
            $data['electionName'] = $election['title'];
            $data['startDate'] = $election['vote_start'];
            $data['endDate'] = $election['vote_end'];

            $this->genPDF($data);
        }
    }

    private function genPDF($data) {
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

        if($data['type'] == 1) {
            $pdf->AddPage();
            $pdf->writeHTML(view('Modules\Election\Views\pdf\byParty', $data), true, false, true, false, '');
            $pdf->Ln(4);
            $pdf->Output('Results for the election: '.$data['electionName'].'.pdf', 'D');
        } elseif($data['type'] == 2) {
            $pdf->AddPage();
            $pdf->writeHTML(view('Modules\Election\Views\pdf\byType', $data), true, false, true, false, '');
            $pdf->Ln(4);
            $pdf->Output('Results for the election: '.$data['electionName'].'.pdf', 'D');
        }
    }
}
