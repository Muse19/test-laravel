function addConsultants(){
  const consultants = $("#consultants")[0].options
  for (const iterator of consultants) {    
    if(iterator.selected)
      $("#consultantsQuery").append(iterator)
  }
}

function removeConsultants(){
  const consultantsQuery = $("#consultantsQuery")[0].options
  for (const iterator of consultantsQuery) {    
    if(iterator.selected)
      $("#consultants").append(iterator)
  }
}

function selectAll(){
  const consultantsQuery = $("#consultantsQuery")[0].options
  for (const iterator of consultantsQuery) {    
    iterator.selected = true
  }
}

async function relatorio(){
  await selectAll()
  let data = $("#form").serialize()  
  $.ajax({
    url:"/relatorio",
    data,
    success: (res) => {
      $("#results").html(res)
    }
  })
}

async function grafico(){
  await selectAll()
  const data = $("#form").serialize()
  $.ajax({
    url:"/grafico",
    data,
    success: (res) => {
      $("#results").html(res)    
    }
  })
}

async function pizza(){
  await selectAll()
  const data = $("#form").serialize()
  $.ajax({
    url:"/pizza",
    data,
    success: (res) => {
      $("#results").html(res)     
    }
  })
}

$("#addConsultants").click( () => {
  addConsultants()
})

$("#removeConsultants").click( () => {
  removeConsultants()
})

$("#relatorio").click( () => {
  relatorio()
})

$("#grafico").click( () => {
  grafico()
})

$("#pizza").click( () => {
  pizza()
})

