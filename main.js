//$(document).ready(function(){
$(function(){
    let imagesrc=[
        "assets/images/PLA_Screen_Global_0.jpg",
        "assets/images/PLA_Screen_Global_1.jpg",
        "assets/images/PLA_Screen_Global_2.jpg",
        "assets/images/PLA_Screen_Global_3.jpg",
        "assets/images/PLA_Screen_Global_4.jpg",
        "assets/images/PLA_Screen_Global_5.jpg",
        "assets/images/PLA_Screen_Global_6.jpg",
        "assets/images/PLA_Screen_Global_7.jpg",
        "assets/images/PLA_Screen_Global_8.jpg",
        "assets/images/PLA_Screen_Global_9.jpg",
    ];
$storage = $('.storage'); //Sélectionne la classe storage
$viewer = $('.viewer'); //Sélectionne la classe viewer
$index = 0;

for(let i=1;i< imagesrc.length; i++ ){
    $storage.append("<div class= " + "image" +i +"></div>");
    $('.image' + i).append("<img src=" + imagesrc[i] + "></img>");
    $viewer.append("<img class='myslides' src=" + imagesrc[i] +"></img>");
}

$(".viewer .myslides:eq(0)").css("display","block"); //document.querySelectorAll('.class1.class2')[0].textContent = 1254; or document.querySelectorAll('.class1.class2')[0].innerHTML = 1254;


$myslides = $('.myslides'); //Création de variable
$stimg = $('.storage img'); //Sélectionne les img dans la classe storage

$(document).on("keydown", () =>{ //Event keydown

    $myslides.css("display", "none");

    $index = show($index); //on met la fonction show() dans la variable index (en gros, quand on clique sur la flèche, le numéro de l'index augmente ou diminue)

    if($index > imagesrc.length-2){ //Permet de ne pas avoir de blanc si on est plus grand que l'index
        $index = 0;
    } else if($index < 0){
        $index = imagesrc.length-2 ; 
    }

    $(".myslides:eq(" + $index + ")").css("display","block");

    console.log($index);
    });

    function show($index){ //Fonction pour se déplacer dans la visionneuse avec les touches fléchées
        if(event.keyCode == 39){//flèche droite
            $index++;
        }
        if(event.keyCode == 37){//Flèche gauche
            $index--;
        }
        return $index;
    }

});

