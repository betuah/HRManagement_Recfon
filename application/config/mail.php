<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $config['mail_config'] = [ 
        'mailtype'      => 'html',
        'charset'       => 'utf-8',
        'MIME-Version'  => '1.0',
        'wordwrap'	    => TRUE,
        'protocol'      => 'smtp',
        'smtp_host'     => 'ssl://smtp.gmail.com',
        'smtp_user'     => 'dev@seameo-recfon.org',    
        'smtp_pass'     => 'nutr1t10n',        
        'smtp_port'     => 465,
        'crlf'          => "\r\n",
        'newline'       => "\r\n",
    ];
