<?php 
require "../database/db_connection.php";

$params = $columns = $totalRecords = $data = array();

$params = $_REQUEST;
$start = $params['start'];
$length = $params['length'];
$columns = array(
    0 => 'user_id',
    1 => 'user_name',
    2 => 'user_email',
    3 => 'role',
    4 => 'action'
);

$where = $sqlTotal = $sqlRecord = "";
// SELECT users.id, users.email, users.name, roles.name AS role FROM users JOIN roles ON users.roles = roles.id WHERE users.name LIKE '%Mohit%';
if( !empty($params['search']['value']) ){
    $where.=" WHERE ( users.name LIKE '%".$params['search']['value']."%' OR users.email LIKE '%".$params['search']['value']."%' OR users.id LIKE '%".$params['search']['value']."%' OR roles.name LIKE '%".$params['search']['value']."%' ) ";
    
}

$sql = "SELECT users.id AS user_id, users.email AS user_email, users.name AS user_name, roles.name AS role FROM users JOIN roles ON users.roles = roles.id ";
$sqlTotal .=$sql;
$sqlRecord .=$sql;

if(isset($where) && $where!=''){
    $sqlTotal .= $where;
    $sqlRecord .= $where;
}


$sqlRecord .= "ORDER BY ".$columns[$params['order'][0]['column']]." ".$params['order'][0]['dir']." LIMIT ".$start.",".$length;

$queryTotal = $conn->query($sqlTotal);
$totalRecords = $queryTotal->num_rows;
$queryRecords = $conn->query($sqlRecord);


while($row = $queryRecords->fetch_assoc()){
    $actionLinks = '<a class="btn btn-outline-info me-2" href="edit-user.php?id=' . $row['user_id'] . '">Edit</a><a class="btn btn-outline-danger" href="delete-user.php?id=' . $row['user_id'] . '">Delete</a>';
    $data[] = array(
        'id' => $row["user_id"],
        'name' => $row["user_name"],
        'email' => $row["user_email"],
        'role' => $row["role"],
        'action' => $actionLinks
    );

}

$response = array(
    "draw" => intval( $params['draw'] ),
    "recordsTotal" => intval( $totalRecords ),
    "recordsFiltered" => intval( $totalRecords ),
    "data" => $data
);

echo json_encode($response);


?>
