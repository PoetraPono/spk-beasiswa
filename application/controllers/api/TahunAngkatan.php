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
class TahunAngkatan extends REST_Controller {

    function __construct($config = 'rest')
    {
        // Construct the parent class
        parent::__construct($config);
        $this->load->model('ModelTahunAngkatan');

    }

    public function tahunangkatans_post()
    {
        $Filter = $this->post('body');
        $data=$this->ModelTahunAngkatan->GetTahunAngkatanWithFilter($Filter)->result();
        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
    public function tahunangkatan_post()
    {
        $TahunAngkatan= (object) $this->post('body');
        if(isset($TahunAngkatan->id_tahun_angkatan)){
            if($this->ModelTahunAngkatan->UpdateTahunAngkatan($TahunAngkatan)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }else{
            if($this->ModelTahunAngkatan->InsertTahunAngkatan($TahunAngkatan)){
                $this->set_response(array('status' => 'sukses'), REST_Controller::HTTP_CREATED);
            }else{
                $this->set_response(array('error' => 'Error saat simpan data'), 404);
            }
        }
    }
    function gettahunangkatanbyid_get($Id)
    {
        # code...
        $where=array('id_tahun_angkatan'=>$Id);
        $tahunAngkatan=$this->ModelTahunAngkatan->GatById($where)->result();
        $this->set_response($tahunAngkatan[0], REST_Controller::HTTP_CREATED);
    }
    function tahunangkatandelete_get($Id)
    {
        if($this->ModelTahunAngkatan->Delete($Id)){

        }else{

        }
    }

    public function tahunangkatans_get()
    {
        $tahunangkatan=$this->ModelTahunAngkatan->GetTahunAngkatan()->result();
        $this->set_response($tahunangkatan, REST_Controller::HTTP_CREATED);
    }
   
    

}
