<?
class CProducts
{
    // Проверка соединения к БД
    function connectionDB($host, $user, $password, $database)
    {       
        $link = mysqli_connect($host, $user, $password, $database);
        if ($link)
            echo '<br>Соединение установлено.';
        else 
            die("Ошибка подключения к БД. " . mysqli_error($link));

        return $link;
    }

    // Проверка подключения к БД
    function checkConnectDB($link, $database)
    {
        $selected = mysqli_select_db($link, $database);
        if ($selected)
            echo '<br>Подключение к БД: '.$database.' прошло успешно.';
        else
            echo '<br>БД: '.$database.' не найдена или отсутствует доступ.';
    }

    // Создание таблицы Products
    function createTable($link)
    {
        $query ="CREATE TABLE IF NOT EXISTS Products
        (
            Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            Product_id INT NOT NULL,
            Product_name VARCHAR(100) NOT NULL,
            Product_price DECIMAL(6,2) NOT NULL,
            Product_article VARCHAR(200) NULL,
            Product_quantity INT NOT NULL,
            Product_visibility BOOLEAN NOT NULL,
            Date_create DATE NOT NULL
        )";

        self::resultQuery($link, $query);
    }
    
    function updateTable($link)
    {
        $query = "UPDATE Products SET Product_visibility=TRUE";
        self::resultQuery($link, $query);
    }
    // Заполнение таблицы данными
    function insertTable($link)
    {
        $query = "INSERT INTO Products VALUES
            (NULL, 1, 'Apple', 30.50, 'green juicy Apple', 9, TRUE, '2021-02-03'),
            (NULL, 2, 'Apricot', 32.55, 'delicious juicy Apricot', 2, TRUE, '2021-02-02'),
            (NULL, 3, 'Fig', 29.99, 'delicious juicy Fig', 5, TRUE, '2021-02-01'),
            (NULL, 4, 'Mango', 25.50, 'delicious juicy Mango', 1, TRUE, '2021-01-30'),
            (NULL, 5, 'Banana', 30.50, 'yellow juicy Banana', 12, TRUE, '2021-01-15'),
            (NULL, 6, 'Tomato', 35.00, 'red juicy Tomato', 6, TRUE, '2021-01-11'),
            (NULL, 7, 'Lemon', 25.99, 'delicious juicy Lemon', 10, TRUE, '2021-01-09'),
            (NULL, 8, 'Orange', 35.25, 'orange juicy Orange', 7, TRUE, '2021-01-22')";

        self::resultQuery($link, $query);
    }

    // Удаление указанной таблицы 
    function dropTable($link, $tablename)
    {
        $query ="DROP TABLE IF EXISTS " . $tablename;

        self::resultQuery($link, $query);
    }

    // Удаление строки из указанной таблицы по указанному условию
    function deleteTableRow($link, $tablename, $querypart)
    {
        $query = "DELETE FROM " . $tablename . " WHERE " . $querypart;

        self::resultQuery($link, $query);
    }

    // Выполнение запроса
    function resultQuery($link, $query)
    {
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

        // if ($result)
        // echo '<br>Выполнение запроса прошло успешно.';
        // else
        // echo '<br>Что то пошло не так.';

        return $result;
    }
}
?>