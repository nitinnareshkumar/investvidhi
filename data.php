<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
include("config/config.inc.php");
// PLEASE EDIT THIS CONFIG

$arr=array();

$result=mysql_query("select * from name_code where visibleOnSearch != 'N' and ( name LIKE '%".mysql_real_escape_string($_GET['chars'])."%' or code LIKE '%".mysql_real_escape_string($_GET['chars'])."%' ) ORDER BY name LIMIT 0, 10") or die(mysql_error());
if(mysql_num_rows($result)>0){
    while($data=mysql_fetch_assoc($result)){
        // Store data in array
        $arr[]=array("id" => $data['number'], "data" => ucwords($data['name']), "thumbnail" => '', "description" => $data['Company_type']);
    }
}

mysql_close($link);

if (!function_exists('json_encode'))
{

function json_encode($a=false)
{
if (is_null($a)) return 'null';
if ($a === false) return 'false';
if ($a === true) return 'true';
if (is_scalar($a))
{
if (is_float($a))
{
// Always use "." for floats.
return floatval(str_replace(",", ".", strval($a)));
}
if (is_string($a))
{
static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
}
else
return $a;
}
$isList = true;
for ($i = 0, reset($a); $i < count($a); $i++, next($a))
{
if (key($a) !== $i)
{
$isList = false;
break;
}
}
$result = array();
if ($isList)
{
foreach ($a as $v) $result[] = json_encode($v);
return '[' . join(',', $result) . ']';
}
else
{
foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
return '{' . join(',', $result) . '}';
}
}
}
// Encode it with JSON format
echo json_encode($arr);
?>