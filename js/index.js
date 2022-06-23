
var element= document.getElementById("quizz1")
var i = 1
let couleur = ["#FFFF00","#FF0000","#00FF00","#00FFFF"];
let compt = 0

while (i <= document.getElementById("conteneur").children.length){
    change(i)
    change(i+1)
    change(i+2)
    change(i+3)
    i+=4
}

function change(indice){
    setInterval(function() {
        document.getElementById("quizz"+(indice)).style.backgroundColor = couleur[compt]
        compt++
        if (compt >= 4 ){
            compt = 0
            }
}, 1000)
}
    

