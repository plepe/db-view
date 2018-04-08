<?php include "conf.php"; /* load a local configuration */ ?>
<?php include "modulekit/loader.php"; /* loads all php-includes */ ?>
<?php require __DIR__ . '/../vendor/autoload.php'; ?>
<?php call_hooks('init'); ?>
<?php
$dbconf[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
$db = new PDOext($dbconf);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

include 'node_modules/db-api/test/structure.php';

/**
 * @backupGlobals disabled
 */
class db_api_test extends PHPUnit_Framework_TestCase {
  public function testDBViewJSON() {
    global $api;

    $view = new DBViewJSON($api, null);
    $view->set_query(array(
      'table' => 'test2',
      'query' => 1,
    ));

    $expected = <<<EOT
[
    {
        "id": 1,
        "commentsCount": 2,
        "comments": [
            {
                "test2_id": 1,
                "id": 2,
                "text": "foobar"
            },
            {
                "test2_id": 1,
                "id": 4,
                "text": "foobar2"
            }
        ]
    }
]
EOT;
    $actual = $view->show();

    $this->assertEquals($expected, $actual);
  }

  public function testDBViewTwig() {
    global $api;

    $view = new DBViewTwig($api, "{{ entry.id }}: {{ entry.commentsCount }}\n");
    $view->set_query(array(
      'table' => 'test2',
      'query' => 1,
    ));

    $expected = <<<EOT
1: 2

EOT;
    $actual = $view->show();

    $this->assertEquals($expected, $actual);
  }
}
