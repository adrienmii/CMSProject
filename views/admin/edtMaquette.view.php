
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
					<tr>
						<td>
							8h
						</td>
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
						<td style="vertical-align: bottom;">
							<div class="tooltip" style="height:60px;">
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
						<td>									
						</td>
						<td style="vertical-align: bottom;">
							<div class="tooltip" style="height:60px;">
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
						<td>									
						</td>								
					</tr>
					<tr>
						<td>
							10h
						</td>
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
						<td>								
						</td>								
					</tr>
					<tr>
						<td>
							12h
						</td>
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
						<td>									
						</td>
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
						<td>							
						</td>
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
						<td>									
						</td>								
					</tr>
					<tr>
						<td>
							14h
						</td>
						<td>
							<div class="tooltip" style="height:60px;">
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
						<td>									
						</td>
						<td>									
						</td>
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
						<td>
							<div class="tooltip" style="height:60px;">
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
						<td>								
						</td>								
					</tr>
					<tr>
						<td>
							16h
						</td>
						<td>									
						</td>
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
						<td>									
						</td>
						<td>								
						</td>
						<td>									
						</td>
						<td>								
						</td>								
					</tr>
					<tr>
						<td>
							18h
						</td>
						<td>									
						</td>
						<td>									
						</td>
						<td>									
						</td>
						<td>								
						</td>
						<td>									
						</td>
						<td>									
						</td>								
					</tr>
				</tbody>
			</table>	
			</div>				
		</div>
	</div>						
</main>	
