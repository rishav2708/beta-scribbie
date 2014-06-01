<?php
	error_reporting(E_ALL);
ini_set('display_errors', 'on');
if (PHP_SAPI != 'cli') {
	echo "<pre>";
}

$string = $_POST['message'];


require_once __DIR__ . '/../autoload.php';
$sentiment = new \PHPInsight\Sentiment();



	// calculations:
	$scores = $sentiment->score($string);
	$class = $sentiment->categorise($string);

	
?>
<head>
	<style>
		/* Basic Grey */
.basic-grey {
    width: 800px;
    margin-right: auto;
    margin-left: auto;
    background: #EEE;
    padding: 20px 30px 20px 30px;
    font: 12px Georgia, "Times New Roman", Times, serif;
    color: #888;
    text-shadow: 1px 1px 1px #FFF;
    border:1px solid #DADADA;
}
.basic-grey h1 {
    font: 25px Georgia, "Times New Roman", Times, serif;
    padding: 0px 0px 10px 40px;
    display: block;
    border-bottom: 1px solid #DADADA;
    margin: -10px -30px 30px -30px;
    color: #888;
}
.basic-grey h1>span {
    display: block;
    font-size: 11px;
}
.basic-grey label {
    display: block;
    margin: 0px 0px 5px;
}
.basic-grey label>span {
    float: left;
    width: 80px;
    text-align: right;
    padding-right: 10px;
    margin-top: 10px;
    color: #888;
}
.basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea,.basic-grey select{
    border: 1px solid #DADADA;
    color: #888;
    height: 24px;
    margin-bottom: 16px;
    margin-right: 6px;
    margin-top: 2px;
    outline: 0 none;
    padding: 3px 3px 3px 5px;
    width: 70%;
    font: normal 12px/12px Georgia, "Times New Roman", Times, serif;
}
.basic-grey select {
    background: #FFF url('down-arrow.png') no-repeat right;
    background: #FFF url('down-arrow.png') no-repeat right);
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance: none;
    text-indent: 0.01px;
    text-overflow: '';
    width: 72%;
    height: 30px;
}
.basic-grey textarea{
    height:100px;
}
.basic-grey .button {
    background: #E48F8F;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
}
.basic-grey .button:hover {
    background: #CF7A7A
}
.text{
	width : 100px;
}
</style>
</head>
<body>
	<form action="demo.php" method="post" class="basic-grey"">
    <h1>Sentiment Analysis and rating system
        <span>This will generate rating from user comment</span>
    </h1>
    <textarea readonly><?php echo $string;?></textarea>
<font size=3>  
 <?php
	
	echo "Dominant: $class, scores: <br>";
	echo "P(Positive)=".$scores['pos']."<br>";
	echo "P(Negative)=".$scores['neg']."<br>";
	echo "P(Neutral)=".$scores['neu']."<br>";
	$score=($scores['pos'])*5;
	
	if($class=="neu")
	{
		$score=$score+$scores['neu']*5-$scores['neg']*5;
	}
	if($class=="neg")
	{
		
		$score=$score-2.5*$scores['neu'];
	}
	if($class=="pos")
	{
		$score=$score+2.5*$scores['neu'];
	}
	echo  "Rating=".$score;
	if($score<=1)
	echo "<img src=filter-rating-1.png>";
	else if($score<=2)
	echo "<img src=filter-rating-2.png>";
	else if($score<=3)
	echo "<img src=filter-rating-3.png>";
	else if($score<=4)
	echo "<img src=filter-rating-4.png>";
	else if($score<=5)
	echo "<img src=filter-rating-5.png>";
	echo "\n";  ?></font>
</form>
</body>
