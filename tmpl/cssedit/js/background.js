 // background cookie
document.getElementById('background').value="";
if (!readCookie('background')){

eraseCookie('background');
createCookie('background', '', 365);
}else{
document.getElementById('background').value=readCookie('background');
}
if (!readCookie('background')){
createCookie('background', '', 365);
}else{
createCookie('background', readCookie('background'), 365);
}
