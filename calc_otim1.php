<?php
include_once 'actions/db_connect.php';
include_once 'includes/header.php';
//echo htmlspecialchars($_COOKIE["dataactual"]) . '!';
$var=$_COOKIE["dataactual"];
//echo $var;
/////////////////////////////
$indices=[];
$indices2=[];
 array_push($indices,0);
 for($i=0;$i<strlen($var);$i++){
	//    echo $i;
	//    echo " ";
	//    echo $var[$i]."\n";
    if ($var[$i]==='*'){
		array_push($indices,$i);
		}
    }
 for ($temp=0;$temp<sizeof($indices);$temp++){
	echo "  ";
	echo "\n";
	//echo $indices[$temp];
	echo "  ";
	echo "\n";
	}
echo "<hr>"	;
$cesta = array(" ");
 for ($temp=1;$temp<sizeof($indices);$temp++){
// FOR DETECAO LINHAS
	//echo " --> ";
	//echo "\n";
	//echo $indices[$temp-1] ." ". $indices[$temp] ;
	echo "\n";
	//echo "<br>";
	$linha=substr($var,$indices[$temp-1],$indices[$temp]-$indices[$temp-1]);
	//echo "LINHA:";
	//echo $linha;
	$indices2=[];
	array_push($indices2,0);
	for($j=0;$j<strlen($linha);$j++){ // DETECAO DATOS POR LINHA
	 		if ($linha[$j]==='>'){
				array_push($indices2,$j);
			}
		} // DETECAO DATOS POR LINHA
	for($l=0;$l<sizeof($indices2);$l++){  // IMPRES POSICION DADOS LINHA
		echo "  ";
		echo "\n";
		//echo $indices2[$l];
		//echo "  ";
		//echo "\n";
		} // IMPRES POSICION DADOS LINHA
		//echo 'substr '.gettype($linha).' ';
	   //echo json_encode($indices2);
	   $nomeusuario=substr($linha,0,$indices2[1]);
	   //echo '  extraccion nomeusuario '.$nomeusuario.'   ';
       $energia=substr($linha,($indices2[1]+1),($indices2[2]-$indices2[1]));
	   $carbos=substr($linha,$indices2[2]+1,($indices2[3]-$indices2[2]));
	   $proto=substr($linha,$indices2[3]+1,($indices2[4]-$indices2[3]));
	   $lipi=substr($linha,$indices2[4]+1,($indices2[5]-$indices2[4]));
	   //echo 'procura linha '.$nomeusuario;
	  // echo 'extracciones  energia'.$energia.'  carbos  '. $carbos.'  proto  '.$proto.' lipi  '.$lipi;
	   $nomeusuario=str_replace('*','',$nomeusuario);
	   $energia=str_replace('>','',$energia);
	   $carbos=str_replace('>','',$carbos);
	   $proto=str_replace('>','',$proto);
	   $lipi=str_replace('>','',$lipi);
	   //echo 'extracciones  energia ajustadas '.$energia.'  % carbos  '. $carbos.' % proto  '.$proto.' % lipi  '.$lipi;
       //echo 'valores normalizados '. floatval(1/400)*(floatval($energia)*floatval($carbos)).' >'. floatval(1/400)*(floatval($energia)*floatval($proto)).' > '. floatval(1/900)*(floatval($energia)*floatval($lipi));
	   //.' >'.$energia*$proto/4.' >'.$energia*$lipi/4;
	   //echo 'teste logitud ',strlen($energia);
	   //echo 'cadena eneria '.$energia;
	   //echo 'cadena proto verfif'.$proto;
	   	   
	   if (empty($lipi)){
		    //echo "cadena lipi vacia";
			$consultlipi='`lipideos` LIKE "%%"';
			$nmlipi=0;
		   }else{
		   $nmlipi=floatval(1/900)*(floatval($energia)*floatval($lipi));
		   $inflipi=$nmlipi*.96;
		   $suplipi=$nmlipi*1.04;
		   $consultlipi='`lipideos` > ' .floor($inflipi).' AND '.'`lipideos` < ' .ceil($suplipi);
		   }
	   if (empty($proto)){
		    //echo "cadena lipi vacia";
			$consultproto='`proteina` LIKE "%%"';
			$nmproto=0;
		   }else{
		   $nmproto=floatval(1/400)*(floatval($energia)*floatval($proto));
		   $infproto=$nmproto*.96;
		   $supproto=$nmproto*1.04;
		   $consultproto='`proteina` '.'> ' .floor($infproto).' AND '.'`proteina` '.'< ' .ceil($supproto);
		   }
	   if (empty($carbos)){
		    //echo "cadena lipi vacia";
			$consultcarbos='`carboidratos` LIKE "%%"';
            $nmcarbos=0;
		   }else{
		   $nmcarbos=floatval(1/400)*(floatval($energia)*floatval($carbos));
		   $infcarbos=$nmcarbos*.96;
		   $supcarbos=$nmcarbos*1.04;
		   $consultcarbos='`carboidratos` '.'> ' .floor($infcarbos).' AND '.'`carboidratos` '.'< ' .ceil($supcarbos);
		   }
	   $nmenerg=floatval($energia);
	   $infenerg=$nmenerg*.96;
	   $supenerg=$nmenerg*1.04;
	   $consultenerg='`energia` '.'> ' .$infenerg.' AND '.'`energia` '.'< ' .$supenerg;
	   //echo 'extracciones  energia ajustadas '.$nmenerg.'  nmcarbos  '. $nmcarbos.'  nmproto  '.$nmproto.' lipi  '.$nmlipi;
	   $norm=$nomeusuario.'>'.$nmenerg.'>'.$nmcarbos.'>'.$nmproto.'>'.$nmlipi.'* ';
	   //echo '  usuario '.$nomeusuario;
	   //echo ' normalizado  '.$norm;
	   array_push($cesta, $norm);
	    }
      //print_r($cesta);
	  $comma_separated = implode(">", $cesta);
	  setcookie("norm",$comma_separated, time() + 3600, '/');
///////////////////////////////////////
?>

<html>
<head>
   <meta charset="ISO 8859">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
 <script>
  $( function() {
    var availableTags = ["Abacate","Abacaxi","Abadejo","Abará","Abiu","Abóbora","Abobrinha","Açafrão","Açaí","Acarajé","Acelga","Acém","Acerola",
	                     "Achocolatado","Açúcar","Ades","Adoçante","Agrião","Água","Aguardente","Agulha","Aipim","Aipo","Alcachofra","Alcatra",
                         "Alface","Alfajores","Alfavaca","Alfenim","Algodão-doce","Alho","Almeirão","Almôndega","Ambrosia","Ameixa","Amêndoa",
						 "Amendoim","Americano","Amido","Amidomil","Amora","Ananás","Andu","Angu","Angusor","Apresuntado","Araçá","Arrasto",
						 "Arroz","Arroz-doce","Arrozina","Arrumadinho","Asa","Aspargo","Ata","Atemóia","Atum","Aveia","Avelã","Azeite","Azeitona",
						 "Bacaba","Bacalhau","Bacon","Baconzitos","Bacurri","Baião","Bala","Banana","Banha","Barra","Barreado","Batata","Batida",
						 "Bau","Bauru","Bebida","Beijo","Beiju","Bergamota","Berinjela","Bertalha","Beterraba","Bidu","Bife","Biribá","Biscoto",
						 "Bisnaguinha","Bisteca","Blanquet","Bobó","Bofe","Bolacha","Bolinho","Bolo","Bomba","Bombom","Brachola","Braço","Bredo",
						 "Brevidade","Brigadeiro","Brioche","Broa","Brócolis","Broto","Buchada","Buriti","Butiá","Cabeça","Cação","Caçarola",
					     "Cacau","Cachaça","Cachorro-quente","Café","Caipirinha","Cajá","Caju","Cajuina","Caldo","Calzone","Camarão","Cana",
						 "Canja","Canjica","Canjiquinha","Canudinho","Capeleti","Capote","Capuccino","Caqui","Cará","Carambola","Caramelo",
						 "Caranguejo","Carcaça","Cariru","Carne","Carré","Caruru","Castanha","Catalonha","Catchup","Catuaba","Cavaco",
						 "Caxiri","Cebola","Cebolinha","Cenoura","Cereais","Cereal","Cereja","Cerveja","Cevada","Chá","Chambaril",
						 "Champanhe","Champignon","Chandele","Chantilly","Charuto","Cheese","Chester","Chiclete","Chicória","Chimarrão",
						 "Chineque","Chips","Chocolate","Chocomilk","Chopp","Chouriço","Chuchu","Chucrute","Chuleta","Churrasco","Churro",
						 "Ciringuela","Coalhada","Coca-cola","Cocada","Coco","Codorna","Coentro","Cogumelo","Complemento","Concentrado",
						 "Confete","Conhaque","Contrafilé","Copa","Coquetel","Coração","Corimba","Corimbatá","Corvina","Costela","Couve",
						 "Coxinha","Cozido","Creme","Cremogema","Croissant","Croquete","Croquinhos","Cruera","Cuca","Cupim","Cupuaçu",
							"Curau","Cuscuz","Cuxá","Danette",
"Demerara",
"Diet shake",
"Dobradinha",
"Doce",
"Dourada",
"Drink",
"Drops",
"Drumete",
"Eggsburguer",
"Empada",
"Enroladinho",
"Erva-doce",
"Ervilha",
"Escarola",
"Esfirra",
"Espinafre",
"Estrogonofe",
"Fanta",
"Farinha",
"Farofa",
"Fato",
"Fava",
"Fécula",
"Feijão",
"Feijoada",
"Fermento",
"Fiambre",
"Fibra",
"Figada",
"Figado",
"Figo",
"Filé",
"Filhos",
"Fios",
"Flocos",
"Folha",
"Fraldinha",
"Frango",
"Fruta",
"Fubá",
"Galeto",
"Galinha",
"Galinhada",
"Garapá",
"Gatorade",
"Geladinho",
"Gelatina",
"Geléia",
"Gemada",
"Gergelim",
"Germe",
"Glicose",
"Goiá",
"Goiaba",
"Goiabada",
"Goma",
"Granola",
"Grão",
"Graviola",
"Graviola",
"Grustoli",
"Guaimu",
"Guaraná",
"Guariroba",
"Gueroba",
"Guisado",
"Hambúrguer",
"Hortelã",
"Imbu",
"Ingá",
"Inhame",
"Iogurte",
"Io-Iô crem",
"Jabá",
"Jabuticaba",
"Jaca",
"Jacaré",
"Jambo",
"Jamelão",
"Jardineira",
"Jenipapo",
"Jerimum",
"Jiló",
"Juçara",
"Jujuba",
"Jurubeba",
"Jussara",
"Ketchup",
"Kinder",
"Kitute",
"Kiwi",
"Lagarto",
"Lambari",
"Laranja",
"Laranjinha",
"Lasanha",
"Legume",
"Leite",
"Lentilha",
"Levedo",
"Licor",
"Lima",
"Limão",
"Lingua",
"Lingüiça",
"Lombo",
"Lula",
"Maçã",
"Macarrão",
"macarronada",
"Macaúba",
"Macaxeira",
"Maionese",
"Mamão",
"Maminha",
"Mandioca",
"Mandioquinha",
"Manga",
"Mangaba",
"Mangalô",
"Manguito",
"Maniçoba",
"Manjar",
"Manjericão",
"Manjuba",
"Manteiga",
"Mão",
"Maracujá",
"Margarina",
"Mari",
"Maria",
"Maricota",
"Mariola",
"Marisco",
"Marmelada",
"Martini",
"Massa",
"Mate",
"Maxixe",
"Mel",
"Melado",
"Melancia",
"Melão",
"Merengue",
"Merluza",
"Mexerica",
"Mil Folhas",
"Milho",
"Milk Shake",
"Mimosa",
"Mingau",
"Mini chicken",
"Mini pizza",
"Minipastel",
"Minuano",
"Miojo",
"Miolo",
"Misto",
"Miúdo",
"Mix de cereais",
"Mocotó",
"Moela",
"Molho",
"Moqueca",
"Moranga",
"Morango",
"Morcela",
"Morcilha",
"Mortadela",
"Mostarda",
"Mousse",
"Muçarela",
"Mucilon",
"Mumu",
"Mungunzá",
"Murici",
"Músculo",
"Musli",
"Mutum",
"Nabo",
"Nambu",
"Nata",
"Nectarina",
"Nescafé",
"Nêspera",
"Neston",
"Nhoque",
"Noz",
"Nuggets",
"Óleo",
"Omelete",
"Orégano",
"Orelha",
"Ossada",
"Ostra",
"Outros",
"Ovas",
"Ovo",
"Ovomaltine",
"Pá",
"Paçoca",
"Paçoquinha",
"Pacová",
"Paio",
"Paleta",
"Palma",
"Palmito",
"Pamonha",
"Panelada",
"Panetone",
"Panqueca",
"Pão",
"Papaia",
"paraguai",
"Parte de galinha",
"Passa",
"Pasta",
"Pastéis",
"Pastel",
"Pastilha",
"Patauá",
"Patê",
"Patinho",
"Pato",
"Paulista",
"Pavê",
"Pé",
"Peito",
"Peixe",
"Peixe não especificado",
"Pepino",
"Pele de porco",
"Pepininho",
"Pépino",
"Pequi",
"Pêra",
"Pernil",
"Peru",
"Pescada",
"Pescadinha",
"Pescoço",
"Pessegada",
"Pêssego",
"Pettit-pois",
"Picanha",
"Picles",
"Picolé",
"Pimenta",
"Pimentão",
"Pinha",
"Pinhão",
"Pintado",
"Pipoca",
"Pirão",
"Pirulito",
"Pistache",
"Pitanga",
"Pitomba",
"Pizza",
"Polenta",
"Polpa",
"Polvillo",
"Porco",
"Porquinho",
"Posta",
"Prato",
"Presuntada",
"Presuntinho",
"Presunto",
"Proteína",
"Puba",
"Pudim",
"Pupunha",
"Purê",
"Pururuca",
"Q-refresko",
"Q-suco",
"Quarto",
"Quebra-quebra",
"Quebra-queixo",
"Quechimia",
"Queijadinha",
"Queijo",
"Quiabo",
"Quibe",
"Quibebe",
"Quicaré",
"Quiche",
"Quindim",
"Quinoa",
"Quirera",
"Rabada",
"Rabanete",
"Radite",
"Rapadura",
"Ravioli",
"Refresco",
"Refrigerante",
"Repolho",
"Requeijão",
"Rim de boi",
"Risoto",
"Rissole",
"Rocambole",
"Romã",
"Rosca",
"Rosquinha",
"Rúcula",
"Rum",
"Sagu",
"Sal",
"Salada",
"Salame",
"Salaminho",
"Salgadinho",
"Salmão",
"Salpicão",
"Salsa",
"Salsão",
"Salsicha",
"Sanduíche",
"Sapoti",
"Sarapatel",
"Sardinha",
"Sarolho",
"Sarrabulho",
"Schimier",
"Seleta",
"Semente de linhaça",
"Sequilho",
"Serralha",
"Shoyo",
"Shoyu",
"Sidra",
"Siri",
"Sobramesa",
"Soja",
"Solda",
"Sonho",
"Sopa",
"Sorvete",
"Sprit",
"Steak",
"Strogonoff",
"Suã",
"Suco",
"Sucrilhos",
"Suflê",
"Sukita",
"Sururu",
"Sushi",
"Suspiro",
"Sustagem",
"Tablete de chocolate",
"Tabule",
"Tacacá",
"Taioba",
"Tamarindo",
"Tangerina",
"Tanja",
"Tapereabá",
"Tapioca",
"Tareço",
"Tatu",
"Tempero a base de sal",
"Tender",
"Tereré",
"Toddynho",
"Tofu",
"Tomate",
"Torrada",
"Torrão",
"Torresmo",
"Torrone",
"Tortas",
"Toucinho",
"Tracajá",
"Tremoço",
"Tripa",
"Trufa",
"Tubaína",
"Tucumã",
"Tucunaré",
"Tucupi",
"Tutu",
"Uaçaí",
"Uísque",
"Umbu",
"Uva",
"Uxi",
"Vaca atolada",
"Vagem",
"Vatapá",
"Vazio (carne bovina)",
"Vinagreira",
"Vinagrete",
"Vinho",
"Virado à paulista",
"Víscera bovina","Vitaflocos","Vitamilho","Vitamina","Vodka","Waffer","Whisky","Xerém de milho","Yakisoba","Yakult"
    ];
    $("#tagscomida").autocomplete({
      source: availableTags
    });
  } );
  </script>

<style>
table {
  border-collapse: collapse;
 margin: 0;
    padding: 0 0 0 0;
    border: 3;
}
.table td {
                border-right: 1px solid red;
                border-bottom: 1px solid red;
                margin: 0;
                margin: 0;
                padding: 0;
            }
textarea {
  width: 500px;
  height: 30px;
  resize: none;
}
</style>
<!--<div class="row">-->
<!--<div class="col s6 m11 push-s1">-->
<h3 class="light"> Area especializada (Selecao de alimentos)</h3>
<br />
<br />
<table>
<tr><td width="50%"></td><td width="70%">
 <label for="tags">Tags: </label>
 <div class="ui-widget">
            <input id="tagscomida" value="*">
</div>
</td></tr>

</table>
<div class="input-field col s12">




<table>
<tr><td width="10%"></td><td>Cardapio</td><td width="10%"></td></tr>
<tr><td></td><td>
<script>
function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
</script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".ingred" ).change(function() {
  	var value = $(this).val();
    alert('value: '+ value);
  });
});
</script>
<script>
function getSelectedOptions(sel) {
    var opts=[],
    opt;
  var len = sel.options.length;
  for (var i = 0; i < len; i++) {
    opt = sel.options[i];
	//console.log(JSON.stringify(opt));
    if (opt.selected) {
      //opts.push(opt); trocada para guardar nro alimento
	  //console.log(opt[0]);
	  //console.log(type(opt));
	  console.log("opts");
	  console.log(opts);
	  console.log("opt");
	  console.log(opt);
	  console.log(opt.value);
	  opts.push(opt.value);
	  //console.log(opts);
	  //console.log(i);
 //     alert(opt.value);
      //console.log(typeof(opts));
	  //console.log(opt);   funciona hasya 12:43 mejorar la salida 
	  //console.log(opts);
	  //const myJSON = JSON.stringify(opts);
	  //console.log(opts.value);
	  //console.log(String(opts.value));
    }
  }
  setCookie('cardapio',opts,1);
  return opts;
 }


</script>


<script>
$(function ()
    {
        $('#filtroselec').change(function () {
            setCookie('filtroselec',$('#filtroselec').val(),2);
			//console.log(=alert($('#filtroselec').val());
        });
    });
</script>
<?php 
$text='%';
if ($_POST) // If form was submited...
{
	$opts = [];
    $text = $_POST["tagscomida"]; // Get it into a variable
 //   echo "<h1>$text</h1>"; // Print it!
 $query="select * from db_alim where Desc_alimento like '%$text%'";
$result=mysqli_query($connect,$query);
//print_r($opts);
echo "<select size='50' name='ingred[]' id='ingred' multiple onChange='getSelectedOptions(this)'>";
while ($row = mysqli_fetch_array($result)) {
	//echo "<textarea  rows='12' id='mytextarea'>".$row['Desc_alimento']."</textarea>";
    echo "<option value='" . $row['Nro_alimento'] . "'>" . $row['Nro_alimento'] . "   " .$row['Desc_alimento']. ',  ' .$row['energia']. ',   ' .$row['proteina']. ',   ' .$row['lipideos']. ',  ' .$row['carboidratos'] . "</option>";
}
 
}

echo "</select>";

?>
</td><td></td></tr>
</table>
<script>
localStorage.clear();
</script>


<table border="1px">
<form name='myForm' method="POST">
<?php
if(isset($_POST['submiting'])){
if (!empty($_POST['ingred'])){
 foreach ($_POST['ingred'] as $selected){
  echo $selected;
  echo "\n";
}}}
?>
</td><td rowspan="8"></td></tr></strong>
</table>
</div>
<!--<a href=" " class="btn">Generar Dieta</a>-->
<a href="gerardieta.php" class="btn">Generar Dieta</a>
<a href="calc_espec.php" class="btn"><< Retornar</a>
</form>
<!--</div>-->
<!--</div>-->
<?php
include_once 'includes/footer.php';
?>
</body>
</html>