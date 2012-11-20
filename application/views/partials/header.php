<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <base href="<?php echo base_url(); ?>">
    <title>Blog tutorial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="CodeIgniter.org.pl">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand">Blog tutorial</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <!-- 
                  Poniżej sprawdzamy, czy dana pozycja w menu jest aktualnie odwiedzaną stroną. 
                  Jeśli tak, to do tagu <li> dodajemy klasę "active", która zmieni wygląd tego elementu.
                  Aby dowiedzieć się jak działa funkcja rsegment zajrzyj do podręcznika: http://podrecznik.codeigniter.org.pl/libraries/uri.html
              -->
              <li <?php echo ($this->uri->rsegment('2') == 'index') ? 'class="active"' : ''; ?>><a href="<?php echo site_url('posts/index'); ?>">Lista</a></li>
              <li <?php echo ($this->uri->rsegment('2') == 'add') ? 'class="active"' : ''; ?>><a href="<?php echo site_url('posts/add'); ?>">Dodaj</a></li>
            </ul>
            <ul class="nav pull-right">
              <!-- 
                  Sprawdzamy, czy użytkownik jest zalogowany i w zależności od tego wyświetlamy
                  odpowiednie pozycje w menu. 
              -->
              <?php if ($this->session->userdata('user_id')): ?>
                <li><a href="<?php echo site_url('users/logout'); ?>">Wyloguj</a></li>
              <?php else: ?>
                <li <?php echo ($this->uri->rsegment('2') == 'login') ? 'class="active"' : ''; ?>><a href="<?php echo site_url('users/login'); ?>">Logowanie</a></li>
              <?php endif; ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <!-- Jeśli istnieją komunikaty o blędach walidacji, wyświetl je. -->
      <?php if (validation_errors()): ?>      
          <?php echo validation_errors(); ?>
      <?php endif; ?>

      <!-- Jeśli istnieje zmienna flashdata o nazwie 'error' wyświetl ją. -->
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-error">
          <a class="close" data-dismiss="alert" href="#">×</a>
          <?php echo $this->session->flashdata('error'); ?>
        </div>
      <?php endif; ?>

      <!-- Jeśli istnieje zmienna flashdata o nazwie 'success' wyświetl ją. -->
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
          <a class="close" data-dismiss="alert" href="#">×</a>
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>