// Set the date we're counting down to
const countDownDate = new Date("Aug 5, 2025 00:00:00");

// Calling countdown function to prevent 1s interval
countdown();

// Update the countdown every 1 second
const x = setInterval(countdown,1000);

function countdown () {
    // Get today's date and time
    const now = new Date();

    // Find the distance between now and the countdown date
    const distance = countDownDate.getTime() - now.getTime();

    // For leap years
    let addedDays;
    addedDays = addDays();

    // Time calculations for days, hours, minutes and seconds
    const years = Math.floor((distance / (1000 * 60 * 60 * 24)) / 365);
    const days = Math.floor(distance % (1000 * 60 * 60 * 24 * 365) / (1000 * 60 * 60 * 24)) + addedDays;
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    // Output the result in an element with id="demo"
    document.getElementById("countdown").innerHTML = `Nächste Wahl: ${years} Jahre ${days} Tage ${hours} Std ${minutes} Min`;

    // Text shown when countdown is over
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "HEUTE SIND WAHLEN!";
    }
}

// function for adding days in case of a leap year
function addDays() {
    const now = new Date();
    let thisYear = now.getFullYear();
    let countdownYear = countDownDate.getFullYear();
    let daysToAdd = 0;

    if(now.getMonth() > 2) {
        thisYear++;
    }
    if(countDownDate.getMonth() < 3 && countDownDate.getDay() !== 28) {
        countdownYear--;
    }

    for(let i = thisYear; i <= countdownYear; i++) {
        if(i % 4 === 0) {
            daysToAdd++;
        }
    }
    return daysToAdd;
}