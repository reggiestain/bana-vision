
const showMenu = (toggleId, navId)=>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId)
  
    if(toggle && nav){
      toggle.addEventListener('click', ()=>{
        nav.classList.toggle('show')
      
      })
    }
  }
const showCard = (toggleId, navId)=>{
    const toggle = document.getElementById(toggleId),
             cont = document.getElementById(navId)
    if(toggle){
      toggle.addEventListener('click', ()=>{
        cont.classList.toggle('cont-on')
      })
    }
  }
  showMenu('header-toggle','nav-menu')
  showCard('content1','content-1')
   showCard('content2','content-2')
   showCard('content3','content-3')
const navLink = document.querySelectorAll('.nav__link');   

function linkAction(){

  navLink.forEach(n => n.classList.remove('active'));
  this.classList.add('active');
}
navLink.forEach(n => n.addEventListener('click', linkAction));
