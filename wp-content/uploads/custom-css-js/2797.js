<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 
jQuery(document).ready(function( $ ){
	var fiveMinutes = 2
	var display = $('.time');
	display.each(function() {
  startTimer(fiveMinutes, display);
});
// 	startTimer(fiveMinutes, display)
})
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
	if (--timer >= 0) {
         
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text('00:00:' +  minutes + ":" + seconds);

//         if (--timer < 0) {
//             timer = duration;
//         }
    }, 1000);
}
}

// window.onload = function () {
//     var fiveMinutes = 60 * 5;
//     var display = document.getElementsByClassName('.time');
// 	console.log(display)
//     startTimer(fiveMinutes, display);
// };</script>
<!-- end Simple Custom CSS and JS -->
