<!DOCTYPE HTML>
<html>
<head>
    <title>Blog</title>
    <meta name="description" content="description"/>
    <meta name="keywords" content="keywords"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine&amp;v1"/>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css"/>
</head>

<body>
<div id="main">
    <div id="header">
        <div id="logo">
            <h1><a href="<?php echo base_url(); ?>blog/">Blog</a></h1>
        </div>
        <div id="menubar">
            <ul id="menu">
                <li class="<?php echo $home_class; ?>"><a href="<?php echo base_url(); ?>blog/">Main</a></li>
                <?php if ($this->session->userdata('user_id')) { ?>
                    <li class="<?php echo $login_class; ?>"><a
                            href="<?php echo base_url(); ?>users/logout">(<?php echo $this->session->userdata['username'] ?>)Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="<?php echo $login_class; ?>"><a href="<?php echo base_url(); ?>users/login">Login</a></li>
                    <li class="<?php echo $register_class; ?>"><a href="<?php echo base_url(); ?>users/register">Register</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>