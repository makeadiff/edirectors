<?php
require '../common.php';

extract(check_user());

if($user_id != 1 and $user_id != 57184) die("This section is only accessable by Binny and Rohit. Ask him for permission to access this section");