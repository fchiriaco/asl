<nav class="navbar navbar-inverse">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <!-- <a class="navbar-brand" href="#">[ ASL Project ]</a> -->
    </div>
	
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-list-alt"></span> ANAGRAFICHE
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo $dirsitoscript ?>amministra/alunni/index.php">Alunni</a></li>
				<li><a href="#">Docenti</a></li>
				<li><a href="#">Sedi</a></li>
				<li><a href="#">Classi</a></li>
				<li><a href="<?php echo $dirsitoscript ?>amministra/materie/index.php">Materie</a></li>
				<li><a href="<?php echo $dirsitoscript ?>amministra/aziende/index.php">Aziende</a></li>
			</ul>
		</li>
      <!--  <li><a href="#">Page 2</a></li> 
        <li><a href="#">Page 3</a></li> --> 
      </ul>
	  
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $dirsitoscript ?>index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul>
	  
    </div>
  
</nav>