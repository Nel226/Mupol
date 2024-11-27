$(function(){
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        stepsOrientation: "vertical",
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Back Step',
            next : 'Next',
            finish : 'Submit',
            current : ''
        },

        onStepChanged: function (event, currentIndex, priorIndex) {
            if (currentIndex > 0) {
                $(".actions a[href='#previous']").css({
                    display: "inline-block",
                    visibility: "visible",
                    opacity: 1
                });
            }
        }
    })
});