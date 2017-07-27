<?php
require 'common.php';

$input_file = '../../index.php';
$url = 'http://makeadiff.in/';

$content = file_get_contents($input_file);
$lines = explode("\n", $content);

$capture = false;
$box = '';
$directors = array();
$raw = array();
foreach ($lines as $line) {
	$l = trim($line);

	if($l == '<!-- Director Information -->') $capture = true;
	if($l == "include('./configuration.php');") $capture = false;

	if($l == '<div class="box">' and $capture) {
		$raw[] = $box;
		$box = '';
	}

	if($capture) {
		$box .= $l . "\n";
	}
}

$sort = 0;

foreach ($raw as $dir) {
	$lines = explode("\n", $dir);
	$sort++;
	$info = array(
			'name'	=> '',
			'image'	=> '',
			'role'	=> '',
			'email'	=> '',
			'description'	=> '',
			'sort'	=> $sort * 10,
			'user_id'=> 0,
			'status'=> 1,
		);
	$cap = false;

	foreach ($lines as $line) {
		$l = trim($line);

		if(preg_match('#<span class="img"><img src="(images/learn/team/.+\.jpg)"/><div class="overlay"></div></span>#', $l, $matches)) {
			$info['image'] = $url . $matches[1];
		}

		if(preg_match('#<h1>(.+)</h1>#', $l, $matches)) {
			$info['name'] = $matches[1];
		}

		if(preg_match('#<h2>(.+)</h2>#', $l, $matches)) {
			$info['role'] = $matches[1];
		}

		if(preg_match('#<a href="mailto:(.+?)"><img src="./images/learn/email.png"/>#', $l, $matches)) {
			$info['email'] = $matches[1];
		}

		// Order is important.
		if($cap and $l == '</div>') $cap = false;
		if($cap) $info['description'] .= $l . "\n";
		if($l == '<div class="role col col-9">') $cap = true;
	}

	$insert_id = $sql->insert("App_Director", $info);

	print $info['name'] . " : " . $insert_id . "\n";

	$directors[] = $info;
}

// dump($directors);
/*
<div class="box">
	<span class="img"><img src="images/learn/team/jithin.jpg"/><div class="overlay"></div></span>
	<div class="copy">
		<div class="row-fluid">
			<div class="col col-3">
				<div class="image-round">
					<!-- Image Comes here -->
				</div>
				<h1>Jithin C Nedumala</h1>
				<h2>Founder &amp; CEO</h2>
				<h3 class="contact">
					<a href="mailto:jithin@makeadiff.in"><img src="./images/learn/email.png"/>&nbsp; jithin@makeadiff.in</a> &nbsp; &nbsp;
					<!-- <a href="mailto:sneheel@makeadiff.in"><img src="./images/learn/linkedin.png"/></a> -->
				</h3>
			</div>
			<div class="role col col-9">
				<h3>What they do</h3>

				<p>Jithin is part of MAD's Strategic Operations team which is responsible for providing direction to the organization, safeguarding the vision, and setting targets. Jithin's core focus is financial oversight, planning, operational delivery, strategic design, and ensuring effective and efficient implementation of MAD's solution for impact on ground. </p>

				<h3>Background &amp; Achievements:</h3>

				<p>Jithin has been working with children in orphanages since his second year of University and in 2006 founded Make a Difference along with three of his friends. Since then he has grown MAD from an idea to make a difference to vulnerable children, into an organisation working with 67 shelters across 23 cities in India.</p>

				<p>Jithin has been awarded the Ashoka Global Youth Social Entrepreneur award, Karmaveer Puraskar, Cordes Fellowship, Dasra peer grant and Youth Actionnet Fellowship for his contribution to society. He was one of the few social entrepreneurs personally supported by Michelle Obama through her International Youth Engagement Program and was one of the contenders for the Forbes India "30 under 30" list. He is currently part of DASRA's 2014/15 cohort of social entrepreneurs.</p>

				<h3>Cause of MADness</h3>

				<p>His inability to reconcile with the way the society treats its most vulnerable has been a leading cause of MADness. His blind belief in young people's role in being a catalyst in creating a better and more equal society has also been a contributory factor. </p>

			</div>
		</div>
	</div>
</div>
*/