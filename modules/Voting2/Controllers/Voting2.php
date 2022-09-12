<?php
namespace Modules\Voting2\Controllers;

use App\Controllers\BaseController;
use Modules\Voting2\Models as Models;
use Modules\Elections\Models as Election;
use App\Models as AppModels;

class Voting2 extends BaseController
{
    public function __construct() {
        $this->electionModel = new Election\ElectionModel();
        $this->voteModel = new Models\VoteModel();
        $this->voteDetailModel = new Models\VoteDetailModel();
        $this->activityLogModel = new AppModels\ActivityLogModel();
        $this->userModel = new AppModels\UserModel();
        $this->electoralPositionModel = new Election\ElectoralPositionModel();
        $this->candidateModel = new Election\CandidateModel();
        $this->positionModel = new Election\PositionModel();

        foreach($this->electionModel->findAll() as $election) {
            if($election['status'] == 'Application') {
                if(strtotime($election['vote_start']) <= strtotime(date('Y-m-d'))) {
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
        $data['perm_id'] = check_role('', '', $this->session->get('role'));
        $data['rolePermission'] = $data['perm_id']['rolePermission'];

        $activeElec = intval($this->electionModel->where('status !=', 'Application')->countAllResults(false));
        if($activeElec <= 0) {
            $this->session->setFlashdata('sweetalertfail', 'No finished and active election.');
            return redirect()->to(base_url());
        }
        $data['perms'] = array();
        foreach($data['rolePermission'] as $rolePerms) {
            array_push($data['perms'], $rolePerms['perm_mod']);
        }

        $data['elections'] = $this->electionModel->findAll();
        // $data['elections'] = $this->electionModel->where('status !=', 'Application')->findAll();

        $data['user_details'] = user_details($this->session->get('user_id'));
        $data['active'] = 'voting';
        $data['title'] = 'Voting';
        return view('Modules\Voting2\Views\combine\index', $data);
    }

    public function other($id) {
        $data['election'] = $this->electionModel->where(['status !=' => 'Application', 'id' => $id])->first();
        // echo '<pre>';
        // print_r($data['positions']);
        // die();
        $data['users'] = $this->userModel->findAll();

        if($data['election']['status'] == 'Finished') {
            echo 'Election is finished, wait for the releasing of results <br>';
            // check if voted
            $voted = $this->voteModel->where(['election_id' => $id, 'voter_id' => $this->session->get('user_id')])->first();
            if(!empty($voted)) {
                if($data['election']['type'] == '2') {
                    echo 'You have voted for this election';
                    // $data['voteDetails'] = $this->voteDetailModel->where(['votes_id' => $voted['id']])->findAll();
                    $data['voteDetails'] = $this->voteDetailModel->viewDetail($voted['id']);
                    // echo '<pre>';
                    // print_r($data['voteDetails']);
                    return view('Modules\Voting2\Views\results2', $data);
                } else {
                    $data['positions'] = $this->electoralPositionModel->positionNameOnCandidate($data['election']['id']);
                    $data['candidates'] = $this->candidateModel->view2($id);
                    echo 'You have voted for this election';
                    $data['voteDetails'] = $this->voteDetailModel->where(['votes_id' => $voted['id']])->findAll();
                    $data['votes'] = $this->voteDetailModel->candidateDetails1($id,$this->session->get('user_id'));
                    // $data['positions'] = $this->electoralPositionModel->positionNameOnCandidate($data['election']['id']);
                    // $data['candidates'] = $this->candidateModel->view2($id);
                    // echo '<pre>';
                    // print_r($data['votes']);
                    return view('Modules\Voting2\Views\combine\resultsType1', $data);
                }
            } else {
                echo 'You didn\'t vote for the election.';
            }
        } elseif($data['election']['status'] == 'Voting') {
            if($data['election']['type'] == '2') {
                // check if voted
                $voted = $this->voteModel->where(['election_id' => $id, 'voter_id' => $this->session->get('user_id')])->first();
                if(!empty($voted)) {
                    echo 'You have voted for this election';
                    $data['voteDetails'] = $this->voteDetailModel->type2($voted['id']);
                    // $data['voteDetails'] = $this->voteDetailModel->where(['votes_id' => $voted['id']])->findAll();
                    $data['votes'] = $this->voteDetailModel->candidateDetails2($id,$this->session->get('user_id'));
                    $data['user_types'] = ['1', '2', '3'];
                    // echo '<pre>';
                    // print_r($data['voteDetails']);
                    return view('Modules\Voting2\Views\results2', $data);
                } else {
                    return view('Modules\Voting2\Views\voteSection2', $data);
                }
            } else {
                // die('type 1');
                // check if voted
                $voted = $this->voteModel->where(['election_id' => $id, 'voter_id' => $this->session->get('user_id')])->first();
                $data['positions'] = $this->electoralPositionModel->positionNameOnCandidate($data['election']['id']);
                $data['candidates'] = $this->candidateModel->view2($id);
                if(!empty($voted)) {
                    echo 'You have voted for this election';
                    $data['voteDetails'] = $this->voteDetailModel->where(['votes_id' => $voted['id']])->findAll();
                    $data['votes'] = $this->voteDetailModel->candidateDetails1($id,$this->session->get('user_id'));
                    // $data['positions'] = $this->electoralPositionModel->positionNameOnCandidate($data['election']['id']);
                    // $data['candidates'] = $this->candidateModel->view2($id);
                    // echo '<pre>';
                    // print_r($data['votes']);
                    return view('Modules\Voting2\Views\combine\resultsType1', $data);
                } else {
                    return view('Modules\Voting2\Views\combine\votingSection', $data);

                }
            }
        }
        if(empty($data['election'])) {
            echo 'Please select an election';
        }
    }
    
    public function cast() {
        $election  = $this->electionModel->where(['status !=' => 'Application', 'id' => $_POST['election_id']])->first();
        if($election['type'] == '1') {
            $this->castType1();
            return redirect()->to(base_url('votes2'));
        } elseif($election['type'] == '2') {
            $this->castType2();
            return redirect()->to(base_url('votes2'));
        }
    }

    public function castType1() {
        if($this->request->getMethod() === 'post') {
            // save first to votes table
            $voter = [
                'election_id' => $this->request->getVar('election_id'),
                'voter_id' => $this->session->get('user_id'),
            ];
            if($this->voteModel->save($voter)) {
                $voterData = $this->voteModel->where(['election_id' => $voter['election_id'], 'voter_id' => $this->session->get('user_id')])->first();
                $data['electionPosition'] = $this->positionModel->where('election_id', $voter['election_id'])->findAll();
                $election = $this->electionModel->where(['id' => $voter['election_id'], 'status' => 'Voting'])->first();
                // pagtapos mag save ng voter detail, isasave na votes
                $activityLog['user'] = $this->session->get('user_id');
                $activityLog['description'] = 'Voted for the election: '.$election['title'];
                $this->activityLogModel->save($activityLog);
                foreach($data['electionPosition'] as $position) {
                    if($this->request->getVar($position['id']) != 0) {
                        $voteData = [
                            'votes_id' => $voterData['id'],
                            'position_id' => $position['id'],
                            'candidate_id' => $this->request->getVar($position['id']),
                        ];
                    } else {
                        $voteData = [
                            'votes_id' => $voterData['id'],
                            'position_id' => $position['id'],
                            'candidate_id' => 0,
                        ];
                    }
                    $this->voteDetailModel->save($voteData);
                }
                $this->session->setFlashdata('firstVoter', 'Vote casted.');
                return redirect()->to(base_url('votes2'));
            } else {
                $this->session->setFlashdata('failMsg', 'Vote not casted, please try again.');
                return redirect()->to(base_url('votes2'));
            }
        }
    }
    
    public function castType2() {
        if($this->request->getMethod() == 'post') {
            if(isset($_POST['regular']) && isset($_POST['part-time']) && isset($_POST['admin'])){
                $countReg = count($_POST['regular']);
                $countPart = count($_POST['part-time']);
                $countAdmin = count($_POST['admin']);
                if($countReg != 4 || $countPart != 4 || $countAdmin != 4){
                    $this->session->setFlashdata('failMsg', 'There\'s some field that needs to meet the requirements!');
                    return redirect()->back();
                }

                // save first to votes table
                $voter = [
                    'election_id' => $this->request->getVar('election_id'),
                    'voter_id' => $this->session->get('user_id'),
                ];
                if($this->voteModel->save($voter)) {
                    $voterData = $this->voteModel->where(['election_id' => $voter['election_id'], 'voter_id' => $this->session->get('user_id')])->first();
                    $election = $this->electionModel->where(['id' => $voter['election_id'], 'status' => 'Voting'])->first();
                    // pagtapos mag save ng voter detail, isasave na votes
                    $activityLog['user'] = $this->session->get('user_id');
                    $activityLog['description'] = 'Voted for the election: '.$election['title'];
                    $this->activityLogModel->save($activityLog);
                    foreach($_POST['regular'] as $regular) {
                        $voteData = [
                            'votes_id' => $voterData['id'],
                            'user_type' => '1',
                            'user_id' => $regular,
                        ];
                        $this->voteDetailModel->save($voteData);
                    }
                    foreach($_POST['part-time'] as $partTime) {
                        $voteData = [
                            'votes_id' => $voterData['id'],
                            'user_type' => '2',
                            'user_id' => $partTime,
                        ];
                        $this->voteDetailModel->save($voteData);
                    }
                    foreach($_POST['admin'] as $admin) {
                        $voteData = [
                            'votes_id' => $voterData['id'],
                            'user_type' => '3',
                            'user_id' => $admin,
                        ];
                        $this->voteDetailModel->save($voteData);
                    }
                    $this->session->setFlashdata('firstVoter', 'Vote casted.');
                    // return redirect()->to(base_url('admin/elections'));
                    return redirect()->back();
                } else {
                    $this->session->setFlashdata('failMsg', 'Vote not casted, please try again.');
                    // return redirect()->to(base_url('admin/elections'));
                    return redirect()->back();
                }
            } else {
                $this->session->setFlashdata('failMsg', 'Follow the instructions, please try again.');
                return redirect()->back();
            }
        }
    }
}