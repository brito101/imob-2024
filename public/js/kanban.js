function countItems(){$(".draggable-area").each((function(){$(this).parent().find(".count").text($(this).find(".draggable-item").length)}))}countItems();let timer,client=null,step=null;function updateKanban(){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"POST",url:$("#kanban").data("action"),data:{client:client,step:step},success:function(t){client=null,step=null,countItems()}})}function dragStart(t){t.currentTarget.classList.add("dragging")}function dragEnd(t){t.currentTarget.classList.remove("dragging")}function dragOver(t){let e=document.querySelector(".draggable-item.dragging");t.currentTarget.appendChild(e),void 0!==t.target.dataset.step&&(client=e.dataset.client,step=t.target.dataset.step,client&&step&&(timer&&clearTimeout(timer),timer=setTimeout((()=>{updateKanban(),timer=null}),500)))}document.querySelectorAll(".draggable-item").forEach((t=>{t.addEventListener("dragstart",dragStart),t.addEventListener("dragend",dragEnd)})),document.querySelectorAll(".draggable-area").forEach((t=>{t.addEventListener("dragover",dragOver),t.addEventListener("drop",dragOver)}));
