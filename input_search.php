<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=db_nutrix', ' ', ' ');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_GET['term'])) {
    $search_for = $_GET['term'];
    $select = $db->prepare("SELECT 'Desc_alimento' FROM 'db_alim' WHERE 'Desc_alimento' LIKE ? LIMIT 50;");
    $select->execute(array("%$search_for%"));
    $data = $select->fetchAll();
    $items = array();
    foreach ($data as $an_item) {
        $items[] = $an_item['item'];
    }
    echo json_encode($items);
}