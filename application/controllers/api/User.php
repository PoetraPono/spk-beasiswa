<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class User extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelUser');

    }

    public function getusers_post()
    {
        $Filter = $this->post('body');
        $data=$this->ModelUser->GetUserWithFilter($Filter)->result();
        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
    public function getkriterias_get()
    {
        $data=$this->ModelKriteria->Getkriteria()->result();
        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
    public function user_post()
    {
        $User= (object) $this->post('body');
        if(isset($User->id_pengelola)){
            if($this->ModelUser->UpdateUser($User)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }else{
            $User->password =  md5($User->password);
            if($this->ModelUser->InsertUser($User)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }

      //  $this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    function getdatauserbyid_get($Id)
    {
        # code...
        $where=array('id_pengelola'=>$Id);
        $User=$this->ModelUser->GatById($where)->result();
        $this->set_response($User[0], REST_Controller::HTTP_CREATED);
    }
    function userdelete_get($Id)
    {
        if($this->ModelUser->Delete($Id)){

        }else{

        }
    }

}
