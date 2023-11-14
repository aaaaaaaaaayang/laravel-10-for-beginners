<!DOCTYPE html>
<html>
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

	<title>Reversi Game</title>
	<style>
		body {
			text-align: center;
		}

		.board {
			text-align: center;
			vertical-align: middle;
			display: inline-block;
		}

		.board button {
			font-size: 2em;
			padding: 35px 35px;
			width:35px;
			height:35px;
			cursor: pointer;
			display: flex;
 			justify-content: center;
  			align-items: center;
		}
		
		.board .white {
			color: #000;
		}

		.board .black {
			color: #fff;
		}

		table{
			border-collapse: collapse;
			border-spacing: 0;
		}

		table td {
			padding:0px;
		}
	</style>
</head>
<body>
	<h1>Reversi Game</h1>

	<div class="board">
		<table>
			<?php
				// row
				for ($i = 0; $i < 8; $i++) {
					echo '<tr>';
					//column
					for ($j = 0; $j < 8; $j++) {
						echo '<td>
							<button style="background-color:#6E9E00">
							</button>
						</td>';
					}
					echo '</tr>';
				}
			?>
		</table>
	</div>

	<script>
	
		const buttons = document.querySelectorAll('.board button');
		let currentbutton = 'white';
		
		buttons.forEach((button, index) => {

			// 4 chess are placed in the initial state of reversi game
			// White chess in initial state
			if (index === 27 || index === 36) {
				button.classList.add('black');
				button.innerHTML='<i class="fas fa-circle fa-sm"></i>'
				button.disabled = true;
			} 
			
			// Black chess in initial state
			else if (index === 28 || index === 35) {
				button.classList.add('white');
				button.innerHTML='<i class="fas fa-circle fa-sm"></i>'
				button.disabled = true;
			} 
			
			// Player can click the button to put in the chess
			else {
				button.addEventListener('click', () => {
				button.classList.add(currentbutton);

				if (currentbutton === 'white') {
					// Next player put black chess
					currentbutton = 'black';
					button.innerHTML='<i class="fas fa-circle fa-sm"></i>'
				} else {
					// Next player put white chess
					currentbutton = 'white';
					button.innerHTML='<i class="fas fa-circle fa-sm"></i>'
				}
				button.disabled = true;
				});
			}
		});
	</script>
</body>
</html>

