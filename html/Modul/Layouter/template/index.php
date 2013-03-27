<div id="page" class="container_12">
	<div id="branding" class="container_12">
		<h1>
			<?php echo $this->title; ?>
		</h1>
		<div class="grid_9 navigation">
				<h3>Servicenavigation</h3> 
				<?php echo $this->menue(0); ?>
		</div>
		<div class="grid_3">
			<form>
				<input name="q" placeholder="Suchbegriff..." />
  				<button type="submit">suchen</button>
  			</form>
		</div>
	</div>
	<div id="content" class="container_12">
		<div id="body" class="grid_9">
			<?php echo $this->content; ?>
		</div>
		<div id="sidebar" class="grid_3">
			<div class="box navigation" id="language">
				<h3>Sprachauswahl</h3> 
				<ol> 
					<li><a href="en">english</a></li> 
					<li><a href="no">norge</a></li> 
				</ol> 
			</div>
			<div class="box navigation" id="mainnavi">
				<h3>Hauptnavigation</h3> 
				<?php echo $this->menue(1); ?>
			</div>
			<div class="box" id="random_image"> 
				<h3>Zufallsbilder</h3> 
				<?php echo $this->randomImage; ?>
			</div>
			<div class="box" id="register">
				<?php #if($this->checkLogin()): ?>
				<h3>Administration</h3>
				<?php echo $this->adminPanel; ?>
				<p><a href="<?php #echo $this->url('login','logout'); ?>">abmelden</a></p>
				<?php #else: ?>
				<h3>Anmeldung</h3>
				<p><a href="<?php #echo $this->url('login','show'); ?>">anmelden</a></p>
				<?php #endif; ?>
			</div>
		</div>
	</div>
	<div class="container_12" id="copyright">
		<h3>Copyright</h3> 
		<p>© 2010 - hergestellt unter der Mithilfe von <a href="http://www.re-design.de">RE-Design</a></p> 
		<noscript> 
			<p>Da ihr Browser den Sie benutzen keine JavaScript können einige Einbusen in der Benutzbarkeit dieser Website entstehen.</p> 
		<!--[if lte IE 8]>
			<p>Der Browser den Sie benutzen ist veraltet. Er besitzt bekannte Sicherheitsschwachstellen, bietet nur begrenzten Komfort und hat viele weitere Nachteile.</p>
		<![endif]--> 
		</noscript>
	</div>
</div>