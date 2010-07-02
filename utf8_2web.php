<!DOCTYPE HTML >
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ascii2htmlcode</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    </head>
    <body>
<pre>

<?php
include 'function.php';
/*
 * open a nfo file and translate it into htmlcode
 */
$testfile='test/hey4.nfo';
$filesize =filesize($testfile);
$fhandle = fopen($testfile,'r');
$thebytes = fread($fhandle, $filesize);
fclose($fhandle);

for($c=0;$c<$filesize;$c++){          // cyctle through the whole file doing a byte at a time.
    $byte=$thebytes[$c];              // get byte to process
    $bits=byte2bin($byte);

 // how many bytes in utf character
    if ($bits[0]==0){ // just the 2 byte
        echo '&#'.ord($byte).';';
    }
    else { // more than 1 byte
        if ($bits[2]==0){                   // two bytes utf 110
            $umm0=$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
            $c++;
            $bits=byte2bin($thebytes[$c]);
            $umm1=$bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
            $umm=$umm0.$umm1;
            echo '&#'.bindec($umm).';';
        }
        else {
            if ($bits[3]==0){               // three bytes
                $umm0=$bits[4].$bits[5].$bits[6].$bits[7];
                $c++;
                $bits=byte2bin($thebytes[$c]);
                $umm1=$bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
                $c++;
                $bits=byte2bin($thebytes[$c]);
                $umm2=$bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
                $umm=$umm0.$umm1.$umm2;
                echo '&#'.bindec($umm).';';
            }
            else {
                if ($bits[4]==0){           // four bytes
                    $umm0=$bits[5].$bits[6].$bits[7];
                    $c++;
                    $bits=byte2bin($thebytes[$c]);
                    $umm1=$bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
                    $c++;
                    $bits=byte2bin($thebytes[$c]);
                    $umm2=$bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
                    $c++;
                    $bits=byte2bin($thebytes[$c]);
                    $umm3=$bits[2].$bits[3].$bits[4].$bits[5].$bits[6].$bits[7];
                    $umm=$umm0.$umm1.$umm2.$umm3;
                    echo '&#'.bindec($umm).';';
                }
            }
        }
    }

}

?>
</pre>
