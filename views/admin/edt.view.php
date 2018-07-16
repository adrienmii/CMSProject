
<main id="edtContainer">	
	<div class="row">

		<div id="weekSelect" class="col-xs-12">
			<?php echo strtoupper($class["classname"]); ?><br>
			<a href="<?php echo DIRNAME.'schedule/view/'.$class["id"].'/'.$goToPreviousWeek; ?>"><</a>
				<span><?php echo $weekDaysArray[0]["str"]." - ".end($weekDaysArray)["str"]?></span>
			<a href="<?php echo DIRNAME.'schedule/view/'.$class["id"].'/'.$goToNextWeek; ?>" id="nextWeek">></a></div>
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<div id="edtTableContainer" >
			<table id="edtTable">
				<thead>
					<tr>
						<th></th>
						<?php
							foreach($weekDaysArray as $day){
			                   echo "<th>".$day["str_short"]."</th>";
			                } 
						?>								
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($hourTable as $hour){
		            ?>
					<tr>
						<td>
							<?php
								$parts = explode(':', $hour);
								echo $hour =  str_pad($parts[0], 2, "0", STR_PAD_LEFT).":".$parts[1];
							?>									
						</td>	
						<?php
							$i = 0;
							foreach($weekDaysArray as $day){
								
								if($hour == $lunchHour){
									echo "<td>Lunch</td>";
								}else{
								
								?>
								<td>
									<?php
										$foundCourse = false;
										foreach($courseList as $course){
											if($hour == $course["startHour"] && $weekDaysArray[$i]["d"] == $course["day"]){
												$foundCourse = true;
												?>
													<div class="tooltip">
														<div style="float:left"><?php echo $course["matiere"]?></div>
														<div class="actionCol text-right">
															<a class="actionEditWhite" href="<?php echo DIRNAME.'schedule/edit/'.$course["id"]; ?>"></a>
															<a class="actionDeleteWhite" href="<?php echo DIRNAME.'schedule/delete/'.$course["id"];?>" onclick="return confirm('Souhaitez vous supprimer ce cours ?')"></a>
														</div>
														<div><?php $BSQL = new BaseSQL(); $userinfo = $BSQL->userInfoById($course["userID"]); echo $userinfo['lastname']." ".$userinfo['firstname']?></div>
														<div class="room"><?php echo $course["room"]?></div>
														
													</div>
												<?php
											}
										}
										if(!$foundCourse){
											?>
												<a style="position: relative;left: 50%;top: 50%;transform: translateX(-50%) translateY(-50%);" 
													href="<?php echo DIRNAME.'schedule/add/'.$class['id'].'/'.$week."/".$weekDaysArray[$i]["d"].'/'.$hour.'/'.$year; ?>" id="addItem">+</a>
											<?php
										}
										$i += 1;
									?>
								</td>
								<?php
								}
			                }
			            	
						?>								
					</tr>		            
		            <?php
		                }
					?>

				</tbody>
			</table>	
			</div>				
		</div>
	</div>						
</main>	
