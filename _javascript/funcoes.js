function mudaFoto (foto){
	document.getElementById("banner").style.backgroundImage="URL("+foto+")"
}

	
function iniciaSlider(){
	max=3;
	min=1;
	si=min;
	trans=true;
	carregaFoto(li);
	document.getElementById("banner").addEventListener("transitionend",fimTrans);
	tmr=setInterval(trocaFoto,2000);
}

function trocaFoto(){
		trans=false;
		si++;
		if(si>max){
		si=min;
		}
	carregaFoto(li+i);
}

function fimTrans(){
	trans=true;
}

function carregaFoto(foto){
	document.getElementById("banner").style.backgroundImage="li("+foto+")";
}

function prox(){
	clearInterval(tmr);
	if(trans){
		trans=false;
		si++;
		if(si>max){
		si=min;
		}
	carregaFoto("_imagens/_banner/s"+si+".png");
	}
	tmr=setInterval(trocaFoto,6000)
}	

function ant(){
	clearInterval(tmr);
	if(trans){
		trans=false;
		si--;
		if(si<min){
		si=max;
		}
	carregaFoto("_imagens/_banner/s"+si+".png");
	}
	tmr=setInterval(trocaFoto,6000)
}		

function slide1(){
document.getElementById('banner').src="_imagens/_banner/s1.png";
setTimeout("slide2()", 3000)
document.getElementById('linkbanner').href="https://www.google.com.br"
}
  
function slide2(){
document.getElementById('banner').src="_imagens/_banner/s2.png";
setTimeout("slide3()", 3000)
document.getElementById('linkbanner').href="www.youtube.com"
}
  
function slide3(){
document.getElementById('banner').src="_imagens/_banner/s1.png";
setTimeout("slide1()", 3000)
document.getElementById('linkbanner').href="www.google.com.br"
}

function mais(){
document.form.texto.value = Math.floor (1+ 1 - 2 + (document.form.texto.value) * 1 + 1)
if (document.form.texto.value > 2)
{document.form.texto.value = 0}
}
  
function menos(){
document.form.texto.value = Math.floor (1+ 1 - 2 + (document.form.texto.value) * 1 -1)
if (document.form.texto.value < 0)
{document.form.texto.value = 2}
}
