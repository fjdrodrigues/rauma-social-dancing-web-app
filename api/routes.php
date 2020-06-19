<?php
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
include_once './user.php';

parse_str($_SERVER['QUERY_STRING'], $request);
$input = file_get_contents('php://input');
/*
// Example
Route::add('/foo/([0-9]*)/bar', function($var1) {
    navi();
    echo $var1.' is a great number!';
  }, 'get');
*/
// Authentication
Route::add('/login', function($params) {
  Authentication::login($params);
}, 'post', true);
Route::add('/logout', function($params) {
  Authentication::logout($params);
}, 'post', true);

// User
Route::add('/user/([0-9]*)', function($params) {
  User::update($params);
}, 'delete', true);
Route::add('/register', function($params) {
  User::create($params);
}, 'post', true);
Route::add('/user/([0-9]*)', function($params) {
  User::delete($params);
}, 'delete', true);

// Activities
Route::add('/activity/([0-9]*)', function($id) {
    Activity::getOneById($id);
  }, 'get');
Route::add('/activity', function() {
    Activity::getActivities(null);
  }, 'get');
Route::add('/activity?category=([a-z_]*)', function($category) {
    Activity::getActivities($category);
  }, 'get');
Route::add('/activity/past', function() {
    Activity::getPastActivities(null);
  }, 'get');
Route::add('/activity/past?category=([a-z_]*)', function($category) {
    Activity::getPastActivities($category);
  }, 'get');
Route::add('/activity/current', function() {
    Activity::getCurrentActivities(null);
  }, 'get');
Route::add('/activity/current?category=([a-z_]*)', function($category) {
    Activity::getCurrentActivities($category);
  }, 'get');
Route::add('/activity/future', function() {
    Activity::getFutureActivities(null);
  }, 'get');
Route::add('/activity/future?category=([a-z_]*)', function($category) {
    Activity::getFutureActivities($category);
  }, 'get');
Route::add('/activity/([0-9]*)', function($params) {
  Activity::update($params);
}, 'put', true);
Route::add('/activity', function($params) {
  Activity::create($params);
}, 'post', true);
Route::add('/activity/([0-9]*)', function($params) {
  Activity::delete($params);
}, 'delete', true);

// Posts
Route::add('/post/([0-9]*)', function($id) {
    Post::getOneById($id);
  }, 'get');
 /*
Route::add('/post/([0-9]*)', function($id) {
    Post::getOneById($id, $request, $input);
  }, 'get');*/

// Run the Routes
Route::run('/api');

?>