
$(document).ready(function(){

    //  récupération des images du fichier xml
    $.ajax({
        type: "GET",
        url: "data.xml",
        dataType : "xml",
        success : recupXmlSlider
    });

});

function decalageSlide(n){
    var idx, courant, suivant;

    var decalageSlideAnimClass={
        forcourant:"",
        forsuivant:""
    }
    var slideTextAnimClass;

    if(n > slideIndex){

        if(n >= slides.length){
            n=0;
        }

        decalageSlideAnimClass.forcourant="decalageGaucheSlideCourante";
        decalageSlideAnimClass.forsuivant="decalageGaucheSlideSuivante";
        slideTextAnimClass="decalageTexteHaut";
    } 

    else if(n < slideIndex){
        if (n<0){
            n=slides.length-1;
        }

        decalageSlideAnimClass.forcourant="decalageDroiteSlideCourante";
        decalageSlideAnimClass.forsuivant="decalageDroiteSlideSuivante";
        slideTextAnimClass="decalageTexteBas";
    }

    if(n != slideIndex){
        suivant=slides[n];
        courant=slides[slideIndex];

        for(idx=0; idx<slides.length; idx++){
            slides[idx].className="slide";
            slides[idx].style.opacity=0;
            points[idx].classList.remove("active");
        }

        courant.classList.add(decalageSlideAnimClass.forcourant);
        suivant.classList.add(decalageSlideAnimClass.forsuivant);

        points[n].classList.add("active");
        slideIndex=n;
    }

    texteDescriptif.style.display="none";
    texteDescriptif.className="texteDescriptif" + slideTextAnimClass;
    texteDescriptif.innerText = slides[n].querySelector(".texteDescriptif").innerText;
    texteDescriptif.style.display = "block";
}

function recupXmlSlider(xml){

    $(xml).find("slide").each(function(){

        $('#slider').append('<div class="slide"><img src="' + $(this).find("image").text() +  '"/><p class="texteDescriptif">' + $(this).find("description").text() + '</p></div>');
    });

    var slideIndex, slides, points, texteDescriptif;

    ImagesInit();
    setTimer();
}

function decalage(idx){
    decalageSlide(slideIndex + idx);
}

var timer = null;
function setTimer() {
    timer = setInterval(function () {
        decalage(1);
    },5900)
}

function ImagesInit(){

    slideIndex=0;

    slides=document.getElementsByClassName("slide");

    slides[slideIndex].style.opacity=1;

    texteDescriptif = document.querySelector(".Descriptif .texteDescriptif");

    texteDescriptif.innerText=slides[slideIndex].querySelector(".texteDescriptif").innerText;

    points=[];
	
    var carouselPoint = document.getElementById("carouselPoint");

    for (var idx=0; idx<slides.length;idx++){
        var point=document.createElement("span");
        point.classList.add("points");

        point.setAttribute("onClick", "decalageSlide("+idx+")");

        carouselPoint.append(point);
        points.push(point);
    }

    points[slideIndex].classList.add("active");
}