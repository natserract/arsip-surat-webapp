
//Javascript
function dropdown() {
    var x = document.getElementById("dropdown2");
    if(x.style.display === "none"){
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function dropdownProfile() {
    var dropdown = document.getElementById("dropdown1");
    if(dropdown.style.display === "none"){
        dropdown.style.display = "block";
    } else {
        dropdown.style.display = "none";
    }
}

function showModal(){
    var modal = document.getElementById("modal");
    if(modal.style.display === "none"){
        modal.style.display = "block";
    } else {
        modal.style.display = "none";
    }
}

function search() {
    var input = document.getElementById("search");
    var filter = document.getElementById("search").value.toLowerCase();
    var table = document.getElementById("table_filter");
    var tr = table.getElementsByTagName("tr");

    for (var i = 0; i < tr.length; i++){
        if(tr[i].innerHTML.toLowerCase().indexOf(filter) > -1){
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
