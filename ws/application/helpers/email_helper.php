<?php 

function enviaEmail($nomeDe = 'Sim TV - Ferramentas de Negócios', $emailDe = 'equipe.sistemas@simtv.com.br', $emailPara = '', $titulo = '', $texto = '', $anexo = false){
    
    $res =& get_instance();
    $res->load->library("My_phpmailer", '', 'phpMailer');
    
    $mail = $res->phpMailer->inicializar();
    
    $mail->From = $emailDe; // Remetente
    $mail->FromName = $nomeDe; // Remetente nome

    $mail->IsHTML(true);

    $mail->Subject = $titulo; // assunto
    $mail->Body = $texto; // Mensagem
    $mail->AddAddress($emailPara,''); // Email e nome do destino
    if($anexo){
        $mail->AddAttachment('./temp/'.$anexo.'.pdf', $anexo.'.pdf'  );
    }
    if($mail->Send()){
        if($anexo){
            apagaArquivo('./temp/'.$anexo.'.pdf');
        }
        return true;
    }else{
        #echo "Erro: " . $mail->ErrorInfo;
        return false;
    }
    
}

/**
     * Util::apagaArquivo()
     * 
     * Apaga arquivo
     * 
     * @return
     */
    function apagaArquivo($arquivo){
        
        if(@unlink($arquivo)){
            return true;
        }else{
           return false; 
        }
        
    }