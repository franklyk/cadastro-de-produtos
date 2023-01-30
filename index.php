<?php
include ("connect.php");

if(isset($_FILES['picture_input'])){
    // var_dump($_FILES['picture_input']);  
    $produto = $_POST['produto'];
    $ingredientes = $_POST['ingredientes'];
    $preco = $_POST['preco'];
    $imagem = $_FILES['picture_input'];
    if($imagem['error'])
        die("Falha ao enviar Imagem");
    if($imagem['size'] > 2097152)
        die("Tamanho de arquivo máximo suportado: 2Mb!!");

    $destino = "b_img/";
    $nomeDaImagem = $imagem['name'];
    $novoNomeDaImagem = uniqid();
    $extensao = strtolower(pathinfo($nomeDaImagem, PATHINFO_EXTENSION));

    if($extensao != "jpg" && $extensao != "png")
        die("TIPO DE IMAGEM NÃO SUPORTADO!!");
    $path = $destino . $novoNomeDaImagem . "." . $extensao;
    $enviado = move_uploaded_file($imagem["tmp_name"], $path);
    if($enviado){
        $mysqli->query("INSERT INTO produtos (produto_img, produto_nome, produto_descricao, produto_preco) VALUES('$path','$produto','$ingredientes','$preco') ") or die ($mysqli->error);
        echo "<p>Arquivo enviado com sucesso!!<p>";
    }else{
        echo "<p>FALHA AO ENVIAR IMAGEM</p>";

    }
    
}

// include_once ("connect.php");
// if(isset($_POST['submit'])){
//     $produto = $_POST['produto'];
//     $ingredientes = $_POST['ingredientes'];
//     $preco = $_POST['preco'];
   
//     $result = mysqli_query($mysqli, "INSERT INTO produtos(produto_nome,	produto_descricao, produto_preco) VALUES ($produto,$ingredientes, $preco)");
// }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <div class="container">
        <form enctype="multipart/form-data" action="index.php" method="post">
            <fieldset>
                <legend>
                    Produtos
                </legend>

                
                <div class="container_cadastro">
                    <label>KLYKWEB-SITES</label>
                    <br><br>
                    <label for="produto"> Produto:</label>
                    <br>
                    <input type="text" name="produto" id="produto">
                    <br><br>
                    <label for="ingredientes"> Ingredientes:</label>
                    <br>
                    <textarea type="text" name="ingredientes" id="ingredientes"></textarea>
                    <br><br>
                    <label for="preco"> Valor R$:</label>
                    <br>
                    <input type="number" name="preco" id="preco" step="0.01">
                    <br>
                    
                </div>
                <div class="container_imagem">
                    <label class="picture" for="picture_input" tabIndex="0">
                    
                        <span class="picture_image"></span>
                        <input type="file" name="picture_input" accept="image/*" id="picture_input">
                    </label>
                    <br><br>
                    <input type="submit" name="submit" id="submit" value="Salvar">
                </div>


            </fieldset>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>