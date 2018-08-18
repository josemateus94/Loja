<?php
session_start();
class MensagemAlerta{    
    public static function mostraAlerta($tipo){          
        if (isset($_SESSION[$tipo])): ?>            
            <p class='alert-<?=$tipo?>'><?= $_SESSION[$tipo]; unset($_SESSION[$tipo]); ?></p>		
        <?php endif;
    }
}
