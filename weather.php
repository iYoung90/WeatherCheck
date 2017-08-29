<?php

	$weather = "";
	$error = "";
	
	$cityName = "";

	if ($_GET){

		$cityName = $_GET['city'];
		$cityNamed = str_replace(' ', '', $cityName);

		if ($_GET['city']){
			//Above can be done differently, so we wouldn't need teh initial check first line use if(array_key_exists('city', $_GET)) also put same condition inside input value in form.
			$file_headers = @get_headers("http://www.weather-forecast.com/locations/".$cityNamed."/forecasts/latest");

			if ($file_headers[0] == 'HTTP/1.1 404 Not Found'){
				$error = " not found, please enter a valid city";
			}else {

		$forecastPage = file_get_contents("http://www.weather-forecast.com/locations/".$cityNamed."/forecasts/latest");

		$pageArray = explode('7 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);

		if (sizeof ($pageArray) > 1){

		$secondPageArray = explode('</span></span></span>', $pageArray[1]);

		if (sizeof ($secondPageArray) > 1){

		$weather = $secondPageArray[0];
	} else {
		$error = " not found, please enter a valid city";
	}
	} else {
		$error = " not found, please enter a valid city";
	}
	}
}

}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <style type="text/css">
    	html{
    		background: url(background.jpg) no-repeat center center fixed;
    		-webkit-background-size: cover;
    		-moz-background-size: cover;
    		-o-background-size: cover;
    		background-size: cover;
    	}

    	body{
    		background: none;
    	}
    </style>
  </head>
  <body>
  	<div class="container-fluid" style="text-align: center; margin-top: 100px; width: 50%;">
  		<div style="margin-bottom: 50px;">
  			<h1 style="color: #1d5cc1;">What's The Weather?</h1>
  			<label for="city" style="color: #1d5cc1;"><strong>Enter the name of a city</strong></label>
  		</div>
  		
  		<form>
  			<div class="form-group" style="margin-bottom: 50px;">
  				<input type="text" class="form-control" name="city" id="city" placeholder="e.g Lagos, Tokyo" value="<?php echo $cityName; ?>">
  			</div>
  			<button type="submit" class="btn btn-primary">Submit</button>
  		</form>

  		<div id="weather" style="margin-top: 15px;">
  			<?php

  				if ($_GET){

  					$cityName = $_GET['city'];
  				if ($weather){
  					echo '<div class="alert alert-success" role="alert"><strong>'.$cityName. '\'s weather: '.'</strong>'.$weather.'</div>';
  				} elseif ($error){
  					echo '<div class="alert alert-danger" role="alert"><strong>'.$cityName. '</strong>'.$error.'</div>';
  				}

  				}

  			?>
  		</div>
  		
  	</div>

    
    <!-- <div style="height: 200px;">
    	<p>
    		
    	</p>
    </div> -->

    <div style="margin-bottom: 0;margin-top: 170px;">
    	
    	<a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px;" href="https://unsplash.com/@hashwhole?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from hash whole.studios"><span style="display:inline-block;padding:2px 3px;"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white;" viewBox="0 0 32 32"><title></title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px;">hash whole.studios</span></a>

    </div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>