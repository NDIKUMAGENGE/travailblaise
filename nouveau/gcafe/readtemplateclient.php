<?php
$search_value=isset($search_term) ? "value='{$search_term}'" : "";
// search form
?>

<form role='search' action='search.php'>
    <div style='margin-left:200px' class='input-group col-md-3 '>

        <input type='text' class='form-control' placeholder='cni ou nom...' name='s' id='srch-term' required <?= $search_value ?> />
        <div class='input-group-btn'>
            <button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>
        </div>
    </div>
</form>

<?php 
// create product button
echo "<div style='margin-left:200px'class='right-button-margin'>";
    echo "<a href='createclient.php' class='btn btn-primary '>";
        echo "<span class='glyphicon glyphicon-plus'></span> Ajouter un Cafeiculteur";
    echo "</a>";
echo "</div>";
 
// display the products if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered' style='background-color:#ffdddd;margin-left:200px'>";
        echo "<tr>";
            echo "<th>Cni</th>";
            echo "<th>nom</th>";
            echo "<th>prenom</th>";
            echo "<th>sexe</th>";
            echo "<th>etat civil</th>";
			 echo "<th>Telephone</th>";
			  echo "<th>province</th>";
			   echo "<th>commune</th>";
			    echo "<th>colline</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$cni}</td>";
                echo "<td>{$nom}</td>";
                echo "<td>{$prenom}</td>";
                echo "<td>{$sexe}</td>";
				echo "<td>{$etatcivil}</td>";
				echo "<td>{$telephone}</td>";
				echo "<td>{$province}</td>";
				echo "<td>{$commune}</td>";
				echo "<td>{$colline}</td>";
                
                echo "<td>";
 
                    // read product button
                    //echo "<a href='read_one.php?id={$cni}' class='btn btn-primary left-margin'>";
                     //   echo "<span class='glyphicon glyphicon-list'></span> Read";
                    //echo "</a>";
 
                    // edit product button
                    echo "<a href='updateclient.php?id={$cni}' class='btn btn-info left-margin'>";
                        echo "<span class='nav-icon fas fa-copy'></span> Edit";
                    echo "</a>";
 
                    // delete product button
                    echo "<a href='deletepersonnel.php?object_id={$cni}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No products found.</div>";
}
?>