<?php 
require_once("header.php");
	session_start();
	
	// if(!$_SESSION['uSer'])
	// {
	// 	header("location: login.php");
	// }
	
	//NOT FUNCTIONAL
	//these should be replaced with the money from the game
	$current_run=$_SESSION['wOn'];
	
	// mysql_connect("localhost", "root", "");
	// mysql_select_db("users_db");
	
	// $user_name=$_SESSION['uSer'];
	// $check_won="SELECT won FROM users WHERE user_name='$user_name'";
	// $run=mysql_query($check_won);
	// while($row=mysql_fetch_array($run))	
	// {
	// 	//it is in row[0] because of the limits which we set in $check_won (it is the only column which shows)
	// 	$user_won=$row[0];
	// }
	//$overall_run=$_SESSION['wOn']+$user_won;
	
	
	if(isset($_POST['return']))
	{
		//if this is set outside of the if(isset($_POST['wOn'])) it adds the value of $current_run twice
		//$query="UPDATE users SET won='$overall_run' WHERE user_name='$user_name'";
		//$execute=mysql_query($query);
		//echo $execute;
		//
		
		echo "<script>window.open('index.php', '_self')</script>";	
	}
	//problems with this button since the session
	if(isset($_POST['try_again']))
	{
		//if this is set outside of the if(isset($_POST['try_again'])) it adds the value of $current_run twice
		// $query="UPDATE users SET won='$overall_run' WHERE user_name='$user_name'";
		// $execute=mysql_query($query);
		// echo $execute;
		//
		
		//we use these in the game window (we refresh them to their original values - declared in the home page)
		$answer_check=0;
		$_SESSION['aNswer_check']=$answer_check;
		$question_check=0;
		$_SESSION['qUestion_check']=$question_check;
		$question_number=1;
		$_SESSION['qUestion_number']=$question_number;
		$prices_check=0;
		$_SESSION['pRices_check']=$question_check;
		// $call_help=0;
		// $_SESSION['cAll_help']=$call_help;
		// $fifty_fifty_help=0;
		// $_SESSION['fIfty_fifty_help']=$fifty_fifty_help;
		// $crowd_help=0;
		// $_SESSION['cRowd_help']=$crowd_help;
		echo "<script>window.open('game.php', '_self')</script>";			
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title> Резултат </title>
	</head>
	<style type='text/css'>
	b {
    color: #ddd;
   
}
#content{
	width: 700px;
	height: 200px;
	float:center;
	margin-left: 25%;
	background-color: transparent;

	}

		#div1
			{
				/* border: solid black; */
				float: left;
				top: 3%;
				left: 45%;
				right: 35%;
				position: absolute;
				font-size:18px;
				
			}

			#div2
			{
				/* border: solid black; */
				
				float: left;
				
				top: 5%;
				left: 8%;
				right: 50%;
				position: absolute;
				font-size:25px;
			}

			#div3
			{
				border-style: double;
				border-width: 5px;
			}

			#oval_parent
			{
			    background:white;
			    width:200px;
			    height:120px;
			    overflow:hidden;
			}

			#oval
			{
				/* */
			    width: 440px;
			    height: 200px;
			    margin:10px 0 0 -10px;  
			    background: white;
			    border-style: solid;
			    border-width: 5px;
			    border-color: black;
			    -webkit-border-radius: 100px / 50px;
			    border-radius: 100px / 50px;
			    text-align: center;
				vertical-align: middle;
				line-height: 20px;  
				top: 15%;
				left: 50%;
				right: 30%;

				-webkit-animation: fadein 3s;
				text-align: justify; 
				text-align: center;
				text-width: 150px;
				word-break: break-all;

				z-index: 100;
    			position: absolute;

    			display: table-cell;
				vertical-align: middle;
			}

			.outer {
			    display: table;
			    position: absolute;
			    height: 100%;
			    width: 100%;
			}

			.middle {
			    display: table-cell;
			    vertical-align: middle;
			}

			.inner {
			    margin-left: auto;
			    margin-right: auto; 
			    width: /*whatever width you want*/;
			}

			

			.oval-thought {
			  position:relative;
			  width:270px;
			  padding:50px 40px;
			  margin:1em auto 80px;
			  text-align:center;
			  color:#fff;
			  background:#075698;
			  /* css3 */
			  background:-webkit-gradient(linear, 0 0, 0 100%, from(#2e88c4), to(#075698));
			  background:-moz-linear-gradient(#2e88c4, #075698);
			  background:-o-linear-gradient(#2e88c4, #075698);
			  background:linear-gradient(#2e88c4, #075698);
			  /*
			  NOTES:
			  -webkit-border-radius:220px 120px; // produces oval in safari 4 and chrome 4
			  -webkit-border-radius:220px / 120px; // produces oval in chrome 4 (again!) but not supported in safari 4
			  Not correct application of the current spec, therefore, using longhand to avoid future problems with webkit corrects this
			  */
			  -webkit-border-top-left-radius:220px 120px;
			  -webkit-border-top-right-radius:220px 120px;
			  -webkit-border-bottom-right-radius:220px 120px;
			  -webkit-border-bottom-left-radius:220px 120px;
			  -moz-border-radius:220px / 120px;
			  border-radius:220px / 120px;
			  -webkit-animation: fadein 3s;
			}

			@-webkit-keyframes fadein {
			    from { opacity: 0; }
			    to   { opacity: 1; }
			}
	</style>

<body>
<section id="banner">
	<?php $test=$_SESSION['game_beaten']; ?>
	<img id="comic" width= "900px" height="500px" src='<?php if($_SESSION['game_beaten']==0){ echo "scene_lost.png"; } else{echo "scene_victory.png"; } ?>' />
<div id="content">
	<!-- <table  border='2' align='center' width='35%' style="border-style: solid; table-layout: fixed; "> -->
	<!-- bgcolor='#A6E7FF' style... border-color: #002E63;-->
	<!-- <tr> 
		<td colspan='2' align='center' >  <b> Резултат </b> </td>  
	</tr>  -->
	
	<tr> 
							<td colspan='2'> 
								<div style="height: 50px; width: 100%; text-align: center; "> 
									<div id="oval" style="font-size: 1.3vw;  margin-left: auto; margin-right: auto;width: 10em;">
										<div class="outer">
		    								<div class="middle">
		    									<div class="inner">  
		    										<?php 
		    											if($_SESSION['game_beaten']==0)
		    											{ 
		    												echo "Ужс, хем че не бих злодея, хем че и сега ще трябва да вадя парите за оправяне на самолета от моя джоб."; 
		    											}
		    											else
		    											{
		    												echo "Проклет да си агенте, може да си победил сега, но ще се върна.";
		    											}
		    											?><!-- "$num. "; $num++;  -->
							<!-- color: #FEFEFA; background-color: #00308F; -->

							<!--<td colspan='2' align='center' color='white'> Question --> <?php  //echo $question_count; $question_count++; ?> <!-- </td> -->
												</div>
											</div>
										</div> 
									</div>
								</div>
							</td>	
						</tr>
	<!-- 
	<tr align='center'>  bgcolor='#FFA700'
		<td colspan='2'>  <b> Стигна до ниво: </b>  </td> 
	</tr>
	 -->
	
		<form action='result.php' method='post'> 
			<!-- <td colspan='2'> <input type='text' style="height: 25px; width: 100%; text-align: center; color: white;" name='current_score' value='<?php echo $current_run; ?>'> </td> -->
  <!-- color: white; background-color: black; -->

	
		
	<!-- <tr align='center' bgcolor='#FFA700'>
		<td colspan='2'> <font size='4'> <b> Total won: </b> </font> </td> 
	</tr>
	
	<tr>
		<td colspan='2'> <input type='text' style="height: 25px; width: 100%; text-align: center; color: white; background-color: black;" name='overall_score' value='<?php echo $overall_run; ?>'> </td>
	</tr>
	
	<tr>
		<td colspan='2' height="100"> <br> </td>
	</tr> -->
	
	<tr>
		<td align='center' colspan='2'> <input type='submit' style="background-color: #A3741A; " name='return' value='<?php if($_SESSION['game_beaten']==0){ echo "Опитай пак."; }else{echo "Браво!"; } ?>'> </td>
		<!-- style="color: black; background-color: #FFA700; "  -->
		<!-- <td align='right'> <input type='submit' name='try_again' value='Опитай пак'> </td> -->
		<!-- style="color: black; background-color: #FFA700; "  -->
	</tr>
		</form>
	<!-- </table> -->
	</div>
	</section>
<?php
require_once("footer.php")	;
?>