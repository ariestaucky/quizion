function enableButton() {
    var selectelem = document.getElementById('quiz');
    var btnelem = document.getElementById('start');
    btnelem.disabled = !selectelem.value;
}

function showForm() {
    var name = document.getElementById("name").value;
    var selopt1 = document.getElementById("inputState").value;
    var selopt2 = document.getElementById("opts1").value;
    var selopt3 = document.getElementById("opts2").value;

    if (name != null && selopt1 != 0 && selopt2 != 0 && selopt3 != 0) {
        console.log(name)
        $.ajax({
            type: "POST",
            url: "/subject",
            // data: { name: name, catagory: selopt1, subject: selopt2, quantity: selopt3 },
            success: function (data) {
                
                console.log(data)
                $('#loadbar').show();
                $('#preparing_quiz').fadeOut();
                setTimeout(function (data) {
                    $('#preparing_quiz').show();
                    $('#loadbar').fadeOut();$('div#preparing_quiz').append(data.page);
                    /* something else */
                }, 1500);
            }
        })
    }

}

$(function () {
    var loading = $('#loadbar').hide();
    $(document)
        .ajaxStart(function () {
            loading.show();
        }).ajaxStop(function () {
            loading.hide();
        });

    $("label.btn").on('click', function () {
        var choice = $(this).find('input:radio').val();
        const userAnswer = choice;
        $('#loadbar').show();
        $('#quiz').fadeOut();
        setTimeout(function () {
            if (currentSlide >= slides.length - 1) {
                // showResults(userAnswer);
                // $(".answer").each(function() {
                //     var selector = `input[name=question${currentSlide}]:checked`;
                //     var selected = $(selector, $(this)).val();

                //     answersList.push({
                //         answer: selected
                //       });
                //       console.log(selector, answersList)
                // });
            } else {
                showNextSlide();
            }
            console.log(currentSlide, slides.length)
            $('#quiz').show();
            $('#loadbar').fadeOut();
            /* something else */
        }, 1500);
    });
});


function showSlide(n) {
    var submitButton = document.getElementById("submit");
    var previousButton = document.getElementById("previous");
    var nextButton = document.getElementById("next");
    var slides = document.querySelectorAll(".slide");

    slides[currentSlide].classList.remove("active-slide");
    slides[n].classList.add("active-slide");
    currentSlide = n;

    if (currentSlide === 0) {
        previousButton.style.display = "none";
    } else {
        previousButton.style.display = "inline-block";
    }

    if (currentSlide === slides.length - 1) {
        console.log('acive')
        nextButton.style.display = "none";
        submitButton.style.display = "inline-block";
    } else {
        nextButton.style.display = "inline-block";
        submitButton.style.display = "none";
    }
}

function showNextSlide() {
    showSlide(currentSlide + 1);
}

function showPreviousSlide() {
    showSlide(currentSlide - 1);
}

// display quiz right away;
const slides = document.querySelectorAll(".slide");
let currentSlide = 0;

showSlide(0);


function showResults(ck) {
    // find selected answer
    var answersList = [];

    const answerContainers = document.getElementById("quiz").querySelectorAll(".answers");
    const answerContainer = answerContainers[currentSlide];
    $(".answer").each(function () {
        var selector = `input[name=question${currentSlide}]:checked`;
        var selected = $(selector, $(this)).val();

        answersList.push({
            answer: selected
        });
        console.log(selector, answersList)
    }),
        console.log(answersList)

    // $.ajax({
    //     type: "POST",
    //     url: "/quiz/result",
    //     data: {data: selector},
    //     // data: { catagory: selopt1, subject: selopt2, quantity: selopt3 },console.log(data)
    //     success: function (data) {
    //         console.log(data)
    //     }
    // })

}

// JavaScript for label effects only
$(window).load(function(){
    $(".col-3 input").val("");
    
    $(".input-effect input").focusout(function(){
        if($(this).val() != ""){
            $(this).addClass("has-content");
        }else{
            $(this).removeClass("has-content");
        }
    })
});