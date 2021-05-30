<?php
session_start();
/*
include 'activity_image.php';
include 'activity_tag.php';
include 'activity_video.php';
include 'image.php';
include 'post_image.php';
include 'post_tag.php';
include 'post_video.php';
include 'tag.php';
include 'video.php';
*/
include_once './route.php';
include_once './activity.php';
include_once './authentication.php';
include_once './post.php';
include_once './tag.php';
include_once './user.php';

$con = Connector::connect();

parse_str($_SERVER['QUERY_STRING'], $request);
$input = file_get_contents('php://input');
/*
// Example
Route::add('/foo/([0-9]*)/bar', function($var1) {
    navi();
    echo $var1.' is a great number!';
  }, 'get');
*/

class Entities {

  private $auth;
  private $tag;

  function __construct() {
    $this->auth = new Authentication();
    $this->tag = new Tag($this->auth);
  }

  public function getAuth() {
    return $this->auth;
  }

  public function getTag() {
    return $this->tag;
  }

}

$entities = new Entities();

// Authentication
Route::add('/login', function($params, $entities) {
  $entities->getAuth()->login($params);
}, 'post', true);
Route::add('/logout', function($params, $entities) {
  $entities->getAuth()->logout($params);
}, 'post', true);

// User
Route::add('/user/([0-9]*)', function($params, $entities) {
  User::update($params);
}, 'delete', true);
Route::add('/register', function($params, $entities) {
  User::create($params);
}, 'post', true);
Route::add('/user/([0-9]*)', function($params, $entities) {
  User::delete($params);
}, 'delete', true);

// Activities
Route::add('/activity/([0-9]*)', function($id, $entities) {
    Activity::getOneById($id);
  }, 'get');
Route::add('/activity', function($entities) {
    Activity::getActivities(null);
  }, 'get');
Route::add('/activity?category=([a-z_]*)', function($category, $entities) {
    Activity::getActivities($category);
  }, 'get');
Route::add('/activity/past', function($entities) {
    Activity::getPastActivities(null);
  }, 'get');
Route::add('/activity/past?category=([a-z_]*)', function($category, $entities) {
    Activity::getPastActivities($category);
  }, 'get');
Route::add('/activity/current', function($entities) {
    Activity::getCurrentActivities(null);
  }, 'get');
Route::add('/activity/current?category=([a-z_]*)', function($category, $entities) {
    Activity::getCurrentActivities($category);
  }, 'get');
Route::add('/activity/future', function($entities) {
    Activity::getFutureActivities(null);
  }, 'get');
Route::add('/activity/future?category=([a-z_]*)', function($category, $entities) {
    Activity::getFutureActivities($category);
  }, 'get');
Route::add('/activity/([0-9]*)', function($params, $entities) {
  Activity::update($params);
}, 'put', true);
Route::add('/activity', function($params, $entities) {
  Activity::create($params);
}, 'post', true);
Route::add('/activity/([0-9]*)', function($params, $entities) {
  Activity::delete($params);
}, 'delete', true);

// Posts
Route::add('/post/([0-9]*)', function($id, $entities) {
    Post::getOneById($id);
  }, 'get');
 /*
Route::add('/post/([0-9]*)', function($id) {
    Post::getOneById($id, $request, $input);
  }, 'get');*/

// Tags
Route::add('/tag', function($entities) {
  $entities->getTag()->getTags(null);
}, 'get');
Route::add('/tag/([0-9]*)', function($params, $entities) {
  $entities->getTag()->update($params);
}, 'put', true);
Route::add('/tag', function($params, $entities) {
  $entities->getTag()->create($params);
}, 'post', true);
Route::add('/tag/([0-9]*)', function($params, $entities) {
  $entities->getTag()->delete($params);
}, 'delete', true);


// Run the Routes
Route::run('/api', $entities);

?>