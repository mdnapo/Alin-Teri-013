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
								
				$("#annuleren").click(function(){
					$(".uploadoverlay").fadeOut('fast');
				});
			
				$("#doneren").click(function(){
					$(".uploadoverlay").fadeIn('fast');
				});
				
				$(".donatie").click(function(){
					$("#zoomimage").attr("src", $(this).attr("src"));
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
					$("#leftarrow").fadeTo('fast', 0.8);
					$("#rightarrow").fadeTo('fast', 0.8);
					$("#closesign").fadeTo('fast', 0.8);
				});
				
				$(".imageoverlaycontent").mouseleave(function(e){
					$("#leftarrow").fadeTo('fast', 0);
					$("#rightarrow").fadeTo('fast', 0);
					$("#closesign").fadeTo('fast', 0);
				});
				
				$("#closesign").click(function(){
					$(".uploadoverlay").fadeOut('fast');
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
				margin: auto;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				padding: 10px;
				width: 500px;
				height: 520px;
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
				margin: auto;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				padding: 10px;
				width: 500px;
				height: 500px;
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
				height: 40px;
			}
        </style>
    </head>
    <body>
		<div class="uploadoverlay">
			<div class="uploadoverlaycontent">
				<table>
					<td>
						Upload hier je foto:<br/>
						<input id="annuleren" type="submit" value="Annuleren"/>
					</td>
					<td>
						<form>
							<input type="submit" value="Kies je foto"/>
						</form>
					</td>
				</table>
			</div>
		</div>
		
		<div class="imageoverlay">
			<div class="imageoverlaycontent">
				<img id="zoomimage" src=""/>
				<img id="leftarrow" src="img\images\arrowleft.png"/>
				<img id="rightarrow" src="img\images\arrowright.png"/>
				<img id="closesign" src="img\images\closesign.png"/>
			</div>
		</div>
		
        <div class="container">
			<div class="content">
				<div class="title">Steun ons</div>
				<div class="text">
				Wij van Alin Teri zien graag wie ons steunen. Daarom hebben wij een eigen actie: laat je steun zien met een foto! Hieronder kun je zien wie ons steunen. Wil jij ook je steun laten zien? Stuur ons jou foto in!
				</div>
				@foreach(File::files('img\donaties') as $file)
					<img class='donatie' src='{{{$file}}}'/>
				@endforeach
				<br/>
				<button id="doneren" type="button">Bijdrage tonen</button>
			</div>
        </div>
		
    </body>
</html>
