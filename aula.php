<!DOCTYPE html>
<head>
    <title>Document</title>
</head>

<body>
   
 <!-- atv 10/03
 <form method="post" action="">
        tabuada:<input type ="number" name="numero">
        <input type="submit">
  <form method="post" action="">
        numero1:<input type ="number" name="numero1">
        <input type="submit">
  <form method="post" action="">
        numero2:<input type ="number" name="numero2">
        <input type="submit">
  <form method="post" action="">
        numero3:<input type ="number" name="numero3">
        <input type="submit">-->

    <?php
   /* $i = 1;
    while ($i < 6){
        echo $i;
        $i = $i++;
    } 

    echo "<br><br>";
    $cor = array("vermelho","verde","blue", "yellow");
    foreach ($cor as $valor){
        echo "$valor  <br>"
    }*/


    /*atv1
    echo "atividade 1"
    $num = array (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
    foreach($num= %2==0){
         echo "$num" . "<br>",
    }*/

     /*atv2
      echo "atividade 2"
     $var1=readline['var1'];
     $var2=readline['var2'];                     
     $var3=readline['var3'];
       if (var1 > var2 && var1 > var3 ){
        echo ($var1 +" o primeir valor é o maior entre os tres" );
       }elseif(var2> var1 && var2> var3){
         echo ($var2 +" o segundo valor é o maior entre os tres" );
       }elseif(var3>var1 && var3>var2){
         echo ($var3 +" o terceiro valor é o maior entre os tres" )
       }
       $valormaior = max($var1, $var2, $var3);
       echo "o maior valor é: "+ $valormaior ."<br>",*/
       
       /*atv3
        echo "atividade 3"
        $num= 1;
        $tabuada=readline("digite o valor da tabuada:");
        if($num<=12, $num++){
        echo ("Tabuada do ".$tabuada)
        $resultado=($tabuada*$num);
        echo($tabuada+"x"+$num ": ",+ $resultado);
        }*/
        
       /* if(isset($_POST['numero'])){
        $numero=(int)$_POST['numero'];
         echo"<h2>Tabuada do $numero <h2/>";
        for($i=1; $i<=12; $i++){
          $resultado= $numero * $i;
          echo "$numero x $i = $resultado <br>";
        }
       } else{
          echo"informe o valor no form acima";
        } */
    
       if($_SERVER["REQUEST_METHOD"]== "POST"){
       $num1=$_POST["numero1"]
       $num2=$_POST["numero2"]
       $num3=$_POST["numero3"]
       }if($num1>$num2 && $num1>$num3){
        echo ""
       }if($num2>$num1 && $num2>$num3){
        echo ""
       }else{
        echo""
       }
      

     

?>
</body>
</html>