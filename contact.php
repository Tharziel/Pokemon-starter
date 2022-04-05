

<?php 

require_once 'menu.php'; 

require_once 'connexionBDD.php';
// Necessite la bibliothéque PHPMailer (https://github.com/PHPMailer/PHPMailer)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])){ 
    $name = htmlspecialchars($_POST['name']);
    $emailFrom = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $date = date('Y-m-d H:i:s');
   
    require_once "includes/Exception.php";
    require_once "includes/PHPMailer.php";
    require_once "includes/SMTP.php";
    

    $mail = new PHPMailer(true); #true car on gére les exceptions

    $query = "INSERT INTO `contact`(`name`, `date`) VALUES (:name, '$date') "; //Requete en sql avec :id qui est un paramétre nommé
    $request = $db->prepare($query); 
    $request->bindValue(":name", $name, PDO::PARAM_STR);
    $request->execute();
    try{
       

       // $mail->SMTPDebug = SMTP::DEBUG_SERVER; # Car on veut afficher les infos de debug (ne pas laisser en prod)
        $mail->isSMTP(); #Indique que l'on transmet par protocole SMTP
        $mail->Host = "localhost";
        $mail->Port = 1025;
        $mail->Charset = "utf-8";

        $mail->addAddress('antoinerobert43@outlook.fr'); # A qui envoyons nous le mail
        // $mail->addCC(); Envoyer une copie
        $mail->setFrom($emailFrom); #Qui envoie le mail
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send(); # On envoie le mail
        $success = "Message envoyé.";


    }catch(Exception $e){
        echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
    }
}


?>

    <main>
    
        
</div>
        <h1 class="text-center">Nous contacter</h1>
         <?php if(isset($_POST['submit'])){ ?>
            <div class="alert alert-success d-flex align-items-center my-3 mx-3" role="alert">
                 <p> <?php echo $success;}  ?></p>
            </div> 
        <form class="my-3 mx-3" method="post">
            <div class="mb-3">
                <input class="form-control" type="text" name="name" placeholder="Votre Nom">
            </div>
            <div class="mb-3">
                <input class="form-control" type="email" name="email" placeholder="Votre Email">
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="subject" placeholder="Votre Sujet">
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="message" placeholder="Message"></textarea>
            </div>
                <button class="form-control"s type="submit" name="submit">Envoyer</button>
        </form>



    </main>


<?php require_once 'footer.php'; ?>
<script src="bootstrap/js/bootstrap.min.js"></script>