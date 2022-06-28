
var element = document.getElementById("quizz1");
let couleur = ["#FFFF00", "#ff000a", "#00FF00", "#00FFFF",];


chargement();

function chargement() {

    change()

    var i = 1;
    let compt = 0;

    // while (i <= document.getElementById("conteneur").children.length) {
    //     change(i + 3);
    //     change(i + 2);
    //     change(i + 1);
    //     change(i);
    //     i += 4;
    // }

    // for (let I = 1; I <= document.getElementById("conteneur").children.length; I++ ){
    //     change(I);
    //     console.log("salut");
    // }

    function change(indice) {
        setInterval(function () {
            // document.getElementById("quizz" + (indice)).style.backgroundColor = couleur[compt];
            document.body.style.backgroundColor = couleur[compt];
            compt++;
            if (compt >= 4) {
                compt = 0;
            }
        }, 1500) 
    }
}


let quizz = document.getElementsByClassName('card');
let search = document.getElementById('trouver');
const recherche = document.getElementById('searchbar');

search.addEventListener('click', () => {

    let input = recherche.value.toLowerCase();

    for (let i = 0; i < quizz.length; i++) {
        if (quizz[i].textContent.toLowerCase().includes(input)) {
            quizz[i].style.display = "block";
        }
        else {
            quizz[i].style.display = "none";
        }
    }
})