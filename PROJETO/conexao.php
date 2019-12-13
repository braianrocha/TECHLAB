<?php
/* @author Cesar Szpak - Celke - cesar@celke.com.br
 * @pagina desenvolvida usando FullCalendar e Bootstrap 4,
 * o código é aberto e o uso é free,
 * porém lembre-se de conceder os créditos ao desenvolvedor.
 */


define('HOST','186.202.152.175');
define('USER','basemapeamento');
define('PASS','A2000pwd');
define('DBNAME','basemapeamento');


$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
