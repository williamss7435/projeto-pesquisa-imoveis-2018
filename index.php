<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="_img/logo-tenda-35x35.png">
    <title>Login</title>
    <link rel="stylesheet" href="_comp/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/login.css">
</head>
<body>
 	<div class="container-fluid">
            <form action="../ge/dados/autenticacao.php" method="post" class="box-login col-12 col-md-4 offset-md-4">

 			<div class="row mt-5 mb-4">
 				<div class="col-12">
 					<img src="_img/logo-tenda-white-300x90.png" alt="Logo Tenda" class="img-fluid mx-auto d-block">
 				</div>
 			</div>

 			<div class="form-group row">
 				<div class="col-12 mt-4">
 					<input type="text" placeholder="Login" class="form-control" name="login" id="login">
 				</div>
 			</div>


			<div class="form-group row">
 				<div class="col-12 mb-3">
 					<input type="password" placeholder="Senha" class="form-control" id="password" name="password">
 				</div>
 			</div>

 			<div class="form-group row">
 				<div class="col-12 mb-5">
 					<button type="submit" class="form-control btn btn-success btn-lg mb-1">Entrar</button>
 				</div>
 			</div>
			
 		</form> 
 	</div>
    
    <script src="_comp/jquery-3.3.1.min.js"></script>
    <script src="_comp/popper.min.js"></script>
    <script src="_comp/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


