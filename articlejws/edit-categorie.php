<?php $client=new SoapClient('http://localhost:8989/ActuService?wsdl');?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>categorie Edit</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</head>
<body>
<?php
     if ( isset($_POST["libelle"]) ) {
     	if(isset($_GET["update"]) && $_GET["update"] != ""){
            $clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
            $parameters =  array();
            
            $parameters["id"] = $_GET["update"];

            
            $parameters["libelle"]= $_POST["libelle"];
           
            
            $result = $clientSOAP->__soapCall("UpdateCategorie",array($parameters));
            $_GET["update"] = "";
            header("Location: categorie.php");
        }
    }

        ?>
<div>
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="edit-categorie.php?update=<?php echo  $_GET["update"] ?>">
					<div class="modal-header">						
						<h4 class="modal-title">Edit categorie</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
								
						
						
						<div class="form-group">
							<label>libelle</label>
							<input type="text" id="libelle" name="libelle" class="form-control" required>
						</div>
						
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>