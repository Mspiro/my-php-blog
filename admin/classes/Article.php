<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/includes/config.php');
class Article
{

    function totalArticle(){
        global $db;
        $count = $db->query('select count(*) from article')->fetchColumn();
        return $count;
    }

    function createArticle($fileName)
    {
        global $db;
        extract($_POST);
        $articleSlug = slug($articleTitle);
        $articleDate = date('Y-m-d H:i:s');
        $userid = $_SESSION['userid'];
        $stmt = $db->query("INSERT INTO article(
        articleTitle, articleSlug, articleDescrip, articleContent, articleDate, articleEditDate, articleTags,userid,articleImage) VALUES('$articleTitle', '$articleSlug', '$articleDescrip', '$articleContent', '$articleDate', '$articleDate','$articleTags', '$userid', '$fileName')")->fetch();
    }

    function deleteArticle($articleId)
    {
        global $db;
        $stmt = $db->query("DELETE FROM article WHERE articleId='" . $articleId . "' ");
    }

    function selectArticleByArticleId($id)
    {
        global $db;
        $stmt = $db->prepare('SELECT * FROM article WHERE articleId = :articleId');
        $stmt->execute(array(':articleId' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    function selectArticleByUserid($id)
    {
        global $db;
        $stmt = $db->prepare('SELECT * FROM article WHERE userid = :userid');
        $stmt->execute(array(':userid' => $id));
        $row = $stmt->fetchAll();
        return $row;
    }

    function selectNextArticle($articleIdc){
        global $db;
        $recom = $db->prepare("SELECT * from article where articleId>:articleIdc order by articleId ASC limit 5");
        $recom->execute(array(':articleIdc' => $articleIdc));
        $row = $recom->fetchAll();
        return $row;
    }

    function selectPreviousArticle($articleIdc){
        global $db;
        $recom = $db->prepare("SELECT * from article where articleId<:articleIdc order by articleId ASC limit 5");
        $recom->execute(array(':articleIdc' => $articleIdc));
        $row = $recom->fetchAll();
        return $row;
    }


    function editArticle($articleId, $articleTitle, $articleSlug, $articleDescrip, $articleContent, $articleTags, $fileName)
    {
        global $db;
        $stmt = $db->prepare('UPDATE article SET articleTitle=:articleTitle, articleSlug=:articleSlug, articleDescrip=:articleDescrip, articleContent=:articleContent, articleEditDate=:articleEditDate, articleTags=:articleTags, articleImage=:articleImage  WHERE articleId=:articleId')->execute(array(
            ':articleImage' => $fileName,
            ':articleTitle' => $articleTitle,
            ':articleSlug' => $articleSlug,
            ':articleDescrip' => $articleDescrip,
            ':articleContent' => $articleContent,
            ':articleId' => $articleId,
            ':articleTags' => $articleTags,
            ':articleEditDate' => date('Y-m-d H:i:s'),
        ));
    }


    // Article comments

    function addComment($articleid){
        global $db;
        extract($_POST);
        $userid = $_SESSION['userid'];
        $addComment = $db->prepare("INSERT INTO comment (userid, articleId, comment) VALUES ('$userid', '$articleid', '$comment')")->execute();
        return $addComment;
    }

    function showComments($articleid){
        global $db;
        $comments = $db->query("SELECT * FROM comment WHERE articleId='" . $articleid . "'")->fetchAll();
        return $comments;
    }

}

$Article = new Article();
