let close = document.querySelector('#closebutton');
let open = document.querySelector('#openbutton')
let head = document.querySelector('header');


close.addEventListener('click',() => {
    head.style.display= 'none';
    head.classList.remove("open");
    head.classList.add("close");
});

open.addEventListener('click',() => {
    head.style.display= 'flex';
    head.classList.remove("close");
    head.classList.add("open");

});

