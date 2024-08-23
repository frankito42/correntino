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
    await listarFamilias() 
    document.getElementById("newFamilia").addEventListener("submit",async (e)=>{
      e.preventDefault()
      await insertFamilia()
    })
  
    
    
  });
  let familias

  async function listarFamilias() {
    await fetch('php/listarFamilias.php')
    .then(response => response.json())
    .then(async (data)=>{
      console.log(data)
      await dibujarTabla(data)
      familias=data
    });
     
   }
  async function insertFamilia() {
    $("#addnewFamily").modal("hide")
    let form= new FormData(document.getElementById("newFamilia"))
    await fetch('php/nuevaFamilia.php',{
        method:"POST",
        body:form,
    })
    .then(response => response.json())
    .then(async (data)=>{
      document.getElementById("newFamilia").reset()
      await listarFamilias() 
      console.log(data)
    });
     
   }
   
   async function dibujarTabla(params) {
    let tr=``
    params.forEach(element => {
        tr+=`
        <tr>
            <td style="display: flex;justify-content: space-between;">${element.nombreCliente} <span onclick="abrirModalEditNameFamili(${element.id},'${element.nombreCliente}')" style="cursor: pointer;color: #33b5e5;"><i class="fa-solid fa-pencil"></i></span></td>
        </tr>
        `
    });
    document.getElementById("tebody").innerHTML=tr
    
   }

   
  
   async function abrirModalIntegrantes(id) {
    $('#integrantes').modal("show")
    document.getElementById("idFami").value=id
    let filtroArray= familias.find((m) => parseInt(m.id) === parseInt(id));
    console.log("Es: " + filtroArray.nombreCliente );
    document.getElementById("nombreFamilu").innerHTML=filtroArray.nombreCliente
    await traerIntegrantes(id)
    
  }
  async function traerIntegrantes(id) {
    await fetch('php/listarIntegrantes.php?id='+id)
  .then((response) => response.json())
  .then((data) => {
    console.log(data)
    dibujarIntegrantes(data)
  
  });
  }
  document.getElementById("integranteNew").addEventListener("submit",async (e)=>{
    e.preventDefault()
    let form= new FormData(document.getElementById("integranteNew"))
    await fetch('php/addIntegrante.php',{
        method:"POST",
        body:form,
    })
    .then(response => response.json())
    .then(async (data)=>{
      document.getElementById("n").value=""
      await traerIntegrantes(data)
      console.log(data)
    });
  })
  
  function dibujarIntegrantes(params) {
    let h5=``
    params.forEach(element => {
      h5+=`<h5 style="text-decoration: underline;">${element.nombre} <span onclick="abrirModalEditNameInte(${element.idIntegrante},'${element.nombre}')" style="cursor: pointer;color: #33b5e5;"><i class="fa-solid fa-pencil"></i></span><h5>`
    });
    document.getElementById("listaIntegrantes").innerHTML=h5
  }
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  /* ///////////////////////////////////////////////////////////////////////////////// */
  async function abrirModalEditNameInte(id,nombre) {
    $('#editaNameModalInte').modal("show")
    document.getElementById("idInte").value=id
    document.getElementById("editNameInte").value=nombre
    document.getElementById("editNameLabelInte").classList.add("active")
    /* document.getElementById("idFami").value=id */
  }

  document.getElementById("fromEditNameInte").addEventListener("submit",async (e)=>{
    e.preventDefault()
    let form= new FormData(document.getElementById("fromEditNameInte"))
    await fetch('php/editarIntegrantes.php',{
        method:"POST",
        body:form,
    })
    .then(response => response.json())
    .then(async (data)=>{
      await traerIntegrantes(document.getElementById("idInte").value)
      $('#editaNameModalInte').modal("hide")
      console.log(data)
    });
  })
  /* ////////////////////////////////////////////////////////////////////////////////////// */
  /* ////////////////////////////////////////////////////////////////////////////////////// */
  /* ////////////////////////////////////////////////////////////////////////////////////// */
  /* ////////////////////////////////////////////////////////////////////////////////////// */
  /* ////////////////////////////////////////////////////////////////////////////////////// */
  /* ////////////////////////////////////////////////////////////////////////////////////// */
  async function abrirModalEditNameFamili(id,nombre) {
    $('#editFamiliaName').modal("show")
    document.getElementById("editNameFamiId").value=id
    document.getElementById("editName").value=nombre
    document.getElementById("editNameLabel").classList.add("active")
    /* document.getElementById("idFami").value=id */
  }

  document.getElementById("fromEditName").addEventListener("submit",async (e)=>{
    e.preventDefault()
    let form= new FormData(document.getElementById("fromEditName"))
    await fetch('php/editarFamiliaNombre.php',{
        method:"POST",
        body:form,
    })
    .then(response => response.json())
    .then(async (data)=>{
      await listarFamilias()
      $('#editFamiliaName').modal("hide")
      console.log(data)
    });
  })
   
