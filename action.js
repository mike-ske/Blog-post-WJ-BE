
var body = document.getElementById('body');
var error_msg = document.getElementById('msg_green');
var error_msg_2 = document.getElementById('msg');
    
body.onclick = function () {
    error_msg.style.opacity =  0;
    error_msg.style.display =  "none";
    error_msg_2.style.opacity =  "none";
}

body.onload = function () {
    error_msg.style.opacity =  0;
    error_msg.style.display =  "none";
    error_msg_2.style.opacity =  "none";
}