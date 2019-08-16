$(document).ready(function () {
  
      //validation
     $('input, select').tooltipster({
         trigger: 'custom',
         onlyOne: false,
         position: 'right',
         theme: 'tooltipster-light'
       });
	

        $("#form").validate({
            errorPlacement: function (error, element) {
                var lastError = $(element).data('lastError'),
                    newError = $(error).text('Campo Requerido');

                $(element).data('lastError', newError);

                if(newError !== '' && newError !== lastError){
                    $(element).tooltipster('content', newError);
                    $(element).tooltipster('show');
                }
            },
            success: function (label, element) {
                $(element).tooltipster('hide');
            }
        });

  
    /* This code handles all of the navigation stuff.
    ** Probably leave it. Credit to https://bootsnipp.com/snippets/featured/form-wizard-and-validation
    */
    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            allPreviousBtn = $('.previousBtn'),
            allPreviousBtn2 = $('.previousBtn2');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            $('input, select').tooltipster("hide");
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    /* Handles validating using jQuery validate.
    */
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input"),
            isValid = true;

        //Loop through all inputs in this form group and validate them.
        for(var i=0; i<curInputs.length; i++){
            if (!$(curInputs[i]).valid()){
                isValid = false;
            }
        }

        if (isValid){
            //Progress to the next page.
          nextStepWizard.removeClass('disabled').trigger('click');    
            // # # # AJAX REQUEST HERE # # # 
            
            /*
            Theoretically, in order to preserve the state of the form should the worst happen, we could use an ajax call that would look something like this:
            
            //Prepare the key-val pairs like a normal post request.
            var fields = {};
            for(var i= 0; i < curInputs.length; i++){
              fields[$(curInputs[i]).attr("name")] = $(curInputs[i]).attr("name").val();
            }
            
            $.post(
                "location.php",
                fields,
                function(data){
                  //Silent success handler.
                }                
            );
            
            //The FINAL button on last page should have its own logic to finalize the enrolment.
            */
        }
    });
    
     allPreviousBtn.click(function(){
        var curStep2 = $(this).closest(".setup-content"),
            curStepBtn2 = curStep2.attr("id"),
            nextStepWizard2 = $('div.setup-panel div a[href="#' + curStepBtn2 + '"]').parent().prev().children("a"),
            curInputs2 = curStep2.find("input"),
            isValid2 = true;

        //Loop through all inputs in this form group and validate them.
        for(var i=0; i<curInputs2.length; i++){
            if (!$(curInputs2[i]).valid()){
                isValid2 = false;
            }
        }

        if (isValid2){
            //Progress to the next page.
          nextStepWizard2.removeClass('disabled').trigger('click');    
            // # # # AJAX REQUEST HERE # # # 
            
            /*
            Theoretically, in order to preserve the state of the form should the worst happen, we could use an ajax call that would look something like this:
            
            //Prepare the key-val pairs like a normal post request.
            var fields = {};
            for(var i= 0; i < curInputs.length; i++){
              fields[$(curInputs[i]).attr("name")] = $(curInputs[i]).attr("name").val();
            }
            
            $.post(
                "location.php",
                fields,
                function(data){
                  //Silent success handler.
                }                
            );
            
            //The FINAL button on last page should have its own logic to finalize the enrolment.
            */
        }
    });
    
    allPreviousBtn2.click(function(){
        var curStep3 = $(this).closest(".setup-content"),
            curStepBtn3 = curStep3.attr("id"),
            nextStepWizard3 = $('div.setup-panel div a[href="#' + curStepBtn3 + '"]').parent().prev().children("a"),
            curInputs3 = curStep3.find("input"),
            isValid3 = true;

        //Loop through all inputs in this form group and validate them.
        for(var i=0; i<curInputs3.length; i++){
            if (!$(curInputs3[i]).valid()){
                isValid3 = false;
            }
        }

        if (isValid3){
            //Progress to the next page.
          nextStepWizard3.removeClass('disabled').trigger('click');    
            // # # # AJAX REQUEST HERE # # # 
            
            /*
            Theoretically, in order to preserve the state of the form should the worst happen, we could use an ajax call that would look something like this:
            
            //Prepare the key-val pairs like a normal post request.
            var fields = {};
            for(var i= 0; i < curInputs.length; i++){
              fields[$(curInputs[i]).attr("name")] = $(curInputs[i]).attr("name").val();
            }
            
            $.post(
                "location.php",
                fields,
                function(data){
                  //Silent success handler.
                }                
            );
            
            //The FINAL button on last page should have its own logic to finalize the enrolment.
            */
        }
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
    
});