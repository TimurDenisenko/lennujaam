<?php
$kasutaja = 'edvardd';
$serverinimi = 'localhost';
$parool = '';
$andmebaas = 'lenujaam';
$yhendus = new mysqli($serverinimi, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset('UTF8');
?>
