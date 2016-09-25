<?php
$arr =  array('img/how.png', 'img/loader.png', 'img/inicio.png', 'img/game.png', 'img/percent-load.png', 'img/seconds.png', 'img/end_box.png',
					'img/end_box_2.png', 'img/btn_how_menu_over.png', 'img/inicio_box.png', 'img/btn_ini_menu_over.png', 'img/btn_ini_menu.png', 
					'img/more_over.png', 'img/again_over.png', 'img/btn_coin_menu_over.png', 'img/btn_how_menu.png', 'img/inicio_btn_over.png',
					'img/btn_rank_menu_over.png',  'img/return_btn_over.png', 'img/more.png', 'img/exit_over.png', 'img/again.png', 'img/inf_more.png',
					'img/inf_more_over.png', 'img/vida.png', 'img/inicio_btn.png', 'img/btn_coin_menu.png', 'img/reloj.png', 'img/exit.png',
					'img/btn_rank_menu.png', 'img/inf_menu.png', 'img/return_btn.png', 'img/inf_menu_over.png', 'img/back.png', 'img/fb.png', 'img/tw.png',
					'img/cover.png', 'img/c1.png', 'img/c2.png', 'img/c3.png', 'img/c4.png', 'img/c5.png', 'img/c6.png', 'img/c7.png', 'img/c8.png',
					'img/c9.png', 'img/c10.png', 'img/nivel_2.png', 'img/nivel_3.png', 'img/nivel_4.png', 'img/nivel_5.png', 'img/nivel_6.png',
					'img/nivel_7.png', 'img/nivel_8.png', 'img/nivel_9.png', 'img/nivel_10.png', 'img/abandonar_box.png', 'img/si.png',
					'img/no.png', 'img/si_over.png', 'img/no_over.png', 'img/5000.gif', 'img/10000.gif', 'img/15000.gif', 'img/20000.gif', 'img/60000.gif',
					'img/70000.gif', 'img/80000.gif', 'img/90000.gif', 'img/100000.gif', 'img/5segs.gif', 'img/20segs.gif');
$htm = "";
for ($i=0; $i<count($arr); $i++) {
	$htm.='{<br>"type":"IMAGE",<br>"source":"../'.$arr[$i].'",<br>"size":'.filesize($arr[$i]).'<br>},';
}
					
echo $htm;

?>