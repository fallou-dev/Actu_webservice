<?php $client=new SoapClient('http://localhost:8989/ActuService?wsdl');?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>categorie Data</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	

	<title></title>
</head>
<body>
	<?php
     if ( isset($_POST["libelle"]) ) {
     	

        
            
            $clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
            $parameters =  new stdclass();
          
            $parameters->libelle= $_POST["libelle"];
     
            
            $result = $clientSOAP->__soapCall("AddCategorie",array($parameters));
            
   
            
            header("Location: categorie.php");
            }
        
    



	?>

	<h1 align="center">Liste des categories</h1>
	<div class="container">
	<p id="success"></p>
	<div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Gerer <b>categorie</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#AddcategorieModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">+</i> <span>Ajouter nouveau categorie</span></a>					
					</div>
                </div>
            </div>
	<?php
	$categories=$client->__soapCall('getAllcategories',array());
	if(!empty($categories->return))
	{
	?>
	<table class='table table-borderless table-striped table-earning' border="1" align="center">
		<thead>
		<tr>
			
			<th>ID</th>
			
			<th>libelle</th>
			
			<th>ACTION</th>
		</tr></thead><?php
		if(!is_array($categories->return))
		{
			?>
				<tbody>
			<tr>
				<td><?= $categories->return->id ?></td>
				
				<td><?= $categories->return->libelle ?></td>
				
				<td>
                      <a href="categorie.php?delete=<?php echo $categories->return->id ?>"class="delete" data-toggle="modal" ><i type="Delete" > Delete</i>
                      </a>
                      
                        <a href="edit-categorie.php?update=<?php echo $categories->return->id ?>" class="edit" data-toggle="modal">
                          
                        	<i type="Edit">Edit </i>
                        
                        </a>
                      </td>
				<tbody>
			</tr>
				</tbody>
			<?php
		}
		else
		{
			foreach ($categories->return as  $categorie) {
				?>
				<tbody>
				<tr>
				<td><?= $categorie->id ?></td>
				
				<td><?= $categorie->libelle ?></td>
				
				<td>
                      <a href="categorie.php?delete=<?php echo $categorie->id ?>" class="delete" data-toggle="modal"><i type="Delete" > Delete</i>
                      </a>
                      
                        <a href="edit-categorie.php?update=<?php echo $categorie->id ?>" class="edit" data-toggle="modal">
                        
                        <i type="Edit"  >Edit </i>
                   
                        </a>
                      </td>
				</tr>

				 <?php  
                    if(isset($_GET["delete"]) && $_GET["delete"] != ""){
                        $clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
                        $parameters = new stdClass();
                        $parameters->id = $_GET["delete"];
                        $result = $clientSOAP->__soapCall("deleteCategorieById", array($parameters));
                        $_GET["delete"] = "";
                        $_GET["delete"] = null;
                        header("Location: categorie.php");
                    }

                    elseif (isset($_GET["id"]) && $_GET["id"] != "") {
                    	$clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
                        $parameters = new stdClass();
                        $parameters->id = $_GET["id"];
                        $result = $clientSOAP->__soapCall("getCategorieById", array($parameters));
                        $_GET["id"] = "";
                        $_GET["id"] = null;
                        header("Location: categorie.php");
                    }{

                    }
                    ?>
				</tbody>

				<?php
			}
		}?>
	</table>
</div>
</div>
	<?php
	}
	else
	{
		echo "liste vide";
	}
?>


<div id="AddcategorieModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="categorie.php">
					<div class="modal-header">						
						<h4 class="modal-title">Ajouter categorie</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
					    			
						
						<div class="form-group">
							<label>libelle</label>
							<input type="text" id="libelle" name="libelle" class="form-control" required>
						</div>
						
						
										
					</div>
					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-success" id="btn-add">Ajouter</button>
					</div>
				</form>
			</div>
		</div>
	</div>



	
</body>
</html>