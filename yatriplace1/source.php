<?php
 mysql_connect("localhost","root","toor");
 mysql_select_db("yatriplace");
 
 $term=$_GET["term"];
 
 $query=mysql_query("SELECT * FROM table2 where cityname like '%".$term."%' order by cityname LIMIT 5");
 $json=array();
 
    while($student=mysql_fetch_array($query)){
         $json[]=array(
		    'predef'=> "Restaurants near",
                    'value'=> $student["cityname"],
                    'label'=>"restaurants near".$student["cityname"]." - ".$student["lat"]
                        );
    }
 
 echo json_encode($json);
 
?>
