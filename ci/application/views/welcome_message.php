<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>tech hackers PH </title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
<style> .brand { color: green; }</style>
<style>@import url(http://fonts.googleapis.com/css?family=Electrolize);</style>



<body id ="home">
<div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <a class="brand" href="#">techhackersph</a>
                   
<li class="active"><a href="http://jpalala.net/">home</a> </li>
<li><a href="http://jpalala.net/index.php/register">register</a> </li>
<?php
 if($this->session->userdata('user')) {
	echo '<li><a href="'. site_url('logout').'">logout</a></li>';

 } else {
	echo '<li><a href="',site_url('logout'). '>">login</a></li>';

 }
 ?>
                </ul>
            </div>
        </div>
</div>
      <div id="header">
        <h1 style="font-family: 'Electrolize', sans-serif;color:green"><span class="highlight">
	<a href="<?php echo base_url(); ?>">Philippine Tech Hackers</a>
		</span></h1>
		<h2>Share your tech news, discoveries, and blogs</h2>
	</div>

</div>

<div id="container" class="row">
       
		<div id="news_items" class="span8">
		<?php
		if(isset($newsItems) && count($newsItems) > 0 ):
			foreach($newsItems as $news):
				echo '<div class="news"> 
						<a href="' . $news['url'] . '">'. $news['title'] . '</a>'
						. $news['comment_count'] . ' <a data="'. $news['id'] .'" href="'. site_url('comment/'.$news['id']) .'">comments </a></div>';
			endforeach;
		endif;
		?>
		
		</div>

	   <div class="span4"> <h3 id="events">Events</h3>
			<p><a href="http://manila.startupweekend.org">Startup Weekend Apr 26</a></p>
        </div>
 <p class="footer">Page rendered in <strong>0.2446</strong> seconds. All rights reserved &copy 2013 Tech Hackers Philippines</a></p>

</div>

</body>
</html>
