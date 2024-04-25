<?php
//echo $_COOKIE["qclientes"];
//echo $_COOKIE["dataactual"];
$num_rows=$_COOKIE["qclientes"];
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
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
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
function loaddata(){
	  let data_actual = getCookie("dataactual")
	  //print(data_actual);
	  console.log(data_actual);
	  console.log(typeof(data_actual));
	  let num_rows = getCookie("qclientes");
	  array1=data_actual
	  console.log(num_rows)
	  for (er=1;er<=(num_rows+1);er++){
		  array1=array1.replace('1*','');
		  //console.log(er)
		  //console.log(array1)
		  }
	  
	  array2=array1.split(">")	  
	  
	  console.log(array2)
	  
	  console.log(array2[0])
	  console.log(array2[6])
	  
	   var theader = '<div><table border="0">\n';
	   var tbody = '';
          tbody += '<tr>';
          tbody += '<td>';tbody += " ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "Nome ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "Kcal ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "% carbos ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "% proteinas ";tbody += '</td>';
          tbody += '<td>';tbody += '<center>';tbody += "% lipideos ";tbody += '</td>';
          tbody += '</tr>';
		  //nome1="Santiago";
		  for($u=1; $u<=num_rows; $u++){
              tbody += '<tr>';
              tbody += '<td>';      tbody += "cliente " + ($u);            tbody += '</td>'
              tbody += '<td>'; tbody+='<input placeholder="nome usuario" type="text" id="cliente" name="cliente" value='+array2[0+5*($u-1)]+'>'; tbody += '</td>'; tbody += '<td>';
              tbody+='<input type="number" placeholder="kcal" id="kcal" name="kcal" value='+array2[1+5*($u-1)]+' size="4" maxlength="10">';     tbody += '</td>';
              tbody += '<td>';  tbody+='<input type="number" step="any" id="carboidratos" name="carboidratos" value='+array2[2+5*($u-1)]+' size="4" maxlength="10">';     
			  tbody += '</td>'; tbody += '<td>'; tbody+='<input type="number" step="any" id="proteinas" name="proteinas" value='+array2[3+5*($u-1)]+' size="4" maxlength="10">';           
			  tbody += '</td>'; tbody += '<td>'; tbody+='<input type="number" step="any" id="lipideos" name="lipideos" value='+array2[4+5*($u-1)]+' size="4" maxlength="10">'; 
			  tbody += '</td>'; tbody += '</tr>\n';
			  }
		  var tfooter = '</table></div>';
    document.getElementById('wrapper').innerHTML = theader + tbody + tfooter;  
	}
	</script>
<html>
<head>
</head>
<body onload="localStorage.clear()">
  <h3 style='color: black; font-family:Helvetica; font-weight: bold; font-size: 34px;' id="po"> Ajuste dados clientes</h3>
<table border="0">
<tr><td style="width:5%">  </td><td style="width:30%"></tr>
<tr><div id="wrapper"></div></td></tr>
<tr><form name="tablegen"><br>
<br><input name='load' type='button' value='LOAD INF' onclick='loaddata()'/>
<input name='modif' type='button' value='MODIFICAR INF' onclick='savemodif()'/>
</form>

</tr>
<td style="width:5%"></td>
</tr>
<tr>
<td></td>
<br></td></form>
<td></td></tr>
<tr><td style="width:5%"></td>
<td style="width:5%"></td></tr>
</table>
    <p id="par"></p>
    <p id="subcadena"></p>
    <p id="method"></p>
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
  var k = "";
  function savemodif() {
            var memo =[];
            var nomes= document.getElementsByName('cliente');
	    var kcals= document.getElementsByName('kcal');
	    var carbos= document.getElementsByName('carboidratos');
	    var prots= document.getElementsByName('proteinas');
        var lips = document.getElementsByName('lipideos');
//      document.getElementById("po").innerHTML = nodeList.values(kcals);
        var selectopt=1;   
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
			   window.location.href = "precalc_otim0.php";
			}
			
    </script>
</body>
</html>