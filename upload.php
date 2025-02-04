<head>
	<style>
		body
		{
			background-color: black;
		}

		a
		{
			background-color: black; 
			color: chocolate;
			font-size: 18pt
		}

		p
		{
			background-color: black;
			color: white;
			font-size: 18pt;
		}
	</style>
</head>

<body>
	<?php
	// time to upload our files
	if(isset($_FILES['uploadFiles']['name']))
	{
		$totalFiles = count($_FILES['uploadFiles']['name']);
		$allowedExtensions = array(".png", ".jpg", "jpeg", ".zip");
		$start = 0;

		while($start < $totalFiles)
		{
			$tmp = $_FILES['uploadFiles']['tmp_name'][$start];
			$eachFileSize = $_FILES['uploadFiles']['size'][$start];
			$eachFileName = $_FILES['uploadFiles']['name'][$start];

			// you can check the size of each file
			if($eachFileSize > 20000000000 )
			{
				// if there is a file greater than 2gbs, then return
				echo $eachFileName." is greater than 2gbs. The upload proceess has been terminated";
				exit(); // kill the loop
			 }

			$eachFileExtension = strtolower(substr($eachFileName, strlen($eachFileName)-4, strlen($eachFileName)));

			// check for illigal file extensions
			if(in_array($eachFileExtension, $allowedExtensions))
			{
				// copy files from temp dir to visible dir on system
				$location = "uploads/".$eachFileName;
				move_uploaded_file($tmp, $location);
			}

			else
			{
				// terminate the loop
				echo $eachFileName." Contais illigal extension, the upload process has been terminated!";
				exit();
			}

			echo $eachFileName." has been uploaded to ".$location."<br />";
			$start ++;
		}
	}
	// Hugin Stitching
	shell_exec('cp ./uploads/* .');
	shell_exec('pto_gen -o project.pto *.jpg');
	shell_exec('cpfind --prealigned -o project.pto project.pto');
	shell_exec('autooptimiser -a -l -s -m -o project.pto project.pto');
	shell_exec('pano_modify -o project.pto --center --straighten --canvas=AUTO --crop=AUTO project.pto');
	shell_exec('hugin_executor --stitching --prefix=pano project.pto');
	shell_exec('sudo chmod 777 pano.tif');
	unlink('img1.jpg');
	unlink('img2.jpg');
	unlink('img3.jpg');
	unlink('img4.jpg');
	unlink('uploads/img1.jpg');
	unlink('uploads/img2.jpg');
	unlink('uploads/img3.jpg');
	unlink('uploads/img4.jpg');
	unlink('project.pto');
	?>
	<p>Image Rendering Complete!</p>
	<a href='pano.tif' download='pano.tif'>Donload Image</a>
</body>
