//simon couleur
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

setInterval(change, 1300);

//barre de recherche
let quizz = document.getElementsByClassName('card');
let search = document.getElementById('trouver');
const recherche = document.getElementById('searchbar');

search.addEventListener('click', () => {

    let input = recherche.value.toLowerCase();

    for (let i = 0; i < quizz.length; i++) {
        if (quizz[i].textContent.toLowerCase().includes(input)){
            quizz[i].style.display = "block";
        }
        else {
            quizz[i].style.display = "none";
        }
    }
})