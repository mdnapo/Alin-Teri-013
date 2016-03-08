<!DOCTYPE html>
<html>
    <head>
        <title>Donaties</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script>
			
			$(document).ready(function(){
				$(".uploadoverlay").hide();
				$(".imageoverlay").hide();
				$("#leftarrow").fadeTo(0, 0);
				$("#rightarrow").fadeTo(0, 0);
				$("#closesign").fadeTo(0, 0);
				$currentImgId = 0;
				
				$("#annuleren").click(function(){
					$(".uploadoverlay").fadeOut('fast');
				});
			
				$("#doneren").click(function(){
					$(".uploadoverlay").fadeIn('fast');
				});
				
				$(".donatie").click(function(){
					$("#zoomimage").attr("src", $(this).attr("src"));
					$currentImgId = $(this).attr('id');
					$(".imageoverlay").fadeIn('fast');
				});
				
				$(".imageoverlay").click(function(e){
					if(e.target == this){
						$(".imageoverlay").fadeOut('fast');
					}
				});
				
				$(".uploadoverlay").click(function(e){
					if(e.target == this){
						$(".uploadoverlay").fadeOut('fast');
					}
				});
				
				$(".imageoverlaycontent").mouseenter(function(){
					$(".donatieui").fadeTo(100, 0.8);
				});
				
				$(".imageoverlaycontent").mouseleave(function(e){
					$(".donatieui").fadeTo(100, 0);
				});
				
				$("#closesign").click(function(){
					$(".imageoverlay").fadeOut('fast');
				});
				
				$("#leftarrow").click(function(){
					if(parseInt($currentImgId)-1 >= 0){
						$currentImgId--;
						$("#zoomimage").fadeOut(100, function(){
							$("#zoomimage").attr("src", $('#' + $currentImgId).attr("src"));
						}).fadeIn(100);
					}
				});
				
				$("#rightarrow").click(function(){
					if(parseInt($currentImgId)+1 < $('.donaties').children().length){
						$currentImgId++;
						$("#zoomimage").fadeOut(100, function(){
							$("#zoomimage").attr("src", $('#' + $currentImgId).attr("src"));
						}).fadeIn(100);
					}
				});
				
				$(".donatieui").mouseenter(function(){
					$(this).fadeTo(100, 1);
				});
				
				$(".donatieui").mouseleave(function(){
					$(this).fadeTo(100, 0.8);
				});
			});
			
		</script>
		<style>
			
            html, body {
				widht: 100%;
				height: 100%;
				margin: 0;
				padding: 0;
                font-family: 'Arial';
            }

            .container {
                margin: 0px 100px 0px 100px;
				border: 5px solid black;
				border-radius: 10px;
            }

			.content {
				margin: 25px;
            }
				
			.text {
				font-size: 20px;
				margin: 10px 0px 10px 0px;
			}
				
            .title {
                font-size: 60px;
				margin: 10px 0px 10px 0px;
            }
			
			.donatie {
				width: 130px;
				margin: 2px;
				height: 130px;
				border: 5px ridge #9fa1a4;
			}
			
			.uploadoverlay {
				position: fixed;
				width: 100%;
				height: 100%;
				background-color: rgba(128, 128, 128, 0.6);
			}
			
			.uploadoverlaycontent {
				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%, -50%);
				padding: 10px;
				background-color: white;
				border-radius: 3px;
			}

			.imageoverlay {
				position: fixed;
				width: 100%;
				height: 100%;
				background-color: rgba(128, 128, 128, 0.6);
			}
			
			.imageoverlaycontent {
				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%, -50%);
				padding: 10px;
				background-color: white;
				border-radius: 3px;
			}
			
			#zoomimage{
				position: relative;
				width: 500px;
				height: 500px;
			}
			
			#leftarrow{
				position: absolute;
				top: 0;
				left: 0;
				bottom: 0;
				right: 0;
				margin: auto auto auto 25px;
				height: 100px;
			}
			
			#rightarrow{
				position: absolute;
				top: 0;
				left: 0;
				bottom: 0;
				right: 0;
				margin: auto 25px auto auto;
				height: 100px;
			}
			
			#closesign{
				position: absolute;
				top: 0;
				left: 0;
				bottom: 0;
				right: 0;
				margin: 25px 25px auto auto;
				height: 30px;
			}
        </style>
    </head>
    <body>
		<?php
		function cropImage($imagePath, $startX, $startY, $width, $height, $id) {
			$file_parts = pathinfo($imagePath);
			$img;
			switch($file_parts['extension'])
			{
				case "png": $img = imagecreatefrompng($imagePath);
				break;
			}
			try{
				$croppedImg = imagecrop($img, array('x' => $startX, 'y' => $startY, 'width' => $width, 'height' => $height));
				imagepng($croppedImg, $id . '.png', 9);
			} catch(Exception $e){
			
			}
		}
		?>
		<div class="uploadoverlay">
			<div class="uploadoverlaycontent">
				<table>
					<form method="POST" enctype="multipart/form-data">
						<tr>
							<td><b>Foto*:</b></td>
							<td><input type="file" name="image" value="Kies je foto" required/></td>
						</tr>
						<tr>
							<td><b>E-mailadres (optioneel):</b></td>
							<td><input type="email" name="email"></td>
						</tr>
						<tr>
							<td><b>Bericht (optioneel):</b></td>
							<td><textarea name="opmerking"></textarea></td>
						<tr>
						<tr>
							<td>*verplicht veld</td>
							<td><button type="submit">Versturen</button></td>
						</tr>
					</form>
				</table>
			</div>
		</div>
		
		<div class="imageoverlay">
			<div class="imageoverlaycontent">
				<img id="zoomimage" src=""/>
				<img class="donatieui" id="leftarrow" src="img\images\arrowleft.png"/>
				<img class="donatieui" id="rightarrow" src="img\images\arrowright.png"/>
				<img class="donatieui" id="closesign" src="img\images\closesign.png"/>
			</div>
		</div>
		
        <div class="container">
			<div class="content">
				<div class="title">Steun ons</div>
				<div class="text">
				Wij van Alin Teri zien graag wie ons steunen. Daarom hebben wij een eigen actie: laat je steun zien met een foto! Hieronder kun je zien wie ons steunen. Wil jij ook je steun laten zien? Stuur ons jou foto in!
				</div>
				<div class="donaties">
				@for($i = 0; $i < count($donations); $i++)
					<img class='donatie' id="{{$i}}" src='{{$donations[$i]}}'/>
				@endfor
				</div>
				<br/>
				<button id="doneren" type="button">Bijdrage tonen</button>
			</div>
        </div>
		
    </body>
</html>
