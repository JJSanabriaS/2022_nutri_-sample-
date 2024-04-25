<?php
include_once 'includes/header.php';
include_once 'includes/mensagem.php'
?>

<h1>Novo Alimento</h1>
<div class="row" >
<div class="col s6 m11 push-s9">
<h3 class="light"></h3>
<form action="actions/createalim.php" method="POST">
<div class="input-field col s12" >
  <b id="version"></b><script>
var empresa_ed = sessionStorage.getItem('empresa_var');
  console.log(empresa_ed);
  document.getElementById("version").innerHTML=empresa_ed;</script><br>
<table>
<tr>
<td>Descricao alimento</td>
<td>Energia(kcal)</td>
<td>Proteina (%)</td>
<td>Lipideos(%)</td>
<td>Carboidratos(%)</td>
<td>Fonte inform</td>
</tr>
    <tr>
<td>
<input type="text" id="Desc_Alimento" name="Desc_Alimento" Required />
</td>
<td><input type="number" step="any" id="Energia" name="Energia" /></td>
<td><input type="number" step="any" id="Proteina" name="Proteina" /></td>
<td><input type="number" step="any" id="Lipideos" name="Lipideos" /></td>
<td><input type="number" step="any" id="Carboidratos" name="Carboidratos" /></td>
<td><input type="text" id="Fonte" name="Fonte"/></td>
    </tr>
</table>
</div>
<button type="submit" name="btn-cadastrar" class="btn"> Incluir</button>
<a href="index_alim.php" class="btn green"> Listar alimentos</a>
<a href="mandala.html" class="btn green"> Retornar menu</a>
</form>
</div></div>
<script>
var x = 0;
function myEnterFunction() {
  if (x < 1){
  location.reload();
  x=x+1;
}
}
</script>
<script>
onmouseover="window.location.reload()"
</script>
<?php
include_once 'includes/footer.php';
?>