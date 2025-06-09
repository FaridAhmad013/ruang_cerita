//Wizard Init

$("#wizard").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "none",
    titleTemplate: '#title#',
    onFinished: function() {
        alert("Form successfully submitted!");
        location.reload();
    }
});

var wizard = $("#wizard")

//Form control

$('[data-step="next"]').on('click', function() {
    wizard.steps('next');
});

$('[data-step="previous"]').on('click', function() {
    wizard.steps('previous');
});

$('[data-step="finish"]').on('click', function() {
    wizard.steps('finish');
});

$("#wizard-tabs").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "none",
    // Disables the finish button (required if pagination is enabled)
    enableFinishButton: false, 
    // Disables the next and previous buttons (optional)
    enablePagination: false, 
    // Enables all steps from the begining
    enableAllSteps: false, 
    // Removes the number from the title
    titleTemplate: '#title#'
});

