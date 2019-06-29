<?php
$result = <<<EOD
[
  {"id":1,"coer":"./coer/94a6f109-940a-4329-a3df-dacceed921b6.jpg","name":"AgileProcessesInSoftwareEngine","adders":"./book/2018_Book_AgileProcessesInSoftwareEngine.epub"},
  {"id":2,"coer":"./coer/c1347988-0bca-4142-b065-a93fb36a4784.jpg","name":"姐姐有妖气","adders":"./book/1012826273.epub"},
  {"id":3,"coer":"./coer/d0663ed7-3f5a-4f53-9f02-e0bfc9c84cb7.jpg","name":"重生之跨国巨头","adders":"./book/1011587607.epub"},
  {"id":5,"coer":"./coer/39b03706-9466-41d1-94b8-b2c045a9fb05.jpg","name":"我要出租自己","adders":"./book/1012447094.epub"},
  {"id":6,"coer":false,"name":"HTTP权威指南","adders":"./book/HTTPAuthoritativeGuide.epub"},
  {"id":7,"coer":"./coer/JavaScriptCode.png","name":"超实用的JavaScript代码片段","adders":"./book/JavaScriptCode.epub"}
]
EOD;
//$data=json_decode($result);
header('Content-type: application/json; charset=UTF-8','Access-Control-Allow-Origin : *');
//echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
echo $result;
?>