<?php

require_once 'app/helper.php';
my_session_start('the_blog');
session_destroy();
header('location: signin.php?sm=5');
