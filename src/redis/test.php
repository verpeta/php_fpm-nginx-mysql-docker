<?php

$redis = new Redis();
$redis->connect('demo-redis', 6379);
echo "Connection to server sucessfully" . PHP_EOL;
//set the data in redis string
$redis->set("tutorial-name", "Redis tutorial");
// Get the stored data and print it
echo "Stored string in redis:: " . $redis->get("tutorial-name") . PHP_EOL;
