<?php

session_start();
if (array_key_exists("infos", $_REQUEST)){  

	if(isset($_REQUEST['infos'])){
		$search = $_REQUEST['infos'];
		// echo $search;
	}
}
?>

<!DOCTYPE html>

<html lang="en" class="wf-robotoslab-n7-active wf-exo2-n4-active wf-exo2-i4-active wf-exo2-n7-active wf-exo2-i7-active wf-active"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="https://mangadatabasevisualizations.wordpress.com/xmlrpc.php">

<title>manga database visualizations</title>
<script src="./mangadatabasevisualizations_files/webfont.js" type="text/javascript" async=""></script><script type="text/javascript">
  WebFontConfig = {"google":{"families":["Roboto+Slab:b:latin,latin-ext","Exo+2:r,i,b,bi:latin,latin-ext"]}};
  (function() {
    var wf = document.createElement('script');
    wf.src = 'https://s1.wp.com/wp-content/plugins/custom-fonts/js/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
	})();
</script><style id="jetpack-custom-fonts-css">.wf-active body, .wf-active button, .wf-active input, .wf-active select, .wf-active textarea{font-family:"Exo 2","Cabin", Helvetica, sans-serif}.wf-active blockquote cite{font-family:"Exo 2","Cabin", Helvetica, sans-serif}.wf-active .main-navigation a{}.wf-active .main-navigation a{}.wf-active .entry-content{}.wf-active .single .entry-content, .wf-active .page .page-content{}.wf-active .read-more{}.wf-active .entry-meta, .wf-active .site-info{}.wf-active .wp-caption-text, .wf-active .comment-metadata{}.wf-active .site-main .comment-navigation, .wf-active .site-main .posts-navigation, .wf-active .site-main .post-navigation{}.wf-active .widget-area, .wf-active .widget-area a, .wf-active #comments{}.wf-active div.sharedaddy h3.sd-title, .wf-active div#jp-relatedposts h3.jp-relatedposts-headline{font-family:"Exo 2","Cabin", Helvetica, sans-serif}.wf-active h1, .wf-active h2, .wf-active h3, .wf-active h4, .wf-active h5, .wf-active h6{font-family:"Roboto Slab","Alegreya", Georgia, serif;font-weight:700;font-style:normal}.wf-active h1{font-style:normal;font-weight:700}.wf-active h2{font-style:normal;font-weight:700}.wf-active h3{font-style:normal;font-weight:700}.wf-active h4{font-style:normal;font-weight:700}.wf-active h5, .wf-active h6{font-style:normal;font-weight:700}.wf-active blockquote{font-family:"Roboto Slab","Alegreya", Georgia, serif;font-style:normal;font-weight:700}.wf-active .widget-title{font-family:"Roboto Slab","Cabin", Helvetica, sans-serif;font-style:normal;font-weight:700}.wf-active .site-title{font-family:"Roboto Slab","Cabin", Helvetica, sans-serif;font-style:normal;font-weight:700}.wf-active .site-description{font-family:"Roboto Slab","Cabin", Helvetica, sans-serif;font-style:normal;font-weight:700}.wf-active .entry-title{font-family:"Roboto Slab","Cabin", Helvetica, sans-serif;font-style:normal;font-weight:700}.wf-active .page-title, .wf-active .page-title, .wf-active .single .entry-title{font-family:"Roboto Slab","Alegreya", Georgia, serif;font-style:normal;font-weight:700}.wf-active .project-title{font-family:"Roboto Slab","Cabin", Helvetica, sans-serif;font-weight:700;font-style:normal}</style>
<link rel="alternate" type="application/rss+xml" title="manga database visualizations » Feed" href="https://mangadatabasevisualizations.wordpress.com/feed/">
<link rel="alternate" type="application/rss+xml" title="manga database visualizations » Comments Feed" href="https://mangadatabasevisualizations.wordpress.com/comments/feed/">
<script type="text/javascript">
/* <![CDATA[ */
function addLoadEvent(func){var oldonload=window.onload;if(typeof window.onload!='function'){window.onload=func;}else{window.onload=function(){oldonload();func();}}}
/* ]]> */
</script>
<link rel="stylesheet" id="all-css-0" href="./mangadatabasevisualizations_files/smileyproject.css" type="text/css" media="all">
<link rel="stylesheet" id="open-sans-css" href="./mangadatabasevisualizations_files/css" type="text/css" media="all">
<link rel="stylesheet" id="all-css-2" href="./mangadatabasevisualizations_files/saved_resource" type="text/css" media="all">
<style id="argent-style-inline-css" type="text/css">
.site-branding { background-image: url(https://mangadatabasevisualizations.files.wordpress.com/2015/08/pink1.jpg); }
</style>
<link rel="stylesheet" id="argent-fonts-css" href="./mangadatabasevisualizations_files/css(1)" type="text/css" media="all">
<link rel="stylesheet" id="all-css-4" href="./mangadatabasevisualizations_files/saved_resource(1)" type="text/css" media="all">
<link rel="stylesheet" id="print-css-5" href="./mangadatabasevisualizations_files/global-print.css" type="text/css" media="print">
<link rel="stylesheet" id="all-css-6" href="./mangadatabasevisualizations_files/global.css" type="text/css" media="all">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:b%7CExo+2:r,i,b,bi&subset=latin,latin-ext,latin,latin-ext" media="all"><script type="text/javascript" src="./mangadatabasevisualizations_files/saved_resource(2)"></script><style type="text/css"></style>
<link rel="stylesheet" id="all-css-0" href="./mangadatabasevisualizations_files/style.css" type="text/css" media="all">
<!--[if lt IE 8]>
<link rel='stylesheet' id='highlander-comments-ie7-css'  href='https://s2.wp.com/wp-content/mu-plugins/highlander-comments/style-ie7.css?m=1351637563g&#038;ver=20110606' type='text/css' media='all' />
<![endif]-->
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://mangadatabasevisualizations.wordpress.com/xmlrpc.php?rsd">
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://s1.wp.com/wp-includes/wlwmanifest.xml"> 
<meta name="generator" content="WordPress.com">
<link rel="shortlink" href="http://wp.me/6zVMz">

<!-- Jetpack Open Graph Tags -->
<meta property="og:type" content="website">
<meta property="og:title" content="manga database visualizations">
<meta property="og:url" content="https://mangadatabasevisualizations.wordpress.com/">
<meta property="og:site_name" content="manga database visualizations">
<meta property="og:image" content="https://s0.wp.com/i/blank.jpg">

<!-- <link rel="openid.delegate" href="./mangadatabasevisualizations_files/mangadatabasevisualizations.html"> -->
	
		<style type="text/css" media="print">#wpadminbar { display:none; }</style>
<style type="text/css" media="screen">
	html { margin-top: 32px !important; }
	* html body { margin-top: 32px !important; }
	@media screen and ( max-width: 782px ) {
		html { margin-top: 46px !important; }
		* html body { margin-top: 46px !important; }
	}
</style>
<meta name="application-name" content="manga database visualizations"><meta name="msapplication-window" content="width=device-width;height=device-height"><meta name="msapplication-tooltip" content="Author posts, manage comments, and manage manga database visualizations."><meta name="msapplication-task" content="name=Write a post;action-uri=https://wordpress.com/post/97221615/new/;icon-uri=https://s2.wp.com/i/icons/post.ico"><meta name="msapplication-task" content="name=Moderate comments;action-uri=https://mangadatabasevisualizations.wordpress.com/wp-admin/edit-comments.php?comment_status=moderated;icon-uri=https://s0.wp.com/i/icons/comment.ico"><meta name="msapplication-task" content="name=Upload new media;action-uri=https://mangadatabasevisualizations.wordpress.com/wp-admin/media-new.php;icon-uri=https://s2.wp.com/i/icons/media.ico"><meta name="msapplication-task" content="name=Blog stats;action-uri=https://mangadatabasevisualizations.wordpress.com/wp-admin/index.php?page=stats;icon-uri=https://s1.wp.com/i/icons/stats.ico"><meta name="title" content="manga database visualizations on WordPress.com">
<style type="text/css" id="syntaxhighlighteranchor"></style>
<link rel="stylesheet" type="text/css" id="gravatar-card-css" href="./mangadatabasevisualizations_files/hovercard.css"><link rel="stylesheet" type="text/css" id="gravatar-card-services-css" href="./mangadatabasevisualizations_files/services.css"></head>
<link rel="stylesheet" type="text/css" href="./mangadatabasevisualizations_files/search.css">
<link rel="stylesheet" type="text/css" href="./mangadatabasevisualizations_files/search2.css">
<body class="home blog logged-in admin-bar custom-background mp6 customizer-styles-applied without-featured-image highlander-enabled highlander-light infinite-scroll neverending customize-support infinity-end">
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="https://mangadatabasevisualizations.wordpress.com/#content">Skip to content</a>

	<header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Menu</button>
			<div class="menu-main-container"><ul id="primary-menu" class="menu nav-menu" aria-expanded="false"><li id="menu-item-26" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-26"><a href="./mangadatabasevisualizations.php">Home</a></li>
<li id="menu-item-28" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-28"><a href="https://mangadatabasevisualizations.wordpress.com/databases/">Databases</a>
<ul class="sub-menu">
	<li id="menu-item-41" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-41"><a href="./mangafox.html">MangaFox</a></li>
	<li id="menu-item-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40"><a href="./mangahere.html">MangaHere</a></li>
	<li id="menu-item-39" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-39"><a href="./mangahost.html">MangaHost</a></li>
  <li id="menu-item-39" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-39"><a href="./myanimelist.html">Myanimelist</a></li>
</ul>
</li>
<li id="menu-item-27" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-27"><a href="https://mangadatabasevisualizations.wordpress.com/contact/">Contact</a></li>
<li>
  <div class="container-2">
   <form name="form1" action="search.php"  >
      <!-- <span class="icon"><i class="fa fa-search"></i></span> -->
      <input name="infos" type="search" id="search" placeholder="Search..."/>
      <input type="submit" style="visibility: hidden; position: absolute;"/>
  </form>
  </div>
</li>
</ul>

</div>		

</nav><!-- #site-navigation -->

		<div class="site-branding">
			<h1 class="site-title"><a href="./mangadatabasevisualizations.php" rel="home">manga database visualizations</a></h1>
			<h2 class="site-description"></h2>
		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<article id="post-2" class="post-2 post type-post status-publish format-standard hentry">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<script language="php">
			
			// echo $search;


			$servername = "localhost";
			$username = "root";
			$password = "123456";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=mangas", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			}
			catch(PDOException $e)
			{
				echo "Connection failed: " . $e->getMessage();
			}

			$sql = 'SELECT name, img FROM MangaFox_Mangas WHERE name  LIKE  "%'. $search . '%"';
			// $sql = 'SELECT name, img FROM MangaFox_Mangas WHERE name  LIKE  "%naruto%"';
			$result = $conn->query($sql);

			if (count($result) > 0){
				foreach ($result as $row){

					print '<tr>';
					print '<td class="borderClass" align="center">';
					print '<a href="' . $row["img"] . '">';
					print '<div class="img" style="padding: 10px; float:left;">';
					print '<img src="' . $row["img"] . 'style=" width:100px; height:124px; float:left;" width = "100"  >';
					print '</div>';
					print '</a>';
					print '</td>';
					print '<td valign="top" >';
					print '<div class="name" style="float:left; margin-bottom:140px">';
					print $row ["name"]; 
					print "</div>";
					print '</td>';
					print '</tr>';
				}

			}
			// print '</ul>';
			
		
	</script>
	</tbody>
	</table>	

	
</article><!-- #post-## -->

		
	</main><!-- #main -->
	</div><!-- #primary -->


	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a> Manga Database Visualizations</a>.
			</br>
			<a> @Haru</a>.		
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

		


</body></html>
