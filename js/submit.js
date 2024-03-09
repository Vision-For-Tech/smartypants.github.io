function submitQuiz() {
    // Get the user's selected answers
    var userAnswers = {
      q1: document.querySelector('input[name="q1"]:checked').value,
      q2: document.querySelector('input[name="q2"]:checked').value,
      q3: document.querySelector('input[name="q3"]:checked').value
    };
  
    // Define the correct answers
    var correctAnswers = {
      q1: "paris",
      q2: "jupiter",
      q3: "lee"
    };
  
    // Calculate the score
    var score = 0;
    for (var question in userAnswers) {
      if (userAnswers[question] === correctAnswers[question]) {
        score++;
      }
    }
  
    // Display the results
    var resultsContainer = document.getElementById("results");
    resultsContainer.innerHTML = "Your score: " + score + " out of 3";
  }
  