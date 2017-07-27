<?php
require '../common.php';

extract(check_user());

if($user_id != 1) die("This section is only accessable by Binny. Ask him for permission to access this section");