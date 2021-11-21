
const btn_M=document.getElementById('btn_medico');
const btn_E=document.getElementById('btn_estudio');
const btn_T=document.getElementById('btn_turno');

const menu_M=document.getElementById('Admin_Medico');
const menu_E=document.getElementById('Admin_Estudio');
const menu_T=document.getElementById('Admin_Turno');


btn_M.addEventListener("click",menu_medico)
btn_E.addEventListener("click",menu_estudio)
btn_T.addEventListener("click",menu_turno)

function menu_medico(){
if(menu_M.style.display=="none"){
menu_M.style.display="flex";
}else{
menu_M.style.display="none"	
}
}

function menu_estudio(){
if(menu_E.style.display=="none"){
menu_E.style.display="flex";
}else{
menu_E.style.display="none"	
}
}

function menu_turno(){
if(menu_T.style.display=="none"){
menu_T.style.display="flex";
}else{
menu_T.style.display="none"	
}
}



