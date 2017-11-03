<?php
//session_destroy();
session_start();

    echo'
    <div id="loginform">
    <form method="post">
        <p>Please enter your name to continue:</p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
    </div>
    ';
    $name="";
  function write(){
	$text=$_POST["msg"];
	$fp = fopen("log.html", 'a');
	fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
	fclose($fp);
  }

  if(isset($_GET['logout'])){ 

    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
    fclose($fp);
     
    session_destroy();
    header("Location: index.php");
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
    	echo "<script>
    	document.body.innerHTML = '';
    	</script>";
		$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
		$name=$_SESSION['name'];
		$fp = fopen("log.html", 'a');
        fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has joined the chat session.</i><br></div>");
        fclose($fp);
		echo'<div>
		<center><h2><b>WELCOME, </b><b>' .$_SESSION["name"].'</b></h2></center>
		</div>
	';	
	$contents="";
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
    //echo $contents;
}
	echo "<div style='margin-left:5%;width:80%;border:solid;height:70%;overflow:auto;padding:10px;background-color:#f2f2f2;color:black' id='chatbox'>
	<p>".$contents."</p>
	</div>";

	echo "<form method='post' style='margin-left:10%'>
			<input type='text' name='msg' placeholder='your message here...' style='width:70%;padding:5px'>
			<input type='submit' name='send' value='ok' style='padding:5px'>
	</form>";

	echo "<div style='float:right;margin-right:10%'><form method='get'>

		<input type='submit' name='logout' value='Log Out' >
	</form></div>";

    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}

if(isset($_POST["send"])){
		if ($_POST["msg"]!="") {
			write();
			    	echo "<script>
    	document.body.innerHTML = '';
    	</script>";
        //$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
		echo'<div>
		<center><h2><b>WELCOME, </b><b>'.$name.'</b></h2></center>
		</div>
	';	
	$contents="";
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
    //echo $contents;
}
	echo "<div style='margin-left:5%;width:80%;border:solid;height:70%;overflow:auto;padding:10px;background-color:#f2f2f2;color:black' id='chatbox'>
	<p>".$contents."</p>
	</div>";

	echo "<form method='post' style='margin-left:10%'>
			<input type='text' name='msg' placeholder='your message here...' style='width:70%;padding:5px'>
			<input type='submit' name='send' value='ok' style='padding:5px'>
	</form>";

	echo "<div style='float:right;margin-right:10%'><form method='get'>
		<input type='submit' name='logout' value='Log Out' >
	</form></div>";

		}
	}
?>