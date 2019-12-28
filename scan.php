<?php


$blue = "\e[34m";
$lblue = "\e[36m";
$red = "\e[31m";
$green = "\e[92m";
$fgreen = "\e[32m";
$yellow = "\e[1;33m";
$bold = "\e[1m";
echo $red."";
system(" sh logo.sh ");
$target = readline("\e[33m"." Enter Target Site (eg:https://www.google.com) : ");

//website ip

  $wip = gethostbyname($target);
  echo"\n$blue"."[+] IP address: ";
  echo "\e[92m";
  echo $wip ."\n\e[0m";

//detect webserver

  $urlws = $target;
  $wsheaders = get_headers($urlws, 1);
  echo"$blue"."[+] Web Server: ";
  $ws = $wsheaders['Server'];
  if ($ws == ""){echo "\e[91mCould Not Detect\e[0m";}
  else { echo "\e[92m$ws \e[0m";}
  echo"\n";

system(" sh sql.sh ");
  $lulzurl = $target;
  $html = file_get_contents($lulzurl);
  $dom = new DOMDocument;
  @$dom->loadHTML($html);
  $links = $dom->getElementsByTagName('a');
  $vlnk = 0;
  foreach ($links as $link){
    $lol= $link->getAttribute('href');
    if( strpos( $lol, '?' ) !== false ){
      echo"\n$blue [#] ".$fgreen .$lol ."\n$cln";
      echo$green." [-] Searching For SQL Errors: ";
      $sqllist = file_get_contents('sqlerrors.ini');
      $sqlist = explode(',', $sqllist);
      if (strpos($lol, '://') !== false){
        $sqlurl = $lol ."'";
      }
      else{
        $sqlurl = $target."/".$lol."'";
      }
      $sqlsc = file_get_contents($sqlurl);
      $sqlvn = "$red Not Found";
      foreach($sqlist as $sqli){
        if (strpos($sqlsc, $sqli) !== false) $sqlvn ="$green Found!";
      }
      echo $sqlvn;
      echo"\n$cln";
      echo "\n";
      $vlnk++ ;
    }
  }
  echo"\n\n$yellow [+] URL(s) With Parameter(s):".$green.$vlnk;
  echo"\n\n";



?>