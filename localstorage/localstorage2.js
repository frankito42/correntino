document.addEventListener("DOMContentLoaded", function(event) {
    //código a ejecutar cuando el DOM está listo para recibir acciones
    iniciarSesion()
});
function iniciarSesion(){
    console.log(JSON.parse(localStorage.getItem("user")))
    if (localStorage.getItem("user")===null) {
        location.href="Login/index.php"
    }else{
        document.getElementById("userNameID").innerHTML=JSON.parse(localStorage.getItem("user")).user
        adminVerif()
    }
}
function cerrarSession(){
    localStorage.clear()
    iniciarSesion()
}
document.getElementById("cerrarSession").addEventListener("click",()=>{
    cerrarSession()
})
function adminVerif() {
    let ussser=JSON.parse(localStorage.getItem("user"))

    console.log(ussser)
    if(ussser.ventas==1){
        document.getElementById("stockOcultar").style.display="none"
        document.getElementById("comprasOcultar").style.display="none"
        document.getElementById("cajaOcultar").style.display="none"
    }
}