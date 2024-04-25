<?php
include_once 'includes/header.php';
include_once 'includes/mensagem.php';
?>
<div class="row">
<div class="col s12 m6 push-s3">
<h3 class="light"> Novo Usuario </h3>
<form action="actions/createuser.php"  method="POST">

<div class="input-field col s12">
<table cellspacing="0" cellpadding="0">
<tr><td><p><strong>Nome usuario:</strong></td>
<td><textarea width="30px" class="form-control animated" name="nomeuser" id="nomeuser" placeholder="nome usuario" required></textarea>
</td></td></tr>
<tr><td><p><strong>Email usuario:</strong>
</td>
<td>
<input width="30px" type="email" id="useremail" name="useremail" required>
</td></td></tr>
<tr><td><p><strong>Senha:</strong></td>
<td>
<input type="text" id="usersenha" name="usersenha" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}" title="Sugestao ->Must contain at least one uppercase and lowercase letter, and at least 4 or more characters" required>
</td></td></tr>
<tr><td><p><strong>Tipo Perfil:</strong></td>
<td><select name="perfil" id="perfil">
    <option value="Admin">Administrador</option>
    <option value="Parceiro">Parceiro</option>
    <option value="Usuario">Usuario</option>
  </select>


</td></td></tr>
</table>
</div>


<button type="submit" name="btn-cadastrar" class="btn"> Incluir</button>
<a href="indexusuarios.php" class="btn green"> Lista Usuarios</a>
<a href="gest_user.php" class="btn green"> Retornar gestao usuarios</a>
</form>
</div>
</div>
<?php
include_once 'includes/footer.php';
?>
