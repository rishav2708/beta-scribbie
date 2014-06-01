<?php
class PosTagger {
        private $dict;
       
        public function __construct($lexicon) {
                $fh = fopen($lexicon, 'r');
                while($line = fgets($fh)) {
                        $tags = explode(' ', $line);
                        $this->dict[strtolower(array_shift($tags))] = $tags;
                }
                fclose($fh);
        }
       
        public function tag($text) {
                preg_match_all("/[\w\d\.]+/", $text, $matches);
                $nouns = array('NN', 'NNS');
               
                $return = array();
                $i = 0;
                foreach($matches[0] as $token) {
                        // default to a common noun
                        $return[$i] = array('token' => $token, 'tag' => 'NN'); 
                       
                        // remove trailing full stops
                        if(substr($token, -1) == '.') {
                                $token = preg_replace('/\.+$/', '', $token);
                        }
                       
                        // get from dict if set
                        if(isset($this->dict[strtolower($token)])) {
                                $return[$i]['tag'] = $this->dict[strtolower($token)][0];
                        }      
                       
                        // Converts verbs after 'the' to nouns
                        if($i > 0) {
                                if($return[$i - 1]['tag'] == 'DT' &&
                                        in_array($return[$i]['tag'],
                                                        array('VBD', 'VBP', 'VB'))) {
                                        $return[$i]['tag'] = 'NN';
                                }
                        }
                       
                        // Convert noun to number if . appears
                        if($return[$i]['tag'][0] == 'N' && strpos($token, '.') !== false) {
                                $return[$i]['tag'] = 'CD';
                        }
                       
                        // Convert noun to past particile if ends with 'ed'
                        if($return[$i]['tag'][0] == 'N' && substr($token, -2) == 'ed') {
                                $return[$i]['tag'] = 'VBN';
                        }
                       
                        // Anything that ends 'ly' is an adverb
                        if(substr($token, -2) == 'ly') {
                                $return[$i]['tag'] = 'RB';
                        }
                       
                        // Common noun to adjective if it ends with al
                        if(in_array($return[$i]['tag'], $nouns)
                                                && substr($token, -2) == 'al') {
                                $return[$i]['tag'] = 'JJ';
                        }
                       
                        // Noun to verb if the word before is 'would'
                        if($i > 0) {
                                if($return[$i]['tag'] == 'NN'
                                        && strtolower($return[$i-1]['token']) == 'would') {
                                        $return[$i]['tag'] = 'VB';
                                }
                        }
                       
                        // Convert noun to plural if it ends with an s
                        if($return[$i]['tag'] == 'NN' && substr($token, -1) == 's') {
                                $return[$i]['tag'] = 'NNS';
                        }
                       
                        // Convert common noun to gerund
                        if(in_array($return[$i]['tag'], $nouns)
                                        && substr($token, -3) == 'ing') {
                                $return[$i]['tag'] = 'VBG';
                        }
                       
                        // If we get noun noun, and the second can be a verb, convert to verb
                        if($i > 0) {
                                if(in_array($return[$i]['tag'], $nouns)
                                                && in_array($return[$i-1]['tag'], $nouns)
                                                && isset($this->dict[strtolower($token)])) {
                                        if(in_array('VBN', $this->dict[strtolower($token)])) {
                                                $return[$i]['tag'] = 'VBN';
                                        } else if(in_array('VBZ',
                                                        $this->dict[strtolower($token)])) {
                                                $return[$i]['tag'] = 'VBZ';
                                        }
                                }
                        }
                       
                        $i++;
                }
               
                return $return;
        }
}
$con=mysqli_connect("localhost","root","salvation123","yatriplace");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$tagger = new PosTagger('lexicon.txt');
$tags=$tagger->tag($_GET['q']);
echo json_encode($tags);
$places=array();
$type1=array();
$num=array();
foreach($tags as $var)
{
if($var['tag']=='CD'||$var['tag']=='CD\n')
 array_push($num,$var['token']);
if($var['tag']=='NN'||$var['tag']=='NNP'||$var['tag']=='NNP\n'||$var['tag']=='NN\n'||$var['tag']=='NNS'||$var['tag']=='NNS\n')
  {
    $result=mysqli_query($con,"SELECT * FROM table2 WHERE cityname='".$var['token']."'");
    $row=mysqli_fetch_array($result);
    if($row)
     {
       //print_r($row);
       array_push($places,$var['token']);
     }
    else
      array_push($type1,$var['token']);
  }
}
//print_r($type1);
foreach($type1 as $type)
{
 giveOut($type,$places);
}
//print_r($fp);
function giveOut($type,$places)
{
$con=mysqli_connect("localhost","root","salvation123","yatriplace");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$query="SELECT * FROM table1 WHERE suggestions_soundex=LEFT(SOUNDEX('".$type."'),10);";
$q=mysqli_query($con,$query);
$ans=mysqli_fetch_array($q);
$type=$ans['suggestions'];
$t=array();
$fp=json_decode(file_get_contents("abc.json"),true);
foreach($fp as $var=>$val)
{ 
   if(in_array($type,$val))
   {
     array_push($t,$var);
   }
 }
//echo $t[0];
$types=$t[0];
if($types==null)
	return;
//echo $types;
//echo json_encode($places);
//print_r($tags);
foreach($places as $var)
{
$result=mysqli_query($con,"SELECT * FROM table2 WHERE cityname='".$var."'");
$row=mysqli_fetch_array($result);
if(!($row)) continue;
$j="https://maps.googleapis.com/maps/api/place/search/json?location=".$row['lat'].",".$row['long']."&radius=100000&types=".$types."&sensor=false&key=AIzaSyDFnAN1_tLIiCggtyjtkFw-Qk9Wl82-ENw";
echo $j;
$json=file_get_contents($j);
$json1=json_decode($json,true);
//print_r($json1);
//echo $json1['results'][0]['geometry']['location']['lat'];
//echo $json1['results'][0]['geometry']['location']['lng'];
//echo $json1['results'][0]['name'];
//echo $json1['results'][0]['photos'][0]['photo_reference'];
foreach($json1['results'] as $var)
{
 if(strpos($_GET['q'],'famous')!==false)
 {
   if($var['rating']>=4.0)
   {
     echo $var['geometry']['location']['lat']."</br>";
 echo $var['geometry']['location']['lng']."</br>";
 echo $var['name']."</br>";
 echo $var['rating']."</br>";
 echo $var['vicinity']."</br>";
 $s= "python url.py ".$var['photos'][0]['photo_reference'];
 $b=exec($s);
 echo $b."</br>";

   }
 }
else
{
 echo $var['geometry']['location']['lat']."</br>";
 echo $var['geometry']['location']['lng']."</br>";
 echo $var['name']."</br>";
 echo $var['rating']."</br>";
 echo $var['vicinity']."</br>";
 $s= "python url.py ".$var['photos'][0]['photo_reference'];
 $b=exec($s);
 echo $b."</br>";
}
}
}
}
?>
