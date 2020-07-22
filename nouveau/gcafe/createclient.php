<style> label,td,input,button,select,textarea,p{border-radius: 8px;font-size:12px} </style>  
    


<?php
include_once 'index.html';
/* include database and object files
//include_once 'config/database.php';
include_once 'objects/client.php';

include_once 'index.php';
// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$client = new client($db);




// set page headers
$page_title = "Ajouter un Client";
include_once "layout_header.php";



// contents will be here
echo "<div class='right-button-margin'>";
echo "<a href='clientaffichage.php' class='btn btn-default pull-right'>Affichage Personnel</a>";
echo "</div>";
?>



<!-- 'create product' html form will be here -->

<!-- PHP post code will be here -->
<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if ($_POST) {

    // set product property values
    
    $client->nom = $_POST['nom'];
    $client->prenom = $_POST['prenom'];
    $client->sexe = $_POST['sexe'];
    $client->etatcivil = $_POST['etatcivil'];
	 $client->nationalite = $_POST['nationalite'];
	  $client->telephone = $_POST['telephone'];
       $client->email = $_POST['email'];
       $client->datenaissance = $_POST['datenaissance'];
       $client->n_identite = $_POST['n_identite'];
       $client->lieunaissance = $_POST['lieunaissance'];
       $client->residence = $_POST['residence'];
       $client->nompere = $_POST['nompere'];
       $client->nommere = $_POST['nommere'];

        $client->fonction = $_POST['fonction'];
       
        $client->password = $_POST['password'];
        $client->role = $_POST['role'];

    // create the product
    if ($client->create()) {
        echo "<div class='alert alert-success'>client was created.</div>";
    }

    // if unable to create the product, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create client.</div>";
    }
}*/
?>

<div class="col-md-8 col-md-offset-4">

<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <table class='table table-hover table-responsive table-bordered' style="background-color:#9ad1d8;margin-left:300px">
    <tr>
            <td>CNI</td>
            <td><input type='text' name='n_identite' class=''  size=70 /></td>
        </tr>
        <tr>
            <td>Nom</td>
            <td><input type='text' name='nom' class=''  size=70 /></td>
        </tr>

        <tr>
            <td>prenom</td>
            <td><input type='text' name='prenom' class=''  size=70/></td>
        </tr>
		
        <tr>
            <td>Date de naissance</td>
            <td><input type='date' name='datenaissance' class=''  size=70 /></td>
        </tr>
		 <tr>
            <td>sexe</td>
            <td><input type='radio' name='sexe' value="M"class='' /><label>Masculin</label></br>
			<input type='radio' name='sexe' value="F"class='' /><label>Feminin</label>
			</td>
        </tr>
		
		
		 <tr>
            <td>Etat Civil</td>
            <td><input type='radio' name='etatcivil' value="celibataire"class='' /><label>Celibataire</label></br>
			<input type='radio' name='etatcivil' value="marier"class='' /><label>Marie</label></br>
			<input type='radio' name='etatcivil' value="veuf"class='' /><label>veuf</label></br>
			<input type='radio' name='etatcivil' value="divorse"class='' /><label>divorse</label></br>
			
			</td>
        </tr>
        <tr>
            <td>Lieu de naissance</td>
            <td><input type='text' name='lieunaissance' class=''  size=70 /></td>
        </tr>
        <tr>
            <td>Residence</td>
            <td><input type='text' name='residence' class=''  size=70 /></td>
        </tr>
        <tr>
            <td>Nom du Pere</td>
            <td><input type='text' name='nompere' class=''  size=70 /></td>
        </tr>
        <tr>
            <td>Nom de la mere</td>
            <td><input type='text' name='nommere' class=''  size=70 /></td>
        </tr>

		<tr>
            <td>nationalite</td>
            <td><input type='text' name='nationalite' class=''  size=70/></td>
        </tr>
		
		<tr>
            <td>tel</td>
            <td><input type='text' name='telephone' class='' size=70 /></td>
        </tr>
		
		
		<tr>
            <td>Mail</td>
            <td><input type='text' name='email' class=''  size=70/></td>
        </tr>
		<tr>
            <td>Fonction</td>
            <td><input type='text' name='fonction' class=''  size=70 /></td>
        </tr>

      
        <tr>
            <td>Password</td>
            <td><input type='text' name='password' class=''  size=70/></td>
        </tr>
        <tr>
            <td>Role</td>
            <td>
                
             <select name="role"  size=70>
                 <option value="Admin"> Admin</option> 
                 <option value="utilisateur"> utilisateur</option>  
</select>
           </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </td>
        </tr>

    </table>
</form>



<?php
// footer
//include_once "layout_footer.php";
?>