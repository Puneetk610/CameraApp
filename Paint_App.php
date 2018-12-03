// Code By PuneetK
<?php
const DB_HOST = '';
const DB_USER = '';
const DB_PASS = '';
const DB_NAME = '';
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$data ="";
$class = $_POST["id"];
$sql = "SELECT `filename` FROM `uploads` WHERE id=".$class;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       // echo "id: " . $row["filename"]. "<br>";
        $data = $row["filename"];
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>


<html>
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.fa {
  padding: 10px;
  font-size: 20px;
  width: 20px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 50%;
}

.fa:hover {
    opacity: 0.7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}

.fa-twitter {
  background: #55ACEE;
  color: white;
}

.fa-google {
  background: #dd4b39;
  color: white;
}
</style>        
        
<style type="text/css">
 .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 12px;
    cursor: pointer;
}
body {
	margin: 0px;
	padding: 0px;
	border: 0;
	overflow: hidden;
	font-family: Arial, sans-serif;
}

#canvas {
	position: absolute;
	top: 0px;
	left: 0px;
	border: 0;
	margin: 0;
	padding: 0;
}

#controls {
	position: absolute;
	display: block;
	top: 0px;
	left: 0px;
	height: 100%;
	width: 220px;
	border: 0;
	margin: 0;
	padding: 0;
	background-color: #333;
	opacity: 0.75;
	border-right: 2px solid #333;
}

.hidden {
	display: none !important;
}

#controls label {
	display: block;
	width: inherit;
	margin: 5px 5px 0 5px;
	font-size: 1.4rem;
	text-transform: uppercase;
	font-weight: bold;
	color: white;
}

#controls input,#controls select {
	width: 200px;
	border: 5px solid #FFF;
	margin: 5px;
	font-size: 1rem;
}

.control-group {
	border-bottom: 1px solid #333;
}

#color-buttons,#line-widths {
	background-color: #CCC;
	height: 150px;
	width: inherit;
	overflow-y: scroll;
}

#color-buttons a {
	width: 30px;
	height: 30px;
	margin: 5px;
	display: inline-block;
	border: 5px solid #FFF;
}

#line-widths a {
	width: 180px;
	height: 30px;
	margin: 5px;
	display: inline-block;
	border: 5px solid #FFF;
}
#line-widths span {
	display:block;
	position: relative; 
	top: 50%; 
	width:100%; 
	background-color:black;
}
#clear-canvas {
	display: block;
	border: 5px solid #FFF;
	margin: 5px;
	padding: 3px;
	text-align: center;
	color: white;
}

#controls-opener {
	position: absolute;
	display: block;
	top: 0px;
	left: 0px;
	height: 30px;
	width: 30px;
	border: 0;
	margin: 0;
	padding: 0;
	background-color: #333;
	opacity: 0.75;
}
</style>
</head>
<!--<body onresize="drawingArea.onScreenSizeChanged()">-->
  <body>
    <input type="hidden" id="imgdata" value='<?php echo $data ?>'>
<!--
    <div id="fontSelectDiv" style="display:block;">
         Font: <select id="fontSelect">
                  <option value="Arial">Arial</option>
                  <option value="Comic Sans" selected="">Comic Sans</option>
                  <option value="Lucida Sans">Lucida Sans</option>
                  <option value="Helvetica">Helvetica</option>
                  <option value="Palatino">Palatino</option>
               </select>

         Size: <select id="sizeSelect">
                  <option value="32">32 px</option>
                  <option value="48" selected="">48 px</option>
                  <option value="64">64 px</option>
                  <option value="128">128 px</option>
               </select>

          Text stroke color: <select id="strokeStyleSelect">
                  <option value="red">red</option>
                  <option value="green">green</option>
                  <option value="blue">blue</option>
                  <option value="orange">orange</option>
                  <option value="cornflowerblue">cornflowerblue</option>
                  <option value="goldenrod">goldenrod</option>
                  <option value="navy" selected="">navy</option>
                  <option value="purple">purple</option>
               </select>

       Text fill color: <select id="fillStyleSelect">
                        <option value="rgba(255,0,0,0.5)">semi-transparent red</option>
                        <option value="green">green</option>
                        <option value="rgba(0,0,255,0.5)" selected="">semi-transparent blue</option>
                        <option value="orange">orange</option>
                        <option value="rgba(100,140,230,0.5)">semi-transparent cornflowerblue</option>
                        <option value="rgba(218,165,32,0.5)">semi-transparent goldenrod</option>
                        <option value="navy">navy</option>
                        <option value="purple">purple</option>
                     </select>
      </div>
-->
	<canvas id="canvas" width="708" height="480" style="margin-left:30px; margin-top:30px;"><span style="margin:50px 50px">Your browser does not support the HTML5 "canvas" tag.</span></canvas>
	<div id="controls" class="">
		<!--div class="control-group"-->
		<label for="color-input"> Color</label>
		<!--input id="color-input" class="input" type="color" value="#000000"></input-->
		<input id="color-input" class="input" type="hidden" value="#000000">
		<!--/div-->
		<div id="color-buttons" class="control-group"></div>
		<label for="brush-size"> Brush Size</label>
		<div id="line-widths" class="control-group"></div>
		<div class="control-group">
			<!--input id="brush-size" class="input" type="number" min="1" value="1"></input-->
			<input id="brush-size" class="input" type="hidden">
		</div>
		<div class="control-group">
			<a id="clear-canvas">Clear Canvas</a>
		</div>
        <div class="control-group">
            <a id="save" class="button" style="margin-left:60px;" >Save Image</a>
        </div>
        <div class="control-group">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-google"></a>
        </div>
	</div>
	<div id="controls-opener" style="left: 221.997px;">
		<svg width="30px" height="30px">
			<g id="open-controls-button">				
				<line x1="6" y1="6" x2="24" y2="6" style="stroke-width: 3; stroke: white;"></line>
				<line x1="6" y1="12" x2="24" y2="12" style="stroke-width: 3; stroke: white;"></line>
				<line x1="6" y1="18" x2="24" y2="18" style="stroke-width: 3; stroke: white;"></line>
				<line x1="6" y1="24" x2="24" y2="24" style="stroke-width: 3; stroke: white;"></line>
			</g>
		</svg>
	</div>
	<script type="text/javascript">
	    if (typeof addEventListener !== 'undefined')
		addEventListener("DOMContentLoaded", function(e) {
			if (isCanvasSupported()) {
				drawingArea = new DrawingArea('canvas');
				controls = new Controls(drawingArea);
                console.log("262");
			} else {
				document.getElementById('controls-opener').setAttribute(
						'class', 'hidden')
                console.log("267");
			}
		});
		var DrawingArea = function(elementId) {

			var _self = this;

			this.canvas = document.getElementById(elementId);
			this.context = this.canvas.getContext("2d");
			this.penDown = false;
			this.lineStarted = false;
			this.touchMode = navigator.userAgent.match(/Android/i) != null;

			this.downEvent = this.touchMode ? 'touchstart' : 'mousedown';
			this.moveEvent = this.touchMode ? 'touchmove' : 'mousemove';
			this.upEvent = this.touchMode ? 'touchend' : 'mouseup';

			this.getMousePos = function(e) {
				var rect = canvas.getBoundingClientRect();
				return {
					x : e.clientX - rect.left,
					y : e.clientY - rect.top
				};
			}

			this.getTouchPos = function(e) {
				var rect = this.canvas.getBoundingClientRect();
				var touch = e.targetTouches[0];
				return {
					x : touch.pageX - rect.left,
					y : touch.pageY - rect.top
				};
			}

			this.onDownEvent = function(e) {
				e.preventDefault();
				this.penDown = true;
			}
			this.canvas.addEventListener(this.downEvent, this.onDownEvent
					.bind(this), false);

			this.onMoveEvent = function(e) {
				e.preventDefault();
				if (!this.penDown)
					return;
				var pos = this.touchMode ? this.getTouchPos(e) : this
						.getMousePos(e);

				if (!this.lineStarted) {
					this.context.beginPath();
					this.context.moveTo(pos.x, pos.y);
					this.lineStarted = true;
				} else {
					this.context.lineTo(pos.x, pos.y);
					this.context.stroke();
				}
			}
			this.canvas.addEventListener(this.moveEvent, this.onMoveEvent
					.bind(this), false);

			this.onUpEvent = function(e) {
				e.preventDefault();
				this.penDown = false;
				this.lineStarted = false;
			}
			this.canvas.addEventListener(this.upEvent, this.onUpEvent
					.bind(this), false);

			this.onScreenSizeChanged = function(forceResize) {
				if (forceResize || (this.canvas.width != window.innerWidth /*|| 
				            this.canvas.height != window.innerHeight*/)) {

					var image = this.context.getImageData(0, 0,
							this.canvas.width, this.canvas.height);

					this.canvas.width = (window.innerWidth - 50);
					this.canvas.height = (window.innerHeight - 50);

					this.context.putImageData(image, 0, 0);
                    
					//this.context.font = "bold 16px Arial";
					//this.context.fillText("www.neilson.co.za", this.canvas.width - 160, this.canvas.height - 20);                

					if (typeof this.controls != 'undefined') {
						try {
							//this.controls.reset();
							this.context.strokeStyle = this.controls.colorInput.value;
							this.context.lineWidth = this.controls.brushSizeSelector.value;
						} catch (e) {
						}
					}
				}
			}
			this.onScreenSizeChanged(true);
            console.log("313");
		}

		var Controls = function(drawingArea) {
            console.log("365");
			var _self = this;
			this.drawingArea = drawingArea;
			this.element = document.getElementById('controls');
			this.touchMode = this.drawingArea.touchMode;

			this.controlsOpener = document.getElementById('controls-opener');
			this.onControlsOpenerClicked = function(e) {
				e.preventDefault();
				this.toggleControlsTray();
			}
			this.controlsOpener.addEventListener(this.drawingArea.upEvent,
					this.onControlsOpenerClicked.bind(this), false);

			this.colorInput = document.getElementById('color-input');
			this.colorInput.value = this.drawingArea.context.strokeStyle;
			         this.onColorInputChanged = function () {
			             this.drawingArea.context.strokeStyle = this.colorInput.value;
			         }
			         this.colorInput.addEventListener("change", this.onColorInputChanged.bind(this));

			var colors = [ {
				name : "Black",
				color : "#000000"
			}, {
				name : "Gunmetal",
				color : "#2C3539"
			}, {
				name : "Midnight",
				color : "#2B1B17"
			}, {
				name : "Charcoal",
				color : "#34282C"
			}, {
				name : "Dark Slate Gray",
				color : "#25383C"
			}, {
				name : "Oil",
				color : "#3B3131"
			}, {
				name : "Black Cat",
				color : "#413839"
			}, {
				name : "Black Eel",
				color : "#463E3F"
			}, {
				name : "Black Cow",
				color : "#4C4646"
			}, {
				name : "Gray Wolf",
				color : "#504A4B"
			}, {
				name : "Vampire Gray",
				color : "#565051"
			}, {
				name : "Gray Dolphin",
				color : "#5C5858"
			}, {
				name : "Carbon Gray",
				color : "#625D5D"
			}, {
				name : "Ash Gray",
				color : "#666362"
			}, {
				name : "Cloudy Gray",
				color : "#6D6968"
			}, {
				name : "Smokey Gray",
				color : "#726E6D"
			}, {
				name : "Gray",
				color : "#736F6E"
			}, {
				name : "Granite",
				color : "#837E7C"
			}, {
				name : "Battleship Gray",
				color : "#848482"
			}, {
				name : "Gray Cloud",
				color : "#B6B6B4"
			}, {
				name : "Gray Goose",
				color : "#D1D0CE"
			}, {
				name : "Platinum",
				color : "#E5E4E2"
			}, {
				name : "Metallic Silver",
				color : "#BCC6CC"
			}, {
				name : "Blue Gray",
				color : "#98AFC7"
			}, {
				name : "Light Slate Gray",
				color : "#6D7B8D"
			}, {
				name : "Slate Gray",
				color : "#657383"
			}, {
				name : "Jet Gray",
				color : "#616D7E"
			}, {
				name : "Mist Blue",
				color : "#646D7E"
			}, {
				name : "Marble Blue",
				color : "#566D7E"
			}, {
				name : "Slate Blue",
				color : "#737CA1"
			}, {
				name : "Steel Blue",
				color : "#4863A0"
			}, {
				name : "Blue Jay",
				color : "#2B547E"
			}, {
				name : "Dark Slate Blue",
				color : "#2B3856"
			}, {
				name : "Midnight Blue",
				color : "#151B54"
			}, {
				name : "Navy Blue",
				color : "#000080"
			}, {
				name : "Blue Whale",
				color : "#342D7E"
			}, {
				name : "Lapis Blue",
				color : "#15317E"
			}, {
				name : "Cornflower Blue",
				color : "#151B8D"
			}, {
				name : "Earth Blue",
				color : "#0000A0"
			}, {
				name : "Cobalt Blue",
				color : "#0020C2"
			}, {
				name : "Blueberry Blue",
				color : "#0041C2"
			}, {
				name : "Sapphire Blue",
				color : "#2554C7"
			}, {
				name : "Blue Eyes",
				color : "#1569C7"
			}, {
				name : "Royal Blue",
				color : "#2B60DE"
			}, {
				name : "Blue Orchid",
				color : "#1F45FC"
			}, {
				name : "Blue Lotus",
				color : "#6960EC"
			}, {
				name : "Light Slate Blue",
				color : "#736AFF"
			}, {
				name : "Slate Blue",
				color : "#357EC7"
			}, {
				name : "Silk Blue",
				color : "#488AC7"
			}, {
				name : "Blue Ivy",
				color : "#3090C7"
			}, {
				name : "Blue Koi",
				color : "#659EC7"
			}, {
				name : "Columbia Blue",
				color : "#87AFC7"
			}, {
				name : "Baby Blue",
				color : "#95B9C7"
			}, {
				name : "Light Steel Blue",
				color : "#728FCE"
			}, {
				name : "Ocean Blue",
				color : "#2B65EC"
			}, {
				name : "Blue Ribbon",
				color : "#306EFF"
			}, {
				name : "Blue Dress",
				color : "#157DEC"
			}, {
				name : "Dodger Blue",
				color : "#1589FF"
			}, {
				name : "Cornflower Blue",
				color : "#6495ED"
			}, {
				name : "Sky Blue",
				color : "#6698FF"
			}, {
				name : "Butterfly Blue",
				color : "#38ACEC"
			}, {
				name : "Iceberg",
				color : "#56A5EC"
			}, {
				name : "Crystal Blue",
				color : "#5CB3FF"
			}, {
				name : "Deep Sky Blue",
				color : "#3BB9FF"
			}, {
				name : "Denim Blue",
				color : "#79BAEC"
			}, {
				name : "Light Sky Blue",
				color : "#82CAFA"
			}, {
				name : "Sky Blue",
				color : "#82CAFF"
			}, {
				name : "Jeans Blue",
				color : "#A0CFEC"
			}, {
				name : "Blue Angel",
				color : "#B7CEEC"
			}, {
				name : "Pastel Blue",
				color : "#B4CFEC"
			}, {
				name : "Sea Blue",
				color : "#C2DFFF"
			}, {
				name : "Powder Blue",
				color : "#C6DEFF"
			}, {
				name : "Coral Blue",
				color : "#AFDCEC"
			}, {
				name : "Light Blue",
				color : "#ADDFFF"
			}, {
				name : "Robin Egg Blue",
				color : "#BDEDFF"
			}, {
				name : "Pale Blue Lily",
				color : "#CFECEC"
			}, {
				name : "Light Cyan",
				color : "#E0FFFF"
			}, {
				name : "Water",
				color : "#EBF4FA"
			}, {
				name : "AliceBlue",
				color : "#F0F8FF"
			}, {
				name : "Azure",
				color : "#F0FFFF"
			}, {
				name : "Light Slate",
				color : "#CCFFFF"
			}, {
				name : "Light Aquamarine",
				color : "#93FFE8"
			}, {
				name : "Electric Blue",
				color : "#9AFEFF"
			}, {
				name : "Aquamarine",
				color : "#7FFFD4"
			}, {
				name : "Cyan or Aqua",
				color : "#00FFFF"
			}, {
				name : "Tron Blue",
				color : "#7DFDFE"
			}, {
				name : "Blue Zircon",
				color : "#57FEFF"
			}, {
				name : "Blue Lagoon",
				color : "#8EEBEC"
			}, {
				name : "Celeste",
				color : "#50EBEC"
			}, {
				name : "Blue Diamond",
				color : "#4EE2EC"
			}, {
				name : "Tiffany Blue",
				color : "#81D8D0"
			}, {
				name : "Cyan Opaque",
				color : "#92C7C7"
			}, {
				name : "Blue Hosta",
				color : "#77BFC7"
			}, {
				name : "Northern Lights Blue",
				color : "#78C7C7"
			}, {
				name : "Medium Turquoise",
				color : "#48CCCD"
			}, {
				name : "Turquoise",
				color : "#43C6DB"
			}, {
				name : "Jellyfish",
				color : "#46C7C7"
			}, {
				name : "Mascaw Blue Green",
				color : "#43BFC7"
			}, {
				name : "Light Sea Green",
				color : "#3EA99F"
			}, {
				name : "Dark Turquoise",
				color : "#3B9C9C"
			}, {
				name : "Sea Turtle Green",
				color : "#438D80"
			}, {
				name : "Medium Aquamarine",
				color : "#348781"
			}, {
				name : "Greenish Blue",
				color : "#307D7E"
			}, {
				name : "Grayish Turquoise",
				color : "#5E7D7E"
			}, {
				name : "Beetle Green",
				color : "#4C787E"
			}, {
				name : "Teal",
				color : "#008080"
			}, {
				name : "Sea Green",
				color : "#4E8975"
			}, {
				name : "Camouflage Green",
				color : "#78866B"
			}, {
				name : "Hazel Green",
				color : "#617C58"
			}, {
				name : "Venom Green",
				color : "#728C00"
			}, {
				name : "Fern Green",
				color : "#667C26"
			}, {
				name : "Dark Forrest Green",
				color : "#254117"
			}, {
				name : "Medium Sea Green",
				color : "#306754"
			}, {
				name : "Medium Forest Green",
				color : "#347235"
			}, {
				name : "Seaweed Green",
				color : "#437C17"
			}, {
				name : "Pine Green",
				color : "#387C44"
			}, {
				name : "Jungle Green",
				color : "#347C2C"
			}, {
				name : "Shamrock Green",
				color : "#347C17"
			}, {
				name : "Medium Spring Green",
				color : "#348017"
			}, {
				name : "Forest Green",
				color : "#4E9258"
			}, {
				name : "Green Onion",
				color : "#6AA121"
			}, {
				name : "Spring Green",
				color : "#4AA02C"
			}, {
				name : "Lime Green",
				color : "#41A317"
			}, {
				name : "Clover Green",
				color : "#3EA055"
			}, {
				name : "Green Snake",
				color : "#6CBB3C"
			}, {
				name : "Alien Green",
				color : "#6CC417"
			}, {
				name : "Green Apple",
				color : "#4CC417"
			}, {
				name : "Yellow Green",
				color : "#52D017"
			}, {
				name : "Kelly Green",
				color : "#4CC552"
			}, {
				name : "Zombie Green",
				color : "#54C571"
			}, {
				name : "Frog Green",
				color : "#99C68E"
			}, {
				name : "Green Peas",
				color : "#89C35C"
			}, {
				name : "Dollar Bill Green",
				color : "#85BB65"
			}, {
				name : "Dark Sea Green",
				color : "#8BB381"
			}, {
				name : "Iguana Green",
				color : "#9CB071"
			}, {
				name : "Avocado Green",
				color : "#B2C248"
			}, {
				name : "Pistachio Green",
				color : "#9DC209"
			}, {
				name : "Salad Green",
				color : "#A1C935"
			}, {
				name : "Hummingbird Green",
				color : "#7FE817"
			}, {
				name : "Nebula Green",
				color : "#59E817"
			}, {
				name : "Stoplight Go Green",
				color : "#57E964"
			}, {
				name : "Algae Green",
				color : "#64E986"
			}, {
				name : "Jade",
				color : "#5EFB6E"
			}, {
				name : "Green",
				color : "#00FF00"
			}, {
				name : "Emerald Green",
				color : "#5FFB17"
			}, {
				name : "Lawn Green",
				color : "#87F717"
			}, {
				name : "Chartreuse",
				color : "#8AFB17"
			}, {
				name : "Dragon Green",
				color : "#6AFB92"
			}, {
				name : "Mint Green",
				color : "#98FF98"
			}, {
				name : "Green Thumb",
				color : "#B5EAAA"
			}, {
				name : "Light Jade",
				color : "#C3FDB8"
			}, {
				name : "Tea Green",
				color : "#CCFB5D"
			}, {
				name : "Green Yellow",
				color : "#B1FB17"
			}, {
				name : "Slime Green",
				color : "#BCE954"
			}, {
				name : "Goldenrod",
				color : "#EDDA74"
			}, {
				name : "Harvest Gold",
				color : "#EDE275"
			}, {
				name : "Sun Yellow",
				color : "#FFE87C"
			}, {
				name : "Yellow",
				color : "#FFFF00"
			}, {
				name : "Corn Yellow",
				color : "#FFF380"
			}, {
				name : "Parchment",
				color : "#FFFFC2"
			}, {
				name : "Cream",
				color : "#FFFFCC"
			}, {
				name : "Lemon Chiffon",
				color : "#FFF8C6"
			}, {
				name : "Cornsilk",
				color : "#FFF8DC"
			}, {
				name : "Beige",
				color : "#F5F5DC"
			}, {
				name : "AntiqueWhite",
				color : "#FAEBD7"
			}, {
				name : "BlanchedAlmond",
				color : "#FFEBCD"
			}, {
				name : "Vanilla",
				color : "#F3E5AB"
			}, {
				name : "Tan Brown",
				color : "#ECE5B6"
			}, {
				name : "Peach",
				color : "#FFE5B4"
			}, {
				name : "Mustard",
				color : "#FFDB58"
			}, {
				name : "Rubber Ducky Yellow",
				color : "#FFD801"
			}, {
				name : "Bright Gold",
				color : "#FDD017"
			}, {
				name : "Golden",
				color : "#EAC117"
			}, {
				name : "Macaroni and Cheese",
				color : "#F2BB66"
			}, {
				name : "Saffron",
				color : "#FBB917"
			}, {
				name : "Beer",
				color : "#FBB117"
			}, {
				name : "Cantaloupe",
				color : "#FFA62F"
			}, {
				name : "Bee Yellow",
				color : "#E9AB17"
			}, {
				name : "Brown Sugar",
				color : "#E2A76F"
			}, {
				name : "BurlyWood",
				color : "#DEB887"
			}, {
				name : "Deep Peach",
				color : "#FFCBA4"
			}, {
				name : "Ginger Brown",
				color : "#C9BE62"
			}, {
				name : "School Bus Yellow",
				color : "#E8A317"
			}, {
				name : "Sandy Brown",
				color : "#EE9A4D"
			}, {
				name : "Fall Leaf Brown",
				color : "#C8B560"
			}, {
				name : "Gold",
				color : "#D4A017"
			}, {
				name : "Sand",
				color : "#C2B280"
			}, {
				name : "Cookie Brown",
				color : "#C7A317"
			}, {
				name : "Caramel",
				color : "#C68E17"
			}, {
				name : "Brass",
				color : "#B5A642"
			}, {
				name : "Khaki",
				color : "#ADA96E"
			}, {
				name : "Camel brown",
				color : "#C19A6B"
			}, {
				name : "Bronze",
				color : "#CD7F32"
			}, {
				name : "Tiger Orange",
				color : "#C88141"
			}, {
				name : "Cinnamon",
				color : "#C58917"
			}, {
				name : "Dark Goldenrod",
				color : "#AF7817"
			}, {
				name : "Copper",
				color : "#B87333"
			}, {
				name : "Wood",
				color : "#966F33"
			}, {
				name : "Oak Brown",
				color : "#806517"
			}, {
				name : "Moccasin",
				color : "#827839"
			}, {
				name : "Army Brown",
				color : "#827B60"
			}, {
				name : "Sandstone",
				color : "#786D5F"
			}, {
				name : "Mocha",
				color : "#493D26"
			}, {
				name : "Taupe",
				color : "#483C32"
			}, {
				name : "Coffee",
				color : "#6F4E37"
			}, {
				name : "Brown Bear",
				color : "#835C3B"
			}, {
				name : "Red Dirt",
				color : "#7F5217"
			}, {
				name : "Sepia",
				color : "#7F462C"
			}, {
				name : "Orange Salmon",
				color : "#C47451"
			}, {
				name : "Rust",
				color : "#C36241"
			}, {
				name : "Red Fox",
				color : "#C35817"
			}, {
				name : "Chocolate",
				color : "#C85A17"
			}, {
				name : "Sedona",
				color : "#CC6600"
			}, {
				name : "Papaya Orange",
				color : "#E56717"
			}, {
				name : "Halloween Orange",
				color : "#E66C2C"
			}, {
				name : "Pumpkin Orange",
				color : "#F87217"
			}, {
				name : "Construction Cone Orange",
				color : "#F87431"
			}, {
				name : "Sunrise Orange",
				color : "#E67451"
			}, {
				name : "Mango Orange",
				color : "#FF8040"
			}, {
				name : "Dark Orange",
				color : "#F88017"
			}, {
				name : "Coral",
				color : "#FF7F50"
			}, {
				name : "Basket Ball Orange",
				color : "#F88158"
			}, {
				name : "Light Salmon",
				color : "#F9966B"
			}, {
				name : "Tangerine",
				color : "#E78A61"
			}, {
				name : "Dark Salmon",
				color : "#E18B6B"
			}, {
				name : "Light Coral",
				color : "#E77471"
			}, {
				name : "Bean Red",
				color : "#F75D59"
			}, {
				name : "Valentine Red",
				color : "#E55451"
			}, {
				name : "Shocking Orange",
				color : "#E55B3C"
			}, {
				name : "Red",
				color : "#FF0000"
			}, {
				name : "Scarlet",
				color : "#FF2400"
			}, {
				name : "Ruby Red",
				color : "#F62217"
			}, {
				name : "Ferrari Red",
				color : "#F70D1A"
			}, {
				name : "Fire Engine Red",
				color : "#F62817"
			}, {
				name : "Lava Red",
				color : "#E42217"
			}, {
				name : "Love Red",
				color : "#E41B17"
			}, {
				name : "Grapefruit",
				color : "#DC381F"
			}, {
				name : "Chestnut Red",
				color : "#C34A2C"
			}, {
				name : "Cherry Red",
				color : "#C24641"
			}, {
				name : "Mahagany",
				color : "#C04000"
			}, {
				name : "Chilli Pepper",
				color : "#C11B17"
			}, {
				name : "Cranberry",
				color : "#9F000F"
			}, {
				name : "Red Wine",
				color : "#990012"
			}, {
				name : "Burgundy",
				color : "#8C001A"
			}, {
				name : "Blood Red",
				color : "#7E3517"
			}, {
				name : "Sienna",
				color : "#8A4117"
			}, {
				name : "Sangria",
				color : "#7E3817"
			}, {
				name : "Firebrick",
				color : "#800517"
			}, {
				name : "Maroon",
				color : "#810541"
			}, {
				name : "Plum Pie",
				color : "#7D0541"
			}, {
				name : "Velvet Maroon",
				color : "#7E354D"
			}, {
				name : "Plum Velvet",
				color : "#7D0552"
			}, {
				name : "Rosy Finch",
				color : "#7F4E52"
			}, {
				name : "Puce",
				color : "#7F5A58"
			}, {
				name : "Dull Purple",
				color : "#7F525D"
			}, {
				name : "Rosy Brown",
				color : "#B38481"
			}, {
				name : "Khaki Rose",
				color : "#C5908E"
			}, {
				name : "Pink Bow",
				color : "#C48189"
			}, {
				name : "Lipstick Pink",
				color : "#C48793"
			}, {
				name : "Rose",
				color : "#E8ADAA"
			}, {
				name : "Desert Sand",
				color : "#EDC9AF"
			}, {
				name : "Pig Pink",
				color : "#FDD7E4"
			}, {
				name : "Cotton Candy",
				color : "#FCDFFF"
			}, {
				name : "Pink Bubblegum",
				color : "#FFDFDD"
			}, {
				name : "Misty Rose",
				color : "#FBBBB9"
			}, {
				name : "Pink",
				color : "#FAAFBE"
			}, {
				name : "Light Pink",
				color : "#FAAFBA"
			}, {
				name : "Flamingo Pink",
				color : "#F9A7B0"
			}, {
				name : "Pink Rose",
				color : "#E7A1B0"
			}, {
				name : "Pink Daisy",
				color : "#E799A3"
			}, {
				name : "Cadillac Pink",
				color : "#E38AAE"
			}, {
				name : "Carnation Pink",
				color : "#F778A1"
			}, {
				name : "Blush Red",
				color : "#E56E94"
			}, {
				name : "Hot Pink",
				color : "#F660AB"
			}, {
				name : "Watermelon Pink",
				color : "#FC6C85"
			}, {
				name : "Violet Red",
				color : "#F6358A"
			}, {
				name : "Deep Pink",
				color : "#F52887"
			}, {
				name : "Pink Cupcake",
				color : "#E45E9D"
			}, {
				name : "Pink Lemonade",
				color : "#E4287C"
			}, {
				name : "Neon Pink",
				color : "#F535AA"
			}, {
				name : "Magenta",
				color : "#FF00FF"
			}, {
				name : "Dimorphotheca Magenta",
				color : "#E3319D"
			}, {
				name : "Bright Neon Pink",
				color : "#F433FF"
			}, {
				name : "Pale Violet Red",
				color : "#D16587"
			}, {
				name : "Tulip Pink",
				color : "#C25A7C"
			}, {
				name : "Medium Violet Red",
				color : "#CA226B"
			}, {
				name : "Rogue Pink",
				color : "#C12869"
			}, {
				name : "Burnt Pink",
				color : "#C12267"
			}, {
				name : "Bashful Pink",
				color : "#C25283"
			}, {
				name : "Carnation Pink",
				color : "#C12283"
			}, {
				name : "Plum",
				color : "#B93B8F"
			}, {
				name : "Viola Purple",
				color : "#7E587E"
			}, {
				name : "Purple Iris",
				color : "#571B7E"
			}, {
				name : "Plum Purple",
				color : "#583759"
			}, {
				name : "Indigo",
				color : "#4B0082"
			}, {
				name : "Purple Monster",
				color : "#461B7E"
			}, {
				name : "Purple Haze",
				color : "#4E387E"
			}, {
				name : "Eggplant",
				color : "#614051"
			}, {
				name : "Grape",
				color : "#5E5A80"
			}, {
				name : "Purple Jam",
				color : "#6A287E"
			}, {
				name : "Dark Orchid",
				color : "#7D1B7E"
			}, {
				name : "Purple Flower",
				color : "#A74AC7"
			}, {
				name : "Medium Orchid",
				color : "#B048B5"
			}, {
				name : "Purple Amethyst",
				color : "#6C2DC7"
			}, {
				name : "Dark Violet",
				color : "#842DCE"
			}, {
				name : "Violet",
				color : "#8D38C9"
			}, {
				name : "Purple Sage Bush",
				color : "#7A5DC7"
			}, {
				name : "Lovely Purple",
				color : "#7F38EC"
			}, {
				name : "Purple",
				color : "#8E35EF"
			}, {
				name : "Aztech Purple",
				color : "#893BFF"
			}, {
				name : "Medium Purple",
				color : "#8467D7"
			}, {
				name : "Jasmine Purple",
				color : "#A23BEC"
			}, {
				name : "Purple Daffodil",
				color : "#B041FF"
			}, {
				name : "Tyrian Purple",
				color : "#C45AEC"
			}, {
				name : "Crocus Purple",
				color : "#9172EC"
			}, {
				name : "Purple Mimosa",
				color : "#9E7BFF"
			}, {
				name : "Heliotrope Purple",
				color : "#D462FF"
			}, {
				name : "Crimson",
				color : "#E238EC"
			}, {
				name : "Purple Dragon",
				color : "#C38EC7"
			}, {
				name : "Lilac",
				color : "#C8A2C8"
			}, {
				name : "Blush Pink",
				color : "#E6A9EC"
			}, {
				name : "Mauve",
				color : "#E0B0FF"
			}, {
				name : "Wiseria Purple",
				color : "#C6AEC7"
			}, {
				name : "Blossom Pink",
				color : "#F9B7FF"
			}, {
				name : "Thistle",
				color : "#D2B9D3"
			}, {
				name : "Periwinkle",
				color : "#E9CFEC"
			}, {
				name : "Lavender Pinocchio",
				color : "#EBDDE2"
			}, {
				name : "Lavender",
				color : "#E3E4FA"
			}, {
				name : "Pearl",
				color : "#FDEEF4"
			}, {
				name : "SeaShell",
				color : "#FFF5EE"
			}, {
				name : "Milk White",
				color : "#FEFCFF"
			}, {
				name : "White",
				color : "#FFFFFF"
			} ];

			this.colorButtonList = document.getElementById('color-buttons');
			for (i = 0; i < colors.length; i++) {
				var button = document.createElement('a');
				button.setAttribute('href', '#');
				//button.innerHTML = colors[i].name;
				button.color = colors[i].color;
				button.onclick = function(e) {
					_self.drawingArea.context.strokeStyle = this.color;
					//_self.colorInput.value = this.color;
				}
				button.style.backgroundColor = colors[i].color;
				this.colorButtonList.appendChild(button);
			}

			var lineWidths = [ 1, 5, 10, 15, 20, 25, 30 ];

			this.lineWidthButtonList = document.getElementById('line-widths');
			for (i = 0; i < lineWidths.length; i++) {
				var button = document.createElement('a');
				button.setAttribute('href', '#');
				button.lineWidth = lineWidths[i];
				button.onclick = function(e) {
					_self.drawingArea.context.lineWidth = this.lineWidth;
					_self.brushSizeSelector.value = this.lineWidth;
				}				
				var span = document.createElement('span');
				span.setAttribute('style','margin-top: -' + (button.lineWidth / 2) + 'px; height: ' + (button.lineWidth) + 'px;');
				button.appendChild(span);
				this.lineWidthButtonList.appendChild(button);
			}

			this.brushSizeSelector = document.getElementById('brush-size');
//			         this.brushSizeSelector.value = this.drawingArea.context.lineWidth;
//			         this.onBrushSizeSelectorChanged = function () {
//			             this.drawingArea.context.lineWidth = this.brushSizeSelector.value;
//			         }
//			         this.brushSizeSelector.addEventListener("change", this.onBrushSizeSelectorChanged.bind(this));

			this.clearCanvasButton = document.getElementById('clear-canvas');
			this.onClearCanvasButtonClicked = function(e) {
				var rect = this.drawingArea.canvas.getBoundingClientRect();
				this.drawingArea.context.clearRect(0, 0, rect.width,
						rect.height);
                
                 var canvas = document.getElementById("canvas");
    var data = document.getElementById("imgdata").value;
    console.log(data);
        //data=data+".jpg";
    console.log(data);
       // alert("test");
    var ctx = canvas.getContext("2d");
        //canvas.getContext('2d').drawImage(data, 0, 0);
    var deviceWidth = window.innerWidth;

    canvasWidth = deviceWidth - 100;
    canvasHeight = deviceWidth - 100;

    canvas.width = canvasWidth;
    canvas.height = canvasHeight;

        var img = new Image;
        img.onload = function() {
            //canvas.width = this.width;
            //canvas.height = this.height;
       // ctx.drawImage(this, 0, 0,img.width,img.height,0,0,canvas.width,canvas.height);
    imgx = 0;
    imgy = 0;
            
     var scale1=Math.min((canvas.width/img.width),(canvas.height/img.height));    
    var sw1=img.width*scale1;
    var sh1=img.height*scale1;
    ctx.drawImage(img,0,0,sw1,sh1);

   // ctx.clearRect(0, 0, canvas.width, canvas.height);
   // ctx.drawImage(img, imgx, imgy, canvas.width, canvas.height);
        };
        img.src = data;
                
                
			}
			this.clearCanvasButton.addEventListener("click",
					this.onClearCanvasButtonClicked.bind(this));

			this.hide = function () {
			    if(this.element.classList){
			        this.element.classList.add('hidden');
			    } else {
			        if(this.element.className.indexOf('hidden') < 0)
			        this.element.className += this.element.className.length > 0 ? ' hidden' : 'hidden';
			    }
				this.visible = false;
				this.controlsOpener.style.left = '0px';
			}
			
			this.show = function() {			    
			    if (this.element.classList) {
			        this.element.classList.remove('hidden');
			    } else {
			        this.element.className = this.element.className.replace('hidden', '');
			    }
				this.visible = true;
				this.controlsOpener.style.left = this.element
						.getBoundingClientRect().width
						+ 'px';
			}

			this.toggleControlsTray = function() {
				if (this.visible) {
					this.hide();
				} else {
					this.show();
				}
			}

			this.reset = function() {
				this.colorInput.value = this.drawingArea.context.strokeStyle;
				this.brushSizeSelector.value = this.drawingArea.context.lineWidth;
			}

			this.drawingArea.controls = this;
			this.show();
		}

		function isCanvasSupported() {
			var elem = document.createElement('canvas');
			return !!(elem.getContext && elem.getContext('2d'));
		}
	</script>
<script>
    var canvas = document.getElementById("canvas");
    var data = document.getElementById("imgdata").value;
    console.log(data);
        //data=data+".jpg";
    console.log(data);
       // alert("test");
    var ctx = canvas.getContext("2d");
        //canvas.getContext('2d').drawImage(data, 0, 0);
    var deviceWidth = window.innerWidth;

    canvasWidth = deviceWidth - 100;
    canvasHeight = deviceWidth - 100;

    canvas.width = canvasWidth;
    canvas.height = canvasHeight;

        var img = new Image;
        img.onload = function() {
            //canvas.width = this.width;
            //canvas.height = this.height;
       // ctx.drawImage(this, 0, 0,img.width,img.height,0,0,canvas.width,canvas.height);
    imgx = 0;
    imgy = 0;
            
     var scale1=Math.min((canvas.width/img.width),(canvas.height/img.height));    
    var sw1=img.width*scale1;
    var sh1=img.height*scale1;
    ctx.drawImage(img,0,0,sw1,sh1);

   // ctx.clearRect(0, 0, canvas.width, canvas.height);
   // ctx.drawImage(img, imgx, imgy, canvas.width, canvas.height);
        };
        img.src = data;
    </script>
    <script>
       document.getElementById('save').addEventListener('click', function() {
    downloadCanvas(this, 'canvas', 'image.png');
       }, false);
        function downloadCanvas(link, canvasId, filename) {
            link.href = document.getElementById(canvasId).toDataURL();
            link.download = filename;
        }
    </script>  
<!--
    <script src="js/text.js"></script>
    <script src="js/example.js"></script>
-->

</body></html>	