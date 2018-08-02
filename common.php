<?php
require '../common.php';

extract(check_user());

if($user_id != 1 and $user_id != 57184 and $user_id != 18269) die("This section is only accessable by Binny, Rohit and Shilpa. Ask either of them for permission to access this section");
