<?php

namespace common\models;

user yii;

Class RecordHelpers {


  public function userHas($model_name) {

    $connection = \Yii::$app->db;

    $userid = Yii::$app->user->identity->id;

    $sql = " SELECT id FROM  $model_name WHERE user_id=:userid";
    $command =$connection->cretaCommand($sql);
    $result = $command->queryOne();

    if ($result == null) {
      return false;
    }else {
      return $result['id'];
    }

  }



}