<?php

function deleteDiv($conn, $id) {
    $sql = "delete from divs where id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../register.php?error=stmterror");
    exit();
    }


    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

  
    
    header("location: ../test/index.php");
    exit();

}


    function createDiv($conn, $red, $green, $blue, $leftPerc, $topPerc, $width, $height, $id) {
        $sql = "insert into divs (id, red, green, blue, leftPerc, topPerc, width, height) values (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../register.php?error=stmterror");
        exit();
        }
    

        mysqli_stmt_bind_param($stmt, "iiiiiiii", $id, $red, $green, $blue, $leftPerc, $topPerc, $width, $height);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        logDivs($conn);
      
        
        header("location: ../test/index.php");
        exit();
    
    }



function logDivs($conn){
 
        session_start();

        $sql = "select * from divs";
        $result = $conn->query($sql);
        $i=0;

if ($result->num_rows > 0) {
    
  while($row = $result->fetch_assoc()) {
      
        $_SESSION["id" . $i] = $row["id"];
        $_SESSION["red" . $i] = $row["red"];
        $_SESSION["green" . $i] = $row["green"];
        $_SESSION["blue" . $i] = $row["blue"];
        $_SESSION["leftPerc" . $i] = $row["leftPerc"];
        $_SESSION["topPerc" . $i] = $row["topPerc"];
        $_SESSION["width" . $i] = $row["width"];
        $_SESSION["height" . $i] = $row["height"];

        
        $i++;
        $_SESSION["i"] = $i;

}
} 
$conn->close();

}
