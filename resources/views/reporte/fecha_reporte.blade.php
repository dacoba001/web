<?php
$meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
$start_date_date = date_create($start_date);
$start_date_format = $start_date_date->format('j')." de ".$meses[$start_date_date->format('n')-1]. " del ".$start_date_date->format('Y');
$end_date_date = date_create($end_date);
$end_date_format = $end_date_date->format('j')." de ".$meses[$end_date_date->format('n')-1]. " del ".$end_date_date->format('Y');
?>
<p class="text-right visible-print">del: {{$start_date_format}} al: {{$end_date_format}}</p>
