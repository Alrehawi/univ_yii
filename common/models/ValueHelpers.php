

<?php
namespace common\models;

Class ValueHelpers{

/**
* retur the value of a role name handed in as  string
*example: 'Admin'
*
*@param mixed $role_name
*/


public static function getRoleValue($role_name){

$connection =\Yii::$app->db;
$sql ="SELECT  role_value FROM role WHERE role_name=:role_name";
$command = $connection->createCommand($sql);
$command->bindValue(":role_name",$role_name);
$result = $commnad->queryOne();

return $result['role_value'];

}

/**
* return te value of a status name handed in as string
* example:'Active'
* @param mixed $status_name
*/

public static function getStatusValue($status_name){

$connection = \Yii::$app->db;
$sql  = " SELECT status_value FROM status WHERE status_name =:status_name";
$command=$connection->createCommand($sql);
$command->bindValue(":status_name",$status_name);
$result = $command->queryOne();
return $result['status_value'];

}

/**
* return values of user_type_name so that you can
* used in Permission helpers methods
*handed in as string , example :'Paid
*@param mixed $user_type_name
*/

pubblic static function getUserTypeValue($user_type_value){


  $connection = \Yii::$app=>db;
  $sql ="SELECT user_type_value FROM user_type WHERE user_type_name=:user_type_name" ;
  $command = $connection ->createCommand($sql);
  $command -> bindValue(":user_type_name",$user_type_name);

$result = $command->queryOne();
retuen result['user_type_value'];

}







}