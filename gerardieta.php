<?php
include_once 'actions/db_connect.php';
include_once 'includes/header.php';
//echo htmlspecialchars($_COOKIE["dataactual"]) . '!';
$datosentrada=$_COOKIE["dataactual"];
$cardapio=$_COOKIE["cardapio"];
$entradanorm=$_COOKIE["norm"];
echo ' elecciones   ';
echo $cardapio;
$query="select * from db_alim where 1";
$result=mysqli_query($connect,$query);
$arrayofrows = array();
$arrayofrows = mysqli_fetch_all($result);
//echo gettype($arrayofrows);
$indcard=[0];
	for($j=0;$j<strlen($cardapio);$j++){ // DETECAO DATOS POR LINHA
	 		if ($cardapio[$j]===','){
				array_push($indcard,$j);
				//print_r($indcard);
				//echo $j;
			}
	}
array_push($indcard,strlen($cardapio));
//print_r($indcard);
//print_r($arrayofrows);
//echo " elemento 6 from cardapio ";
//echo $cardapio[1];
$arrayt=implode("|",$arrayofrows[$cardapio[0]]);
//echo $arrayt;
//echo " indices3 ";
$indices3=[];
for($m=0;$m<strlen($arrayt);$m++){  // IMPRES POSICION DADOS LINHA
	 		if ($arrayt[$m]==='|'){
				array_push($indices3,$m);
							}
}
//echo "primer alimento";
//print_r($indices3);
$posalim=substr($cardapio,$indcard[0],$indcard[1]-$indcard[0]);
echo ($posalim-1);
echo "   ";
$cadv1=implode("|",$arrayofrows[$posalim-1]);
//echo "primer alimento ";
echo $cadv1;
$indices4=[];
for($m=0;$m<strlen($cadv1);$m++){  // IMPRES POSICION DADOS LINHA
	 		if ($cadv1[$m]==='|'){
				array_push($indices4,$m);
							}
}
$nomeali=substr($cadv1,$indices4[0],$indices4[1]-$indices4[0]);
//$nomeali=$cadv1[0];
//echo " cadena sin modificar";
//echo $nomeali;
$nomeali=str_replace('|','',$nomeali);
echo " nome alimento 1";
echo $nomeali;
echo "   ";
$enrest=substr($cadv1,$indices4[1],$indices4[2]-$indices4[1]);
echo $enrest;
$protrest=substr($cadv1,$indices4[2],$indices4[3]-$indices4[2]);
$liprest=substr($cadv1,$indices4[3],$indices4[4]-$indices4[3]);
$carbrest=substr($cadv1,$indices4[4],$indices4[5]-$indices4[4]);
$enrest=str_replace('|','',$enrest);
$protrest=str_replace('|','',$protrest);
$liprest=str_replace('|','',$liprest);
$carbrest=str_replace('|','',$carbrest);
$factor=100;
if ($enrest==NULL){	$enrest=0;}
if ($protrest==NULL){	$protrest=0;}
if ($liprest==NULL){	$liprest=0;}
if ($carbrest==NULL){	$carbrest=0;}
$enrest=$enrest/$factor;
echo " saida rest gerardieta linha 38 ";
echo $enrest;
echo " saida rest gerardieta linha 41 ";
echo $carbrest;
$carbrest=$carbrest/$factor;
$liprest=$liprest/$factor;
$protrest=$protrest/$factor;
//echo " saida rest gerardieta linha 45 ";
echo $carbrest;
$arrayali[]=$nomeali;
//echo " vector comidas ";
//echo $arrayali;
for($l=1;$l<(sizeof($indcard)-1);$l++){  // IMPRES POSICION cardapio diferente del primero
       $varcard=substr($cardapio,$indcard[$l],$indcard[$l+1]-$indcard[$l]);
	   $varcard=str_replace(',','',$varcard);
	   $cad=implode("|",$arrayofrows[$varcard-1]);
	   $indices3=[];
	   for($m=0;$m<strlen($cad);$m++){  // IMPRES POSICION DADOS LINHA
	 		if ($cad[$m]==='|'){
				array_push($indices3,$m);
							}
	   }
        $nomealim=substr($cad,$indices3[0],$indices3[1]-$indices3[0]);	   
		$nomealim=str_replace('|','',$nomealim);
//		echo $nomealim;
		$enrestc=substr($cad,$indices3[1],$indices3[2]-$indices3[1]);
        $protrestc=substr($cad,$indices3[2],$indices3[3]-$indices3[2]);
        $liprestc=substr($cad,$indices3[3],$indices3[4]-$indices3[3]);
        $carbrestc=substr($cad,$indices3[4],$indices3[5]-$indices3[4]);
        $enrestc=str_replace('|','',$enrestc);
        $protrestc=str_replace('|','',$protrestc);
        $liprestc=str_replace('|','',$liprestc);
        $carbrestc=str_replace('|','',$carbrestc);
		if ($enrestc==NULL){	$enrestc=0;}
		if ($protrestc==NULL){	$protrestc=0;}
		if ($liprestc==NULL){	$liprestc=0;}
		if ($carbrestc==NULL){	$carbrestc=0;}

	    $enrest='-'.strval($enrest).','.'-'.$enrestc/$factor;
		$enrest=str_replace('--','-',$enrest);
		
		$protrest=strval($protrest).','.strval($protrestc)/strval($factor);
		$liprest=strval($liprest).','.strval($liprestc)/strval($factor);
		$carbrest=strval($carbrest).','.strval($carbrestc)/strval($factor);
//		echo "linha 63 gerardieta";
		echo $carbrestc;
		echo $protrest;
		echo $liprest;
		echo $carbrest;
		$arrayali[]=$nomealim;
		
 }
echo " vector comidas linha 87";
print_r($arrayali);
$indices3=[];
$metac=[];
array_push($indices3,0);
for($N=0;$N<strlen($entradanorm);$N++){  // IMPRES POSICION DADOS LINHA
	 		if ($entradanorm[$N]==='*'){
				array_push($indices3,$N);
				}
	}
 for($l=1;$l<sizeof($indices3);$l++){  // IMPRES POSICION cardapio diferente del primero
       $cadenavar=substr($entradanorm,$indices3[$l-1],$indices3[$l]-$indices3[$l-1]);
	   $indices4=[];
	   for($km=0;$km<strlen($cadenavar);$km++){  // IMPRES POSICION DADOS LINHA
	 		if ($cadenavar[$km]==='>'){
				array_push($indices4,$km);
										}
	   }
	  $nomeusuario=substr($cadenavar,$indices4[0],$indices4[1]-$indices4[0]); 
      $metaener=substr($cadenavar,$indices4[1],$indices4[2]-$indices4[1]);
	  $metacarbo=substr($cadenavar,$indices4[2],$indices4[3]-$indices4[2]);
	  $metaprot=substr($cadenavar,$indices4[3],$indices4[4]-$indices4[3]);
	  $metalip=substr($cadenavar,$indices4[4],strlen($cadenavar)-$indices4[4]);
	  echo ' metas  ';
	  echo ' '.$nomeusuario.'  '.$metaener.'   '.$metacarbo.'  '.$metaprot.'  '.$metalip;
	  echo '';
	  $metaener=str_replace('>','',$metaener);
	  $metaener=str_replace('*','',$metaener);
	  $metacarbo=str_replace('>','',$metacarbo);
	  $metacarbo=str_replace('*','',$metacarbo);
	  $metaprot=str_replace('>','',$metaprot);
	  $metaprot=str_replace('*','',$metaprot);
	  $metalip=str_replace('>','',$metalip);
	  $metalip=str_replace('*','',$metalip);
	  $nomeusuario=str_replace('>','',$nomeusuario);
	  $nomeusuario=str_replace('*','',$nomeusuario);
	  $funobj='['.$nomeusuario.','.$enrest.','.$metaener.']';
	  $optproto='['.$nomeusuario.','.$protrest.','.$metaprot.']';
	  $optcarbo='['.$nomeusuario.','.$carbrest.','.$metacarbo.']';
	  $optlip='['.$nomeusuario.','.$liprest.','.$metalip.']';
	  echo ' funobj  '.$funobj;
	  echo '';
	  echo ' funcarb  '.$optcarbo;
	  echo '';
	  echo ' funprot  '.$optproto;
	  echo '';
	  echo ' funlip  '.$optlip;
	  echo '';
	  setcookie('funobj'.$l,$funobj, time() + 3600, '/');
	  setcookie('optproto'.$l,$optproto, time() + 3600, '/');
	  setcookie('optcarbo'.$l,$optcarbo, time() + 3600, '/');
	  setcookie('optlip'.$l,$optlip, time() + 3600, '/');
	  setcookie('cardapionom',json_encode($arrayali,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), time() + 3600, '/');
	  $metascook=$metaener.','.$metacarbo.','.$metaprot.','.$metalip;
	  array_push($metac,$metascook);
	  echo ' metas cook ';
	  print_r($metac);
	        
  }
  setcookie('metascook',json_encode($metac), time() + 3600, '/');
  header('Location: saida_otim1.html'); //bloquadao para testes de novo gerardieta 10/fev 23:13

///////////////////////////////////////
?>
<style>
table {
  border-collapse: collapse;
 margin: 0;
    padding: 0 0 0 0;
    border: 3;
	border:3px solid black;
}
.table td {
                border-right: 1px solid red;
                border-bottom: 1px solid red;
                margin: 0;
                margin: 0;
                padding: 0;
				border:3px solid black;
            }
</style>
</td><td></td></tr>
</table>
<?php
include_once 'includes/footer.php';
?>