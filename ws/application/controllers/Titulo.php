<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Titulo extends CI_Controller {

    
    /**
     * Titulo::__construct()
     * 
     * Classe resposável por processar os relatórios
     * 
     * @return
     */
    public function __construct(){
        
		parent::__construct();
        
        include_once('config-api.php');
        
        if($this->input->post('senha') != PASSWORD){
            echo json_encode(array('error' => 'Senha da API inválida ou não informada.'));
            exit();
        }
        
        $this->load->helper('url');        
        $this->load->model('titulo_model','titulo'); 
        
    }
    
	public function index()
	{
		$this->load->view('titulo/view_segunda_via');
	}
    
    /**
     * Titulo::segundaViaPdf()
     * 
     * Gera o PDF da segunda no navegador ou envia por e-mail dependendo do que é informado
     * 
     * @return
     */
    public function segundaViaPdf(){
        
        $this->load->helper("titulo");
        $this->load->helper("msgs_email");
        
        #$_POST['permissor'] = 61;
        #$_POST['titulo'] = 3978011;
        #$_POST['email'] = 'tiago.costa@simtv.com.br';
        
        if(!$this->input->post('permissor') or !$this->input->post('titulo')){
            echo json_encode(array('error' => 'Passe os parâmetros'));
            exit();
        }
        
        $verificaTitulo = verificaSegundaVia($this->input->post('permissor'), $this->input->post('titulo'), 'prod');
        
        if($verificaTitulo != 0){
            echo json_encode(array('error' => 'Não foi possível abrir a segunda via desse título.'));
            exit();
        }
        
        $dadosSacado = $this->titulo->dadosSacadoTitulo();
        $dadosTitulo = $this->titulo->dadosTitulo();
        $itensTitulo = $this->titulo->itensFaturaTitulo();
        
        if(!$dadosSacado or !$dadosTitulo or !$itensTitulo){ 
            echo json_encode(array('error' => 'Nada encontrado'));
            exit();
        }
        
        $dados['dadosCedente'] = dadosCedente($this->input->post('permissor'));
        $dados['dadosSacado'] = $dadosSacado;
        $dados['dadosTitulo'] = $dadosTitulo;
        $dados['itensTitulo'] = $itensTitulo;
        
        if($dados['dadosTitulo']->CODIGO_BANCO == 237 or $dados['dadosTitulo']->CODIGO_BANCO == 707)
        {
            $codigobanco = 237;
        }else
        {
            $codigobanco = $dados['dadosTitulo']->CODIGO_BANCO;
        }
        
        $dados['logoPrincipal'] = base_url('assets/titulo/images/logoSimTv.jpg');
        $dados['logoBanco'] = logo($this->input->post('permissor'));
        $dados['codigo_banco_com_dv'] = geraCodigoBanco($codigobanco);
        $dados['local_pagamento'] = 'Pagável preferencialmente no banco emissor.';
        $dados['dadosFixos'] = dadosFixos();

        $html=$this->load->view('titulo/view_segunda_via', $dados, true);
        
        try{
        
            //load mPDF library
    		$this->load->library('m_pdf');
            
            $this->m_pdf->pdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
            $stylesheet1 = file_get_contents('./assets/titulo/css/styles.css');
            $this->m_pdf->pdf->WriteHTML($stylesheet1,1);
            $stylesheet2 = file_get_contents('./assets/titulo/css/personalizado.css');
            $this->m_pdf->pdf->WriteHTML($stylesheet2,1);
           //generate the PDF from the given html
    		$this->m_pdf->pdf->WriteHTML($html);
    
            //download it.
            $nome_boleto = date("YmdHis").rand(1000,9999);
            
            if($this->input->post('email')){
                $this->m_pdf->pdf->Output("./temp/".$nome_boleto.".pdf");
            }else{
                #$this->m_pdf->pdf->Output($nome_boleto.".pdf", "D"); # Força download
                $this->m_pdf->pdf->Output();
            }
        
        }catch( Exception $e ){
            
            echo '<script>alert("Ocorreu ao gerar o PDF. Se o erro persistir, entre em contato com o suporte, dizendo em que condições este erro aconteceu.");</script>';
        }
        
        if($this->input->post('email')){
            
            $titulo = utf8_decode("SIM - 2º via de boleto"); 
            
            $msg = utf8_decode(msgEmailSegundaVia($dadosSacado->NOME, $dadosTitulo->DATA_VENCIMENTO));
            
            $this->load->helper("email");  
            
            $status = enviaEmail('Sim TV', 'naoresponda@simtv.com.br', $this->input->post('email'), $titulo, $msg, $nome_boleto);
            
            if($status){
                $sair = "window.close();";
                echo '<script>alert("A 2º via do boleto foi enviado com sucesso para o email:\n'.$this->input->post('email').'");'.$sair.'</script>';
            }else{
                echo '<script>alert("Ocorreu um erro ao enviar o boleto por e-mail. Se o erro persistir, entre em contato com o suporte, dizendo em que condições este erro aconteceu.");</script>';
            }           
            
            @unlink("./temp/".$nome_boleto.".pdf");
        }       
        
    }
    
    /**
     * Titulo::segundaViaPdf()
     * 
     * Gera o PDF da segunda no navegador ou envia por e-mail dependendo do que é informado
     * 
     * @return
     */
    public function segundaViaPdfPaga(){
        
        $this->load->helper("titulo");
        $this->load->helper("msgs_email");
        
        #$_POST['permissor'] = 61;
        #$_POST['titulo'] = 3978011;
        #$_POST['email'] = 'tiago.costa@simtv.com.br';
        
        if(!$this->input->post('permissor') or !$this->input->post('titulo')){
            echo json_encode(array('error' => 'Passe os parâmetros'));
            exit();
        }
        /*
        $verificaTitulo = verificaSegundaVia($this->input->post('permissor'), $this->input->post('titulo'), 'prod');
        
        if($verificaTitulo != 0){
            echo json_encode(array('error' => 'Não foi possível abrir a segunda via desse título.'));
            exit();
        }
        */
        $dadosSacado = $this->titulo->dadosSacadoTitulo();
        $dadosTitulo = $this->titulo->datosTituloPago();
        $itensTitulo = $this->titulo->itensFaturaTitulo();
        #echo '<pre>'; print_r($dadosTitulo); exit();
        if(!$dadosSacado or !$dadosTitulo or !$itensTitulo){ 
            echo json_encode(array('error' => 'Nada encontrado'));
            exit();
        }
        
        $dados['dadosCedente'] = dadosCedente($this->input->post('permissor'));
        $dados['dadosSacado'] = $dadosSacado;
        $dados['dadosTitulo'] = $dadosTitulo;
        $dados['itensTitulo'] = $itensTitulo;
        
        if($dados['dadosTitulo']->CODIGO_BANCO == 237 or $dados['dadosTitulo']->CODIGO_BANCO == 707)
        {
            $codigobanco = 237;
        }else
        {
            $codigobanco = $dados['dadosTitulo']->CODIGO_BANCO;
        }
        
        $dados['logoPrincipal'] = base_url('assets/titulo/images/logoSimTv.jpg');
        $dados['logoBanco'] = logo($this->input->post('permissor'));
        $dados['codigo_banco_com_dv'] = geraCodigoBanco($codigobanco);
        $dados['local_pagamento'] = 'Pagável preferencialmente no banco emissor.';
        $dados['dadosFixos'] = dadosFixos();

        $html=$this->load->view('titulo/view_segunda_via_paga', $dados, true);
        
        try{
        
            //load mPDF library
    		$this->load->library('m_pdf');
            
            $this->m_pdf->pdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
            $stylesheet1 = file_get_contents('./assets/titulo/css/styles.css');
            $this->m_pdf->pdf->WriteHTML($stylesheet1,1);
            $stylesheet2 = file_get_contents('./assets/titulo/css/personalizado.css');
            $this->m_pdf->pdf->WriteHTML($stylesheet2,1);
           //generate the PDF from the given html
    		$this->m_pdf->pdf->WriteHTML($html);
    
            //download it.
            $nome_boleto = date("YmdHis").rand(1000,9999);
            
            if($this->input->post('email')){
                $this->m_pdf->pdf->Output("./temp/".$nome_boleto.".pdf");
            }else{
                #$this->m_pdf->pdf->Output($nome_boleto.".pdf", "D"); # Força download
                $this->m_pdf->pdf->Output();
            }
        
        }catch( Exception $e ){
            
            echo '<script>alert("Ocorreu ao gerar o PDF. Se o erro persistir, entre em contato com o suporte, dizendo em que condições este erro aconteceu.");</script>';
        }
        
        if($this->input->post('email')){
            
            $titulo = utf8_decode("SIM - 2º via de boleto"); 
            
            $msg = utf8_decode(msgEmailSegundaVia($dadosSacado->NOME, $dadosTitulo->DATA_VENCIMENTO));
            
            $this->load->helper("email");  
            
            $status = enviaEmail('Sim TV', 'naoresponda@simtv.com.br', $this->input->post('email'), $titulo, $msg, $nome_boleto);
            
            if($status){
                $sair = "window.close();";
                echo '<script>alert("A 2º via do boleto foi enviado com sucesso para o email:\n'.$this->input->post('email').'");'.$sair.'</script>';
            }else{
                echo '<script>alert("Ocorreu um erro ao enviar o boleto por e-mail. Se o erro persistir, entre em contato com o suporte, dizendo em que condições este erro aconteceu.");</script>';
            }           
            
            @unlink("./temp/".$nome_boleto.".pdf");
        }        
        
    }
    
    public function testeEmail(){
        
        $this->load->library('email');
        $this->load->helper("msgs_email");        
        $this->email->initialize(); // Aqui carrega todo config criado anteriormente
        $this->email->from('ti@simtv.com.br', 'Equipe TI informa');
        $this->email->to('tiago.costa@simtv.com.br'); 
        #$this->email->cc('outro@outro-site.com'); 
        #$this->email->bcc('fulano@qualquer-site.com'); 
        
        #$this->email->attach('./temp/201601191314554488.pdf');
        
        $titulo = utf8_encode("So teste"); 
        $msg = msgEmailSegundaVia('Tiago Silva Costa', '20/01/2016');
        
        $this->email->subject($titulo);
        $this->email->message($msg);	
        
        $this->email->send();
        
        #@unlink("./temp/201601191314554488.pdf");
        
    }
    
}