<?php $client=new SoapClient('http://localhost:8989/ActuService?wsdl');?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>user Data</title>
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
     if (isset($_POST["email"]) && isset($_POST["prenom"]) ) {
     	

        
            
            $clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
            $parameters =   new stdClass();
            $parameters->nom = $_POST["nom"];
            $parameters->prenom= $_POST["prenom"];
            $parameters->email= $_POST["email"];
            $parameters->role = $_POST["role"];
            $parameters->motdepasse= $_POST["motdepasse"];
            
          
            
            $result = $clientSOAP->__soapCall("AddUser",array($parameters));
            
   
            
            header("Location: user.php");
            }
        
    



	?>

	<h1 align="center">Liste des users</h1>
	<div class="container">
	<p id="success"></p>
	<div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Gerer <b>user</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#AdduserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">+</i> <span>Ajouter nouveau user</span></a>					
					</div>
                </div>
            </div>
	<?php
	$users=$client->__soapCall('getAllusers',array());
	if(!empty($users->return))
	{
	?>
	<table class='table table-borderless table-striped table-earning' border="1" align="center">
		<thead>
		<tr>
			
			<th>ID</th>
			<th>nom</th>
			<th>motdepasse</th>
			<th>prenom</th>
			<th>email</th>
			<th>role</th>
			<th>ACTION</th>
		</tr></thead><?php
		if(!is_array($users->return))
		{
			?>
				<tbody>
			<tr>
				<td><?= $users->return->id ?></td>
				<td><?= $users->return->nom ?></td>
				<td><?= $users->return->motdepasse ?></td>
				<td><?= $users->return->prenom ?></td>
				<td><?= $users->return->email ?></td>
				<td><?= $users->return->role ?></td>
				<td>
                      <a href="user.php?delete=<?php echo $users->return->id ?>"class="delete" data-toggle="modal" ><i type="Delete" > Delete</i>
                      </a>
                      
                        <a href="edit-user.php?update=<?php echo $users->return->id ?>" class="edit" data-toggle="modal">
                          
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
			foreach ($users->return as  $user) {
				?>
				<tbody>
				<tr>
				<td><?= $user->id ?></td>
				<td><?= $user->nom ?></td>
				<td><?= $user->motdepasse ?></td>
				<td><?= $user->prenom ?></td>
				<td><?= $user->email ?></td>
				<td><?= $user->role ?></td>
				<td>
                      <a href="user.php?delete=<?php echo $user->id ?>" class="delete" data-toggle="modal"><i type="Delete" > Delete</i>
                      </a>
                      
                        <a href="edit-user.php?update=<?php echo $user->id ?>" class="edit" data-toggle="modal">
                        
                        <i type="Edit"  >Edit </i>
                   
                        </a>
                      </td>
				</tr>

				 <?php  
                    if(isset($_GET["delete"]) && $_GET["delete"] != ""){
                        $clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
                        $parameters = new stdClass();
                        $parameters->id = $_GET["delete"];
                        $result = $clientSOAP->__soapCall("deleteUserById", array($parameters));
                        $_GET["delete"] = "";
                        $_GET["delete"] = null;
                        header("Location: user.php");
                    }

                    elseif (isset($_GET["id"]) && $_GET["id"] != "") {
                    	$clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
                        $parameters = new stdClass();
                        $parameters->id = $_GET["id"];
                        $result = $clientSOAP->__soapCall("getUserById", array($parameters));
                        $_GET["id"] = "";
                        $_GET["id"] = null;
                        header("Location: user.php");
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


<div id="AdduserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="user.php">
					<div class="modal-header">						
						<h4 class="modal-title">Ajouter user</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
					    <div class="form-group">
							<label>nom</label>
							<input type="text" id="nom" name="nom" class="form-control" required>
						</div>					
						
						<div class="form-group">
							<label>prenom</label>
							<input type="text" id="prenom" name="prenom" class="form-control" required>
						</div>
						<div class="form-group">
							<label>email</label>
							<input type="text" id="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>role</label>
							<input type="text" id="role" name="role" class="form-control" required>
						</div>
						<div class="form-group">
							<label>motdepasse</label>
							<input type="text" id="motdepasse" name="motdepasse" class="form-control" required>
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