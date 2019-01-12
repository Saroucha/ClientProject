/* ici on cree le systeme de passage de slide (pagination)*/

var carrousel = {

//on va creer des variables

	nbSlide : 0,
	nbCurrent : 1, // stoker l'element courrant
	elemCurrent : null, // permet de stocker l'element html qui est affiche
	elem : null, // qui va permettre de definir sur quel type je veux initialiser un carrousel 
	
      init : function(elem){
		this.nbSlide = elem.find(".slide").length; //la fonction qui va compter le nomdre de slide qu'on a 

		//creer la pagination
		elem.append('<div class="navigation"></div>');
		for(var i=1;i<=this.nbSlide;i++){
			elem.find(".navigation").append("<span>"+i+"</span>");
		}

		//initialisation du carrousel
		
		this.elem=elem;
		elem.find(".slide").hide();
		elem.find(".slide:first").show();
		elemCurrent = elem.find(".slide:first");
	}
}

$(function(){
carrousel.init($("#carrousel"));  
});