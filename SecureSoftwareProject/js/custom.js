// $(document).ready(function () {
//     $('#sidebarCollapse').on('click', function () {
//         $('#sidebar').toggleClass('active');
//     });
// });

$(function () {

    function timeChecker() {

        setInterval(function () {
            var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
            timeCompare(storedTimeStamp);
        }, 3000);
    }

    function timeCompare(timeString) {
        var currentTime = new Date();
        var pastTime = new Date(timeString);
        var timeDiff = currentTime - pastTime;
        var minPast = Math.floor((timeDiff / 60000));

        if (minPast > 4) //greater than 1 minute
        {
            sessionStorage.removeItem("lastTimeStamp");
            window.location = "/SecureSoftwareProject/index.php";
            return false;
        } else {
            console.log(currentTime + " - " + pastTime + " - " + minPast + " min past");
        }

    }

    $(document).mousemove(function () {

        var timeStamp = new Date();
        sessionStorage.setItem("lastTimeStamp", timeStamp);
    });

    timeChecker();
});



