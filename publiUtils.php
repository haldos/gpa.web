<?php

function printConference($row)
{
  global $lg;
  if ($lg=="fr")
    {
      $txtPhd="Th&egrave;se de l'";
      $txtMaster="DEA de l'";
      $txtTechRep="Rapport de recherche";
    }
  else
    {
      $txtPhd="PhD thesis from ";
      $txtMaster="Master thesis from " ;
      $txtTechRep="Technical Report";
    }
  
 switch($row["entry"])
    {
    case "InProceedings":
      echo $row["booktitle"];
      break;
      
    case "Article":
      echo "$row[journal]";
      break;
      
    case "Book":
    case "InBook":
      #echo $row["publisher"];
      # echo "$row[booktitle], $row[publisher]";
      echo "$row[booktitle], $row[series], $row[publisher], $row[editor]";
      break;
      
    case "PhdThesis":
      echo $txtPhd.$row["school"];
      break;

    case "MastersThesis":
      echo $txtMaster.$row["school"];
      break;
      
    case "TechReport":
      echo "$txtTechRep $row[number], $row[institution]";
      break;
      
    case "InCollection":
      echo "$row[booktitle], $row[publisher]";
      break;

    default:
      echo $row["entry"];
      break;
    }
 
 if (!empty($row["volume"]))
   echo ", Volume $row[volume]";
 if (!empty($row["number"]))
   echo ", Number $row[number]";
 if (!empty($row["pages"]))
   echo ", page $row[pages]";

  echo " - $row[month] $row[year]\n";
}

function printAuthors($id)
{
  $aresult = sqlQuery("SELECT * FROM authors,publiauthors where authors.id=publiauthors.idAuthor AND publiauthors.idPubli=$id ORDER BY rank ASC");
##  $aresult = sqlQuery("SELECT * FROM authors" );

  $first=true;
  while ($aresult && $arow=mysql_fetch_array($aresult))
    {
      $cod = getAuthorURL($arow[first], $arow[last]);
      if (!$first)
	echo ",\n";
/*
      if (!empty($arow["url"]))
       {
	echo "   <a href='$arow[url]'>$arow[first] $arow[last]</a>";
       }
*/
      if ( $cod > 0 )
	echo "   <a href='/institucional/personal/mostrardocente.php3?cod_doc=$cod'>$arow[first] $arow[last]</a>";
      else
	echo "   $arow[first] $arow[last]";
      $first = false;
    }
}

# Called by displayPublication()
function printPubliLine($row)
{
  global $lg;
  $id=$row["id"];
  $year=$row["year"];
  $bibtex=$row["bibTex"];
  $path="/publicaciones/$year/$bibtex";

  sqlConnect();
  // Retrieve associated documents
  $dresult = sqlQuery("SELECT type,source,sizeX,sizeY FROM docs,publidocs where docs.id=publidocs.idDoc AND publidocs.idPubli=$id AND (type='IMG' OR type='PDF' OR type='PS') ORDER BY type DESC,source ASC");
  
  while ($dresult && $drow=mysql_fetch_array($dresult))
    {
      $type=$drow["type"];
      $src=$drow["source"];
      if ($type=="IMG" && !isset($firstImage))
	{
	  $firstImage = 1;
	  $ratio=1.0*$drow["sizeX"]/$drow["sizeY"];
	  $h=60.0;
	  $w=$h*$ratio;
	  $pt=13;
	  if ($w>80)
	    {
	      $w=80;
	      $h=$w/$ratio;
	      $pt=13 + (60-$h)/2.0;
	    }

	  $w=floor($w);
	  $h=floor($h);
	  $pt=floor($pt)."px";

	  $thumb ="  <div style='padding-top:$pt'><a href='$path'>\n";
	  $thumb.="   <img src='$path/.thumbs/$src.jpg' width='$w' height='$h' alt='$bibtex'/></a>\n";
	  $thumb.="  </div>\n";
	}
      
      if ($type=="PDF") $docs.="   <a href=\"$path/$src\"><img class='doc' src='images/pdf.png' alt='$src' /></a>\n";
      if ($type=="PS")  $docs.="   <a href=\"$path/$src\"><img class='doc' src='/publicaciones/images/ps.png' alt='$src' /></a>\n";
    }

/*
  if (isset($thumb))
    {
      echo " <div class='thumb image'>\n";
      echo " $thumb";
      echo " </div>\n";
    }
  else
    echo " <div class='thumb'></div>\n";

  echo " <div class='ref'>\n";
  echo "  <div class='title'>\n   <a href=\"$path/\">\n    ".$row["title"]."\n   </a> &nbsp; \n"; 
  echo "$docs  </div>\n";
*/

  echo " <div class='ref'>\n";
  echo " $docs<div class='title'>\n   <a href=\"$path/\">\n    ".$row["title"]."\n   </a> &nbsp; \n"; 
  echo "</div>\n";

  // Search for authors
  echo "  <div class='authors'>\n";
  printAuthors($id);
  echo "\n  </div>\n";

  echo "  <div class='conf'>\n   ";
  printConference($row);
  echo "  </div>\n";
  echo " </div>\n\n";
}

function printGalleryLine($row)
{
  global $lg;
  $id=$row["id"];
  $year=$row["year"];
  $bibtex=$row["bibTex"];
  $path="/publicaciones/$year/$bibtex";

  echo " <div class='ref'>\n";
  echo "  <div class='title'>\n   <a href=\"$path/\">\n    ".$row["title"]."\n   </a>\n  </div>\n"; 

  // Search for authors
  echo "  <div class='authors'>\n";
  printAuthors($id);
  echo "\n  </div>\n";

  echo "  <div class='conf'>\n   ";
  printConference($row);
  echo "  </div>\n";

  echo " </div>\n\n";

  echo " <div class='imgMovies'>\n";

  sqlConnect();
  // Retrieve associated documents
  $dresult = sqlQuery("SELECT type,source,sizeX,sizeY FROM docs,publidocs where docs.id=publidocs.idDoc AND publidocs.idPubli=$id AND (type='IMG' OR type='MOV') ORDER BY type ASC,source ASC");
  
  while ($dresult && $drow=mysql_fetch_array($dresult))
    {
      $type=$drow["type"];
      $src=$drow["source"];

      if (($type=="IMG") || ($type=="MOV"))
	{
	  $ratio=1.0*$drow["sizeX"]/$drow["sizeY"];
	  $h=60.0;
	  $w=$h*$ratio;
	  $pt=13;
	  if ($w>80)
	    {
	      $w=80;
	      $h=$w/$ratio;
	      $pt=13 + (60-$h)/2.0;
	    }

	  if ($type=="MOV")
	    $class="movie";
	  else
	    $class="image";

	  $w=floor($w);
	  $h=floor($h);
	  $pt=floor($pt)."px";

	  echo "  <div class='thumb $class'><div style='padding-top:$pt'><a href='$path/$src'>\n";
	  echo "  <img src='$path/.thumbs/$src.jpg' width='$w' height='$h' alt='$src $sizeText'/></a></div></div>\n";
	}
    }
  echo " </div>\n\n";
}

function printBibTex($row)
{
  if (!$row["id"]) { die ("No publication id given"); }

  $aresult = sqlQuery("SELECT first, last, url FROM authors, publiauthors WHERE authors.id = publiauthors.idAuthor AND publiauthors.idPubli=$row[id] ORDER BY rank");

  while ($arow = mysql_fetch_array($aresult))
    {
      if (!$authors)
	$authors = "$arow[last], $arow[first]";
      else
	$authors .= " and $arow[last], $arow[first]";
    }

  mysql_free_result ($aresult);

  $res = "@".$row[entry]."{".$row[bibTex].",\n";

  if ($row["entry"] == "Proceedings")
    $res .= "  editor       = \"$authors\",\n";
  else
    $res .= "  author       = \"$authors\",\n";
  
  $res .= "  title        = \"$row[title]\",\n";
  
  if ($row["booktitle"])   { $res .= "  booktitle    = \"$row[booktitle]\",\n"; }
  if ($row["journal"])     { $res .= "  journal      = \"$row[journal]\",\n"; }
  if ($row["school"])      { $res .= "  school       = \"$row[school]\",\n"; }
  if ($row["chapter"])     { $res .= "  chapter      = \"$row[chapter]\",\n"; }
  if ($row["institution"]) { $res .= "  institution  = \"$row[institution]\",\n"; }

  if ($row["number"])      { $res .= "  number       = \"$row[number]\",\n"; }
  if ($row["series"])      { $res .= "  series       = \"$row[series]\",\n"; }
  if ($row["volume"])      { $res .= "  volume       = \"$row[volume]\",\n"; }
  if ($row["pages"])       { $res .= "  pages        = \"$row[pages]\",\n"; }

  if ($row["month"])       { $res .= "  month        = \"$row[month]\",\n"; }
  if ($row["year"])        { $res .= "  year         = \"$row[year]\",\n"; }

  if ($row["editor"])      { $res .= "  editor       = \"$row[editor]\",\n"; }
  if ($row["publisher"])   { $res .= "  publisher    = \"$row[publisher]\",\n"; }
  if ($row["organization"]){ $res .= "  organization = \"$row[organization]\",\n"; }
  if ($row["address"])     { $res .= "  address      = \"$row[address]\",\n"; }
  if ($row["edition"])     { $res .= "  edition      = \"$row[edition]\",\n"; }
  if ($row["note"])        { $res .= "  note         = \"$row[note]\",\n"; }
  if ($row["type"])        { $res .= "  type         = \"$row[type]\",\n"; }
  if ($row["optkey"])      { $res .= "  key          = \"$row[optkey]\",\n"; }
  if ($row["keywords"])    { $res .= "  keywords     = \"$row[keywords]\",\n"; }

  $res .= "  url          = \"http://$_SERVER[HTTP_HOST]/publicaciones/$row[year]/$row[bibTex]\"\n";
  
  $pattern = array("é","è","ê","ë","á","à","â","ä","í","ì","î","ï",
		   "ó","ò","ô","ö","ú","ù","û","ü","ç","Ç","ñ","Ñ","&");
  $replace = array("\'{e}","\`{e}","\^{e}","{\\\"{e}}","\'{a}","\`{a}","\^{a}","{\\\"{a}}","\'{\i}","\`{\i}","\^{\i}","{\\\"{\i}}",
		   "\'{o}","\`{o}","\^{o}","{\\\"{o}}","\'{u}","\`{u}","\^{u}","{\\\"{u}}","\c{c}","\c{C}","\~{n}","\~{N}","\&");

  $res = str_replace($pattern, $replace, $res);
  # echo "<pre class='bibtex'>\n$res}\n</pre>\n\n";

  $web_path="/iie/ext7/grupos/apache/htdocs/";
  $bib_file="/publicaciones/$row[year]/$row[bibTex]/bibtex.txt";
  $bib_path="$web_path/$bib_file";
  if (!file_exists($bib_path))
   {
      $fd_bt=fopen($bib_path, "w");
      fwrite($fd_bt, "$res}\n" );
      fclose($fd_bt);
   }

  echo "<a href=\"http://$_SERVER[HTTP_HOST]/$bib_file\" target=\"_new\">Descargar BibTex <img src=\"/publicaciones/images/BibTeX_logo.png\" alt='bibtex'></a>";
}

function escapeXMLChars($str)
{
  $ascii = array("&", ">", "<");
  $xml   = array("&amp;amp;", "&amp;lt;", "&amp;gt;");

  return str_replace($ascii, $xml, $str);
}

function printXML($row)
{
  if (!$row["id"]) { die ("No publication id given"); }

  if (($row["entry"]=="Misc") || ($row["entry"]=="Manual") ||
      ($row["entry"]=="Unpublished") || ($row["entry"]=="Booklet"))
    return;

  echo "<pre>\n";
  echo " &lt;DESC_REF&gt;\n";
  
  echo "  &lt;AUTEURS&gt;\n";

  $aresult = sqlQuery("SELECT first, last, url FROM authors, publiauthors WHERE authors.id = publiauthors.idAuthor AND publiauthors.idPubli=$row[id] ORDER BY rank");
  while ($arow = mysql_fetch_array($aresult))
    echo "   &lt;AUT_REF&gt;$arow[last] $arow[first]&lt;/AUT_REF&gt;\n";
  mysql_free_result ($aresult);
  echo "  &lt;/AUTEURS&gt;\n";
  
  echo "  &lt;TITR_REF&gt;".escapeXMLChars($row["title"])."&lt;/TITR_REF&gt;\n";
  echo "  &lt;ANN_PUB&gt;$row[year]&lt;/ANN_PUB&gt;\n";

  if ($row["number"] || $row["volume"] || $row["pages"] || $row["series"])
    {
      echo "  &lt;COLL_REF&gt;\n";
      if ($row["number"]) { echo "   &lt;NUM&gt;$row[number]&lt;/NUM&gt;\n"; }
      if ($row["series"]) { echo "   &lt;COL_LIB&gt;".escapeXMLChars($row[series])."&lt;/COL_LIB&gt;\n"; }
      if ($row["volume"]) { echo "   &lt;VOL&gt;$row[volume]&lt;/VOL&gt;\n"; }
      if ($row["pages"])  { echo "   &lt;PAG&gt;$row[pages]&lt;/PAG&gt;\n"; }
      echo "  &lt;/COLL_REF&gt;\n";
    }

   switch($row["entry"])
    {
    case "Article":
      echo "  &lt;INFO_PUB&gt;\n";
      echo "   &lt;REVUE&gt;".escapeXMLChars($row["journal"])."&lt;/REVUE&gt;\n";
      echo "  &lt;/INFO_PUB&gt;\n";
      $typeP="ART";
      $typeS="ACL";
      break;
      
    case "InProceedings":
      echo "  &lt;INFO_COL&gt;\n";
      echo "   &lt;TEXT_COL&gt;".escapeXMLChars($row["booktitle"])."&lt;/TEXT_COL&gt;\n";
      echo "  &lt;/INFO_COL&gt;\n";
      $typeP="COL";
      $typeS="ACT";
      break;
      
    case "Proceedings":
    case "Book":
      echo "  &lt;INFO_OUV&gt;\n";
      echo "   &lt;EDIT&gt;".escapeXMLChars($row[publisher])."&lt;/EDIT&gt;\n";
      echo "  &lt;/INFO_OUV&gt;\n";
      $typeP="OUV";
      $typeS="RCH";
      break;
      
    case "PhdThesis":
    case "MastersThesis":
      echo "  &lt;INFO_TRU&gt;\n";
      echo "   &lt;UNIV_TRU&gt;".escapeXMLChars($row[school])."&lt;/UNIV_TRU&gt;\n";
      echo "  &lt;/INFO_TRU&gt;\n";
      $typeP="TRU";
      if ($row["entry"] == "MastersThesis")
	$typeS="MEM";
      else
	$typeS="THN";
      break;
      
    case "TechReport":
      echo "  &lt;INFO_RAP&gt;\n";
      echo "   &lt;TEXT_RAP&gt;$row[number], ".escapeXMLChars($row[institution])."&lt;/TEXT_RAP&gt;\n";
      echo "  &lt;/INFO_RAP&gt;\n";
      $typeP="RAP";
      $typeS="REC";
      break;

    case "InCollection":
    case "InBook":
      echo "  &lt;INFO_COV&gt;\n";
      if ($row["booktitle"]) echo "   &lt;TITR_OUV&gt;".escapeXMLChars($row[booktitle])."&lt;/TITR_OUV&gt;";
      if ($row["editor"])    echo "   &lt;EDIT_OUV&gt;".escapeXMLChars($row[editor])."&lt;/EDIT_OUV&gt;";
      if ($row["publisher"]) echo "   &lt;TEXT_OUV&gt;".escapeXMLChars($row[publisher])."&lt;/TEXT_OUV&gt;";
      echo "  &lt;/INFO_COV&gt;\n";
      $typeP="COV";
      break;

    default:
      $typeP="Unknown";
      break;
    }
   
  echo "  &lt;THEM_SCI&gt;\n";
  echo "   &lt;CN_SCI&gt;\n    &lt;SEC_SCI&gt;7&lt;/SEC_SCI&gt;\n   &lt;/CN_SCI&gt;\n";
  if ($row["keywords"]) echo "   &lt;MC_LIB&gt;".escapeXMLChars($row[keywords])."&lt;/MC_LIB&gt;\n";
  if ($row["note"]) echo "   &lt;MC_LIB&gt;".escapeXMLChars($row[note])."&lt;/MC_LIB&gt;\n";
  echo "  &lt;/THEM_SCI&gt;\n";

  echo "  &lt;INFO_REF&gt;\n";
  // echo "   &lt;COD_UNIT&gt;UMRxxxx&lt;/COD_UNIT&gt;\n"; filled automatically
  echo "   &lt;COD_EQU&gt;IIE&lt;/COD_EQU&gt;\n";
  echo "   &lt;TYPE_P&gt;$typeP&lt;/TYPE_P&gt;\n";
  if (!empty($typeS)) echo "   &lt;TYPE_S&gt;$typeS&lt;/TYPE_S&gt;\n";
  echo "   &lt;TYPE_L&gt;$row[entry]&lt;/TYPE_L&gt;\n";
  echo "   &lt;STATUT&gt;PUB&lt;/STATUT&gt;\n";
  echo "   &lt;ANN_PROD&gt;$row[year]&lt;/ANN_PROD&gt;\n";
  echo "   &lt;ID_ORIG&gt;IIE-$row[bibTex]&lt;/ID_ORIG&gt;\n";
  echo "  &lt;/INFO_REF&gt;\n";

  echo "  &lt;INFO_URL&gt;\n";
  echo "   &lt;URL_TEXTE&gt;http://$_SERVER[HTTP_HOST]/Publications/$row[year]/$row[bibTex]&lt;/URL_TEXTE&gt;\n";
  echo "   &lt;URL_IMAGE&gt;http://$_SERVER[HTTP_HOST]/Publications/$row[year]/$row[bibTex]&lt;/URL_IMAGE&gt;\n";
  echo "  &lt;/INFO_URL&gt;\n";

  echo " &lt;/DESC_REF&gt;\n</pre>\n\n";
}

function bibQueryResults($option)
{
  // Perform query according to search fields
  $tables="publis";
  $criterion="WHERE 1";

  if (!empty($option["idAuthor"]))
    {
      $tables.=", publiauthors, authors";
      $criterion .= " AND publis.id=publiauthors.idPubli AND authors.id=publiauthors.idAuthor AND authors.id=$option[idAuthor]";
    }
  else
    if (!empty($option["author"]))
      {
	$tables.=", publiauthors, authors";
	$criterion .= " AND publis.id=publiauthors.idPubli AND authors.id=publiauthors.idAuthor AND authors.last like '%$option[author]%'";
      }

  if (!empty($option["title"]))
    $criterion .= " AND (title like '%$option[title]%' OR keywords like '%$option[title]%')";

  if (!empty($option["groups"]))
    $criterion .= " AND (groups like '%$option[groups]%' OR keywords like '%$option[groups]%')";

  if (!empty($option["bibtex"]))
    $criterion .= " AND bibTex='$option[bibtex]'";

  if ($option["onlyThesis"] == 'all' )
   {
   }
  elseif ($option["onlyThesis"] == 'thesis' )
   {
    $criterion .= " AND (entry = 'MastersThesis' OR entry = 'PhdThesis') AND not entry = 'Misc' ";
   }
  elseif ($option["onlyThesis"] == 'articles' )
   {
    $criterion .= " AND not (entry = 'MastersThesis' OR entry = 'PhdThesis' OR entry = 'Misc' )";
   }
  elseif ($option["onlyThesis"] == 'studentsthesis' )
   {
    $criterion .= " AND (entry = 'Misc')";
   }

  if (!empty($option["ambit"]) )
   {
    $criterion .= " AND note = '' ";
   }

  if (!empty($option["year"]) && $option["year"]!="-1")
    $criterion .= " AND year=$option[year]";

  if (empty($option["query"]))
    $option["query"] = "SELECT publis.* FROM $tables $criterion ORDER BY year DESC, title ASC";

  return sqlQuery($option["query"]);
}


function displayResults($result, $option)
{
  global $lg;
  if ($lg=="fr")
    $txtIn="en";
  else
    $txtIn="in";
  
  if (empty($option["pg"]))
    $option["pg"] = 1;

  if ($option["display"]=="gallery")
    echo "<div class='results gallery'>\n";
  else
    if ($option["display"]=="bibtex")
      echo "<div class='results bibtex'>\n";
    else
      echo "<div class='results list'>\n";

  if (empty($option["nbPerPage"])) $option["nbPerPage"]=10;
  if (empty($option["fullYear"]))  $option["fullYear"]=false;
  
  // Page limits
  if ($option["pg"]==-1)
    {
      $minCount=0;
      $maxCount=99999;
    }
  else
    {
      $minCount=($option["pg"]-1)*$option["nbPerPage"];
      $maxCount=$minCount+$option["nbPerPage"];
    }

  $count=-1;
  $addHR=false;
  $stopAtNextYear=false;
  $prevYear=-1;

  if ($option["display"]=="xml")
    {
      // echo "<pre>\n &lt;?xml version=\"1.0\" encoding='ISO-8859-1'?&gt;\n";
	  echo "<pre>\n &lt;?xml version=\"1.0\" encoding='UTF-8'?&gt;\n";
      echo " &lt;PUBCNRS&gt;\n</pre>\n";
    }

  while ($result && $row=mysql_fetch_array($result))
    {
      $count++;
      if ($count<$minCount) continue;
      if ($count>=$maxCount)
	if ($option["fullYear"])
	  {
	    $stopAtNextYear = true;
	    $maxCount = 99999;
	  }
	else
	  break;

      if ($row["year"] != $prevYear)
	{
	  if ($stopAtNextYear) break;
	  $prevYear=$row["year"];

	  if (($option["display"]=="bibtex") || ($option["display"]=="xml"))
	    {
	      if ($addHR)		
		echo " <hr style=\"height: 5px;\"/>\n\n";
	    }
	  else
	    {
	      if ($addHR)
		echo " <div class='interYear'>&nbsp;</div>\n\n";
	  echo " <div class='year'>Publications $txtIn $prevYear</div>\n\n";
	    }
	  $addHR = false;
	}

      if ($addHR)
	echo " <hr />\n\n";
      else
	$addHR = true;

      if ($option["display"]=="gallery")
	printGalleryLine($row);
      else
	if ($option["display"]=="bibtex")
	  printBibtex($row);
	else
	  if ($option["display"]=="xml")
	    printXML($row);
	  else
	  printPubliLine($row);
    }

  if ($option["display"]=="xml")
    echo "<pre>&lt;/PUBCNRS&gt;</pre>\n";

  if ($addHR)
    echo " <hr />\n\n";

  echo "</div>\n";

  echo "<br style='clear:both'/>\n";
}


function displayPublications($option)
{
  require_once("utils.php");
  sqlConnect();
  $result = bibQueryResults($option);
  displayResults($result, $option);
  mysql_close();
}

function getAuthorURL($first, $last)
{
    # $trozos = explode(" ", $last);
    # $last = $trozos[0];
    if (!$xlink = mysql_connect("localhost", "moodleusr", "MoodleAccess" ) )
     {
       sendMessage("Unable to connect to mySQL server");
       die("Unable to connect to mySQL server. Administrator has been warned.");
     }

    if (!mysql_select_db('moodle', $xlink))
     {
       sendMessage("Unable to select $database mySQL database");
       echo("Unable to select mySQL database. Administrator has been warned.");
       die("</body>\n</html>\n");
     }
#  $xresult = mysql_query("select id from mdl_user firstname like '%$first%' and lastname like '%$last%'", $xlink);

   $xresult = mysql_query( "select id  from mdl_user u inner join ( select d.userid, data as institucion from mdl_user_info_field i, mdl_user_info_data d where i.id=d.fieldid and i.shortname='institucion' and d.data='UDELAR/FING/IIE' ) as tinstitucion on u.id=tinstitucion.userid where firstname like '%$first%' and lastname like '%$last%';", $xlink );

  $out = 0;

  if ($xresult)
   {
      if ( ( mysql_num_rows( $xresult ) == 1 ) && 
           ( $xrow=mysql_fetch_array($xresult) ) )
       {
          $out = $xrow[id];
       }
      elseif ( mysql_num_rows( $xresult ) > 1 )
       {
          $out = -1;
       } 
   }
  mysql_close( $xlink );
  return $out;
}

?>
