<?php
include ("connect.php");

if(isset($_GET['excluir'])){

    $id = intval($_GET['excluir']);
    $sql_query = $mysqli->query("SELECT * FROM  produtos WHERE produto_id = '$id'") or die ($mysqli->error);
    
   
    $arquivo = $sql_query->fetch_assoc();
   

    if(unlink($arquivo['produto_img'])){
        $mysqli->query("DELETE FROM produtos WHERE produto_id = '$id'") or die($mysqli->error);
        echo "<p>Arquivo deletado!!";
        header('location: cart.php');
    }

    
}

$sql_query = $mysqli->query("SELECT * FROM produtos") or die($mysqli->error);

?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Carrinho de compras</title>
</head>
<body>


    <table class="cart">
        <caption>Produtos</caption>
        
        <thead>
            <tr>
                <th>Foto</th>
                <th>Produto</th>
                <th>Descriçao</th>
                <th>Valor R$</th>
                <th>config</th>
            </tr>
        </thead>
    
        <tbody>
        <?php
        while($produtos = $sql_query->fetch_assoc()){
        ?>
            <tr>
                <td><img height="50" src="<?php echo $produtos['produto_img']?>" alt=""></td>
                <td><?php echo $produtos['produto_nome'] ?> </td>
                <td><?php echo $produtos['produto_descricao']?></td>
                <td><?php echo $produtos['produto_preco']?></td>
                <td><a href="cart.php?excluir=<?php echo $produtos['produto_id'] ?>">Excluir</a></td>
            </tr>

            <?php
            }
            ?>

        </tbody>
            
        <tfoot>
            <tr>
                <th scope="row" colspan="3">TOTAL R$ </th>
                <th scope="row" colspan="2" class="vlr">0,00</th>
            </tr>
        </tfoot>
    </table>
    
</body>
</html>