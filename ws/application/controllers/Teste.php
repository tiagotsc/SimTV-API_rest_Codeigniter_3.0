<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Teste extends CI_Controller  {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
     
    function __construct()
    {
        // Construct our parent class
        parent::__construct();
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        #$this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        #$this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        #$this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }
    
    public function testeEmailPhpMailer(){
        
        $this->load->helper("email");  
        
        $status = enviaEmail('Sim TV - Ferramentas de Negócios', 'naoresponda@simtv.com.br', 'tiago.costa@simtv.com.br', 'Titulo teste', 'Texto teste', false);
        
        if($status){
            echo 'Enviado';
        }else{
            echo 'Nao enviado';
        }
        exit();
        
    }
     
	public function teste()
	{
		echo 1; exit();
	}
    
}
