function showroute() {
    document.getElementById("datatable").style.display = "block";
}
function showrouteAdmin(){
    document.getElementById('busesDiv').style.display="block";
    document.getElementById('busscheduleDiv').style.display="none";
    document.getElementById('depoDiv').style.display="none";
    document.getElementById('routestopDiv').style.display="none";
    document.getElementById('staffDiv').style.display="none";

    document.getElementById('showbuses').style.backgroundColor="#182C61";
    document.getElementById('showbusschedule').style.backgroundColor="#3B3B98";
    document.getElementById('showdepo').style.backgroundColor="#3B3B98";
    document.getElementById('showroutestop').style.backgroundColor="#3B3B98";
    document.getElementById('showstaff').style.backgroundColor="#3B3B98";
}
function showbusscheduleAdmin(){
    document.getElementById('busesDiv').style.display="none";
    document.getElementById('busscheduleDiv').style.display="block";
    document.getElementById('depoDiv').style.display="none";
    document.getElementById('routestopDiv').style.display="none";
    document.getElementById('staffDiv').style.display="none";

    document.getElementById('showbuses').style.backgroundColor="#3B3B98";
    document.getElementById('showbusschedule').style.backgroundColor= "#182C61";
    document.getElementById('showdepo').style.backgroundColor="#3B3B98";
    document.getElementById('showroutestop').style.backgroundColor="#3B3B98";
    document.getElementById('showstaff').style.backgroundColor="#3B3B98";
    
}
function showdepoAdmin(){
    document.getElementById('busesDiv').style.display="none";
    document.getElementById('busscheduleDiv').style.display="none";
    document.getElementById('depoDiv').style.display="block";
    document.getElementById('routestopDiv').style.display="none";
    document.getElementById('staffDiv').style.display="none";
    
    document.getElementById('showbuses').style.backgroundColor="#3B3B98";
    document.getElementById('showbusschedule').style.backgroundColor="#3B3B98";
    document.getElementById('showdepo').style.backgroundColor=" #182C61";
    document.getElementById('showroutestop').style.backgroundColor="#3B3B98";
    document.getElementById('showstaff').style.backgroundColor="#3B3B98";
}
function showroutestopAdmin(){
    document.getElementById('busesDiv').style.display="none";
    document.getElementById('busscheduleDiv').style.display="none";
    document.getElementById('depoDiv').style.display="none";
    document.getElementById('routestopDiv').style.display="block";
    document.getElementById('staffDiv').style.display="none";

    document.getElementById('showbuses').style.backgroundColor="#3B3B98";
    document.getElementById('showbusschedule').style.backgroundColor="#3B3B98";
    document.getElementById('showdepo').style.backgroundColor="#3B3B98";
    document.getElementById('showroutestop').style.backgroundColor= "#182C61";
    document.getElementById('showstaff').style.backgroundColor="#3B3B98";
}
function showstaffAdmin(){
    document.getElementById('busesDiv').style.display="none";
    document.getElementById('busscheduleDiv').style.display="none";
    document.getElementById('depoDiv').style.display="none";
    document.getElementById('routestopDiv').style.display="none";
    document.getElementById('staffDiv').style.display="block";

    document.getElementById('showbuses').style.backgroundColor="#3B3B98";
    document.getElementById('showbusschedule').style.backgroundColor="#3B3B98";
    document.getElementById('showdepo').style.backgroundColor="#3B3B98";
    document.getElementById('showroutestop').style.backgroundColor="#3B3B98";
    document.getElementById('showstaff').style.backgroundColor= "#182C61";
}

// document.getElementById('showbuses').onclick=showrouteAdmin;
// document.getElementById('showbusschedule').onclick=showbusscheduleAdmin;
// document.getElementById('showdepo').onclick=showdepoAdmin;
// document.getElementById('showroutestop').onclick=showroutestopAdmin;
// document.getElementById('showstaff').onclick=showstaffAdmin;
