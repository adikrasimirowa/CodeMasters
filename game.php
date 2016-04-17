<?php
require_once('header.php');
	session_start();

	
	
	// if(!$_SESSION['uSer'])
	// {
	// 	header("location: login.php");
	// }
?>

<!DOCTYPE html>
<html> <!-- NOT FUNCTIONAL -->
	<head>	
		<meta charset="UTF-8">
		<title> Игра </title>
		<style type="text/css">
		.question
		{
			position:absolute;
			margin-top: 1%;
			margin-left: 49%;
			line-height:20px;
			height:40px;
		


		}
		#comic{
			position: relative;
			
			 float:left; 
			 margin-left: 20%;
			 padding-right: 5px;
			 padding-bottom: 5px;
			  z-index: 0.5;

			}
			#forma{
			position: relative;
			}
			#progress
			{ margin-left: 2%;
				position: absolute;


			}
			#answers
			{
				margin-top: 10px;
			}
			.talk
			{
				position:absolute;
			
			margin-left: 10%;
			line-height:20px;
			height:40px;


			}

			/* LINEEEEEEEEE*/

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
	</head>
	
	<?php
		//$question_worth=$_SESSION['current_level'];
		//echo "<script type='text/css> body{ background:url('scene_".$question_worth."')}</script>'"
	
	?>
	<section id="banner">
		<img id="comic" width= "900px" height="500px" src='<?php echo  "scene_".$_SESSION['current_level'].".png"; ?>' />

	
	<!--the values of the submit buttons should be changed to the ones of a database(localhost/phpmyadmin...)-->
		<!--<table width='100%' cellspacing='8' border='0' bgcolor='purple' align='center' style=" position: absolute; bottom: 0px; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);"> -->
		<!-- <table border='1' bgcolor='black' style=" border-style: solid; border-color: #FFFFFF; bottom: 2px; height: 40px; margin-top: 40px; text-align: center; vertical-align: middle; position: fixed; width: 99%; "> -->
		<!-- "table-layout: fixed" makes the spacing equal-->
		
		<!-- !!! <table border='4' style=" border-style: bottom: 2px; height: 40px; margin-top: 40px; text-align: center; vertical-align: middle; position: fixed; width: 99%; table-layout: fixed;">  <!-- bgcolor='lightblue' align='center' --> 
		
		<!--bgcolor='lightblue' style="solid; border-color: #7CB9E8;"-->	
			<div id="forma">
			<form action='' method='post'>
				
				<?php
					mysql_connect("localhost", "root", "");
					mysql_set_charset("utf8");
					mysql_select_db("game_db");
					
					$a_check=$_SESSION['aNswer_check'];
					$query="SELECT * FROM answers WHERE answer_group_id>$a_check";
				
					$run=mysql_query($query);
					
					$question_count=1;
					//$dialogue_progress=$_SESSION['dialogue'];
					
					$q_check=$_SESSION['qUestion_check'];
					$query_q="SELECT * FROM questions WHERE question_id>$q_check";							
						
					$run_q=mysql_query($query_q);
									
					//$num=$_SESSION['qUestion_number'];
						
					//I don't think that this should be done with a 'while'		
					$row=mysql_fetch_array($run);
					$row_q=mysql_fetch_array($run_q);
					
						$answer_group_id=$row[0];
						$answer_a=$row[1];
						$answer_b=$row[2];
						$answer_c=$row[3];
						$answer_d=$row[4];
						$correct_answer=$row[5];
						$correct_answer_response=$row[6];
						$wrong_answer_response=$row[7];
						$their_dialogue=$row[8];
						$our_dialogue=$row[9];
						
						$question=$row_q[1];
						$question_worth=$row_q[2];
						$question_group=$row_q[3];
						$question_dialogue=$row_q[4];
						$check_for_end=$row_q[5];
						$speech_boxes=$row_q[6];
						$reached_ending_check=$row_q[7];

						$_SESSION['box_type']=$question_dialogue;
						//echo "<script>alert('$correct_answer')</script>";

				?>
				
					<!-- The helpers and the prices are currently not implemented in a table (they should be) -->
					<!-- <tr> -->	
					<?php
						//we separate these variables ($row_q=>$row_questions) so there is no conflict
						$prices_check=$_SESSION['pRices_check'];
						$query_prices="SELECT * FROM questions WHERE question_id>$prices_check";							
					
						$run_prices=mysql_query($query_prices);
					?>
					<!-- <tr> --> 
					
					
					<br>
					<?php
						$repeat=0;
						
						while($row_prices=mysql_fetch_array($run_prices))
						{
							$current_price=$row_prices[2];
							
							if($current_price==$question_worth && $repeat==0 && $_SESSION['beginning_check']!=1)
							{
								if($check_for_end!=1)
								{
								 	$_SESSION['current_level']=$question_worth;
								}
								if($check_for_end=='1')
								{
									$_SESSION['current_level']=$question_worth+1;
								}

								if($speech_boxes=='1')
								{
									if($_SESSION['box_type']==1)
								 	{
								 		$_SESSION['box_type']=0;
								 	}
								 	else
								 	{
								 		$_SESSION['box_type']=1;
								 	}
								}
					?>			
							

								<div align='left' id="progress"> 

									
											<label >
												<?php 
													echo "<h4 style=' color:white;'>Ниво  ".$question_group." (Демо)</h4>"; 
													//echo $answer_group_id." ".$question_dialogue;
												?>
											</label>

										<?php 
											//if($repeat==0)//$_SESSION['previous_page_question_level']!=$question_worth)
											
											//echo "test".$_SESSION['previous_page_question_level'].$question_worth;
												
											echo "<img width= '200px' height='300px'src='progress_".$question_group.".png' /> <br> ";
												
											$repeat=1;
										?>
										
											
									
								</div>	
					<?php
							}
						}
					?>
				<!-- </tr> -->
				
				<?php
					if($question_dialogue!=1 && $_SESSION['beginning_check']!=1)
					{
						//echo "<script>window.alert('Това е въпрос!')</script>";
				?>
				

				<!--- QUIZZZ!!!!! -->
				</br>
					<!-- <input type='text' class="question" style="height: 20%; width: 20%; text-align: center; " name='question' value='<?php echo $question; ?>'>  --> <!-- "$num. "; $num++;  -->
					<div id="<?php if($_SESSION['current_level']!=3){ echo 'div1'; }else{echo'div2';}	?>">
									<div style="height: 50px; width: 100%; text-align: center; "> 
										<div id="oval" style="font-size: 1.3vw;  margin-left: auto; margin-right: auto; width: 10em;"> 
											<div class="outer">
			    								<div class="middle">
			    									<div class="inner">  
														<?php echo $question; ?>
													</div>
												</div>
											</div> 
										</div>
									</div> 
								</div> 
					<!-- color: #FEFEFA; background-color: #00308F; -->

					<!--<td colspan='2' align='center' color='white'> Question --> <?php  //echo $question_count; $question_count++; ?> <!-- </td> -->
			
				
				
				
					<!-- <td align='left'> -->
			<table cellspacing='3' border='1' bgcolor='grey' align='center' style=" position: relative; margin-top: 34.2%; bottom: 0px; left: 50%; margin-right: -50%; transform: translate(-50%, -50%); height: 15%; width: 40%;">			
				<tr>
					<!-- <td align='left'> -->
					<td>	
						<input type='submit' style=" width: 100%;" name='btn' value='<?php echo $answer_a; ?>'> 
						<!-- color: #FEFEFA; background-color: #2E5894; -->
					</td>
					
					<!-- <td align='right'> -->
					<td>
						<input type='submit' style="width: 100%;" name='btn' value='<?php echo $answer_b; ?>'>
						<!-- color: #FEFEFA; background-color: #2E5894; -->
					</td>
				</tr>

				<tr>
					<td>
						<input type='submit' style="width: 100%;" name='btn' value='<?php echo $answer_c; ?>'>
						<!-- color: #FEFEFA; background-color: #2E5894;  -->
					</td>
					<td>
						<input type='submit' style="width: 100%;" name='btn' value='<?php echo $answer_d ?>'>
						<!-- color: #FEFEFA; background-color: #2E5894;  -->
					</td>
				</tr>
			</table>
 	<!-- </div> -->
				<?php
					}

					if($question_dialogue==1 && $_SESSION['beginning_check']!=1)
					{
						//echo "<script>window.alert('Това е диалог!')</script>";
				?>

				<!-- Quiiizzzzzzzzzz!!!!! -->
						 <!-- <input type='text' class="question" style="height: 20%; width: 20%; text-align: center; "   name='question' value='<?php echo $their_dialogue; ?>'> --> <!-- "$num. "; $num++;  -->
						<tr> 
							<td colspan='2'> 
								<div id="div2">
									<div style="height: 50px; width: 100%; text-align: center; "> 
										<div id="oval" style="font-size: 1.3vw;  margin-left: auto; margin-right: auto;width: 10em;"> 
											<div class="outer">
			    								<div class="middle">
			    									<div class="inner">  
														<?php 
															if($_SESSION['current_level']!=3)
															{ 
																echo $our_dialogue; 
															}
															else
															{
																echo $their_dialogue;
															}
														?>
													</div>
												</div>
											</div> 
										</div>
									</div> 
								</div>
							</td>
						</tr>
							<!-- color: #FEFEFA; background-color: #00308F; -->

							<!--<td colspan='2' align='center' color='white'> Question --> <?php  //echo $question_count; $question_count++; ?> <!-- </td> -->
					

					 
							<!-- <input type='text' class="talk" style="height: 50px; width: 50%; text-align: center; " name='question' value='<?php echo $our_dialogue; ?>'> --> <!-- "$num. "; $num++;  -->
						<tr> 
							<td colspan='2'> 
								<div id="div1">
									<div style="height: 50px; width: 100%; text-align: center; "> 
										<div id="oval" style="font-size: 1.3vw;  margin-left: auto; margin-right: auto;width: 10em;"> 
											<div class="outer">
			    								<div class="middle">
			    									<div class="inner">  
														<?php 
															if($_SESSION['current_level']!=3)
															{ 
																echo $their_dialogue; 
															}
															else
															{
																echo $our_dialogue;
															} 
														?>
													</div>
												</div>
											</div> 
										</div>
									</div> 
								</div> 
							</td> <!-- "$num. "; $num++;  -->
							<!-- color: #FEFEFA; background-color: #00308F; -->

							<!--<td colspan='2' align='center' color='white'> Question --> <?php  //echo $question_count; $question_count++; ?> <!-- </td> -->
						</tr>

							<!-- color: #FEFEFA; background-color: #00308F; -->

							<!--<td colspan='2' align='center' color='white'> Question --> <?php  //echo $question_count; $question_count++; ?> <!-- </td> -->
					

						<tr> 
							<td colspan='2'> <input type='submit' style="height: 55px; width: 50%; text-align: center;  background-color:#53741A; " name='<?php echo "progress";//.$dialogue_progress; ?>' value='Продължи'> </td> <!-- "$num. "; $num++;  -->
							<!-- color: #FEFEFA; background-color: #00308F; -->

							<!--<td colspan='2' align='center' color='white'> Question --> <?php  //echo $question_count; $question_count++; ?> <!-- </td> -->
						</tr>

				<?php
					}
					
					if($_SESSION['beginning_check']==1)
					{
						//echo "<script>window.alert('Това е диалог!')</script>";
				?>
				<!---Quiiiiizzzz! -->
						<tr> 
							<td colspan='2'> 
								<div style="height: 50px; width: 100%; text-align: center; "> 
									<div id="oval" style="font-size: 1.3vw;  margin-left: auto; margin-right: auto;width: 10em;">
										<div class="outer">
		    								<div class="middle">
		    									<div class="inner">  
		    										Еб@@г0, някой ми свали самолета. Трябва да намеря кой е и да го арестувам! <!-- "$num. "; $num++;  -->
							<!-- color: #FEFEFA; background-color: #00308F; -->

							<!--<td colspan='2' align='center' color='white'> Question --> <?php  //echo $question_count; $question_count++; ?> <!-- </td> -->
												</div>
											</div>
										</div> 
									</div>
								</div>
							</td>	
						</tr>

						<tr> 
							<td colspan='2'> <input type='submit' style="height: 55px; width: 50%; text-align: center; background-color:#53741A;  " name='begin_game' value='Намери злодея'> </td> <!-- "$num. "; $num++;  -->
							<!-- color: #FEFEFA; background-color: #00308F; -->

							<!--<td colspan='2' align='center' color='white'> Question --> <?php  //echo $question_count; $question_count++; ?> <!-- </td> -->
						</tr>

				<?php
					}
				?>


				
				
				<?php
					//$dialogue="progress".$dialogue_progress;
					//$_SESSION['previous_page_question_group']=$question_worth;
					if(isset($_POST['progress'/*$dialogue*/]))
					{
						if($reached_ending_check!=1)
						{
							$_SESSION['aNswer_check']++;
							$_SESSION['qUestion_check']++;
							$_SESSION['dialogue']++;
							//$_SESSION['qUestion_number']++;
							//$_SESSION['current_level']=$question_worth;

							//$_SESSION['previous_page_question_group']=$question_worth; //ИНАЧЕ НИ ПОКАЗВА ИЗОБРАЖЕНИЯТА ПО БРОЯ НА ЕЛЕМЕНТИТЕ ОТ ГРУПАТА 
							
							echo "<script>window.open('game.php', '_self')</script>";
						}

						if($reached_ending_check==1)
						{
							$_SESSION['game_beaten']=1;
							//echo "<script>alert('Предавам се! Ти си мастър бате.')</script>";

							echo "<script>window.open('result.php', '_self')</script>";
						}
					}

					if(isset($_POST['begin_game'/*$dialogue*/]))
					{
						$_SESSION['beginning_check']++;


						$_SESSION['current_level']++;
						
						echo "<script>window.open('game.php', '_self')</script>";
					}
					
					if(isset($_POST['btn']))
					{
						$choice=$_POST['btn'];
							
							if($choice==$correct_answer)
							{	
								if($reached_ending_check!=1)
								{
									if($correct_answer_response!='-')
									{
										echo "<script>alert('".$correct_answer_response."')</script>";
										
										$_SESSION['aNswer_check']++;
										$_SESSION['qUestion_check']++;
										//$_SESSION['qUestion_number']++;
										//$_SESSION['current_level']=$question_worth;

										//$_SESSION['previous_page_question_group']=$question_worth; //ИНАЧЕ НИ ПОКАЗВА ИЗОБРАЖЕНИЯТА ПО БРОЯ НА ЕЛЕМЕНТИТЕ ОТ ГРУПАТА 
							
										echo "<script>window.open('game.php', '_self')</script>";
									}

									// if($question_worth==1000000)
									// {	
									// 	$won=1000000;
									// 	echo "<script>alert('You won!')</script>";
									// 	echo "<script>window.open('result.php', '_self')</script>";
									// }
									// else
									// {
									// 	echo "<script>alert('Congratulations you are at $question_worth! Proceed.')</script>";
									// }
									// $_SESSION['aNswer_check']++;
									// $_SESSION['qUestion_check']++;
									// //$_SESSION['qUestion_number']++;
									// echo "<script>window.open('game.php', '_self')</script>";
								}

								if($reached_ending_check==1)
								{
									$_SESSION['game_beaten']=1;
									//echo "<script>alert('Предавам се! Ти си мастър бате.')</script>";

									echo "<script>window.open('result.php', '_self')</script>";
								}
							}
							else
							{	
								//maybe the $_SESSION function doesn't work well with the if one (I think that it disregards the if frame and gets the last value so we cancel that out by a die();)
								if($wrong_answer_response!='-')
								{
									echo "<script>alert('".$wrong_answer_response."')</script>";
									
									if($question_group==1)
									{
										$_SESSION['aNswer_check']++;
										$_SESSION['qUestion_check']++;
										//$_SESSION['qUestion_number']++;

										//$_SESSION['previous_page_question_group']=$question_worth; //ИНАЧЕ НИ ПОКАЗВА ИЗОБРАЖЕНИЯТА ПО БРОЯ НА ЕЛЕМЕНТИТЕ ОТ ГРУПАТА 
					
										echo "<script>window.open('game.php', '_self')</script>";	
									}
									else
									{
										//$_SESSION['wOn']=$won;
										$_SESSION['wOn']=$question_group;
										echo "<script>alert('Край! Умре, ама стигна до ниво $question_group.')</script>";

										echo "<script>window.open('result.php', '_self')</script>";
									}
									
								}
								// if($question_worth<=1000)
								// {	
								// 	$won=0;
								// 	$_SESSION['wOn']=$won;
								// 	echo "<script>alert('Game over! You won $won.')</script>";
								// 	echo "<script>window.open('result.php', '_self')</script>";
									
								// 	die();
								// }
								// if($question_worth>1000 AND $question_worth<=32000)
								// {	
								// 	$won=1000;
								// 	$_SESSION['wOn']=$won;
								// 	echo "<script>alert('Game over! You won $won.')</script>";
								// 	echo "<script>window.open('result.php', '_self')</script>";
									
								// 	die();
								// }	
								// if($question_worth>32000 AND $question_worth<=1000000)
								// {	
								// 	$won=32000;
								// 	$_SESSION['wOn']=$won;
								// 	echo "<script>alert('Game over! You won $won.')</script>";
								// 	echo "<script>window.open('result.php', '_self')</script>";
									
								// 	die();
								// }
							}
					}
					
				?>
			
			
			</form>
			</div>
			</section>

		<!--</table>-->	
<?php
require_once("footer.php")	;
?>




