function clicked() {
    alert("Clicked!");
}

function changeColor() {
    var div1 = document.getElementById("div1");
    var newColor = document.getElementById("color-input").value;
    div1.style.backgroundColor = newColor;
}