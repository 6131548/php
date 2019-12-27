<?php
try {
    $dbh = new \PDO('mysql:host=localhost;dbname=1202tp', 'root', 'root');
    foreach($dbh->query('SELECT * from tp_order') as $row) {
        print_r($row);
    }
    $dbh = null;//关闭链接
} catch (\PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
