
<main id="edtContainer">	
	<div class="row">
		<div id="weekSelect" class="col-xs-12">
			<a href="<?php echo DIRNAME.'schedule/edit/'.$class.'/'.$goToPreviousWeek; ?>"><</a>
				<span><?php echo $weekDaysArray[0]["str"]." - ".end($weekDaysArray)["str"]?></span>
			<a href="<?php echo DIRNAME.'schedule/edit/'.$class.'/'.$goToNextWeek; ?>" id="nextWeek">></a></div>
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
								echo $hour
							?>									
						</td>	
						<?php
							foreach($weekDaysArray as $day){
			                  
								if($hour == $lunchHour){
									echo "<td>Lunch</td>";
								}else{
								
								?>
								<td>
									<div class="tooltip">
										<div>UX Design</div>
										<div>M. COAT</div>
										<div class="room">B21</div>
										<div class="tooltiptext">
											<div class="course">Intégration Web Avancée</div>
											<div class="courseDate">05/02/2018 (2 heures)</div>
											<div class="info">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel facilisis ante.</div>
											<a href="#" class="courseLink">Ouvrir le cours</a>
										</div>
									</div>
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
