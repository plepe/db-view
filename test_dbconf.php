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


