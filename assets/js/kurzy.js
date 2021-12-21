let datum;
let buttonDatum;
let buttonPocet;
let kurzy;

window.onload = function() {
    datum = document.getElementById("getDatum");
    kurzy = document.getElementById("kurzy");
    buttonDatum = document.getElementById("buttonDatum");
    buttonDatum.onclick = posliDotaz;
    buttonPocet = document.getElementById("buttonPocet");
    buttonPocet.onclick = prepoctiKurzy;

    posliDotaz();   // onload zobrazujeme kurzy aktualniho dne
}

function posliDotaz() { // AJAX volani
    let url = "./kurzy.php?date=" + pripravDatum();
    let xhr = new XMLHttpRequest();
    xhr.onload = () => {
        kurzy.innerHTML = xhr.responseText        
    }    
    xhr.open("GET", url)
    xhr.send();    
}

function pripravDatum() {   // uprava datumu do formatu dd.mm.rrrr kvuli CNB
    let dateArr = "", newDate = "";
    if (datum.value){
        dateArr = datum.value.split("-");
        newDate = `${dateArr[2]}.${dateArr[1]}.${dateArr[0]}`    
    }
    return newDate;
}

function prepoctiKurzy() {  //  prepocitani kurzu dle zadaneho mnozstvi
    let pocet = document.getElementById("getPocet");
    let mnozstviAll = document.getElementsByClassName("mnozstvi");
    let kurzAll = document.getElementsByClassName("kurz");
    for (let i = 0; i < mnozstviAll.length ;i++) {
        let kur = parseFloat(kurzAll[i].innerText.replace(",","."));
        let mno = parseFloat(mnozstviAll[i].innerText);
        let poc = parseFloat(pocet.value);
        let kurz = kur / mno * poc;
        kurz = Math.round(kurz*1000)/1000;  // zaokrouhleni na 3 mista
               
        kurzAll[i].innerText = kurz.toString().replace(".",",");    // vlozeni nove hodnoty kurzu

        mnozstviAll[i].innerText = pocet.value; // vlozeni nove hodnoty mnozstvi
    }
}