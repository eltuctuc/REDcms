<?php
include_once 'core/Template.php';

$tpl = new Template('./templates/layouts');
$tpl->load('index.tpl.html');

$tpl->set('##TITLEBAR##',		'RE-Design - Beispiel-Template-Code');
$tpl->set('##WEBSITETITLE##',	'RE-Design');
$tpl->set('##TAGLINE##',		'Template-Klassen-Beispiel');
$tpl->set('##CONTENT##',		'<p>Lorem ipsum dolor sit amet, ... et netus et malesuada fames ac turpis egestas.</p>');
$tpl->set('##SIDEBAR##',		'<div class="box"><h2>Autor</h2><p>Enrico Reinsdorf</p></div>');

echo $tpl->get(Template::DISPLAY_HTML);
?>