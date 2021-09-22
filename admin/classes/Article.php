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

    function showArticleByArticleId($id)
    {
        global $db;
        $stmt = $db->prepare('SELECT * FROM article WHERE articleId = :articleId');
        $stmt->execute(array(':articleId' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    function showArticleUserId($id)
    {
        global $db;
        $stmt = $db->prepare('SELECT * FROM article WHERE userid = :userid');
        $stmt->execute(array(':userid' => $id));
        $row = $stmt->fetchAll();
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
}

$Article = new Article();
