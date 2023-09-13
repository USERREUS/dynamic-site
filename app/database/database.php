<!-- app/database/database.php Файл взаимодействия с БД-->

<?php

    session_start();
    require('connect.php');
    
    // Вывод значения
    function v($value){
        echo '<pre>';
        print_r($value);
        echo '<pre>';
        exit();
    }

    // Проверка на ошибки
    function db_check_error($query){
        $errInfo = $query->errorInfo();
    
        if ($errInfo[0] !== PDO::ERR_NONE){
            echo $errInfo[2] . '<pre>';
            exit();
        }

        return true;
    }

    // Запрос на получение данных одной таблицы с параметрами поиска
    function select_all($table, $params = []){
        global $pdo;
        $sql = "SELECT * FROM $table";

        if(!empty($params)){
            $i = 0;
            foreach($params as $key => $value){
                if(!is_numeric($value)){
                    $value = "'" . $value . "'";
                }
                if($i === 0){
                    $sql = $sql . " WHERE $key = $value"; 
                } else {
                    $sql = $sql . " AND $key = $value";
                }
                $i++;
            }
        }

        $query = $pdo->prepare($sql);
        $query->execute();
        
        db_check_error($query);

        return $query->fetchAll();
    }

    // Запрос на получение одной строки данных с одной таблицы с параметрами поиска
    function select_one($table, $params = []){
        global $pdo;
        $sql = "SELECT * FROM $table";

        if(!empty($params)){
            $i = 0;
            foreach($params as $key => $value){
                if(!is_numeric($value)){
                    $value = "'" . $value . "'";
                }
                if($i === 0){
                    $sql = $sql . " WHERE $key = $value"; 
                } else {
                    $sql = $sql . " AND $key = $value";
                }
                $i++;
            }
        }

        $query = $pdo->prepare($sql);
        $query->execute();
        
        db_check_error($query);

        return $query->fetch();
    }

    $params = [
        'admin' => 1,
        'user_name' => 'Sam'
    ];

    // Запись данных в БД
    function insert($table, $params){
        global $pdo;
        
        $i = 0;
        $col = '';
        $mask = '';

        foreach($params as $key => $value){
            if($i === 0){
                $col = $col . "$key";
                $mask = $mask . "'" . $value . "'"; 
            }
            else{
                $col = $col . ", $key";
                $mask = $mask . ", '" . $value . "'";
            }
            $i++;
        }

        $sql = "INSERT INTO $table ($col) VALUES ($mask)";

        $query = $pdo->prepare($sql);
        $query->execute($params);   
        db_check_error($query);

        return $pdo->lastInsertId();
    }

    // Обновление данных в таблице
    function update($table, $id, $params){
        global $pdo;
        
        $i = 0;
        $str = '';

        foreach($params as $key => $value){
            if($i === 0){
                $str = $str . $key . " = '" . $value . "'"; 
            }
            else{
                $str = $str . ", " . $key . " = '" . $value . "'";
            }
            $i++;
        }

        $sql = "UPDATE $table SET $str WHERE id = $id";

        $query = $pdo->prepare($sql);
        $query->execute();   
        db_check_error($query);
    }

    // Удаление данных из таблицы
    function delete($table, $id){
        global $pdo;

        $sql = "DELETE FROM $table WHERE id = $id";

        $query = $pdo->prepare($sql);
        $query->execute();   
        db_check_error($query);
    }

    // Выборка записей с автором в админку (posts)
    function select_all_from_posts_with_users($table1, $table2){
        global $pdo;
        $sql = "
            SELECT
            t1.*,
            t2.user_name,
            t2.admin
            FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.user_id = t2.id
            ORDER BY t1.id DESC";

        $query = $pdo->prepare($sql);
        $query->execute();
        db_check_error($query);
        return $query->fetchAll();
    }

    // Выборка записей с автором на главную (posts)
    function select_all_from_posts_join_users($table1, $table2, $limit, $offset){
        global $pdo;
        $sql = "SELECT t1.*, t2.user_name, t2.admin 
        FROM $table1 AS t1 
        JOIN $table2 AS t2 ON t1.user_id = t2.id 
        WHERE t1.status = 1 
        ORDER BY t1.id DESC
        LIMIT $limit OFFSET $offset";

        $query = $pdo->prepare($sql);
        $query->execute();
        db_check_error($query);
        return $query->fetchAll();
    }

    // Выборка записей с автором на главную (posts)
    function select_top_from_posts($table1){
        global $pdo;
        $sql = "SELECT * FROM $table1 WHERE id_topic = 10 AND status = 1";

        $query = $pdo->prepare($sql);
        $query->execute();
        db_check_error($query);
        return $query->fetchAll();
    }

    // Поиск по заголовкам и содержимому (простой)
    function search_in_title_and_content($term, $table1, $table2){
        $text = trim(strip_tags(stripcslashes(htmlspecialchars($term)))); // Чистим запрос
        global $pdo;
        $sql = "
        SELECT 
        t1.*, t2.user_name, t2.admin 
        FROM $table1 AS t1 
        JOIN $table2 AS t2 
        ON t1.user_id = t2.id 
        WHERE t1.status=1
        AND t1.title LIKE '%$text%'
        OR t1.content LIKE '%$text%'
        ";

        $query = $pdo->prepare($sql);
        $query->execute();
        db_check_error($query);
        return $query->fetchAll();
    }

    // Выборка записи с автором на single (posts)
    function select_one_from_posts_join_users($table1, $table2, $id){
        global $pdo;
        $sql = "SELECT t1.*, t2.user_name FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.user_id = t2.id WHERE t1.id = $id";

        $query = $pdo->prepare($sql);
        $query->execute();
        db_check_error($query);
        return $query->fetch();
    }

    // Выборка записи с автором на single (posts)
    function count_row($table){
        global $pdo;
        $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";

        $query = $pdo->prepare($sql);
        $query->execute();
        db_check_error($query);
        return $query->fetchColumn();
    }

    // Выборка записи с автором на single (posts)
    function select_one_from_posts_join_users_topics($table1, $table2, $table3, $id){
        global $pdo;
        $sql = "SELECT t1.*, t2.user_name, t3.name
        FROM $table1 AS t1 
        JOIN $table2 AS t2 ON t1.user_id = t2.id
        JOIN $table3 as t3 ON t1.id_topic = t3.id 
        WHERE t1.id = $id";

        $query = $pdo->prepare($sql);
        $query->execute();
        db_check_error($query);
        return $query->fetch();
    }
?>