<?php include "conf.php"; /* load a local configuration */ ?>
<?php include "modulekit/loader.php"; /* loads all php-includes */ ?>
<?php
$postsSpec = array(
  'id' => 'posts',
  'fields' => array(
    'id' => array(
      'type' => 'int',
      'read' => true, 'write' => true,
    ),
    'author' => array(
      'type' => 'string',
      'read' => true, 'write' => true,
    ),
    'message' => array(
      'type' => 'string',
      'read' => true, 'write' => true,
    ),
    'commentsCount' => array(
      'type' => 'int',
      'select' => 'select count(*) from comments where comments.postId=posts.id',
    ),
    'comments' => array(
      'type' => 'sub_table',
      'id' => 'comments',
      'parent_field' => 'postId',
      'fields' => array(
        'id' => array(
          'type' => 'int',
          'read' => true, 'write' => true,
        ),
        'postId' => array(
          'type' => 'int',
          'read' => true, 'write' => true,
        ),
        'author' => array(
          'type' => 'string',
          'read' => true, 'write' => true,
        ),
        'message' => array(
          'type' => 'string',
          'read' => true, 'write' => true,
        ),
      ),
    ),
  ),
);

// Initialize database
$dbconf[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
$db = new PDOext($dbconf);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$api = new DBApi($db);
$api->addTable($postsSpec);

$result = $api->do(array(
  array(
    'action' => 'select',
    'table' => 'posts',
  ),
));

print_r(iterator_to_array_deep($result));
