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
    <title>TV - 3 | Form</title>
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

        <h1 class="text-theme py-3 text-center rounded-top fw-bold" style="background-color:var(--themeColor1);border-bottom: 2px solid var(--themeColor2) !important;">TV - 3</h1>

        <p class="lastChanges text-muted px-3">Last Modified: <span></span></p>

        <form class="p-3 mt-3">

            <div class="row">

                <!--general-->
                <div class="col-lg-12 d-block rounded mb-4">
                    <p class="fw-bold mb-0 position-relative">
                        <span class="text-light py-2 px-3 d-inline-block rounded-top position-relative" style="left:1rem;background: linear-gradient(to bottom, var(--themeColor1), var(--themeColor2));">General</span>
                    </p>
                    <div class="d-block-w-100 border border-2 border-dark pt-3 rounded" style="background-color: #f4f4f4">
                        <div class="mb-3 px-3">
                            <label class="form-label">Backgound Color:</label>
                            <input type="text" class="form-control" id="backgroundColor">
                            <div id="emailHelp" class="form-text">Change the color by placing Hex color code such as "#ff0000".<br>Site ref: <a href="https://flatuicolors.com/" class="text-muted fw-bold" target="_blank">"flatuicolors.com"</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--header-->
                <div class="col-lg-6 d-block rounded mb-4">
                    <p class="fw-bold mb-0 position-relative">
                        <span class="text-light py-2 px-3 d-inline-block rounded-top position-relative" style="left:1rem;background: linear-gradient(to bottom, var(--themeColor1), var(--themeColor2));">Header</span>
                    </p>
                    <div class="d-block-w-100 border border-2 border-dark pt-3 rounded" style="background-color: #f4f4f4">
                        <div class="mb-3 px-3">
                            <label class="form-label">Text:</label>
                            <input type="text" class="form-control" id="headerText">
                        </div>
                        <div class="styles">
                            <p class="styles_active px-3 text-dark fw-bold fst-italic" style="cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>Click to edit styles</p>
                            <div class="style_on d-none">
                                <div class="mb-3 px-3">
                                    <label class="form-label">Background Color:</label>
                                    <input type="text" class="form-control" id="headerBackgroundColor">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Color:</label>
                                    <input type="text" class="form-control" id="headerColor">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Font Size:</label>
                                    <input type="text" class="form-control" id="headerFontSize">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Line Height:</label>
                                    <input type="text" class="form-control" id="headerHeight">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Text Alignment:</label>
                                    <select class="form-select" id="headingAlignment">
                                        <option value="left">Left</option>
                                        <option value="center">Center</option>
                                        <option value="right">Right</option>
                                    </select>
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Padding Left:</label>
                                    <input type="text" class="form-control" id="headerLeft">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Margin Bottom:</label>
                                    <input type="text" class="form-control" id="headerMarginBottom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--all-wraps-->
                <div class="col-lg-6 d-block rounded mb-4">
                    <p class="fw-bold mb-0 position-relative">
                        <span class="text-light py-2 px-3 d-inline-block rounded-top position-relative" style="left:1rem;background: linear-gradient(to bottom, var(--themeColor1), var(--themeColor2));">All Wraps</span>
                    </p>
                    <div class="d-block-w-100 border border-2 border-dark pt-3 rounded" style="background-color: #f4f4f4">
                        <div class="mb-3 px-3">
                            <label class="form-label">List:</label>
                            <textarea class="form-control" id="allWrapList" style="height: 100px"></textarea>
                            <div class="form-text">Add "@XX" in the end to set price, where XX is price<br>Add "--" before wrap name to set as unavailable.</div>
                        </div>
                        <div class="styles">
                            <p class="styles_active px-3 text-dark fw-bold fst-italic" style="cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>Click to edit styles</p>
                            <div class="style_on d-none">
                                <div class="mb-3 px-3">
                                    <label class="form-label">Width:</label>
                                    <input type="text" class="form-control" id="allWrapWidth">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Background Color:</label>
                                    <input type="text" class="form-control" id="allWrapBackgroundColor">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Color:</label>
                                    <input type="text" class="form-control" id="allWrapColor">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Font Size:</label>
                                    <input type="text" class="form-control" id="allWrapFontSize">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Line Height:</label>
                                    <input type="text" class="form-control" id="allWrapGapLine">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Margin Bottom:</label>
                                    <input type="text" class="form-control" id="allWrapMarginBottom">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Gap Between Item & Price:</label>
                                    <input type="text" class="form-control" id="allWrapGapBetween">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Price Background Color:</label>
                                    <input type="text" class="form-control" id="allWrapPriceBackGroundColor">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Price Color:</label>
                                    <input type="text" class="form-control" id="allWrapPriceColor">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Price Line Height:</label>
                                    <input type="text" class="form-control" id="allWrapPriceHeight">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--more-->
                <div class="col-lg-6 d-block rounded mb-4">
                    <p class="fw-bold mb-0 position-relative">
                        <span class="text-light py-2 px-3 d-inline-block rounded-top position-relative" style="left:1rem;background: linear-gradient(to bottom, var(--themeColor1), var(--themeColor2));">Coming Soon</span>
                    </p>
                    <div class="d-block-w-100 border border-2 border-dark pt-3 rounded" style="background-color: #f4f4f4">
                        <div class="mb-3 px-3">
                            <label class="form-label">Text</label>
                            <input type="text" class="form-control" id="moreText">
                        </div>
                        <div class="styles">
                            <p class="styles_active px-3 text-dark fw-bold fst-italic" style="cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>Click to edit styles</p>
                            <div class="style_on d-none">
                                <div class="mb-3 px-3">
                                    <label class="form-label">Active:</label>
                                    <select class="form-select" id="moreStatus">
                                        <option value="block">Yes</option>
                                        <option value="none">No</option>
                                    </select>
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Space from Bottom:</label>
                                    <input type="text" class="form-control" id="moreBottom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--footer-->
                <div class="col-lg-6 d-block rounded mb-4">
                    <p class="fw-bold mb-0 position-relative">
                        <span class="text-light py-2 px-3 d-inline-block rounded-top position-relative" style="left:1rem;background: linear-gradient(to bottom, var(--themeColor1), var(--themeColor2));">Footer</span>
                    </p>
                    <div class="d-block-w-100 border border-2 border-dark pt-3 rounded" style="background-color: #f4f4f4">
                        <div class="mb-3 px-3">
                            <label class="form-label">Text (Right Side):</label>
                            <input type="text" class="form-control" id="footerTextRight">
                        </div>
                        <div class="mb-3 px-3">
                            <label class="form-label">Text (Left Side):</label>
                            <input type="text" class="form-control" id="footerTextLeft">
                        </div>
                        <div class="styles">
                            <p class="styles_active px-3 text-dark fw-bold fst-italic" style="cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>Click to edit styles</p>
                            <div class="style_on d-none">
                                <div class="mb-3 px-3">
                                    <label class="form-label">Active:</label>
                                    <select class="form-select" id="footerStatus">
                                        <option value="block">Yes</option>
                                        <option value="none">No</option>
                                    </select>
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Background Color:</label>
                                    <input type="text" class="form-control" id="footerBackgroundColor">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Color:</label>
                                    <input type="text" class="form-control" id="footerColor">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Font Size:</label>
                                    <input type="text" class="form-control" id="footerFontSize">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Line Height:</label>
                                    <input type="text" class="form-control" id="footerHeight">
                                </div>
                                <div class="mb-3 px-3">
                                    <label class="form-label">Space from Bottom:</label>
                                    <input type="text" class="form-control" id="footerBottom">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <input type="hidden" id="lastModified">

            <center class="mb-3 border-top pt-4 mt-3">
                <button id="submit" type="submit" class="btn btn-primary px-4 py-3 me-3">Submit</button>
                <span onclick="history.back()" class="btn btn-danger px-4 py-3">Cancel</span>
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
            let tv = data.tv3;

            // last modifed
            document.querySelector(".lastChanges span").innerText = data.lastModified;
            document.querySelector("#lastModified").value = new Date().toLocaleString();

            // general
            document.querySelector("#backgroundColor").value = tv.backgroundColor;

            // header
            document.querySelector("#headerText").value = tv.header.text;
            document.querySelector("#headerBackgroundColor").value = tv.header.backgroundColor;
            document.querySelector("#headerColor").value = tv.header.color;
            document.querySelector("#headerFontSize").value = tv.header.fontSize;
            document.querySelector("#headerHeight").value = tv.header.height;
            document.querySelector("#headerLeft").value = tv.header.left;
            document.querySelector("#headerMarginBottom").value = tv.header.marginBottom;
            document.querySelector("#headingAlignment").value = tv.header.alignment;

            // footer
            document.querySelector("#footerTextLeft").value = tv.footer.textLeft;
            document.querySelector("#footerTextRight").value = tv.footer.textRight;
            document.querySelector("#footerBackgroundColor").value = tv.footer.backgroundColor;
            document.querySelector("#footerColor").value = tv.footer.color;
            document.querySelector("#footerFontSize").value = tv.footer.fontSize;
            document.querySelector("#footerHeight").value = tv.footer.height;
            document.querySelector("#footerBottom").value = tv.footer.bottom;
            document.querySelector("#footerStatus").value = tv.footer.status;

            // more
            document.querySelector("#moreText").value = tv.more.text;
            document.querySelector("#moreStatus").value = tv.more.status;
            document.querySelector("#moreBottom").value = tv.more.bottom;

            // all-wraps
            const wrapsList = () => {
                let list = "";
                tv.allWraps.list.forEach(w => list += `${w}\n`);
                return list;
            }
            document.querySelector("#allWrapList").value = wrapsList();
            document.querySelector("#allWrapList").style.height = `${document.querySelector("#allWrapList").scrollHeight}px`;
            document.querySelector("#allWrapColor").value = tv.allWraps.color;
            document.querySelector("#allWrapPriceColor").value = tv.allWraps.price.color;
            document.querySelector("#allWrapPriceBackGroundColor").value = tv.allWraps.price.backgroundColor;
            document.querySelector("#allWrapPriceHeight").value = tv.allWraps.price.height;
            document.querySelector("#allWrapBackgroundColor").value = tv.allWraps.backgroundColor;
            document.querySelector("#allWrapWidth").value = tv.allWraps.width;
            document.querySelector("#allWrapFontSize").value = tv.allWraps.fontSize;
            document.querySelector("#allWrapGapLine").value = tv.allWraps.gap.line;
            document.querySelector("#allWrapGapBetween").value = tv.allWraps.gap.between;
            document.querySelector("#allWrapMarginBottom").value = tv.allWraps.marginBottom;

            // form submit
            document.forms[0].addEventListener("submit", (e) => {
                e.preventDefault();
                document.querySelector("#submit").setAttribute("disabled", true);

                data.lastModified = document.querySelector("#lastModified").value.trim();

                tv.backgroundColor = document.querySelector("#backgroundColor").value.trim();

                tv.header.text = document.querySelector("#headerText").value.trim();
                tv.header.color = document.querySelector("#headerColor").value.trim();
                tv.header.backgroundColor = document.querySelector("#headerBackgroundColor").value.trim();
                tv.header.fontSize = document.querySelector("#headerFontSize").value.trim();
                tv.header.height = document.querySelector("#headerHeight").value.trim();
                tv.header.left = document.querySelector("#headerLeft").value.trim();
                tv.header.marginBottom = document.querySelector("#headerMarginBottom").value.trim();
                tv.header.alignment = document.querySelector("#headingAlignment").value.trim();

                tv.footer.textLeft = document.querySelector("#footerTextLeft").value.trim();
                tv.footer.textRight = document.querySelector("#footerTextRight").value.trim();
                tv.footer.backgroundColor = document.querySelector("#footerBackgroundColor").value.trim();
                tv.footer.color = document.querySelector("#footerColor").value.trim();
                tv.footer.fontSize = document.querySelector("#footerFontSize").value.trim();
                tv.footer.height = document.querySelector("#footerHeight").value.trim();
                tv.footer.bottom = document.querySelector("#footerBottom").value.trim();
                tv.footer.status = document.querySelector("#footerStatus").value.trim();

                tv.more.status = document.querySelector("#moreStatus").value.trim();
                tv.more.text = document.querySelector("#moreText").value.trim();
                tv.more.bottom = document.querySelector("#moreBottom").value.trim();

                tv.allWraps.list = document.querySelector("#allWrapList").value.split("\n").filter(l => l.trim() != "");
                tv.allWraps.color = document.querySelector("#allWrapColor").value.trim();
                tv.allWraps.price.color = document.querySelector("#allWrapPriceColor").value.trim();
                tv.allWraps.price.backgroundColor = document.querySelector("#allWrapPriceBackGroundColor").value.trim();
                tv.allWraps.price.height = document.querySelector("#allWrapPriceHeight").value.trim();
                tv.allWraps.backgroundColor = document.querySelector("#allWrapBackgroundColor").value.trim();
                tv.allWraps.width = document.querySelector("#allWrapWidth").value.trim();
                tv.allWraps.fontSize = document.querySelector("#allWrapFontSize").value.trim();
                tv.allWraps.gap.line = document.querySelector("#allWrapGapLine").value.trim();
                tv.allWraps.gap.between = document.querySelector("#allWrapGapBetween").value.trim();
                tv.allWraps.marginBottom = document.querySelector("#allWrapMarginBottom").value.trim();

                // tv.allSouces.list = document.querySelector("#allSouceList").value.split("\n").filter(l => l.trim() != "");
                // tv.allSouces.color = document.querySelector("#allSouceColor").value.trim();
                // tv.allSouces.backgroundColor = document.querySelector("#allSouceBackgroundColor").value.trim();
                // tv.allSouces.fontSize = document.querySelector("#allSouceFontSize").value.trim();
                // tv.allSouces.gap = document.querySelector("#allSouceGap").value.trim();

                // tv.selectSouce.text = document.querySelector("#selectSouceText").value.trim();
                // tv.selectSouce.color = document.querySelector("#selectSouceColor").value.trim();
                // tv.selectSouce.fontSize = document.querySelector("#selectSouceFontSize").value.trim();
                // tv.selectSouce.gap = document.querySelector("#selectSouceGap").value.trim();
                // tv.selectSouce.left = document.querySelector("#selectSouceLeft").value.trim();

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

        // show-styles
        document.querySelectorAll(".styles_active").forEach(s => {
            s.addEventListener("click", () => {
                s.classList.add("d-none");
                s.nextElementSibling.classList.remove("d-none");
            })
        });
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

        .form-text {
            color: #333;
            font-style: italic;
        }

        .form-label {
            font-weight: bold;
            color: var(--themeColor2);
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