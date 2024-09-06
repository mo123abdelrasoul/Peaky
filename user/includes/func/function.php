<?php

function gettitle()
{

    global $pagetitle;

    if (isset($pagetitle)) {

        echo $pagetitle;
    } else {

        echo "default";
    }
}

// function to check member
function checkMember($select, $from, $value)
{

    global $con;

    $stmt = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $stmt->execute(array($value));
    $count = $stmt->rowCount();
    return $count;
}

// Function To get value with condtion 
function getvalue($select, $from, $where, $value)
{

    global $con;

    $stmt = $con->prepare("SELECT $select FROM $from WHERE $where = ?");
    $stmt->execute(array($value));
    return $stmt->fetch();
}

function redirect($themsg, $url = null, $seconds = 5)
{

    if ($url == null) {

        $url = "dash.php";
        $link = "HomePage";
    } elseif (isset($_SERVER['HTTP_REFERER'])) {

        $url = $_SERVER['HTTP_REFERER'];
        $link = "Previous Page";
    }
    echo $themsg;
    echo "<div class = 'alert alert-info'>You Will Be Redirected to $link After $seconds Seconds.</div>";
    header("refresh:$seconds;url=$url");
}


// Function To check If This Page Arabic Or English To Include The File
function translate()
{
    if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
        include "includes/langs/arabic.php";
    } elseif (isset($_GET['lang']) && $_GET['lang'] == "en") {
        include "includes/langs/english.php";
    } else {
        include "includes/langs/english.php";
    }
}


// Function To Convert English Numbers To Arabic Numbers

function translate_numbers($number)
{
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
        return str_replace($english, $arabic, $number);
    } else {
        return str_replace($arabic, $english, $number);
    }
}


// Function To select or update or anything in sql

function selectquery($select, $from, $where = '', $limit = '')
{
    global $con;
    $stmt = $con->prepare("SELECT $select FROM $from $where $limit");
    $stmt->execute();
    $queries = $stmt->fetchAll();
    return $queries;
}
