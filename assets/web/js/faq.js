window.addEventListener('load', function() {
    var questions = document.getElementsByClassName('question')
    var arrow = document.querySelector('#arrow')
    
    for (var i = 0; i < questions.length; i++) {
      questions[i].addEventListener('click', function() {
        var answer = this.nextElementSibling;
        if (answer.style.display === 'none') {
          answer.style.display = 'block';

          arrow.classList.remove("fas", "fa-chevron-down");
          arrow.classList.add("fa", "fa-chevron-up");

        } else {
          answer.style.display = 'none';

          arrow.classList.remove("fa", "fa-chevron-up");
          arrow.classList.add("fas", "fa-chevron-down");
        }
      });
    }
  });
  
  