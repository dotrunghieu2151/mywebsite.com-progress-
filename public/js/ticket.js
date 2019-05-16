$(document).ready(function(){
   const updateBtn = $(".ticket-update");
   const removeBtn = $(".ticket-remove");
   const ticketForm = $(".ticket-form");
   const products = $("#products")
   const sum = $("#sum");
   $.fn.appendOrReplace = function(selector,content){
       let ele = this.find(selector);
       ele.length > 0 ? $(selector).replaceWith(content) : this.append(content);
   }
   removeBtn.on("click",function(){
      ticketForm.data("button",this.name); 
   });
   updateBtn.on("click",function(){
      ticketForm.data("button",this.name); 
   });
   ticketForm.on("submit",function(e){
      e.preventDefault();
      let loading = $(this).find(".loading");
      let ticketId = ($(this).closest(".ticket-showcase").attr("id"));
      let qc = $(this).find("input[name='qc']");
      let qa = $(this).find("input[name='qa']");
      let qs = $(this).find("input[name='qs']");
      let date = $(this).find("input[name='date']");
      let qError =$(this).find(".qError");
      let dError = $(this).find(".dError");
      let totalPrice = $(this).find(".total-price");
      let wkDeal = $(this).find(".wk-deal");
      let ageDiscount = $(this).find(".age-discount");
      let submitButton = $(this).data("button");
      loading.css("display","block");
      $.ajax({
          
           url: "/mywebsite.com/ticket/handle/"+ticketId,
           type: "POST",
           data: `${submitButton}=ajax&qc=${qc.val()}&qa=${qa.val()}&qs=${qs.val()}&date=${date.val()}`,
           success:function(data) {
               data = JSON.parse(data);
               loading.css("display","none");
               if (data.status === "error") {
                   qError.html(data.q );
                   dError.html(data.date);
               } else {
                   qError.html("");
                   dError.html("");
                   switch(submitButton){
                       case "update-ticket":
                           qc.val(data.ticketDetail.qc);
                           qa.val(data.ticketDetail.qa);
                           qs.val(data.ticketDetail.qs);
                           date.val(data.ticketDetail.date);
                           totalPrice.html("Total price: "+data.ticketDetail.totalPrice+"$");
                           wkDeal.html("Weekend Deal: "+data.ticketDetail.wkDiscount+"%");
                           ageDiscount.html("Age discount: "+data.ticketDetail.ageDiscount+"%");
                           let newProduct = $(`<p id='product${data.ticketDetail.id}'>${data.ticketDetail.name}<span class='price'>${data.ticketDetail.totalPrice}$ (${data.ticketDetail.qc} x children, ${data.ticketDetail.qa} x adults, ${data.ticketDetail.qs} x seniors)</span></p>`);
                           products.appendOrReplace("#product"+data.ticketDetail.id,newProduct);
                           sum.html(data.totalPrice+"$");
                       break;                      
                       case "remove-ticket":
                           let notify = $("#ticket-notify");
                           if (data.tickNum === 0) {
                               notify.addClass("hide");
                               $("#check-out-btn").addClass("hide");
                           } else {
                            notify.html(data.tickNum);
                           }
                           sum.html(data.totalPrice+"$");
                           $("#"+ticketId).remove();
                           $("#product"+ticketId).remove();
                       break;
                   }
               }              
           },
           error: function(req, err){ 
               console.log('my message ' + err);
           }
       });    
   });
   
});


