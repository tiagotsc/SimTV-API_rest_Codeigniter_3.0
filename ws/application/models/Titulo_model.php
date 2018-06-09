<?php

/**
 * Titulo_model
 * 
 * Classe que realiza o tratamento do módulo de Log
 * 
 * @package   
 * @author Tiago Silva Costa
 * @version 2015
 * @access public
 */
class Titulo_model extends CI_Model{
	
    private $conexao;
    
	/**
	 * Titulo_model::__construct()
	 * 
	 * @return
	 */
	function __construct(){
		parent::__construct();    
        
        $this->conexao = $this->load->database('oracle', TRUE);
	}
    
    /**
     * Titulo_model::dadosTitulo()
     * 
     * Pega os dados do título
     * 
     * @return query
     */
    public function dadosTitulo(){
        
        $sql = "SELECT 
                		emconlindig AS linha_digitavel,
                		emconbarcode AS codigo_barra,
                		emconbcocod AS codigo_banco,
                		emconplacod AS agencia,
                		emconnrocta AS conta,
                		TO_CHAR(emfchcon, 'DD/MM/YYYY') AS data_geracao,
                		emconbcocarteira AS carteira,
                		emconvalenv AS valor,
                		TO_CHAR(emconfchval, 'DD/MM/YYYY') AS data_vencimento
                FROM emcont 
                WHERE percod = ".$this->input->post('permissor')." AND emnrocob = ".$this->input->post('titulo')." AND ROWNUM = 1 
                ORDER BY emfchcon DESC";
        
        return $this->conexao->query($sql)->row();
        
    }
    
    public function dadosSacadoTitulo(){
        
        $sql = "SELECT
                	A .PERCOD AS PERMISSOR,
                	E.EMNOSSONUMBCO AS NOSSO_NUMERO,
                	A .ABOCOD AS ASSINANTE,
                	A .ABONOMAPE AS NOME,
                	NVL(
                		TRIM(
                			NVL(TRIM(A .ABODOCNRO), A .ABORUC)
                		),
                		'-'
                	)AS CPF,
                	CASE
                	WHEN(TRIM(A .ABODOCNRO) IS NOT NULL)THEN
                		'F'
                	ELSE
                		'J'
                	END AS TPOCLIENTE,
                    TRIM(A.ABOCOBUF)UF,
                    TRIM(A.ABOCOBCIU)CIDADE,
                    TRIM(A.ABOCOBZIP)CEP,
                    TRIM(A.ABOCOBBAR)BAIRRO,
                    TRIM(A.ABOCOBDIR)ENDERECO,
                    TRIM(A.ABOCOBCOMP)COMPLEMENTO,
                    '-' AS NUMERO,
                    E.EMNROCOB TITULO,
                    SUM(EN.EMVALLIN)AS NUMVALOR,
                    E.EMFCHVTO VENCIMENTO,
                    E.EMLinDig
                FROM
                	ABONAD A,
                	ENVMEZ E,
                	ENMEDE EN
                WHERE
                	E.PERCOD = ".$this->input->post('permissor')."
                	AND E.EMNROCOB = ".$this->input->post('titulo')."
                	AND A.PERCOD = E.PERCOD
                	AND E.PERCOD = EN.PERCOD
                	AND A.ABOCOD = E.EMABOCOD
                	AND E.EMNROCOB = EN.EMNROCOB
                GROUP BY
                	A.PERCOD,
                	A.ABODOCNRO,
                	A.ABOCOD,
                	A.ABORUC,
                	A.ABODOCNRO,
                	A.ABOCOBUF,
                	A.ABOCOBCIU,
                	A.ABOCOBZIP,
                	A.ABOCOBBAR,
                	A.ABOCOBDIR,
                	A.ABOCOBCOMP,
                	E.EMNROCOB,
                	E.EMFCHVTO,
                	A.ABONOMAPE,
                	E.EMLinDig,
                		E.EMNOSSONUMBCO";
                        
        return $this->conexao->query($sql)->row();
        
    }
    
    public function itensFaturaTitulo(){
        
        $sql = "SELECT 
                		TO_CHAR(E.EMFCHLIN,'DD/MM/YYYY') DATA, 
                		C.COFAABOCOD COD_CONCEITO, 
                		--TO_CHAR(C.COFAABODSC) CONCEITO, 
                		TO_CHAR(TRIM(C.COFAABODSC)||'   -   '||E.EMCOMMOT) CONCEITO,
                		TO_CHAR(NVL(E.EMCOTNRO, '-')) REFERENCIA, 
                		EMVALLIN VALOR 
                FROM ENMEDE E, COFAABO C 
                WHERE E.PERCOD = ".$this->input->post('permissor')." AND E.EMNROCOB = ".$this->input->post('titulo')." AND E.emcofaabocod = C.COFAABOCOD
                UNION ALL
                SELECT 
                		TO_CHAR(EMFCHDOCPAG,'DD/MM/YYYY') DATA,
                		C.COFAABOCOD COD_CONCEITO, 
                		--TO_CHAR(C.COFAABODSC) CONCEITO,
                		TO_CHAR('CREDITO') CONCEITO,
                		TO_CHAR('NOTA DE CREDITO') REFERENCIA,
                		-EMIMPPAG
                FROM ENVREC E, FACLAB F, COFAABO C 
                WHERE E.percod = ".$this->input->post('permissor')."
                AND emnrocob = ".$this->input->post('titulo')."
                AND E.EMTPODOCPAG = 'N'
                AND E.EMNRODOCPAG = F.FACNRO
                AND E.PERCOD = F.PERCOD
                AND F.COFAABOCOD = C.COFAABOCOD
                AND FACTPO = 'N'";
                
        return $this->conexao->query($sql)->result();
        
    }
    
    /**
     * Titulo_model::datosTituloPago()
     * 
     * Pega os dados do título pago
     * 
     * @return query
     */
    public function datosTituloPago(){
     
        $sql = "SELECT 
                  EMLINDIG AS linha_digitavel,
                  '0' as codigo_barra,
                  EMBCOCOD AS codigo_banco,
                  '0' AS agencia,
                  '0' AS conta,
                  TO_CHAR(EMFCHREG, 'DD/MM/YYYY') AS data_geracao,
                  '0' AS carteira,
                  EMVALPAG AS valor,
                  TO_CHAR(EMFCHVTO, 'DD/MM/YYYY') AS data_vencimento
                FROM envmez 
                WHERE percod = ".$this->input->post('permissor')." AND emnrocob = ".$this->input->post('titulo')." AND ROWNUM = 1 
                ORDER BY EMFCHREG DESC";
        
        return $this->conexao->query($sql)->row();
        
    }

}