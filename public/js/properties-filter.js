$(".open_filter").on("click",(function(e){e.preventDefault();const t=$(".form_advanced"),a=$(this);"none"!==t.css("display")?a.text("Filtro Avançado ↓"):a.text("✗ Fechar"),t.slideToggle()}));let goal="",category="",type="",city="",bedroom="",suite="",bathroom="",garage="",base_price="",limit_price="";const goalSelect=$("#goal"),categorySelect=$("#category"),typeSelect=$("#type"),citySelect=$("#city"),bedroomSelect=$("#bedroom"),suiteSelect=$("#suite"),bathroomSelect=$("#bathroom"),garageSelect=$("#garage"),basePriceSelect=$("#base_price"),limitPriceSelect=$("#limit_price");function getData(e,t){$.ajax({method:"POST",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},data:{goal:goal,category:category,type:type,city:city,bedroom:bedroom,suite:suite,bathroom:bathroom,garage:garage,base_price:base_price,limit_price:limit_price},url:e,success:function(e){e&&($(`#${t}`).children().remove(),$(`#${t}`).append('<option value="" disabled selected>Selecione</option>'),e.forEach((e=>{null!==e?$(`#${t}`).append(`<option value="${e}">${e}</option>`):$(`#${t}`).append('<option value="">Indiferente</option>')})))}})}goalSelect.val(""),categorySelect.val(""),typeSelect.val(""),citySelect.val(""),bedroomSelect.val(""),suiteSelect.val(""),bathroomSelect.val(""),garageSelect.val(""),basePriceSelect.val(""),limitPriceSelect.val(""),goalSelect.on("change",(function(){goal=$(this).val(),categorySelect.val(""),category="",typeSelect.val(""),type="",citySelect.val(""),city="",bedroomSelect.val(""),bedroom="",suiteSelect.val(""),suite="",bathroomSelect.val(""),bathroom="",garageSelect.val(""),garage="",basePriceSelect.val(""),base_price="",limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"category")})),categorySelect.on("change",(function(){category=$(this).val(),typeSelect.val(""),type="",citySelect.val(""),city="",bedroomSelect.val(""),bedroom="",suiteSelect.val(""),suite="",bathroomSelect.val(""),bathroom="",garageSelect.val(""),garage="",basePriceSelect.val(""),base_price="",limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"type")})),typeSelect.on("change",(function(){type=$(this).val(),citySelect.val(""),city="",bedroomSelect.val(""),bedroom="",suiteSelect.val(""),suite="",bathroomSelect.val(""),bathroom="",garageSelect.val(""),garage="",basePriceSelect.val(""),base_price="",limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"city")})),citySelect.on("change",(function(){city=$(this).val(),bedroomSelect.val(""),bedroom="",suiteSelect.val(""),suite="",bathroomSelect.val(""),bathroom="",garageSelect.val(""),garage="",basePriceSelect.val(""),base_price="",limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"bedroom")})),bedroomSelect.on("change",(function(){bedroom=$(this).val(),suiteSelect.val(""),suite="",bathroomSelect.val(""),bathroom="",garageSelect.val(""),garage="",basePriceSelect.val(""),base_price="",limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"suite")})),suiteSelect.on("change",(function(){suite=$(this).val(),bathroomSelect.val(""),bathroom="",garageSelect.val(""),garage="",basePriceSelect.val(""),base_price="",limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"bathroom")})),bathroomSelect.on("change",(function(){bathroom=$(this).val(),garageSelect.val(""),garage="",basePriceSelect.val(""),base_price="",limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"garage")})),garageSelect.on("change",(function(){garage=$(this).val(),basePriceSelect.val(""),base_price="",limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"base_price")})),basePriceSelect.on("change",(function(){base_price=$(this).val(),limitPriceSelect.val(""),limit_price="",getData($(this).data("url"),"limit_price")})),$("form").submit((function(e){$.ajax({method:"POST",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},url:$(this).attr("action"),data:{goal:goal,category:category,type:type,city:city,bedroom:bedroom,suite:suite,bathroom:bathroom,garage:garage,base_price:base_price,limit_price:limit_price}})}));
