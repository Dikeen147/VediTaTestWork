<!DOCTYPE HTML>
<html>
<head>
    <title>test work form VediTa</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="bg-dark text-white text-center p-2">Test work from VediTa</div>  
            </div>
        </div>
        <div class="row">
        <?
            require_once 'connection.php';
            require_once 'CProducts.php';

            $cproducts = new CProducts();
            $link = $cproducts->connectionDB($host, $user, $password, $database);
            $cproducts->checkConnectDB($link, $database);

            // Создание таблицы
            $query = $cproducts->createTable($link);
            $rowCount = $cproducts->resultQuery($link, "SELECT Id FROM Products LIMIT 1");
            $isEmpty = mysqli_num_rows($rowCount);
            if ($isEmpty == 0)
            {
                // Заполнение таблицы данными
                $query = $cproducts->insertTable($link);
            }
            // Обновление таблицы
            //$query = $cproducts->updateTable($link);
            // Удаление данных из таблицы
            //$query = $cproducts->deleteTableRow($link, "Products", "id = '3'");
            // Удаление таблицы Products
            //$query = $cproducts->dropTable($link, "Products");
            
            $result = $cproducts->resultQuery($link, "SELECT * FROM Products WHERE Product_visibility=TRUE");

            mysqli_close($link);
        ?>
        </div>
        
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">PRODUCT NAME</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">ARTICLE</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">DATE CREATE</th>
                        <th scope="col">VISIBILITY</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result)
                        {
                            $rows = mysqli_num_rows($result);
                            
                            for ($i = 0; $i < $rows; ++$i)
                            {
                                $row = mysqli_fetch_row($result);
                                echo "<tr class='row".$row[0]."'>
                                    <th scope='row'>".$row[0]."</th>
                                    <td>".$row[2]."</td>
                                    <td>".$row[3]."</td>
                                    <td>".$row[4]."</td>
                                    <td class='text-center'>
                                        <div class='quantity'>
                                            <span class='sub'>-</span>
                                            <input type='text' data-id=".$row[0]." value=".$row[5]." />
                                            <span class='add'>+</span>
                                        </div>
                                    </td>    
                                    <td>".$row[7]."</td>
                                    <td><button type='button' onclick='hideProduct(this)' data-id=".$row[0]." id='row".$row[0]."' class='btn btn-primary'>Скрыть</button></td>
                                </tr>";
                            }
                        }    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="script.js"></script>
</html>

