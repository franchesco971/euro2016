<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset='UTF-8'">
        <meta name="Description" content="On parie tous sur l'EURO">
        <meta http-equiv="content-language" content="fr" />  
        <title><?php if (!isset($title)) { ?>
                Euro viapresse 2016
            <?php } else { echo $title; } ?></title>
        <link href="/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/css/flags.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            .container #head,.container #content,.container #footer
            {
                padding-left: 10px;
            }
            .container> .row> .col-md-3
            {
                width: 305px;
            }
            .container> .row>.col-md-6
            {
                width: 560px;
            }
            .container #perso
            {
                padding-right: 0px;
            }
        </style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    </head>
    
    <body class="txtnoire container center-block">
	<div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="row" id="head">
                    <?php 
                    if($user->isAuthenticated())
                    {?>
                    <div id="perso" class="col-md-6">
                        <h3>Bonjour <?php echo $_SESSION['user']->pseudo();?> <br><a href="deconnexion.html" class="txtnoire">D&eacute;connexion</a></h3>
                    </div>
                    <div id="menu" class="textbleu col-md-6">
                        <h3  class="">
                            <a href="/">Accueil</a> | 
                            <a href="/parier.html">Parier</a> | 
                            <a href="/reglement.html">R&egrave;glement</a>|
                            <a href="/classement.html">Classement</a>
                        </h2>
                    </div>

    <?php	
                    }
    ?>
                    
                </div>
                <div class="row" id="content" >
                        <b style="color:#F00;">
                                <?php 	if($user->hasFlash())
                            {
                                echo $user->getFlash();	
                            }
                    ?>
                    </b>
                    <?php echo $content; ?>

                </div>
            
                <div class="row" id="footer" style="padding-top:10px;">
                </div>
            </div>
            <div class="col-md-3"></div>
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
            <script src="/js/bootstrap.js"></script>
  	</body>
</html>