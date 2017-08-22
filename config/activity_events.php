<?php
$recent_activity = array(
"<a href='?page=garage&rtoken=".$racing_token_winner."' class='tip_trigger'>".$winner."<span class='tip' style='display:none;'><img src='contents/avatar/small_avatar/".$winner_small_img."' /></span></a> outraced <a href='?page=garage&rtoken=".$racing_token_loser."' class='tip_trigger'>".$loser."<span class='tip' style='display:none;'><img src='contents/avatar/small_avatar/".$loser_small_img."' /></span></a> and gained points",
"<a href='?page=garage&rtoken=".$racing_token_winner."' class='tip_trigger'>".$winner."<span class='tip' style='display:none;'><img src='contents/avatar/small_avatar/".$winner_small_img."' /></span></a> left <a href='?page=garage&rtoken=".$racing_token_loser."' class='tip_trigger'>".$loser."<span class='tip' style='display:none;'><img src='contents/avatar/small_avatar/".$loser_small_img."' /></span></a> in the dust, for an extra points",
"Close call!! <a href='?page=garage&rtoken=".$racing_token_winner."' class='tip_trigger'>".$winner."<span class='tip' style='display:none;'><img src='contents/avatar/small_avatar/".$winner_small_img."' /></span></a> managed to beat <a href='?page=garage&rtoken=".$racing_token_loser."' class='tip_trigger'>".$loser."<span class='tip' style='display:none;'><img src='contents/avatar/small_avatar/".$loser_small_img."' /></span></a> and got points",
);

$recent_activity_five_win = array(
$winner." snatched an extra points for outspacing five opponents in row",
);

$recent_activity_events = array(
$winner." gained points at ".$events." event at ".$places.".",
);

$first_login_activity = array(
						$player." joined RedRush.",
						"Another racer joins the fray. ".$player.", see you in the tracks",
						"A new racer, ".$player.", just entered the tracks!"
						);

$after_puzzle_game = array(
					"That was some fast thinking! ".$player." has finished Solve The Rush!",
					"With a quick wit and fast reflexes, ".$player." completed Solve the Rush",
					$player." has found the solution to Solve the Rush!",
					$player." has aced Solve the Rush!"
					);
					
$after_cooking_game = array(
					"Delisiozo! ".$player." serves up a masterpiece in What’s Cooking!",
					"Look who’s cookin’! ".$player." has completed What’s Cooking with a five star cuisine!",
					"Served! ".$player." just made a five star dish in What’s Cooking!",
					$player." turned the kitchen upside down in Cucina Italia!",
					$player." completes are courses in the Cucina Italia!",
					"Meet the champ of the kitchen, ".$player." just beat Cucina Italia!",
					);

$after_segway_game = array(
					$player." has survived and conquered the Rush Hour!",
					"Great driving skills! ".$player." has slipped away from the Rush Hour!",
					$player." drives through the Rush Hour with ease, eccelente!"
					);
					
$after_findobject_game = array(
					$player." got a keen eye, he /she found everything in Find Objects",
					"Found it! ".$player." reveals all in the Find Object mini game",
					"Everything’s found! ".$player." has seen it all in Find Objects."
					);
?>