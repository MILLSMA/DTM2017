//: toogle navigation on smaller screens
function hammenu() {
    var x = document.getElementById("navid");
	var y = document.getElementById("show_button");
    if (x.className === "nav") {
        x.className += " responsive";
		x.style.position = 'fixed';
		y.style.visibility = 'hidden';
    } else {
        x.className = "nav";
		y.style.visibility = 'visible';
    }

}
//button to go back from each course page
function goBack() {
    window.history.back();
}

//button to show filters on smaller screens
function show_filters(){
	var x = document.getElementById("filer_side");
        x.style.display = "block";

}

//button to hide filters on smaller screens
function hide_filters(){
	var x = document.getElementById("filer_side");
        x.style.display = "none";

}
