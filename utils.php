<?php

function context()
{
  $text="\n\nContext :\n";
  $text.="On ".date("l j F Y G:i:s")."\n";
  $text.="SCRIPT_URL:      ".$_SERVER["SCRIPT_URL"]."\n";
  $text.="QUERY_STRING:    ".$_SERVER["QUERY_STRING"]."\n";
  $text.="SCRIPT_FILENAME: ".$_SERVER["SCRIPT_FILENAME"]."\n";
  $text.="REMOTE_ADDR :    ".$_SERVER["REMOTE_ADDR"]."\n";
  $text.="HTTP_REFERER :   ".$_SERVER["HTTP_REFERER"]."\n";
  $text.="\n------------------------------------------\n\n";
  return $text;
}

function sendMessage($message)
{
  $adminNot="/tmp/basilic-log.txt";
  if (strstr($adminNot, '@'))
    error_log($message.context(), 1, $adminNot, "Subject:Publication server error\n");
  else
    error_log($message.context(), 3, $adminNot);
}

function error($message)
{
  echo "<p>\n<span style='color:red;'><b>Error</b></span> : $message\n</p>\n";
  sendMessage($message);
  die();
}

function connectToSql($name, $password)
{
  $database="basilic";
  $host="localhost";

  if (!$link = mysql_connect($host, $name, $password))
    {
      sendMessage("Unable to connect to mySQL server\nHost=$host\nName=$name");
      die("Unable to connect to mySQL server. Administrator has been warned.");
    }

  if (!mysql_select_db($database, $link))
    {
      sendMessage("Unable to select $database mySQL database");
      echo("Unable to select mySQL database. Administrator has been warned.");
      die("</body>\n</html>\n");
    }
}

function sqlConnect()
{
  connectToSql("www", "www");
}

function intranetSqlConnect()
{
  connectToSql("intranet", "cilisab");
}

function sqlQuery($query)
{
  if ($result = mysql_query($query))
    return $result;
  else
    {
      sendMessage("Invalid sql query : $query");
      echo("Invalid Sql query. Administrator has been warned\n");
      // echo("Debug : Invalid Sql query : <br />\n<code>$query</code>\n");
      die("</body>\n</html>\n");
    }
}

?>
