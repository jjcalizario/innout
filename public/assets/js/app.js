
(function(){
    const menuToogle = document.querySelector('.menu-toogle');

menuToogle.onclick = function(e){
    const body = document.querySelector('body');
    body.classList.toggle('hide-sidebar');
}

})()


