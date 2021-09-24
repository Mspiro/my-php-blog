<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/includes/config.php');

class Comment{

  function addComment($articleid)
  {
    global $db;
    extract($_POST);
    $userid = $_SESSION['userid'];
    $addComment = $db->prepare("INSERT INTO comment (userid, articleId, comment) VALUES ('$userid', '$articleid', '$comment')")->execute();
    return $addComment;
  }

  function showComments($articleid)
  {
    global $db;
    $comments = $db->query("SELECT * FROM comment WHERE articleId='" . $articleid . "'")->fetchAll();
    return $comments;
  }
}

$Comment = new Comment();