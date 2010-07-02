<?php
function byte2bin($input)  // convert  BYTE  into an 8 binary repesentation (character)
{    $bb= decbin(ord($input));          // make the byte into binary
    $bb= str_repeat('0',(8-strlen($bb))).$bb; // make it 8 bits long as decbinstrips high bits
     return $bb;
}
?>