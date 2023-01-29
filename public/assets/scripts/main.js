import { menuBurger } from "./modules/menu_burger.js";


window.addEventListener('mouseover', (e) => {

console.log(e.clientX);
console.log(e.clientY);

document.getElementById('heroimg').style.boxShadow = `#000000 ${e.clientX*0.1}px ${e.clientY*0.1}px 0px`;

})
