<?php $client=new SoapClient('http://localhost:8989/ActuService?wsdl');?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Article Data</title>
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
     if (isset($_POST["datecreation"]) && isset($_POST["contenu"]) ) {
     	

        
            
            $clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
            $parameters =  array();
            $parameters["categorie"] = $_POST["categorie"];
            $parameters["contenu"]= $_POST["contenu"];
            $parameters["datecreation"] = $_POST["datecreation"];
            $parameters["datemodification"] = $_POST["datemodification"];
            $parameters["titre"] = $_POST["titre"];
          
            
            $result = $clientSOAP->__soapCall("AddArticle",array($parameters));
            
   
            
            header("Location: article.php");
            }
        
    



	?>

	<h1 align="center">Liste des articles</h1>
	<div class="container">
	<p id="success"></p>
	<div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Gerer <b>Article</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#AddArticleModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">+</i> <span>Ajouter nouveau Article</span></a>					
					</div>
                </div>
            </div>
	<?php
	$articles=$client->__soapCall('getAllArticles',array());
	if(!empty($articles->return))
	{
	?>
	<table class='table table-borderless table-striped table-earning' border="1" align="center">
		<thead>
		<tr>
			
			<th>ID</th>
			<th>Categorie</th>
			<th>Titre</th>
			<th>Contenu</th>
			<th>Datecreation</th>
			<th>Datemodification</th>
			<th>ACTION</th>
		</tr></thead><?php
		if(!is_array($articles->return))
		{
			?>
				<tbody>
			<tr>
				<td><?= $articles->return->id ?></td>
				<td><?= $articles->return->categorie ?></td>
				<td><?= $articles->return->titre ?></td>
				<td><?= $articles->return->contenu ?></td>
				<td><?= $articles->return->datecreation ?></td>
				<td><?= $articles->return->datemodification ?></td>
				<td>
                      <a href="article.php?delete=<?php echo $articles->return->id ?>"class="delete" data-toggle="modal" ><i type="Delete" > Delete</i>
                      </a>
                      
                        <a href="edit-article.php?update=<?php echo $articles->return->id ?>" class="edit" data-toggle="modal">
                          
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
			foreach ($articles->return as  $article) {
				?>
				<tbody>
				<tr>
				<td><?= $article->id ?></td>
				<td><?= $article->categorie ?></td>
				<td><?= $article->titre ?></td>
				<td><?= $article->contenu ?></td>
				<td><?= $article->datecreation ?></td>
				<td><?= $article->datemodification ?></td>
				<td>
                      <a href="article.php?delete=<?php echo $article->id ?>" class="delete" data-toggle="modal"><i type="Delete" > Delete</i>
                      </a>
                      
                        <a href="edit-article.php?update=<?php echo $article->id ?>" class="edit" data-toggle="modal">
                        
                        <i type="Edit"  >Edit </i>
                   
                        </a>
                      </td>
				</tr>

				 <?php  
                    if(isset($_GET["delete"]) && $_GET["delete"] != ""){
                        $clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
                        $parameters = new stdClass();
                        $parameters->id = $_GET["delete"];
                        $result = $clientSOAP->__soapCall("deleteArticleById", array($parameters));
                        $_GET["delete"] = "";
                        $_GET["delete"] = null;
                        header("Location: article.php");
                    }

                    elseif (isset($_GET["id"]) && $_GET["id"] != "") {
                    	$clientSOAP = new SoapClient("http://localhost:8989/ActuService?wsdl");
                        $parameters = new stdClass();
                        $parameters->id = $_GET["id"];
                        $result = $clientSOAP->__soapCall("getArticleById", array($parameters));
                        $_GET["id"] = "";
                        $_GET["id"] = null;
                        header("Location: article.php");
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


<div id="AddArticleModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="article.php">
					<div class="modal-header">						
						<h4 class="modal-title">Ajouter Article</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
					    <div class="form-group">
							<label>categorie</label>
							<input type="number" id="categorie" name="categorie" class="form-control" required>
						</div>					
						
						<div class="form-group">
							<label>contenu</label>
							<input type="text" id="contenu" name="contenu" class="form-control" required>
						</div>
						<div class="form-group">
							<label>datecreation</label>
							<input type="date" id="datecreation" name="datecreation" class="form-control" required>
						</div>
						<div class="form-group">
							<label>datemodification</label>
							<input type="date" id="datemodification" name="datemodification" class="form-control" required>
						</div>
						<div class="form-group">
							<label>titre</label>
							<input type="text" id="titre" name="titre" class="form-control" required>
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