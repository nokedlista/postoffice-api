<?php
session_start();
include './vendor/autoload.php';

use App\Html\Request;
use App\Html\PageCounties;

PageCounties::head();
PageCounties::nav();
Request::handle();
PageCounties::footer();

Request::handle();
