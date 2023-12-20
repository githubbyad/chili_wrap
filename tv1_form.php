<?php

$json = file_get_contents('php://input');
$data = json_decode($json);
$dataString = json_encode($data, JSON_PRETTY_PRINT);
$path = "wrapsdata.json";
if ($json != "") {
    file_put_contents($path, $dataString);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;700&display=swap" rel="stylesheet">
    <title>TV - 1 | Form</title>
    <script>
        function createCookie(name, value, days) {
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                var expires = "; expires=" + date.toGMTString();
            } else var expires = "";
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function eraseCookie(name) {
            createCookie(name, "", -1);
        }
    </script>
</head>

<body class="bg-theme p-lg-3">
    <div id="accessDenied" class="d-none text-dark fw-bold d-flex justify-content-center align-items-center" style="height: 100vh;flex-direction: column;">
        <p class="fs-2">Access Denied!</p>
        <div class="w-100 d-block text-center">
            <button class="btn btn-danger" onclick="window.location.reload()">Please try again</button>
        </div>
    </div>
    <script>
        if (!readCookie("loginAccess")) {
            document.body.style.display = "none";
            const url = `wrapsdata.json?v=${Math.random()}`;
            const getData = async () => {
                const obj = await fetch(url);
                const data = await obj.json();
                const vcode = data.code;

                const code = prompt("Enter Security Code to access this page");
                if (code === null || code.trim() == "") {
                    document.querySelector(".container").remove();
                    document.querySelector("#accessDenied").classList.remove("d-none");
                    document.body.style.display = "block";
                } else if (code.trim() != "" && code != null) {
                    if (code.trim() == vcode) { // passed
                        createCookie("loginAccess", true);
                        document.body.style.display = "block";
                    } else {
                        document.querySelector(".container").remove();
                        document.querySelector("#accessDenied").classList.remove("d-none");
                        document.body.style.display = "block";
                    }
                }
            }
            getData();
        }
    </script>

    <div class="container col-lg-6 bg-body rounded px-0 mb-5 shadow border-1">

        <h1 class="text-theme py-3 text-center rounded-top fw-bold" style="background-color:var(--themeColor1);border-bottom: 2px solid var(--themeColor2) !important;">TV - 1</h1>

        <p class="lastChanges text-muted px-3">Last Modified: <span></span></p>

        <form class="p-3 mt-3">

            <div class="row">

                <!--general-->
                <div class="col-lg-12 d-block rounded mb-4">
                    <p class="fw-bold mb-0 position-relative">
                        <span class="text-light py-2 px-3 d-inline-block rounded-top position-relative" style="left:1rem;background: linear-gradient(to bottom, var(--themeColor1), var(--themeColor2));">Slider</span>
                    </p>
                    <div class="d-block-w-100 border border-2 border-dark pt-3 rounded" style="background-color: #f4f4f4">
                        <div class="mb-3 px-3">
                            <label class="form-label">Images:</label>
                            <textarea class="form-control" id="images" style="height: 100px"></textarea>
                            <div class="form-text">Upload image in "Files" icon of "bulletlink.com" and place file name with extenstion here.</div>
                        </div>
                        <div class="mb-3 px-3">
                            <label class="form-label">Interval (seconds):</label>
                            <input type="text" class="form-control" id="interval">
                            <div class="form-text">Page refresh required for inteveral to work.</div>
                        </div>
                    </div>
                </div>
            </div>





            <input type="hidden" id="lastModified">

            <center class="mb-3 border-top pt-4 mt-3">
                <button id="submit" type="submit" class="btn btn-primary px-4 py-3 me-3">Submit</button>
                <span onclick="history.back()" class="btn btn-danger px-4 py-3 ">Cancel</span>
            </center>

        </form>
    </div>

    <script>
        const url = `wrapsdata.json?v=${Math.random()}`;
        let lastModified = 0;

        const getData = async () => {
            const obj = await fetch(url);
            const data = await obj.json();
            lastModified = data.lastModified;
            let tv = data.tv1;

            // last modifed
            document.querySelector(".lastChanges span").innerText = data.lastModified;
            document.querySelector("#lastModified").value = new Date().toLocaleString();

            // slider
            document.querySelector("#interval").value = tv.interval;

            const imageList = () => {
                let list = "";
                tv.images.forEach(w => list += `${w}\n`);
                return list;
            }
            document.querySelector("#images").value = imageList();


            // form submit
            document.forms[0].addEventListener("submit", (e) => {
                e.preventDefault();
                document.querySelector("#submit").setAttribute("disabled", true);

                data.lastModified = document.querySelector("#lastModified").value.trim();

                tv.interval = document.querySelector("#interval").value.trim();
                tv.images = document.querySelector("#images").value.split("\n").filter(l => l.trim() != "");

                // upload data to json file
                async function uploadData() {
                    const response = await fetch("", {
                        method: "POST",
                        mode: "cors",
                        cache: "no-cache",
                        credentials: "same-origin",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        redirect: "follow",
                        referrerPolicy: "no-referrer",
                        body: JSON.stringify(data),
                    });
                    if (response.ok) {
                        // alert("Success! Data has been submitted.");
                        location.href = "list.htm";
                    }
                }

                uploadData();
            });


        };
        getData();
    </script>
    <style>
        :root {
            --themeColor1: #99fe19;
            --themeColor2: rgb(30, 109, 1);
        }

        .border-dark {
            border-color: var(--themeColor2) !important;
        }

        .styles_active {
            color: var(--themeColor2) !important;
        }

        .bg-theme {
            background-color: #0c2602;
        }

        .text-theme {
            color: var(--themeColor2) !important;
        }

        .border-top {
            border-color: var(--themeColor2) !important;
        }

        .form-control,
        .form-select {
            border: 1px solid var(--themeColor2);
        }

        .form-label {
            font-weight: bold;
            color: var(--themeColor2);
        }

        .form-text {
            color: #333;
            font-style: italic;
        }

        a {
            text-decoration: none;
        }

        .fs-7 {
            font-size: 0.8rem;
        }
    </style>
</body>

</html>