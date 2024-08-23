$(document).ready(async function(){
   /*  $("#filtroProductos").keyup(function(){
    _this = this;
    $.each($("#mytable tbody tr"), function() {
    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
    $(this).hide();
    else
    $(this).show();
    });
    }); */
    document.getElementById("filtroForm").addEventListener("submit",async (e)=>{
      e.preventDefault()
      let form=new FormData(document.getElementById("filtroForm"))
          await fetch('php/listarGastos.php',{
            method:"POST",
            body:form
          })
      .then((response) => response.json())
      .then(async (data) =>{
         console.log(data)
         await dibujarTabla(data)
        });
    })
    $("#formGroupExampleInput1").dateDropper()
    $("#formGroupExampleInput2").dateDropper()
    await listarGastos() 
    document.getElementById("newGasto").addEventListener("submit",async (e)=>{
      e.preventDefault()
      await insertGasto()
    })
    document.getElementById("monto").addEventListener("keyup",async (e)=>{
      e.target.value=separator(e.target.value.replace(/,/g, ""))
    })
  
    
    
  });
  let familias

  async function listarGastos() {
    await fetch('php/listarGastos.php')
    .then(response => response.json())
    .then(async (data)=>{
      console.log(data)
      await dibujarTabla(data)
      familias=data
    });
     
   }
  async function insertGasto() {
    $("#modalGasto").modal("hide")
    let form= new FormData(document.getElementById("newGasto"))
    await fetch('php/nuevoGasto.php',{
        method:"POST",
        body:form,
    })
    .then(response => response.json())
    .then(async (data)=>{
      document.getElementById("newGasto").reset()
      await listarGastos() 
      console.log(data)
    });
     
   }
   
   async function dibujarTabla(params) {
    document.getElementById("fecha1").innerHTML=document.getElementById("formGroupExampleInput1").value
    document.getElementById("fecha2").innerHTML=document.getElementById("formGroupExampleInput2").value
    let tr=``
    let suma=0
    params.forEach(element => {
      suma+=parseFloat(element.monto)
        tr+=`
        <tr>
            <td>${element.fecha}</td>
            <td>${element.detalle} </td>
            <td>$${separator(element.monto)} <span onclick="borrar(${element.idGasto})" style="cursor: pointer;color: red;"><i class="fa-solid fa-trash"></i></span></td>
        </tr>
        `
    });
    tr+=`<tr style="background: #0cd30c45;">
      <td colspan="2"><h4>TOTAL</h4></td>
      <td><h4>$${separator(suma)}</h4></td>
    </tr>`
    document.getElementById("tebody").innerHTML=tr
    
   }

   
  
   


  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */


  function separator(numb) {
    console.log(numb)
    /* if (numb<=0) {
      
    }else{ */
      var str = numb.toString().split(".");
      str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return str.join(".");
    /* } */
}
   
async function borrar(id) {

  let confirmacion=confirm("Esta seguro de eliminar este gasto?")
  if (confirmacion) {
    await fetch('php/delete.php?id='+id)
  .then((response) => response.json())
  .then(async (data) => {
    console.log(data)
    await listarGastos() 
  });
  }
}