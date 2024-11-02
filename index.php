<?php
$firstName = $name = $phone = $email = $message = "";
$firstNameError = $nameError = $phoneError = $emailError = $messageError = "";
$isSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $firstName = verifyInput($_POST['firstName']);
  $name  = verifyInput($_POST['name']);
  $phone = verifyInput($_POST['phone']);
  $email = verifyInput($_POST['email']);
  $message = verifyInput($_POST['message']);
  $isSuccess = true;

  if (empty($firstName)) {
    $firstNameError = "svp ecrivez votre prénom !!";
    $isSuccess = false;
  }

  if (empty($name)) {
    $nameError = "svp ecrivez votre nom !!";
    $isSuccess = false;
  }

  if (empty($message)) {
    $messageError = "svp entrez votre message !!";
    $isSuccess = false;
  }
  if (!isEmail($email)) {
    $emailError = "Votre email n'est pas valide ";
    $isSuccess = false;
  }

  if (!isPhone($phone)) {
    $phoneError = "Que du chiffres et des espaces, svp...";
    $isSuccess = false;
  }

  if (!isName($name)) {
    $nameError = "nom invalide";
    $isSuccess = false;
  }
}
function isEmail($var)
{
  return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function isPhone($var)
{
  return preg_match("/^[0-9 ]*$/", $var);
}
function isName($var)
{
  return preg_match("#Idrissi#", $var);
}


/////securiter:nettoyer ce que veut faire un hacker/////
function verifyInput($var)
{
  $var = trim($var);  //enlever les espaces 
  $var = stripslashes($var); //enlever les antislache
  $var = htmlspecialchars($var);
  return $var;
}
////////validation du coteClient ajouter:required au input////////



?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Contactez-moi!</title>
  <meta name="viewport" content="width=device-width ,initial-scale = 1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="http://fonts.googleapis.com/css?family=lato" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="container">
    <div class="divider"></div>
    <div class="heading">
      <h2>contactez-moi</h2>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
          <div class="row">

            <div class="col-md-6">
              <label for="firstName">Prénom<span class="blue"> *</span></label>
              <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Votre prenom" value="<?php echo $firstName; ?>">
              <p class="comments"><?php echo $firstNameError; ?></p>
            </div>

            <div class="col-md-6">
              <label for="name">Nom<span class="blue"> *</span></label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Votre nom" value="<?php echo $name; ?>">
              <p class="comments"><?php echo $nameError; ?></p>
            </div>

            <div class="col-md-6">
              <label for="email">Email<span class="blue"> *</span></label>
              <input type="email" required name="email" id="email" class="form-control" placeholder="Votre email" value="<?php echo $email; ?>">
              <p class="comments"><?php echo $emailError; ?></p>
            </div>


            <div class="col-md-6">
              <label for="phone">Téléphone</label>
              <input type="tel" name="phone" id="phone" class="form-control" placeholder="Votre telephone" value="<?php echo $phone; ?>">
              <p class="comments"><?php echo $phoneError; ?></p>
            </div>


            <div class="col-md-12">
              <label for="message">Message<span class="blue"> *</span></label>
              <textarea id="message" name="message" class="form-control" placeholder="Votre message" rows="4"><?php echo $message; ?></textarea>
              <p class="comments"><?php echo $messageError; ?></p>
            </div>

            <div class="col-md-12">
              <p class="blue"> <b>* Ces informations sont requises</b></p>
            </div>

            <div class="col-md-12">
              <input type="submit" class="button1" value="Envoyer">
            </div>


          </div>
          <P class="thank-you" style="display: <?php if ($isSuccess) echo 'block';
                                                else echo 'none'; ?>">Votre message a bien été envoyé.Merci de m'avoir contacté :) </P>
        </form>
      </div>
    </div>
  </div>

</body>

</html>