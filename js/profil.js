
let card = document.querySelector(".container");
let couleur = ["#FFFF00","#FF0000","#00FF00","#0000FF"];
let compt = 0

function change(){
    document.body.style.background = couleur[compt];
    compt++
    if (compt >= 4 ){
        compt = 0
    }
}

setInterval(change(), 5000)
setInterval(console.log("lol"), 1000)