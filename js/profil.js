
let couleur = ["#FFFF00","#FF0000","#00FF00","#00FFFF"];
let compt = 0

change()

function change(){
    document.body.style.backgroundColor = couleur[compt];
    compt++
    if (compt >= 4 ){
        compt = 0
    }
}

setInterval(change, 1300)
