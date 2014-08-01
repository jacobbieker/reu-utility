/*
 * Simple display function to switch back textarea to
 * upload prompt.
 */
function displayUpload() {
	document.getElementById('textbox').style.display = "none";
	document.getElementById('upFile').style.display = "inline";
}


/*
 * Simple display function to change the upload prompt
 * to a textarea for the user to type input.
 */
function displayTextarea() {
	document.getElementById('upFile').style.display = "none";
	document.getElementById('textbox').style.display = "block";
}