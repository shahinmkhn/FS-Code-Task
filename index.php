<?php


require_once 'dbh.php';
require_once 'func.php';

logDivs($conn);

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>    
        test
    </title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>


<!-- -------------------------------------------------------------------------------------------------------------- -->
<!-- 1 - php -->


<?php
echo '<div id="main" style="width:100%">';
$numId=0;

// bazada olan div'ləri əlavə etmək
if($_SESSION["i"] > 0){
for($a=0; $a<$_SESSION["i"]; $a++){
echo '<div onclick="deleteDiv(' . $_SESSION["id" . $a] . ');" id=' . $_SESSION["id" . $a] 
            . ' style="background: #' . dechex($_SESSION["red" . $a]) . dechex($_SESSION["green" . $a]) 
            . dechex($_SESSION["blue" . $a]) . '; width: ' . $_SESSION["width$a"] . 'px; height: ' 
            . $_SESSION["height$a"] . 'px; position: absolute; top:' . $_SESSION["topPerc" . $a] . '%; left:' 
            . $_SESSION["leftPerc" . $a] . '%"></div>';
}

// identifikasiya üçün
$num =  $_SESSION["i"]-1;
$numId = $_SESSION["id" . $num];
echo $numId;
}

echo '</div>';


// Add Div düyməsi
echo '<button onclick="addiv(0,0,0,0,0,0,0,' . $numId . ');" style="position:absolute; top:5px; left: 5px;">Add Div</button>';


session_unset();
session_destroy();

?>



<!-- --------------------------------------------------------------------------------------------------------- -->
<!-- 2 ajax -->

<!-- script vasitəsilə məlumatları post etmək üçün ajaxdan istifadə edirik, məlumatlar bck.php'də qəbul olunur. -->


<!-- div yaradırıq -->
<script>
    function create (redA, greenA, blueA, leftA, topA, widthA, heightA, idA) {
        $.ajax({
            url:"bck.php",    //the page containing php script
            type: "post",    //request type,
            dataType: 'json',
            data: {done: "success", red: redA, green: greenA, blue: blueA, left: leftA, top: topA, width: widthA, height: heightA, id: idA},
            success:function(result){
                console.log(result.result);
            }
        });
    }



// div'i silirik
    function deleteIt (idA) {
        $.ajax({
            url:"bck.php",    //the page containing php script
            type: "post",    //request type,
            dataType: 'json',
            data: {done: "successdel", id: idA},
            success:function(result){
                console.log(result.result);
            }
        });
    }
</script>


<!-- ------------------------------------------------------------------------------------------------------ -->
<!-- 3 js -->



<script>
var adder = 1;
function addiv(redCss, greenCss, blueCss, leftPerc, topPerc, widthA, heightA, idA){

// div yaratmaq
var div = document.createElement("div");
div.style.color = "white";
div.id = idA+adder;


// məlumatların təsadüfiliyini təmin etmək
if(redCss == 0){
redCss = getRandomInt(16, 255);
greenCss = getRandomInt(16, 255);
blueCss = getRandomInt(16, 255);
leftPerc = getRandomInt(5, 95);
topPerc = getRandomInt(5, 95);
widthA = getRandomInt(30, 80);
heightA = getRandomInt(30, 80);

}

create(redCss, greenCss, blueCss, leftPerc, topPerc, widthA, heightA, idA+adder);


div.style.background = '#' + redCss.toString(16)
     + greenCss.toString(16) + blueCss.toString(16);
     
div.style.position = "absolute";
div.style.left = leftPerc + '%';
div.style.top = topPerc + '%';
div.style.width = widthA + "px";
div.style.height = heightA + "px";


document.getElementById("main").appendChild(div);
console.log(div.id);


// div'ə basılanda deleteDiv() funksiyasını çağırsın.
div.setAttribute("onclick", "deleteDiv(" + div.id + ")");
adder++;

}


function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


// div'i həm bazadan, həm də ekrandan silirik
function deleteDiv(id){

    console.log(id);

    var elem = document.getElementById(id);
    elem.parentNode.removeChild(elem);

    deleteIt(id);

}

</script>




</body>
</html>