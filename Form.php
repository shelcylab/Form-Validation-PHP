<!DOCTYPE HTML>
<html>
<head>
  <style>
    .fields {
      display: table
    }

    .fields-row {
      display: table-row;
    }

    .fields-row b {
      display: table-cell
    }

    .error {color: #FF0000;}
  </style>
</head>
<body>

    <?php

    $nameErr = $pwdErr = $cpwdErr =  $cityErr =  $stateErr = $zipErr = $phnErr = $expErr = $cardErr = "";
    $email = $password = $cpassword = $fname = $lname= $addr = $city = $state = $zip = $phn = $cnumber= $exp = "";
  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $cards=$_POST['cards'];
        $addr=$_POST['addr'];
        $cnumber=$_POST['cnumber'];
        $cards=$_POST['cards'];
  
//password   
    if (empty($_POST["password"])) {
        $pwdErr = "Password Required!";
    } else {
        $password = test_input($_POST["password"]);
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
            $pwdErr = 'Must have one each of upper, lower, digit, and - ';
        }
      }
  
//verify password        
    if (empty($_POST["cpassword"])) {
        $cpwdErr = "Retype your password.";
    }     
    else{
        $cpassword = test_input($_POST["cpassword"]);
    if(!($_POST["password"] === $_POST["cpassword"])){
        $cpwdErr = "Passwords do not match..";
    }
}
//city 
      if (empty($_POST["city"])) {
        $cityErr = "Required.";
    } else {
        $city = test_input($_POST["city"]);
      }
  
//state
      if (empty($_POST["state"])) {
        $stateErr = "Required.";
    } else {
        $state = test_input($_POST["state"]);
      }
  
//zip code
      if (empty($_POST["zip"])) {
        $zipErr = "Required.";
      }else{
      $zip = test_input($_POST["zip"]);
      if(!preg_match('/^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]?$/', $zip)) {
            $zipErr = 'Invalid zip code.';
        }
      } 
  
//phone number
      if (empty($_POST["phn"])) {
        $phnErr = "Required.";
    }else{
        $phn = test_input($_POST["phn"]);
      if (!preg_match ('/^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/', $phn)) {
        $phnErr = "Invalid phone number.";
        }
      }
//card number 

if(!empty($_POST['cards'])) {    
    foreach($_POST['cards'] as $value){

                if(!((strcmp($value,"card1")==0)|| (strcmp($value,"card2")==0)||(strcmp($value,"card3")==0)))
                {
                    $cardErr = "Please select a card type.";
                }
             else {
                $cards = test_input($_POST["cards"]);
              }
              
              if(strcmp($value,"card1")==0)
              {
                  $card="card1";
              }
              else if(strcmp($value,"card2")==0)
              {
                $card="card2";
              }
              else if(strcmp($value,"card3")==0)
              {
                $card="card3";
              }
                
            }
        }

//expiry date   
      if (empty($_POST["exp"])) {
        $expErr = "Invalid date format.";
      } else {
        $exp = test_input($_POST["exp"]);
        // /[0-9]{2}\/[0-9]{2}\/[0-9]{4}/
        // if (!preg_match ('/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][[:digit:]]|3[01])\/[[:digit:]]{4}$/', $phn)) {
        if (!preg_match ('/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][[:digit:]]|3[01])\/[[:digit:]]{4}$/', $exp)) {
            $expErr = "Invalid date format.";
      }
    }
}
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>
  <h1>Register for an Account</h1>
  <p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
     <fieldset>

    <legend><b>Account Information:</b></legend><br>

    <div class="fields">

      <div class="fields-row">
        <b><label for="email">E-Mail:</label></b>
        <input type="text" id="email" name="email">
      </div>

      <div class="fields-row">
        <b><label for="password">Password:</label></b>
        <input type="password" id="password" name="password">
        <span class="error">* <?php echo $pwdErr;?></span>
      </div>

      <div class="fields-row">
        <b><label for="cpassword">Verify Password:</label></b>
        <input type="password" id="cpassword" name="cpassword">
        <span class="error">* <?php echo $cpwdErr;?></span>
      </div>

    </div>

  </fieldset>
  <br>

  <fieldset>
    <legend><b>Contact Information:</b></legend><br>
    <div class="fields">

      <div class="fields-row">
        <b><label for="fname">First name:</label></b>
        <input type="text" id="fname" name="fname"><br>
      </div>
      <div class="fields-row">
        <b><label for="lname">Last name:</label></b>
        <input type="text" id="lname" name="lname"><br>
      </div>
      <div class="fields-row">
        <b><label for="addr">Address:</label></b>
        <input type="text" id="addr" name="addr"><br>
      </div>
      <div class="fields-row">
        <b><label for="city">City:</label></b>
        <input type="text" id="city" name="city">
        <span class="error">* <?php echo $cityErr;?></span>
      </div>
      <div class="fields-row">
        <b><label for="state">State:</label></b>
        <input type="text" id="state" name="state">
        <span class="error">* <?php echo $stateErr;?></span>
      </div>
      <div class="fields-row">
        <b><label for="zip">ZIP Code:</label></b>
        <input type="text" id="zip" name="zip">
        <span class="error">* <?php echo $zipErr;?></span>
      </div>
      <div class="fields-row">
        <b><label for="phn">Phone Number:</label></b>
        <input type="text" id="phn" name="phn">
        <span class="error">* <?php echo $phnErr;?></span>
      </div><div class="fields-row"></div>
    </div>
  </fieldset>

  <br>
  <fieldset>
    <legend><b>Payment Information:</b></legend><br>
    <div class="fields">
      <div class="fields-row">
      <b><label for="cards">Card Type:</label></b>
      <input type="text" name="cards[]" list="cardList" placeholder="Select One">
      <datalist id="cardList">
        <option value="card1">Card1</option>
        <option value="card2">Card2</option>
        <option value="card3">Card3</option>
        </datalist>




      <span class="error">* <?php echo $cardErr;?></span>
    </div>
    <div class="fields-row">
      <b><label for="cnumber">Card Number:</label></b>
      <input type="text" id="cnumber" name="cnumber"><br>
    </div>
      <div class="fields-row">
      <b><label for="exp">Expiration Date:</label></b>
      <input type="text" id="exp" name="exp" placeholder="mm/dd/yyyyy">
      <span class="error">* <?php echo $expErr;?></span>
    </div>
    </div>
  </fieldset>

  <br>
  <fieldset>
    <legend><b>Submit Registration:</b></legend><br>
    <input type="submit" value="Register">
    <input type="submit" value="Reset">
  </fieldset>
  <br>

  </form>

  <?php
echo "<h2>Review the details:</h2>";
echo "Name: ".$fname." ".$lname;
echo "<br>";
echo "Email Address: ".$email;
echo "<br>";
echo "Verify your passwords: ".$password." and ".$cpassword;
echo "<br>";
echo "Address: Line1 - ".$addr.", City - ".$city.", State - ".$state.", Zip Code - ".$zip;
echo "<br>";
echo "Phone Number: ".$phn;
echo "<br>";
echo "Card Details: Card type - ".$card."Card number - ".$cnumber."Expiry date - ".$exp;
echo "<br>";

?>
  
</body>
</html>