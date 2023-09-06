<!DOCTYPE html>
<html>

<head>

    <title>Horse Race</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
</head>

<body>
    <div class="container-race">
        <div class="container-head ps-4 pt-4">
            <button id="StartBtn" class="btn btn-primary">Start</button>
            <button id="ResetBtn" class="btn btn-warning">Reset</button>
        </div>

        <div class="container-body">

            <!-- paard 1 -->
            <div class="line">
                <img src="images/backgroundgrass.png" alt="" id="grass1">

                <div class="horse" id="horse1">
                    <img id="horse1Img" src="images/horse 1 standing.png" alt="">
                </div>
                <div class="horseName">
                    <h1>Stormy</h1>
                </div>
            </div>

            <!-- paard 2 -->
            <div class="line">
                <img src="images/backgroundgrass.png" alt="" id="grass2">

                <div class="horse" id="horse2">
                    <img id="horse2Img" src="images/horse 2 standing.png" alt="">
                </div>
                <div class="horseName">
                    <h1>Unicorn</h1>
                </div>
            </div>

            <!-- paard 3 -->
            <div class="line">
                <img src="images/backgroundgrass.png" alt="" id="grass3">

                <div class="horse" id="horse3">
                    <img id="horse3Img" src="images/horse 3 standing.png" alt="">
                </div>
                <div class="horseName">
                    <h1>Lucky</h1>
                </div>
            </div>

            <!-- paard 4 -->
            <div class="line">
                <img src="images/backgroundgrass.png" alt="" id="grass4">

                <div class="horse" id="horse4">
                    <img id="horse4Img" src="images/horse 4 standing.png" alt="">
                </div>
                <div class="horseName">
                    <h1>Shadow</h1>
                </div>
            </div>

            <!-- paard 5 -->
            <div class="line">
                <img src="images/backgroundgrass.png" alt="" id="grass5">

                <div class="horse" id="horse5">
                    <img id="horse5Img" src="images/horse 5 standing.png" alt="">
                </div>
                <div class="horseName">
                    <h1>Bliksem</h1>
                </div>
            </div>

            <img src="images/finishline.jpg" id="finishline" alt="">
        </div>
    </div>

    <!-- winningHorse modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-xl modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Winner</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="winnerHorseImg" class="ms-0 me-0 w-75 h-75">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Random function om snelheid van paarden te bepalen
        function random(min, max) {
            return Math.floor(Math.random() * (max - min) + min);
        }

        var winnerHorse = [];

        var winningSound = new Audio("sounds/winning.wav");
        var horseSound = new Audio("sounds/horseRunningSound.wav");

        // Als er op de start button wordt geklikt
        $("#StartBtn").click(function() {

            horseSound.play();

            // Als het horseSound stopt, weer opnieuw afspelen
            if (horseSound.duration > 0 && !horseSound.paused) {
                console.log("playing horseSound")
                horseSound.play();
            }

            // Reset button op disabled zetten
            $("#ResetBtn").attr("disabled", true);

            // Alle paarden naar gif veranderen
            for (let i = 1; i <= 5; i++) {
                $("#horse" + i + "Img").attr("src", "gifs/horse " + i + " running.gif");

            }
            // Start button op disabled zetten
            $("#StartBtn").attr("disabled", true);

            // Border van de paarden weghalen
            $(".horse").css("border", "none");

            // Paarden laten rennen
            let raceInterval = setInterval(function() {

                for (let i = 1; i <= 5; i++) {
                    var horsePosition = $("#horse" + i).position().left;
                    var newHorsePosition = horsePosition + random(0, 25);
                    $("#horse" + i).css("left", newHorsePosition + "px");

                    // Als het paard over de finish is
                    if (newHorsePosition >= 1640) {

                        // horseSound stoppen en eerste paard winnerHorse array pushen
                        horseSound.pause();
                        winnerHorse.push((i));

                        // Interval stoppen 
                        clearInterval(raceInterval);
                        winningSound.play();

                        // Winner paard laten zien met modal en alle paarden weer naar standing veranderen
                        $("#winnerHorseImg").attr("src", "images/horse " + i + " standing.png");
                        $("#exampleModal").modal("show");
                        for (let i = 1; i <= 5; i++) {
                            $("#horse" + i + "Img").attr("src", "images/horse " + i + " standing.png");
                        }
                        // Reset button weer activeren
                        $("#ResetBtn").attr("disabled", false);
                    }
                }
            }, 40);
        });

        // Als er op de reset button wordt geklikt
        $("#ResetBtn").click(function() {

            // Alle paarden weer naar standing veranderen
            $("#StartBtn").attr("disabled", false);
            $(".horse").css("left", "0");
            $(".horse").css("border-right", "1px solid red");
            winnerHorse = [];
        });
    </script>


</body>

</html>