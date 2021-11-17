let close = document.querySelector('#closebutton');
let open = document.querySelector('#openbutton')
let head = document.querySelector('header');


close.addEventListener('click',() => {
    head.style.display= 'none';
});

open.addEventListener('click',() => {
    head.style.display= 'flex';
});

