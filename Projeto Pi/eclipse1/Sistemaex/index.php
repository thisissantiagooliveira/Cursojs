<?php
//verificar se o usuario j� esta logado

?>
<!doctype html>
<html>
<head>
<title>Sistema</title>
<meta charset="UTF-8"/>
</head>
<style>
a{
color:#8B9BA8; 
text-decoration: none;
padding-left:30px; 
font-size:18px;
}
a:hover{
text-decoration: underline;
}
</style>
<body>
<table width="1000" border="0"
cellspacing="0" cellspading="0">

<tr style="background-color:#005497;">
<td colspan="2">
	<table wider="100%" border="0" cellspacing="0" cellspading="0">
	<tr style="background-color:#005497; height: 50px;">
	<td wider="60%"><span style="color:#ffffff; padding-left:25px; ">UTIC - unidade de Tecnologia da Informação e Comunicação</span></td>
	<td wider="40%" align="right"><span style="color:#ffffff; padding-left:410px;"> Logue no sistema <img src="img\perfil.png" width="30" align="center" ></span></td>
	</tr>
	</table>
</td>
</tr>

<tr>
<td colspan="2">
<table wider="100%" border="0" cellspacing="0" cellspading="0">
	<tr style=" height: 90px;">
	<td wider="30%"><img src="img\logo.png" width="200" style="padding-left:30px"></td>
	<td wider="70%" align="center">
	<span style="padding-left:100px">
	<img src="img\home6.png"	height="40">&nbsp;
	<img src="img\utic.png"		height="40">&nbsp;
	<img src="img\equipe.png" 	height="40">&nbsp;
	<img src="img\noticias.png" height="40">&nbsp;
	<img src="img\cursos5.png" height="40">&nbsp;
	<img src="img\turmas5.png" height="40">&nbsp;
	<img src="img\ambiente2.png" height="40">&nbsp;
	</span>
	</td>
	</tr>
	</table>
</td>
</tr>

<tr>
<td width="30%">
<table width="100%" border="0" cellspacing="0" cellspading="0">
<tr>
<td height="40"><span style="color:#FF7226; font-size:14px; font-family: century Gothic; padding-left:30px ">Painel</span> <img src="img\seta.jpg" align="center" width="10"/>
<span style="color:#898591; font-size:14px; font-family: century Gothic;"> Admistração do site </span><img src="img\seta.jpg" align="center" width="10"/></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td width="30%">
<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Painel de Controle</span></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center"> Usuario do Sistema</a></td>
</tr>
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center"> Localidades</a></td>
</tr>
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center"> Entrada</a></td>
</tr>
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center"> Empresas</a></td>
</tr>
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center">  Solicitações</a></td>
</tr>
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center">  Turmas</a></td>
</tr>
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center">  Matriculas</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>	
<td width="30%">
<span style="color:#FF6E06; padding-left:30px; font-size:18px;">Relatorios</span></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
	
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center">  Por Turmas</a></td>
</tr>
<tr>
<td><a href="#"><img src="img\quad.jpg" width="9" align="center">  Por curso</a></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>	
<td width="70%" align="center" valign="top">
<form action="validarLogin.php" method="post">
<label>Login:</label>
<input type="text" name="login" maxlength="10"/><br/><br/>
<label>Senha:</label>
<input type="password" name="senha" maxlength="10"/><br/><br/>
<input type="submit" value="Enviar"/>
</form>	
</td>		
</tr>

<tr style="background-color:#0D2263; color:#FFFFFF" >
<td coslpan="2" align="center">
<span>
<img width="55" src="img\logo2.png"/><br/>
	Av.joão de barros, N° 1593 - Espinheiro - Recife - PE, CEP 52.021-180<br/>
	(81) 31348100
</span>		
</td>
</tr>
</table>

</body>
</html>