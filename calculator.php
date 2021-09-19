<<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.php">
    </head>
    <body>

        <!-- PHP CALCULATION FUNCTIONS -->
    <?php 

// CIF Function
function CIF(float $price, float $weight) {
    $temp=$weight/2.2;
    $result=($price+$temp) * 2;
  return round($result,2);
}

// CIF DUTY Function
function cifDuty(float $price, float $weight) {
    $temp=CIF($price,$weight);
    $result=($temp * 0.2) + $temp;
  
  return round($result,2);
}

// CIF DUTY VAT Function
function cifDutyVat(float $price, float $weight) {
    $temp=cifDuty($price,$weight);
    $result=($temp * 0.125) + $temp;
  
  return round($result,2);
}

// CHARGE USD
function USD(float $price, float $weight) {
    $temp=cifDutyVat($price,$weight);
    $result=($temp * 0.2) + $temp;
  
  return round($result,2);
}

// CHARGE TTD
function TTD(float $price, float $weight) {
    $temp=USD($price,$weight);
    $result=($temp * 6.8) + 34;
  
  return round($result,2);
}
?>

<!-- SHIPPING CALCULATOR -->
  <?php 
    $price=0.0;
    $weight=0.0;
    ?>

    <form class="form-style-7" action="calculator.php" method="POST">
<ul>
<li>
    <label for="price">Unit Price $</label>
    <input type="number" name="price" maxlength="15" placeholder=<?php  echo $price ?> >
    <span>Enter Your Unit Price Here</span>
    <?php 
    $price = $_POST['price'];
    ?>
      
</li>
<li>
    <label for="weight">Weight (Lbs)</label>
    <input type="number" name="weight" maxlength="100" placeholder=<?php  echo $weight ?>>
    <span>Enter Your Item Weight Here</span>
    <?php 
    $weight = $_POST['weight'];
    ?>
    
    <div classname="container"> 
<li> <input type="submit" name="submit" value="Calculate" class="button button4" /></li>
</div>

</li>

<li>
    <label for="url">CIF $</label>
    <input type="url" name="url" maxlength="100" readonly placeholder="<?php echo CIF($price,$weight) ?>">
    <span>CIF Calculation</span>
</li>
<li>
    <label for="url">CIF DUTY $</label>
    <input type="url" name="url" maxlength="100" readonly placeholder= <?php echo cifDuty($price,$weight) ?>>
    <span> CIF DUTY </span>
</li>
<li>
    <label for="text"> CIF DUTY VAT $</label>
    <input type="url" name="url" maxlength="100" readonly placeholder= <?php echo cifDutyVat($price,$weight) ?>>
    <span>CIF DUTY VAT </span>
</li>
  
  <hr class="rounded" color="#D1B000">

  <li>
    <label for="url">Total Cost (USD$)</label>
    <input type="url" name="url" maxlength="100" readonly placeholder= <?php echo USD($price,$weight) ?>>
    <span>Total Cost (USD$) </span>
</li>
  <li>
    <label for="url">Total Cost (TTD$)</label>
    <input type="url" name="url" maxlength="100" readonly placeholder= <?php echo TTD($price,$weight) ?>>
    <span>Total Cost (TTD$) </span>
</li>
</ul>
</form>

    </body>
</html>