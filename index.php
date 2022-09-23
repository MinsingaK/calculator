<?php

    $current_value = 0;
    $input = [];

    function affichevaleur($values){
        $a = "";
        foreach($values as $value){
            $a .= $value;
        }
        return $a;
    }

    function calcul($entreuser){
        $tab = [];
        $char = "";
        foreach($entreuser as $num){
            if(is_numeric($num) || $num = "."){
                $char .=$num;
            }elseif(!is_numeric($num)){
                if(!empty($char)){
                    $tab[] = $char;
                    $char = "";
                }
                $tab[] = $num;
            }
        }
        if(!empty($char)){
            $tab[] = $char;
        }
        
        $nombre_courant = 0;
        $action = null;
        for($i = 0; $i<count($tab); $i++){
            if(is_numeric($tab[$i])){
                if($action){
                    if($action == "+"){
                        $nombre_courant = $nombre_courant + $tab[$i];
                    }
                    $action = null;
                }else{
                    if($nombre_courant == 0){
                        $nombre_courant = $tab[$i];
                    }
                }
            }else{
                $action = $tab[$i];
            }
        }
        return $nombre_courant;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['input'])){
            $input = json_decode($_POST['input']);
        }
        if(isset($_POST)){
            foreach($_POST as $key => $value){
                if($key == 'egal'){
                    $current_value = calcul($input);
                }elseif($key != 'input'){
                    $input[] = $value;
                }  
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="shortcut icon" href="images/alien-153542__340.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>My calculator</title>
</head>
<body>
    <section class="content_box">
        <h2>Ma calculatrice</h2>
        <form method="POST">
            <div class="zone_calcul">
                <input type="hidden" name="input" value='<?php echo json_encode($input); ?>'>
                <p><?php echo affichevaleur($input); ?></p>
                <input type="text" value="<?php echo $current_value; ?>">
            </div>
            <div class="content">
                <div class="content_header">
                    <button name="clear" class="number">C</button>
                    <button name="division" value="/" class="number">&#247;</button>
                    <button name="mult" class="number" value="x">	&#215;</button>
                    <button name="delete" class="number" value="dlt">&#8592;</button>
                </div>
                <div class="card">
                    <div class="content_number">
                        <button name="1" class="number" value="1">&#49;</button>
                        <button name="2" class="number" value="2">&#50;</button>
                        <button name="3" class="number" value="3">&#51;</button>
                        <button name="4" class="number" value="4">&#52;</button>
                        <button name="5" class="number" value="5">&#53;</button>
                        <button name="6" class="number" value="6">&#54;</button>
                        <button name="7" class="number" value="7">&#55;</button>
                        <button name="8" class="number" value="8">&#56;</button>
                        <button name="9" class="number" value="9">&#57;</button>
                        <button name="0" class="number" value="0">&#48;</button>
                        <button name="comma" class="number" value=",">&#44;</button>             
                    </div>
                    <div class="content_aside">
                        <button name="moins" class="number" id="moins" value="-">&#45;</button>
                        <button name="plus" class="number" id="plus" value="+">&#43;</button>
                        <button name="egal" class="number" id="egal" value="=">&#61;</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</body>
</html>