window.onload = function(){ 
var lookup = document.getElementById("lookup");
var input = document.getElementById("country");
var result = document.getElementById("result");
var lookupc = document.getElementById("lookup_cities");
lookup.addEventListener("click", function(e) {
    e.preventDefault();
    console.log("did it");
    var httpRequest = new XMLHttpRequest();
    var url = "http://localhost/info2180-lab5/world.php";
    var data = input.value;
    var exec = '?country=' + data;
    httpRequest.onreadystatechange = function() {
        if(httpRequest.readyState === XMLHttpRequest.DONE){
            if(httpRequest.status === 200){
                var results = httpRequest.responseText;
                result.innerHTML = results;
            } else{
                alert("Error Code");
            }
        }
    }
    httpRequest.open('GET', url+exec, true);
    httpRequest.send();
});
lookupc.addEventListener("click", function(e) {
    e.preventDefault();
    console.log("did it again");
    var httpRequest = new XMLHttpRequest();
    var url = "http://localhost/info2180-lab5/world.php";
    var data = input.value;
    var exec = '?country=' + data;
    httpRequest.onreadystatechange = function() {
        if(httpRequest.readyState === XMLHttpRequest.DONE){
            if(httpRequest.status === 200){
                var results = httpRequest.responseText;
                result.innerHTML = results;
            } else{
                alert("Error Code");
            }
        }
    }
    httpRequest.open('GET', url+exec, true);
    httpRequest.send();
});
}