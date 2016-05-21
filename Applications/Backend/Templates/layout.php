<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>
            <?php if (!isset($title)) { ?>
                Mon super site
            <?php } else { echo $title; } ?>
        </title>
        
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />        
        <link rel="stylesheet" href="/css/Envision.css" type="text/css" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    </head>
    
    <body>
        <div id="wrap">
            <div id="header">
                <h1 id="logo-text"><a href="/">Mon super site</a></h1>
                <p id="slogan">Comment ça ! il n'y a presque rien  ?</p>
            </div>
            
            <div  id="menu">
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <?php if ($user->isAuthenticated()) { ?>
                    <li><a href="/admin/">Admin</a></li>
                    <li><a href="/admin/news-insert.html">Ajouter une news</a></li>
                    <li><a href="/admin/equipes">Equipes</a></li>
                    <li><a href="/admin/matchs">Matchs</a></li>
                    <?php } ?>
                </ul>
            </div>
            
            <div id="content-wrap">
                <div id="main">
                    <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
                    
                    <?php echo $content; ?>
                </div>
            </div>
        
            <div id="footer"></div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="/js/bootstrap.js"></script>
        <script type="text/javascript">
            $("document").ready(function() {
                $("#datepicker").datepicker();
            });
        </script>
    </body>
</html>
