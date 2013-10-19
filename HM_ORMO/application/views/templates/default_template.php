<!-- HTML 5 -->
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<title>ORMO TESZTFELADAT</title>
	<!-- Own content -->
	<link rel="stylesheet" href="<?php ECHO base_url().APPPATH."css/style.css"; ?>">
	<!-- ENDS Own content -->
	
	<!-- Third party content -->
	  <!-- CSS -->
	  <link rel="stylesheet" href="<?php ECHO base_url().APPPATH."third_party/in-admin-panel/style.css"; ?>">
	  <!-- ENDS CSS -->
	  
	  <!-- Analog Clock -->
	  <script src="<?php ECHO base_url().APPPATH."third_party/in-admin-panel/clockp.js"; ?>"></script>
	  <script src="<?php ECHO base_url().APPPATH."third_party/in-admin-panel/clockh.js"; ?>"></script> 
	  <!-- ENDS Analog Clock -->
	
	  <!-- jQuery -->
	  <script src="<?php ECHO base_url().APPPATH."third_party/jquery-1.8.2/jquery-1.8.2.min.js"; ?>"></script>
	  <link rel="stylesheet" href="<?php ECHO base_url().APPPATH."third_party/jquery.ui-1.9.1/css/start/jquery-ui-1.9.1.min.css"; ?>">
	  <script src="<?php ECHO base_url().APPPATH."third_party/jquery.ui-1.9.1/js/jquery-ui-1.9.1.min.js"; ?>"></script>
	  <!-- ENDS jQuery -->
	
	  <!-- Niceforms -->
	  <link rel="stylesheet" media="all" href="<?php ECHO base_url().APPPATH."third_party/in-admin-panel/niceforms-default.css"; ?>">
	  <script type="text/javascript" src="<?php ECHO base_url().APPPATH."third_party/in-admin-panel/niceforms.js"; ?>"></script>
	  <!-- ENDS Niceforms -->
	  
	  <!-- LighView -->
	  <link rel="stylesheet" href="<?php ECHO base_url().APPPATH."third_party/lightview-3.2.5/css/lightview/lightview.css"; ?>">
	  <!--[if lt IE 9]>
	    <script src="<?php ECHO base_url().APPPATH."third_party/lightview-3.2.5/js/excanvas/excanvas.js"; ?>"></script>
	  <![endif]-->
	  <script src="<?php ECHO base_url().APPPATH."third_party/lightview-3.2.5/js/lightview/lightview.js"; ?>"></script>
	  <script src="<?php ECHO base_url().APPPATH."third_party/lightview-3.2.5/js/spinners/spinners.min.js"; ?>"></script>
	  <!-- ENDS LighView -->
	  
	  <!-- JS -->
	  
	  <!-- ENDS JS -->
	<!-- ENDS Third party content -->
	
	<!-- Own content -->
    <script type="text/javascript" src="<?php ECHO base_url().APPPATH."js/main.js"; ?>"></script>
	<?php ECHO (ISSET($header)) ? $header : ""; ?>
	<!-- ENDS Own content -->
  </head>
  
  <body>
    <div id="main_container">
	  <div class="header">
        <div class="logo">
	      <a href="#"><img src="<?php ECHO base_url().APPPATH."third_party/in-admin-panel/images/logo.gif"; ?>" alt="" title="" border="0"></a>
	    </div>
        <div class="right_header">
	      Welcome Admin,
	      <a href="#">Visit site</a>
		  |
		  <a href="#" class="messages">(3) Messages</a>
		  |
		  <a href="#" class="logout">Logout</a>
	    </div>
        <div id="clock_a"></div>
      </div>
	  <!-- ENDS div.header -->
    
      <div class="main_content">
        <div class="menu">
          <ul>
		    <li><?php ECHO anchor("club/index", "Csapatok", ARRAY("id" => "a_clubs")); ?></li>
			<li><a href="javascript:void(0)" id="a_new_club">Új csapat</a></li>
			<li><a href="javascript:void(0)" id="a_new_player">Új játékos</a></li>
		  </ul>
        </div> 
      
	    <div class="center_content">  
          <div class="left_content">
		    <div class="sidebarmenu">
			  <?php ECHO (ISSET($sidebar)) ? $sidebar : ""; ?>
            </div>
		    <!-- CONTENT REMOVED (sidebar boxes) -->
		  </div> 
		  <!-- ENDS div.left_content -->
      
		  <div class="right_content">
		    <?php ECHO (ISSET($content)) ? $content : ""; ?>
          </div>
	    </div>
	    <!-- ENDS div.center_content -->                 
      
        <div class="clear"></div>
      </div>
	  <!-- ENDS div.main_content -->                 
    
	  <div class="footer">
        <div class="left_footer">
	      IN ADMIN PANEL | Powered by
		  <a href="http://indeziner.com">INDEZINER</a>
	    </div>
        <div class="right_footer">
	      <a href="http://indeziner.com">
		    <img src="<?php ECHO base_url().APPPATH."third_party/in-admin-panel/images/indeziner_logo.gif"; ?>" alt="" title="" border="0" />
		  </a>
	    </div>
      </div>
	</div>
	<div id="dialog"></div>
  </body>
</html>