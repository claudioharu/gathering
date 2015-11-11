
<style>
@font-face {
      font-family: 'fontello';
      src: url('./font/fontello.eot?93932919');
      src: url('./font/fontello.eot?93932919#iefix') format('embedded-opentype'),
           url('./font/fontello.woff?93932919') format('woff'),
           url('./font/fontello.ttf?93932919') format('truetype'),
           url('./font/fontello.svg?93932919#fontello') format('svg');
      font-weight: normal;
      font-style: normal;
    }
     
     
    .demo-icon
    {
      font-family: "fontello";
      font-style: normal;
      font-weight: normal;
      speak: none;
     
      display: inline-block;
      text-decoration: inherit;
      width: 1em;
      margin-right: .2em;
      text-align: center;
      /* opacity: .8; */
     
      /* For safety - reset parent styles, that can break glyph codes*/
      font-variant: normal;
      text-transform: none;
     
      /* fix buttons height, for twitter bootstrap */
      line-height: 1em;
     
      /* Animation center compensation - margins should be symmetric */
      /* remove if not needed */
      margin-left: .2em;
     
      /* You can be more comfortable with increased icons size */
      /* font-size: 120%; */
     
      /* Font smoothing. That was taken from TWBS */
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
     
      /* Uncomment for 3D effect */
      /* text-shadow: 1px 1px 1px rgba(127, 127, 127, 0.3); */
    }
	
     </style>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="search2.css">
<link rel="stylesheet" href="css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
<script  src="jquery.js"></script>

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">			
			<i class="demo-icon icon-cartoons1" style="font-size:100px; color:black">&#xe800;</i> 
			<h1><a href="./visualizer.php">MangaVis</a></h1>
			<!-- <span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a></span> -->
		</div>
		<div id="triangle-up"></div>
	</div>
</div>
<div id="menu-wrapper">
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="./visualizer.php" accesskey="1" title="">Home</a></li>
				<li><a href="./database.php" accesskey="2" title="">Databases</a></li>
				<li><a href="./people.php" accesskey="3" title="">People</a></li>
				<li><a href="./mangas.php" accesskey="4" title="">Titles</a></li>
				<li><a href="./sitemap.php" accesskey="5" title="" style="color: #ff9000;">Sitemap</a></li>
				<li><a href="./about.php" accesskey="6" title="">About</a></li>
			</ul>
		</div>
</div>

<div id="wrapper">

	<div id="featured-wrapper">
		<div id="sitemap">
			<div> <a href="./visualizer.php"> <h2 class="tooltip" onmouseover="homeTip()" onmouseout="tip()">Home </h2></a> </div>
			<div> <a href="./database.php"> <h2 class="tooltip" onmouseover="dataTip()" onmouseout="tip()"> Databases </h2> </a>
				<p><a href="./database.php?set1=1#graphMenu" class="tooltip" onmouseover="dataTipChart1()" onmouseout="tip()"> Hottes types (visual) </a></p>
				<p><a href="./database.php?set2=1#graphMenu" class="tooltip" onmouseover="dataTipChart2()" onmouseout="tip()"> Hottes types (votes) </a> </p>
				<p><a href="./database.php?set3=1#graphMenu" class="tooltip" onmouseover="dataTipChart3()" onmouseout="tip()"> Treemap by categorie </a> </p>
				<p><a href="./database.php?set4=1#graphMenu" class="tooltip" onmouseover="dataTipChart4()" onmouseout="tip()"> 10 most popular </a> </p>
				<p><a href="./database.php?set5=1#graphMenu" class="tooltip" onmouseover="dataTipChart5()" onmouseout="tip()"> 10 less popular </a> </p>
			</div>
			<div><a href="./people.php"> <h2 class="tooltip" onmouseover="peopleTip()" onmouseout="tip()"> People </h2> </a>
				<p><a href="./people.php?set1=1#graphMenu" class="tooltip" onmouseover="peopleTipChart1()" onmouseout="tip()"> Genre popularity </a> </p>
				<p><a href="./people.php?set2=1#graphMenu" class="tooltip" onmouseover="peopleTipChart2()" onmouseout="tip()"> 10 most famous </a> </p>
				<p><a href="./peoplelist.php" class="tooltip" onmouseover="peopleTipList()" onmouseout="tip()"> List </a> </p>
			</div>
			<div> <a href="./mangas.php"> <h2 class="tooltip" onmouseover="titlesTip()" onmouseout="tip()"> Titles </h2> </a>
				<p><a href="./mangas.php?set1=1#graphMenu" class="tooltip" onmouseover="titlesTipChart1()" onmouseout="tip()"> 10 most popular titles </a> </p>
				<p><a href="./mangas.php?set2=1#graphMenu" class="tooltip" onmouseover="titlesTipChart2()" onmouseout="tip()"> 10 less popular titles </a> </p>
        <p><a href="./mangas.php?set3=1#graphMenu" class="tooltip" onmouseover="titlesTipChart3()" onmouseout="tip()"> Rank of all titles </a> </p>
				<p><a href="./mangalist.php" class="tooltip" onmouseover="titlesTipList()" onmouseout="tip()"> List </a> </p>
			</div>
			<div> <a href="./about.php"> <h2 class="tooltip" onmouseover="aboutTip()" onmouseout="tip()">About </h2> </a> </div>
		</div>	
		
		<span id="tip" class="tooltip follow-scroll"> Hover your mouse over the items to get a brief explanation of them. </span>
	</div>
</div>	

</div>
<div id="copyright" class="container">
<p>MangaVis icon was made by <a href="http://wwww.freepik.com">Freepik</a>, <a href="http://creativecommons.org/licenses/by/3.0/">licensed by CC BY 3.0 </a> | Visualizations were created using <a href="http://d3js.org/">d3.js</a> | Design by <a href="http://templated.co/">TEMPLATED.</a></p>
</div>

<script>
	
	function tip()
    {
        document.getElementById("tip").innerHTML="Hover your mouse over the items to get a brief explanation of them.";
    }
	
	function aboutTip()
    {
        document.getElementById("tip").innerHTML="On this page you will find information regarding the project's authors and contact info.";
    }
	
	
	function titlesTip()
    {
        document.getElementById("tip").innerHTML="In this section you can find information regarding the titles presented in our databases.";
    }
	
	function titlesTipChart1()
    {
        document.getElementById("tip").innerHTML='Bar chart showing the top 10 most popular titles.';
    }
	
	function titlesTipChart2()
    {
        document.getElementById("tip").innerHTML='Bar chart showing the top 10 less popular titles.';
    }

  function titlesTipChart3()
    {
        document.getElementById("tip").innerHTML='Bar chart showing the popularity of all titles. By using the context graph, you can select the amount of data displayed.';
    }
	
	function titlesTipList()
    {
        document.getElementById("tip").innerHTML='List of titles in the databases. By clicking on a title, you can see more information about it.';
    }
	
	function peopleTip()
    {
        document.getElementById("tip").innerHTML="In this section we present information about authors and artists featured in our databases.";
    }
	
	function peopleTipChart1()
    {
        document.getElementById("tip").innerHTML='Donut graph showing the genres with more views / votes.';
    }
	
	function peopleTipChart2()
    {
        document.getElementById("tip").innerHTML='Bar chart showing the rank of the most popular authors. By clicking on an author, you can view the popularity of previous works of this artist.';
    }
	
	function peopleTipList()
    {
        document.getElementById("tip").innerHTML='List of authors and artists in the databases. By clicking on a name, you can see more information about it.';
    }
	
	function dataTip()
    {
        document.getElementById("tip").innerHTML="In this section you will find general information about the databases.";
    }
	
	function dataTipChart1()
    {
        document.getElementById("tip").innerHTML='Heatmap containing the "hottest" combinations of categories according to the number of views.';
    }
	
	function dataTipChart2()
    {
        document.getElementById("tip").innerHTML='Heatmap containing the "hottest" combinations of categories according to the number of votes.';
    }
	
	function dataTipChart3()
    {
        document.getElementById("tip").innerHTML="Treemap showing the amount of titles and authors by category.";
    }
	
	function dataTipChart4()
    {
        document.getElementById("tip").innerHTML="Bar chart showing the top 10 most popular publishers.";
    }
	
	function dataTipChart5()
    {
        document.getElementById("tip").innerHTML="Bar chart showing the top 10 less popular publishers.";
    }
	
	function homeTip()
    {
        document.getElementById("tip").innerHTML="The website homepage. It contains information about the tool and a brief explanation of our goals.";
    }
    
	(function($) {
    var element = $('span.tooltip.follow-scroll'),
        originalY = element.offset().top;
    
    // Space between element and top of screen (when scrolling)
    var topMargin = 20;
    
    // Should probably be set in CSS; but here just for emphasis
    element.css('position', 'relative');
    
    $(window).on('scroll', function(event) {
        var scrollTop = $(window).scrollTop();
        
        element.stop(false, false).animate({
            top: scrollTop < originalY
                    ? 0
                    : scrollTop - originalY + topMargin
        }, 300);
    });
})(jQuery);

</script>
</body>
</html>
