/* Start Practical Demo Script */
const EQU_IN = document.getElementById("equ");
let lines = document.getElementsByClassName("line");

function solve() {
    const EQUATION = encodeURIComponent(EQU_IN.value);
    const URI = `solve.php?equ=${EQUATION}`;
    let response_obj;

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            response_obj = JSON.parse(this.response);
            for(let ele of lines) {
                ele.textContent = "";
            }
            if (response_obj.msg == "Solved") {
                
                write(response_obj.solve, lines, "Array");
            } else {
                write(response_obj.error, lines[0], "String");
            }
        }
    };
    xhttp.open("GET", URI, true);
    xhttp.send();
}

function write(value, target, type) {
    let i = 0;
    let letters = "";

    if (type == "String") {
        let timer = setInterval(function () {
            letters += value[i];
            target.textContent = letters;
            if (letters.length < value.length) {
                i++;
            } else {
                clearInterval(timer);
            }
        }, 50);
    }

    if (type == "Array") {
        let target_index = 0;
        let timer = setInterval(function () {
            letters += value[target_index][i];
            target[target_index].textContent = letters;
            if (letters.length < value[target_index].length) {
                i++;
            } else {
                i = 0;
                letters = "";
                target_index++;
            }

            if (target_index >= value.length) {
                clearInterval(timer);
            }
        }, 50);
    }
    
}
/* End Practical Demo Script */