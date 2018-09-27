function clicked() {
    alert("Clicked!");
}

function changeColor() {
    var div1 = document.getElementById("div1");
    var newColor = document.getElementById("color-input").value;
    div1.style.backgroundColor = newColor;
}

$(document).ready(function(){
    $("#color-button").click(function(){
        var newColor = $("#color-input").val();
        $("#div1").css("background-color", newColor);
    });
});

$(document).ready(function(){
    $("#fade-button").click(function(){
        $("#div3").fadeToggle();
    });
});