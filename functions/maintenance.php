<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php bloginfo('name') ?> - site en construction</title>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/maintenance.css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Coustard:400,900' rel='stylesheet' type='text/css'>
	
	<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<header>
	<h1><img src='<?php bloginfo('template_url') ?>/img/logo_company.png' alt="<?php bloginfo('name') ?>" /></h1>
</header>

<section>
	<article>
    	<h2>Maintenance</h2>
        <p>Désolé mais notre site est en cours de maintenance.<br /><br />Merci de votre compréhension !</p> 
        <a href="/wp-login.php" title="Se connecter">Admin login</a>
    </article>
</section>
</body>
</html>
