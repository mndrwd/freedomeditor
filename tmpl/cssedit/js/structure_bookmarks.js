 // bookmarkz cookie
if (document.getElementById('bookmarkz')!=null)
document.getElementById('bookmarkz').value="";
if (!readCookie('bookmarkz')){

eraseCookie('bookmarkz');
createCookie('bookmarkz', '', 365);
}else{
if (document.getElementById('bookmarkz')!=null)
document.getElementById('bookmarkz').value=readCookie('bookmarkz');
}
if (!readCookie('bookmarkz')){
createCookie('bookmarkz', '', 365);
}else{
createCookie('bookmarkz', readCookie('bookmarkz'), 365);
}
