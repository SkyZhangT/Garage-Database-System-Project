<?php
define('PROJECT_ONLINE', 1);

include 'dba.php';

$num1 = $_GET['num1'];
$num2 = $_GET['num2'];
$num3 = $_GET['num3'];

$database = new MySQLDataAccess('localhost', 'root', 'rooty', 'cse3241_project');
$database->beginT();
$database->rollbackT();
$database->beginT();
$database->commitT();
$aData = $database->select('*')
                  ->from('garage', 'g')
                  ->innerJoin('parking_spot', 'ps', 'ps.garage_id = g.id AND ps.garage_id = ?', $num1)
                  ->where("ps.spot_no > ? and ps.spot_no < ?", $num2, $num3)
                  ->orderBy('ps.spot_no DESC')
                  ->execute('getRows');

// $aQuery = $database->select('*');
// $aQuery = $aQuery->from('garage', 'g');
// $aQuery = $aQuery->where(array('id' => 0))->execute('getRows');
//$aData = $database->rawQuery("select * from garage g inner join parking_spot ps on ps.garage_id = g.id where ps.spot_no = ?", array($id))->execute('getRows');

// $database2 = new MySQLDataAccess('localhost', 'root', 'rooty', 'cse3241_project');

// $q1 = $database2->select('*');
// $q2 = $database->from('user')->where(array('name' => 'bob', 'id' => 2));
// $aData = $q1->appendQuery($q2)->execute('getRows');

// $res = $database->update('user', array('name' => $name, 'createdate' => $date), array('id' => 2));

// $aData = $database->select('name')->from('user')->where(array('name' => $name))->execute('getRow');

// $res = $database->insert('garage', array(
//             'id' => 504,
//             'name' => 'bob',
//             'managed_by' => 1
//         ));
//var_dump($res);

foreach ($aData as $aUser) {
    print_r($aUser);
    echo '</br>';
    //echo $aUser['name'] . '</br>';
}

?>