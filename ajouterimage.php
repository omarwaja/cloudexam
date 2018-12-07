<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Espace administrateur</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/crude.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>


<body>
<?php
 if(isset($_GET['supp'])){if($_GET['supp']==1){echo "<div class='alert alert-success alert-dismissible'>
   <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
   <strong>Success!</strong> La suppression a été faite avec succés !
 </div>";} else  {echo "<div class='alert alert-danger alert-dismissible'>
   <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
   <strong>Echec!</strong> Suppression echouée !
 </div>";}}

 if(isset($_GET['ajout'])){if($_GET['ajout']==1){echo "<div class='alert alert-success alert-dismissible'>
   <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
   <strong>Success!</strong> L'ajout' a été fait avec succés !
 </div>";} else  {echo "<div class='alert alert-danger alert-dismissible'>
   <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
   <strong>Echec!</strong> Ajout echoué !
 </div>";}}


 if(isset($_GET['update'])){if($_GET['update']==1){echo "<div class='alert alert-success alert-dismissible'>
   <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
   <strong>Success!</strong> La modification a été faite avec succés !
 </div>";} else  {echo "<div class='alert alert-danger alert-dismissible'>
   <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
   <strong>Echec!</strong> Modification echoué !
 </div>";}}
  ?>
<div class="container">
	<div class="row">
		<form action="" method="POST" enctype="multipart/form-data" class="col-sm-4" style="margin-left:30%" >
		<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
			<div class="form-group" style="padding:10px">
			<h4 class="text-center">Ajouter une nouvelle Image</h4>
			<input type="file" class="form-control" name="img" required/>
			<div class="modal-footer">
				<input type="submit" class="btn btn-success" name="submit" style="margin-right:32%;padding-left:30px;padding-right:30px;" value="Ajouter"/>
			</div>
		    </div>
		</form>
	</div>
</div>
<?php
	try
	{
		$db='mysql:host=localhost;dbname=cloud';
		$user='root';
		$mp='';
		$connexion=new PDO($db,$user,$mp);
		$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	}
	catch (Exception $Obj)
	{
		echo " connexion impossible".$Obj->getMessage();
	}
    if(isset($_POST['submit'])){ 
			$nomimg = $_FILES['img']['name'] ;
			$nomimg = str_replace(' ', '', $nomimg);
			$nomimg = str_replace('é', 'e', $nomimg);
			$nomimg = str_replace('è', 'e', $nomimg);
			$nomimg = str_replace('à', 'a', $nomimg);
			$nomimg = str_replace(' ', '', $nomimg);
			$nomimg = str_replace('-', '_', $nomimg);
			$nomimg = str_replace('/', '_', $nomimg);
			$nomimg = str_replace('@', '_', $nomimg);
			$sql=$connexion->prepare("INSERT INTO `galerie` (`img`) VALUES (:a)");
			$sql->bindParam('a', $nomimg);
			$res=$sql->execute();
			$dirpath = realpath(dirname(getcwd()));
			$doc=$dirpath."/cloud-preparing/img/".$nomimg;
			$resultat = move_uploaded_file($_FILES['img']['tmp_name'],$doc);			
			if ($res){ echo "Transfert réussi";
				header('location:./ajouterimage.php?ajout=1'); }
			else header('location:./ajouterimage.php?ajout=2');
	}
?>
</body>