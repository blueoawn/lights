<!DOCTYPE html>
<html>
	<head>
    <title>Lab 2</title>
	<script type="application/javascript">
     function sendAjax(url,method,str){
    var req = new XMLHttpRequest();
    req.open(method, url,true);
    req.setRequestHeader("Content-Type","application/json");
    req.send(str);
}
    function lightspazz(lightID){
    var lightOn = true;
    var bri = 255;
    var urlStr = "http://130.166.45.108/api/";
    var authCode = "lH7nZmlzj1fMbsjzOAyrs6sO24zAsMY--IiF59vH";
	var hue = 53498;
    urlStr += authCode;
    urlStr += "/lights/" + lightID + "/state";
    console.log(urlStr);
    sendAjax(urlStr,"PUT",JSON.stringify({"on" : lightOn , "bri" : bri , "hue" : hue }));
}
	function lightandcolor(lightID,color){
    var lightOn = true;
    var bri = 255;
    var urlStr = "http://130.166.45.108/api/";
    var authCode = "lH7nZmlzj1fMbsjzOAyrs6sO24zAsMY--IiF59vH";
	var hue = color;
    urlStr += authCode;
    urlStr += "/lights/" + lightID + "/state";
    console.log(urlStr);
    sendAjax(urlStr,"PUT",JSON.stringify({"on" : lightOn , "bri" : bri , "hue" : hue }));
}
    function lightsrcool(){
    lightspazz(5);
	setTimeout(lightspazz(5),600);
	setTimeout(halt(),1200);
	setTimeout(lightspazz(5),1800);
	setTimeout(halt(),2400);
	setTimeout(lightspazz(5),3200);
	setTimeout(halt(),4800);
	setTimeout(lightspazz(5),5400);
	}
	function halt(){
	var urlStr = "http://130.166.45.108/api/";
    var authCode = "lH7nZmlzj1fMbsjzOAyrs6sO24zAsMY--IiF59vH";
	var hue = 000;
    urlStr += authCode;
    urlStr += "/lights/" + 5 + "/state";
		sendAjax(urlStr,"PUT",JSON.stringify({"on" : false , "bri" : 0 , "hue" : hue }));
	}
	function ddosthemlights(){
	for(var i=0;i<12;i++){
		lightsout();
	}
	}
	function lightsout(){
	var bri = 0;
    var urlStr = "http://130.166.45.108/api/";
	var urlStr2 = "http://130.166.45.108/api/";
	var urlStr3 = "http://130.166.45.108/api/";
	var urlStr4 = "http://130.166.45.108/api/";
	var urlStr5 = "http://130.166.45.108/api/";
	var urlStr6 = "http://130.166.45.108/api/";
    var authCode = "lH7nZmlzj1fMbsjzOAyrs6sO24zAsMY--IiF59vH";
	var hue = 000000;
    urlStr += authCode;
    urlStr += "/lights/" + 1 + "/state";
    urlStr2 += authCode;
    urlStr2 += "/lights/" + 2 + "/state";
    urlStr3 += authCode;
    urlStr3 += "/lights/" + 3 + "/state";
	urlStr4 += authCode;
    urlStr4 += "/lights/" + 4 + "/state";
    urlStr5 += authCode;
	urlStr5 += "/lights/" + 5 + "/state";
    urlStr6 += authCode;
	urlStr6 += "/lights/" + 6 + "/state";
    console.log(urlStr);
    sendAjax(urlStr,"PUT",JSON.stringify({"on" : false , "bri" : bri , "hue" : hue }));
    sendAjax(urlStr2,"PUT",JSON.stringify({"on" : false , "bri" : bri , "hue" : hue }));
    sendAjax(urlStr3,"PUT",JSON.stringify({"on" : false , "bri" : bri , "hue" : hue }));
	sendAjax(urlStr4,"PUT",JSON.stringify({"on" : false , "bri" : bri , "hue" : hue }));
    sendAjax(urlStr5,"PUT",JSON.stringify({"on" : false , "bri" : bri , "hue" : hue }));
    sendAjax(urlStr6,"PUT",JSON.stringify({"on" : false , "bri" : bri , "hue" : hue }));
		}
</script>
    </head>
	<body>
		
	<br>
	
		
		<?php
			$pageNum = 0;
			if( isset($_GET["page"]) )
			{
				$pageNum = $_GET["page"];
				settype($pageNum, "integer");
			}
			else
			{
				$pageNum = 1;
			}

			if($pageNum > 5 || $pageNum < 1)
			{
				echo("<strong>Error...this page does not exist!</strong></body></html>");
				die();
			}

			echo ("<strong>Pg. $pageNum</strong>");
			if($pageNum == 1)
			{
		?>
			<form method="get" action="">

          <input type="hidden" name="page" value="2">
		  <input type="hidden" name="signup" value="1">
          <p><label>Username
            <input type="text" name="username">
          </label></p>
          <p><label>Password
            <input type="password" name="password">
          </label></p>
		  <p><label>Retype Password
		    <input type="password" name="repassword">
		  </label></p>
          <p><input type="submit" name ="submit" value="REGISTER"></p>
        </form>
		
		<br>
		<br>
		
		<form method="get" action="<?php ?>">

          <input type="hidden" name="page" value="3">
		  <input type="hidden" name="signin" value="1">
          <p><label>Username
            <input type="text" name="logusername">
          </label></p>
          <p><label>Password
            <input type="password" name="logpassword">
          </label></p>
          <p><input type="submit" name ="submit" value="LOGIN"></p>
        </form>
		<?php
			} else if($pageNum == 2){ // $pageNum == 2
			if (isset($_GET['signup'])){
				$dbusername = $dbpassword = "";
					if (isset($_GET["username"]) && isset($_GET["password"])){
						$dbusername = $_GET["username"];
						$dbpassword = $_GET["password"];
						$dbsalt = $_GET["repassword"];
						/* if($password != $dbsalt){
							die("<br>Passwords must match!</body></html>");
						} */
						$con = mysqli_connect("localhost","root","maria484","users");
						if (mysqli_connect_errno()){
							echo "Failed to connect to db." . mysqli_connect_errno();	
						}
					//$query = "INSERT INTO users ('userid', 'username', 'password', 'salt') VALUES (NULL, 
						mysqli_query($con, "INSERT INTO users (username,password,salt)
						VALUES ('$dbusername', '$dbpassword', '$dbsalt')");
					/* mysqli_real_query($con, "INSERT INTO users ('userid','username','pass','salt')
					VALUES (0, '$dbusername', '$dbpassword', '$dbsalt')"); */
						mysqli_close($con);
						
					}
					else{
						echo("<p><strong>Error...your info was not received properly...!</strong></p></body></html>");
						die();
					}
			}
		?>
			<p><strong>SUCCESSFUL ACCOUNT CREATION</strong></p>

			<form method="get" action="">				
				<input type="hidden" name="page" value="1">
				<p><input type="submit" value="Back to Page 1"></p>
			</form>
			
		<?php
					}
			 else {
				 if (isset($_GET["logusername"]) && isset($_GET["logpassword"])){
					 $logusername = $_GET["logusername"];
					 $logpassword = $_GET["logpassword"];
					 $con = mysqli_connect("localhost","root","maria484","users");
					 $checkuser = "SELECT * FROM users WHERE username LIKE \"" . $logusername . "\" AND password LIKE \"" . 
					 $logpassword . "\" ";
					 $result = mysqli_query($con, $checkuser);
					 $numRows = mysqli_num_rows($result);
					 if ($numRows >= 1){
						 if($logusername == "Admin" || $logusername == "Administrator"){//pg 4
							 
						 }
						 else{//pg 3
							?>
							 <p>SUCCESSFUL LOG IN</p>
							 
								<p id="thisistheone">wow wwowowowow</p>
								<button id = "button1" onClick="lightspazz(5)"> click </button>
								<button id = "button2" onClick="lightsrcool()"> another cool button </button>
								<button id = "button3" onClick="ddosthemlights()"> dangerous button </button>
								<button id = "button4" onClick="halt()"> HALT! YOU HAVE VIOLATED THE LAW! </button>
								<button id = "button5" onClick="lightsout()"> die </button>
								
								<form method="get" action="">				
									<input type="hidden" name="page" value="1">
									<p><input type="submit" value="LOGOUT"></p>
								</form>
							 
							 <?php
						 }
					 }
					 else{
						 echo ("<p>Died</p></body></html>");
						 						 
						 
						 die();
					 }
					 
				 }
			 }
		?>

		<hl><br><br><br>
	</body>
</html>
