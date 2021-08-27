<!DOCTYPE html>	
<?php
	if (!isset($_SESSION)) {
		session_start();
	}
	$str_login_error = 'loginErro';
	$str_login_deslogado='logindeslogado';	
?>
<style>
    #informacoes {
        display: none;
        font-family: "Times New Roman", Times, serif;
        font-size: 30px;
				width:100%;
    }
    
    #tabelaprimaria {
        display: none;
    }
</style>
<html lang="pt-br"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Leitura QRCode - Cliente Honda</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="login/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="css/nprogress.css" rel="stylesheet">
	<!-- Animate.css -->
	<link href="css/animate.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="css/custom.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script type="text/javascript" src="scripts/qrcode.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
</head>
<body class="login" onLoad='javascript:window.clear.history(0)'>
	<div>
	
			<center>
			
					<div>
						<p><img src="imagens/logo.svg" alt="" width="100px"></p>
					</div>				
					<div class="separator" style="margin-top: 0px; padding-top: 0px;"></div>
					<div><h1 style="margin-top: 0px; margin-bottom: 0px;">Painel de leitura</h1></div>
					<div class="separator" style="margin-top: 0px; padding-top: 0px;"></div>
					<div id='principal'>
						
							<div><h1 class="btn-success btn-block" style="border-color: #0060AA; background: #0F5499; color: #fff; margin-top: 0px; margin-bottom: 0px;">Aponte a ca&#770;mera</h1></div>
										
						<div class="separator" style="margin-top: 0px; padding-top: 0px;"></div>
						
						    <video id="preview" width="180px" ></video>
                    </div>      

                    <div id="tabelaprimaria">
                        <h1 id="nEtiqueta"></h1>
                    </div>
                                    
            <div id="informacoes">
							
							<table id="tabela" class="table table-bordered" width="100%">
								<!-- <thead><tr></tr></thead> -->
                <tbody>
									<tr>
										<td colspan="2"  style="text-align:center;">
											<div id="codigoItemHonda"> </div>
                    </td>
										<!-- <td>
												<p id="codigoItemHonda"> </p>
										</td> -->
									</tr>
									<tr>
										<td>Quantidade</td>
										<td><p id="quantidade"></p></td>
                  </tr>
									<tr>
										<td>UN de Medida </td>
										<td><p id="unidadeMedida"></p></td>
									</tr>
									<tr>
										<td> Pedido </td>
										<td><p id="pedido"></p></td>
                  </tr>
                  <tr>
										<td> Tipo </td>
                    <td><p id="tipo"></p></td>
                  </tr>
									<tr>
											<td> Linha </td>
											<td><p id="linha"></p></td>
									</tr>
                  <tr>
										<td> Nota Fiscal </td>
										<td><p id="notaFiscal"></p></td>
									</tr>
									<tr>
										<td> Data de Fabric&ccedil;&atilde;o </td>
										<td><p id="dataFabricacao"></p></td>
									</tr>
									<tr>
										<td>Estoque</td>
										<td><p id="estoque"></p></td>
									</tr>
                </tbody>
							</table>
						<div class="clearfix"></div>
						<div>
							<button class="btn btn-success submit btn-block" type="button" onclick="LimparTela()" >Nova Leitura</button>
							
						</div>													
						</div>
						<div class="separator">							
							<div class="clearfix"></div>
								<p>©2021 All Rights Reserved. GrupoIS!</p>
						</div>

			</center>
		</div>
			
		</div>
	
</body>
</html>
<script>
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    scanner.addListener('scan', function(content) {      
        if (content.length == 107) {
            document.getElementById('principal').style.display = 'none';         
            var codigoItemHonda = content.slice(1, 26);
            var quantidade = parseInt(content.slice(26, 39));
            var unidadeMedida = content.slice(39, 41);
            var validade = content.slice(41, 49);
            var pedido = content.slice(49, 57);
            var tipo = content.slice(57, 59);
            var linha = parseInt(content.slice(59, 65));
            var notaFiscal = parseInt(content.slice(65, 78));
            var dataFabricacao = content.slice(78, 86);
            var estoque = parseInt(content.slice(86, 99));
            var nEtiqueta = content.slice(99, content.length + 1);
            document.getElementById('tabelaprimaria').style.display = 'block';
            document.getElementById('informacoes').style.display = 'block';
            stringDoItem = "Item : " + codigoItemHonda;
            document.getElementById('quantidade').innerHTML = quantidade;
            document.getElementById('unidadeMedida').innerHTML = unidadeMedida;
            document.getElementById('pedido').innerHTML = pedido;
            document.getElementById('tipo').innerHTML = tipo;
            document.getElementById('linha').innerHTML = linha;
            document.getElementById('notaFiscal').innerHTML = notaFiscal;
            document.getElementById('dataFabricacao').innerHTML = dataFabricacao;
            document.getElementById('estoque').innerHTML = estoque;
            document.getElementById('nEtiqueta').innerHTML = nEtiqueta;
            $.post("configbd.php", {
                id: codigoItemHonda
            }, function(retorna) {
                document.getElementById('codigoItemHonda').innerHTML = stringDoItem + " <br> " + retorna;
            });
        } else {
            alert("QrCode Invalido");
        }
    });
    Instascan.Camera.getCameras().then(cameras => {
        let selectedCamera;
        if (cameras.length > 0) {
            for (let c = 0; c < cameras.length; c++) {
                if (cameras[c].name.indexOf('back') != -1) {
                    selectedCamera = cameras[c];
                }
            }

            if (!selectedCamera) selectedCamera = cameras[0];
        }

        if (selectedCamera) {
            scanner.start(selectedCamera);
        } else {
            console.error("No cameras found.");
        }

    });

    // função para gerar o qrCode
    // function createQrCode(userInput) {
    //     // var userInput = document.getElementById('valor').value;
    //     var qrcode = new QRCode("qrcode", {
    //         text: userInput,
    //         width: 128,
    //         height: 128,
    //         colorDark: "black",
    //         colorLight: "white",
    //         correctLevel: QRCode.CorrectLevel.H
    //     });
    // }


    function LimparTela() {
     
        document.location.reload(true);
    }
</script>