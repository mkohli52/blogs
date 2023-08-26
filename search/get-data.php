<?php
header('Content-Type: application/json');
require "../database/db_connection.php";
$response = array();
if($_POST["by"] == 1 ){
    $sql = "SELECT
    b.id,
    b.title,
    b.description,
    b.content,
    u.id AS user_id,
    u.name AS user_name,
    GROUP_CONCAT(DISTINCT c.cate_name ORDER BY c.id) AS category_names,
    GROUP_CONCAT(DISTINCT c.id ORDER BY c.id) AS category_ids
FROM
    blogs b
JOIN
    users u ON b.user_id = u.id
JOIN
    blog_category bc ON b.id = bc.blog_id
JOIN
    categories c ON bc.category_id = c.id
WHERE
    u.name LIKE '%".$_POST["query"]."%' AND b.deleted_at IS NULL
GROUP BY
    b.id, b.title, b.description, b.content, u.id, u.name;";
$result = $conn->query($sql);
while($data = $result->fetch_assoc()){
    $response[] = $data;
}


}

echo(json_encode($response));

?>