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
            /*.container #head,.container #content,.container #footer
            {
                padding-left: 20px;
            }*/
            /*.container> .row> .col-md-3
            {
                width: 305px;
            }
            .container> .row>.col-md-6
            {
                width: 560px;
            }*/
            .container #perso
            {
                padding-right: 0px;
            }
            #central{
                padding-left: 2.8em;
            }
            #menu
            {
                padding-top: 10px;
            }
        </style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    </head>
    
    <body class="txtnoire container center-block">
	<div class="row">
            <!--<div class="col-md-3"></div>-->
            <div id="central" class="col-md-6 col-md-offset-3 col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-2">
                <div class="row" id="head">
                    <?php 
                    if($user->isAuthenticated())
                    {?>
                    <div id="perso" class="col-md-6 col-xs-6 col-sm-6">
                        <h3>Bonjour <?php echo $_SESSION['user']->pseudo();?></h3>
                    </div>
                    <div id="menu" class="col-md-6 col-xs-6 col-sm-6">
                        <ul class="nav nav-pills">
                            <li role="menu" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                  Menu <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li role="Accueil" class="active"><a href="/">Accueil</a></li>
                                    <li role="Parier"><a href="/parier.html">Parier</a></li>
                                    <li role="reglement"><a href="/reglement.html">R&egrave;glement</a></li>
                                    <li role="Classement"><a href="/classement.html">Classement</a></li>
                                </ul>
                            </li>
                            <li><a href="/deconnexion.html" class="">D&eacute;connexion</a></li>
                            
                        </ul>
                    </div>
                        
    <?php	
                    }
    ?>
                    
                </div>
                <div class="row" id="content" >
                    <?php if($user->hasFlash())                               
                        {
                            echo '<b style="color:#F00;">'.$user->getFlash().'</b>';	
                        }
                    ?>
                    <?php echo $content; ?>

                </div>
            
                <div class="row" id="footer" style="padding-top:10px;">
                </div>
            </div>
            <!--<div class="col-md-3"></div>-->
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
            <script src="/js/bootstrap.js"></script>
  	</body>
</html>