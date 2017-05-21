<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <!-- <link rel="icon" href="/favicon.ico"> -->

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/assets/styles/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/styles/blog.css" rel="stylesheet">
  </head>

  <body>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
			<?php
				echo anchor('', 'Home', array('class' => 'blog-nav-item active'));
				echo anchor('pages/about', 'About', array('class' => 'blog-nav-item'));
			?>
        </nav>
      </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title"><?php echo $blog_title; ?></h1>
        <p class="lead blog-description"><?php echo $blog_subtitle; ?></p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

