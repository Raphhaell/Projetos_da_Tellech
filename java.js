const header = document.querySelector("header");

window.addEventListenner ("scroll", function(){
	header.classList.toggle ("Sticky", this.window.scrolly > 0);
})