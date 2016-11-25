<?php 
// phpinfo();
  $m = new MongoClient();
    // 选择一个数据库
   $db = $m->mydb;
   $collection = $db->mycol;
   $document = array( 
      "title" => "MongoDB", 
      "description" => "database", 
      "likes" => 100,
      "url" => "http://www.w3cschool.cc/mongodb/",
      "by", "w3cschool.cc"
   );
   $collection->insert($document);
   $cursor = $collection->find();
   foreach ($cursor as $document) {
      var_dump($document);
	  echo '<br>';
   }


?>