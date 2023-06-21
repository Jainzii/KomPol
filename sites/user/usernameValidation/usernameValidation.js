const usernameInput = document.getElementsByClassName("usernameInput").item(0);

async function compareResults() {
    const input = this.value;
    if (input !== ""){
        $.ajax({
            type: "GET",
            url: "../usernameValidation/usernameValidation.php?username=" + input,
            success: function(data) {
                let feedbackField = document.getElementById("feedback");
                console.log(feedbackField);
                if (feedbackField === null || feedbackField === undefined) {
                    feedbackField = document.createElement("p");
                    feedbackField.id = "feedback";
                    document.getElementById("feedbackContainer").appendChild(feedbackField);
                }

                if (data) {
                    feedbackField.innerHTML = "Dieser Benutzername ist verfügbar!";
                } else {
                    feedbackField.innerHTML = "Benutzername leider vergeben.";
                }
            }
        });
    }
}

usernameInput.onkeyup = compareResults;