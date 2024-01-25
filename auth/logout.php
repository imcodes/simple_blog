<?php
session_start();
//check if the user is logged in, if not, redirect to login
validateLogin();
logout();