
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
  
    <div class="container" style="margin-bottom:10%">
      
      <div class="row px-5">
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
			$sql="select * from galerie ";
			$res=$connexion->query($sql);
			$photos=$res->fetchAll(PDO::FETCH_NUM);
			foreach ($photos as $p) {
        ?>
  <div class="col-md-6 p-4"><img class="img-responsive m-3" style="margin-top:10%" src="./img/<?php echo $p[1]; ?>" /></div>
		<?php }; ?>
  </div>
    </div>

</body>
</html>
