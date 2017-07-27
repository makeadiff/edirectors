<?php
require './common.php';

$directors = $sql->getAll("SELECT * FROM App_Director WHERE status=1 ORDER BY sort");

foreach($directors as $dir) {
	echo <<<END
<div class="box">
	<span class="img"><img src="{$dir['image']}"/><div class="overlay"></div></span>
	<div class="copy">
		<div class="row-fluid">
			<div class="col col-3">
				<div class="image-round">
					<!-- Image Comes here -->
				</div>
				<h1>{$dir['name']}</h1>
				<h2>{$dir['role']}</h2>
				<h3 class="contact"><a href="mailto:{$dir['email']}"><img src="http://makeadiff.in/images/learn/email.png"/>&nbsp; {$dir['email']}</a></h3>
			</div>
			<div class="role col col-9">
				{$dir['description']}
			</div>
		</div>
	</div>
</div>
END;
}