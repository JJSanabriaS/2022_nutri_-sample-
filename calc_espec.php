<?php
require_once 'actions/db_connect.php';
function clear($input){
global $connect;
$var=mysqli_escape_string($connect,$input);
$var=htmlspecialchars($var);
return $var;
}
?>
<style>

.button {
  background-color: #26a69a; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

input[type="text"], textarea {
  background-color : #d1d1d1; 

}

input[type='number']{
    width: 80px;
   background-color : #d1d1d1; 
}
input[type=button], input[type=submit], input[type=reset] {
  background-color: #26a69a; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
input[type=button], input[type=submit], input[type=reset]:disabled {
  background-color: #26a69a;
}
</style>
<script>
const origConsoleLog = console.log;
const logArr = [];
console.log = (...args) => {
  origConsoleLog.apply(console, args);
  logArr.push(args);
};
const logAll = () => {
  origConsoleLog.call(console, logArr.join('\n'));
  $dataactual =logArr.join('\n')
  localStorage.setItem('logclientes',$dataactual);
  };
</script>
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

<script>
function readConsole(){
   consoleStorage.forEach(msg => {doSomething(msg);});
}
</script>
<script>
function createTable()
{
    num_super=1;
    num_cols=5;
    num_ports=1;
    var num_rows = document.getElementById('clientenutrix').value;
	var tbody = '';
    var colStart = num_cols / num_super;
    for( var i=0; i<num_super; i++){
        var theader = '<div><table border="0">\n';
          tbody += '<tr>';
          tbody += '<td>';tbody += " ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "Nome ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "Kcal ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "% carbos ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "% proteinas ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "% lipideos ";tbody += '</td>';
              tbody += '</tr>';
            for($u=1; $u<=num_rows; $u++){
              tbody += '<tr>';
              tbody += '<td>';      tbody += "cliente " + ($u);            tbody += '</td>'
              tbody += '<td>'; tbody+='<input placeholder="nome usuario" type="text" id="cliente" name="cliente" value="">'; tbody += '</td>'; tbody += '<td>';
              tbody+='<input type="number" placeholder="kcal" id="kcal" name="kcal" value="" size="4" maxlength="10">';     tbody += '</td>';
              tbody += '<td>';  tbody+='<input type="number" step="any" id="carboidratos" name="carboidratos" value="" size="4" maxlength="10">';     
			  tbody += '</td>'; tbody += '<td>'; tbody+='<input type="number" step="any" id="proteinas" name="proteinas" value="" size="4" maxlength="10">';           
			  tbody += '</td>'; tbody += '<td>'; tbody+='<input type="number" step="any" id="lipideos" name="lipideos" value="" size="4" maxlength="10">'; 
			  tbody += '</td>'; tbody += '</tr>\n';
    }
    var tfooter = '</table></div>';
    document.getElementById('wrapper').innerHTML = theader + tbody + tfooter;  }
	setCookie('qclientes',num_rows,1);
}
</script>
<html>
<head>
</head>
<body onload="console.clear()">
  <h3 style='color: black; font-family:Helvetica; font-weight: bold; font-size: 34px;' id="po"> Entrada dados clientes</h3>
<table border="0">
<tr>
<td style="width:5%"></td>
<td style="width:30%">
<form name="tablegen"><br><br>
<label>Clientes: <input type='text' name='clientenutrix' size='4' maxlength='1' id='clientenutrix';'/></label><br />
<input name='generate' type='button' value='ADICIONAR INF' onclick='createTable()';'/>

</form>
<div id="wrapper"></div></td>
<td style="width:5%"></td>
</tr>
<tr>
<td></td>
<td><p>Qual metodo de solucao deseja:</p>
<input type="radio" id="otimizacao" name="met_sol" value="otimizacao">
<label for="Otimizacao">Otimizacao</label><br>
<input type="radio" id="pesquisa" name="met_sol" value="pesquisa">
<label for="Pesquisa">Pesquisa</label><br>
<br></td></form>
<td></td></tr>
<tr><td style="width:5%"></td>
<td style="width:30%"><input name='generdiet' id='generdiet' onclick='Captvars()' type='button' value='CONTINUAR >>'/>
<button class="button"><a href="mandala.html" style="text-decoration: none;"><< MENU OPC</a></button></td>
<td style="width:5%"></td></tr>
</table>
    <p id="par"></p>
    <p id="subcadena"></p>
    <p id="method"></p>
  <script type="text/javascript">
//        var k = "The respective values are :";
        var k = "";
        function Captvars() {
            var memo =[];
            var nomes= document.getElementsByName('cliente');
	    var kcals= document.getElementsByName('kcal');
	    var carbos= document.getElementsByName('carboidratos');
	    var prots= document.getElementsByName('proteinas');
            var lips = document.getElementsByName('lipideos');
//            document.getElementById("po").innerHTML = nodeList.values(kcals);
            if (document.getElementById('otimizacao').checked == true) {   
            var selectopt=1;   } else {           var selectopt=2;   }  
               for (var i = 0; i < nomes.length; i++) {
				  var a = nomes[i];
				  var b=kcals[i];
				  var c=carbos[i];
				  var d=prots[i];
				  var e=lips[i];
    //				  k = k + "array[" + i + "].value= "+ a.value + '>'+ b.value + ">"+ c.value + ">"+ d.value + ">"+ e.value + //",,"+selectopt+",,.,,";
				  k = k + a.value + '>'+ b.value + ">"+ c.value + ">"+ d.value + ">"+ e.value + ">"+selectopt+"*";
//">"+f.value+">"+g.value+">"+h.value+">"+
				  console.log(a.value + ";"+ b.value + ";"+ c.value + ";"+ d.value + ";"+e.value+";"+selectopt+"\r");
//+f.value+";"+g.value+";"+h.value+";"
				  }
            //document.getElementById("po").innerHTML = "Output";
			   logAll();
               setCookie('dataactual',k,1);
			   			   
            if (selectopt==1){
			 //document.getElementById("method").innerHTML =" otimizacao";            
			 console.log("continua com otimizacao");
			 window.location.href = "precalc_otim0.php";
             } else if (selectopt==2){
				// document.getElementById("subcadena").innerHTML ="pesquisa";  
				 console.log("continua com pesquisa");
			     window.location.href = "alert_bus.html"
 }
        }
    </script>
</body>
</html>