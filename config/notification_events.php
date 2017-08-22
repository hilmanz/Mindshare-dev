<?php
$challenged_player = array(
'Hop into your ride, <font color="GreenYellow">'.$player.'</font> has challenged you to a race',
"<font color='GreenYellow'>".$player."</font> asks you, who's the better. Are you up to answer that?",
"<font color='GreenYellow'>".$player."</font> claims to be a better racer than you. What do you have to say about that?",

);

$challenged_player_lose = array(
"Are you gonna let it slide? Upgrade your car and show them what you're made off.",
"Tough break! Get more points, upgrade your ride and take back the flag!",
"<a href='?page=garage&rtoken=".$racing_token."' class='tip_trigger'>".$opponent."</a> manages to outrun you in a race. Upgrade your car, challenge 'em aggain and show 'em what you got!",
"You ain't gonna let <a href='?page=garage&rtoken=".$racing_token."' class='tip_trigger'>".$opponent."</a> get a way with this are you? Upgrade your car and challenge 'em again!",
);

$challenged_player_win = array(
"Now they know not to mess with you! Congrats for winning the race!",
"Congratulations for the win! Upgrade your car and go for the top!",
"'Grats, that was a great race! Now go and challenge other racers!",
"Nice upgrades, great skills. Congrats for the win, we salute you!",
"You've been challenged by <a href='?page=garage&rtoken=".$racing_token."' class='tip_trigger'>".$opponent."</a>, you show 'em who's the beter racer. Congratulations for the win!",
);


?>