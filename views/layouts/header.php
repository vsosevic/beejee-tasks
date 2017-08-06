<!DOCTYPE html>
<html>
<head>
    <title>Beejee Tasks</title>
    <link rel="stylesheet" type="text/css" href="../../template/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- <script src="../../scripts/preview.js"></script> -->
</head>

<body>

<nav class="navbar navbar-default">

  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/tasks/">Beejee Tasks</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/tasks/">Tasks <span class="sr-only">(current)</span></a></li>
        <li><a href="/tasks/add">Add task</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

        <?php if(!empty($_SESSION) && $_SESSION['admin']): ?>
          <li><a href="/logout/">Logout</a></li>
          
        <?php else: ?>
          <li><a href="/login/">Login</a></li>
        <? endif; ?>

      </ul>
    </div> <!-- /.navbar-collapse -->

  </div> <!-- /.container-fluid -->
</nav>