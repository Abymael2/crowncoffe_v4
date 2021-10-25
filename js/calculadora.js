function takeValue(x){
    document.getElementById('Result').innerHTML +=x;
}

function clearInput(){
    document.getElementById('Result').innerHTML = "";
}

function calculateResult(){
    var result = eval(document.getElementById('Result').innerHTML);
    document.getElementById('Result').innerHTML = result;
}

var cero = document.getElementById('cero');
var uno = document.getElementById('uno');
var dos = document.getElementById('dos');
var tres = document.getElementById('tres');
var cuatro = document.getElementById('cuatro');
var cinco = document.getElementById('cinco');
var seis = document.getElementById('seis');
var siete = document.getElementById('siete');
var ocho = document.getElementById('ocho');
var nueve = document.getElementById('nueve');
var punto = document.getElementById('punto');

var borrar = document.getElementById('borrar');
var igual = document.getElementById('igual');
var mas = document.getElementById('mas');
var menos = document.getElementById('menos');
var milti = document.getElementById('milti');
var div = document.getElementById('div');

cero.addEventListener("click", function(){
    takeValue(0);
})
uno.addEventListener("click", function(){
    takeValue(1);
})
dos.addEventListener("click", function(){
    takeValue(2);
})
tres.addEventListener("click", function(){
    takeValue(3);
})
cuatro.addEventListener("click", function(){
    takeValue(4);
})
cinco.addEventListener("click", function(){
    takeValue(5);
})
seis.addEventListener("click", function(){
    takeValue(6);
})
siete.addEventListener("click", function(){
    takeValue(7);
})
ocho.addEventListener("click", function(){
    takeValue(8);
})
nueve.addEventListener("click", function(){
    takeValue(9);
})
punto.addEventListener("click", function(){
    takeValue(".");
})

mas.addEventListener("click", function(){
    takeValue("+");
})
menos.addEventListener("click", function(){
    takeValue("-");
})
milti.addEventListener("click", function(){
    takeValue("*");
})
div.addEventListener("click", function(){
    takeValue("/");
})

igual.addEventListener("click", function(){
    calculateResult();
})
borrar.addEventListener("click", function(){
    clearInput();
})

