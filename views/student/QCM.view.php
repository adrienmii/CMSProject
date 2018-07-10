
<main id="qcmContainer">
	<section class="col-XS-12">
		<header>
			<div id="timeLeft"><span id="timer">2:00</span></div>
			<div id="questionNumber">Question<br><b><?php echo $config['currentQuestion'] ?></b><br>sur <?php echo $config['nbQuestion'] ?></div>
			<div id="question"><?php echo $config['question']['question']; ?></div>
		</header>
		<main>

			<?php $this->addModal("qcm", $config); ?>

		</main>
	</section>
</main>


<script type="text/javascript">
var timeoutHandle;
function countdown(minutes) {
    var seconds = 60;
    var mins = minutes
    function tick() {
        var counter = document.getElementById("timer");
        var current_minutes = mins-1
        seconds--;
        counter.innerHTML =
        current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
        if (seconds <= 5 && seconds >= 0) {
        	$('#timer').css('color', '#ca5c5d');
        }
        if( seconds > 0 ) {
            timeoutHandle=setTimeout(tick, 1000);
        } else {
        	$('input[name="submit_signin"]').click();

            if(mins > 1){
               setTimeout(function () { countdown(mins - 1); }, 1000);
            }
        }
    }
    tick();
}

countdown(1);

</script>
			