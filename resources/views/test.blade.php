<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;700&display=swap" rel="stylesheet">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/bootstrap-icons.min.css">

    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>

    <style>

    .container_box {
        border-radius: 10px;
        border-top: 3px solid #4363EC;
        background: #FFF;
        box-shadow: 0px 0px 15px 0px rgba(202, 209, 242, 0.22);
        max-width: 756px;
        height: 504px;
        flex-shrink: 0;
        padding-top: 15px;
    }

    .vote_page_title {
        color: #4363EC;
        font-family: Rajdhani;
        font-size: 28px;
        font-style: normal;
        font-weight: 700;
        line-height: 28px;
        /* 100% */
    }

    .Make_a {
        color: #000;
        font-family: Rajdhani;
        font-size: 24px;
        font-style: normal;
        font-weight: 500;
        line-height: 18px;
        /* 75% */
    }

    .option-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        border-radius: 8px;
        border: 1px solid #4363EC;
        background: #FFF;
        padding: 10px;
    }

    .option-number {
        width: 26px;
        height: 26px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #4363EC;
        color: #FFF;
        text-align: center;
        font-family: Rajdhani;
        font-size: 18px;
        font-style: normal;
        font-weight: 700;
        line-height: 26px;
        margin-right: 10px;
    }

    .option-label {
        color: #535974;
        font-family: Rajdhani;
        font-size: 20px;
        font-style: normal;
        font-weight: 500;
        line-height: 18px;
        flex-grow: 1;
    }

    .option-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        border-radius: 8px;
        border: 1px solid #4363EC;
        background: #FFF;
        padding: 10px;
    }

    .option-number {
        width: 26px;
        height: 26px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #4363EC;
        color: #FFF;
        text-align: center;
        font-family: Rajdhani;
        font-size: 18px;
        font-style: normal;
        font-weight: 700;
        line-height: 26px;
        margin-right: 10px;
    }

    .option-label {
        color: #535974;
        font-family: Rajdhani;
        font-size: 20px;
        font-style: normal;
        font-weight: 500;
        line-height: 18px;
        flex-grow: 1;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        color: #535974;
        font-family: Rajdhani;
        font-size: 20px;
        font-style: normal;
        font-weight: 500;
        line-height: 18px;
        text-transform: capitalize;
    }

    .checkbox-label input[type="radio"] {
        display: none;
    }

    .checkbox-label .checkbox-icon {
        position: relative;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid #4363EC;
        background-color: #FFF;
    }

    .checkbox-label input[type="radio"]:checked+.checkbox-icon::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #0FA31E;
        display: block;
        color: #0FA31E;
        font-family: Font Awesome 6 Free;
        font-size: 20px;
        font-style: normal;
        font-weight: 900;
        line-height: 20px;
        /* 100% */
        text-transform: capitalize;
    }

    .sheare_link {
        color: #4363EC;
        font-family: Rajdhani;
        font-size: 20px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    .inline-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .vote_page_count,
    .vote_page_counts {
        color: #222A46;
        font-family: Rajdhani;
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 28px;
        /* 155.556% */
    }

    .vote_page_title_vote_page_count {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .vote_page_title,
    .vote_page_count {
        margin-right: 10px;
    }

    .vote_page_counts {
        display: inline;
        margin-right: 10px;
    }

    .vote_percentage {
        display: inline;
        text-align: right;
    }

    .vote_result_row {
        display: grid;
        grid-template-columns: 1fr auto auto;
        align-items: center;
        gap: 10px;
    }

    .vote_page_counts {
        margin: 0;
    }

    .vote_percentage {
        justify-self: end;
    }

    /* Custom CSS for the slider container */
    .custom-range-container {
        width: 100%;
        height: 20px;
        background-color: #FFF;
        border-radius: 5px;
        margin-bottom: 10px;
        position: relative;
        overflow: hidden;
        padding: 3px;
        border-radius: 10px;
        border: 1px solid #DCE0F4;
    }

    /* Custom CSS for the filled part of the slider */
    .custom-range-fill {
        height: 100%;
        border-radius: 10px;

    }

    /* Background colors for each difficulty level */
    .super-easy .custom-range-fill {
        background: #4BC0C0;
    }

    .somewhat-easy .custom-range-fill {
        background: #FFCD56;
    }

    .moderate .custom-range-fill {
        background: #FF6384;
    }

    .quite-difficult .custom-range-fill {
        background: #FF9F40;
    }

    .vote_percentage {
        color: #4363EC;
        text-align: right;
        font-family: Rajdhani;
        font-size: 16px;
        font-style: normal;
        font-weight: 700;
        line-height: 22px;
        /* 137.5% */
    }

    .circle {
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: conic-gradient(#4BC0C0 0% 40%,
                /* 40% - #4BC0C0 color */
                #FFCD56 40% 70%,
                /* 30% - #4BC0C0 color */
                #FF6384 70% 90%,
                /* 20% - #FF6384 color */
                #FF9F40 90% 100%
                /* 10% - #FF9F40 color */
            );
    }

    .col_chart {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* Set the height of the column to occupy the full viewport height */
    }

    .col_chart_ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;

    }

    .col_chart_li {
        display: flex;
        align-items: center;
        margin: 8px;
        font-size: 18px;
    }

    .bi {
        margin-right: 8px;
    }

    .col_criclr {
        display: inline-flex;
        align-items: center;
        /* Center the circle vertically */
    }

    .icon_chart_Super {
        color: #4BC0C0;
    }

    .icon_chart_Somewhat {
        color: #FFCD56;
    }

    .icon_chart_Moderate {
        color: #FF6384;
    }

    .icon_chart_Quite {
        color: #FF9F40;
    }
    </style>
</head>

<body>
    <div class="container container_box mt-5">
        <span class="vote_page_title pt-5">How easy is it to embed a Poll?</span><br>
        <span class="vote_page_count">by Nector infoway <i class="bi bi-stopwatch"></i> 53 minutas ago</span><br>

        <p class="Make_a mt-5">Make a choice:</p>

        <div class="option-container">
            <span class="option-number">1</span>
            <label class="option-label">Option 1</label>
            <label class="checkbox-label">
                <input type="radio" name="option" value="option1">
                <span class="checkbox-icon"></span>
            </label>
        </div>

        <div class="option-container">
            <span class="option-number">2</span>
            <label class="option-label">Option 2</label>
            <label class="checkbox-label">
                <input type="radio" name="option" value="option2">
                <span class="checkbox-icon"></span>
            </label>
        </div>

        <div class="option-container">
            <span class="option-number">3</span>
            <label class="option-label">Option 3</label>
            <label class="checkbox-label">
                <input type="radio" name="option" value="option3">
                <span class="checkbox-icon"></span>
            </label>
        </div>

        <div class="option-container">
            <span class="option-number">4</span>
            <label class="option-label">Option 4</label>
            <label class="checkbox-label">
                <input type="radio" name="option" value="option4">
                <span class="checkbox-icon"></span>
            </label>
        </div>

        <div class="inline-container">
            <a class="nav-link">
                <button type="button" class="header_button_blue">Vote Now</button>
            </a>
            <a class="sheare_link" href="" style="text-decoration: none;">Share Link</a>

        </div>
    </div>

    .<div class="container mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="vote_page_title_vote_page_count">
                    <p class="vote_page_title">Poll Result</p>
                    <p class="vote_page_count">Total votes: 10</p>
                </div>

                <div class=" mt-1">
                    <!-- Slider 1: Super Easy -->
                    <div class="vote_result_row">
                        <p class="vote_page_counts">Super Easy</p>
                        <span class="vote_percentage">40% - 4 votes</span>
                    </div>
                    <div class="custom-range-container super-easy">
                        <div class="custom-range-fill" style="width: 40%;"></div>
                    </div>

                    <!-- Slider 2: Somewhat Easy -->
                    <div class="vote_result_row">
                        <p class="vote_page_counts">Somewhat Easy</p>
                        <span class="vote_percentage">30% - 4 votes</span>
                    </div>
                    <div class="custom-range-container somewhat-easy">
                        <div class="custom-range-fill" style="width: 30%;"></div>
                    </div>

                    <!-- Slider 3: Moderate -->
                    <div class="vote_result_row">
                        <p class="vote_page_counts">Moderate</p>
                        <span class="vote_percentage">20% - 4 votes</span>
                    </div>
                    <div class="custom-range-container moderate">
                        <div class="custom-range-fill" style="width: 20%;"></div>
                    </div>

                    <!-- Slider 4: Quite difficult -->
                    <div class="vote_result_row">
                        <p class="vote_page_counts">Quite difficult</p>
                        <span class="vote_percentage">10% - 4 votes</span>
                    </div>
                    <div class="custom-range-container quite-difficult">
                        <div class="custom-range-fill" style="width: 10%;"></div>
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <div class="vote_page_title_vote_page_count">
                    <p class="vote_page_title">Poll Chart Result</p>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-8 ">
                        <div class="circle"></div>
                    </div>
                    <div class="col-6 col-sm-4 col_chart">
                        <ul class="col_chart_ul">
                            <li class="col_chart_li vote_page_counts"><i class="bi bi-circle-fill icon_chart_Super"></i>
                                Super Easy</li>
                            <li class="col_chart_li vote_page_counts"><i
                                    class="bi bi-circle-fill icon_chart_Somewhat"></i> Somewhat Easy</li>
                            <li class="col_chart_li vote_page_counts"><i
                                    class="bi bi-circle-fill icon_chart_Moderate"></i> Moderate</li>
                            <li class="col_chart_li vote_page_counts"><i class="bi bi-circle-fill icon_chart_Quite"></i>
                                Quite difficult</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
    // Get the sliders' container elements and their filled part
    const sliders = document.querySelectorAll('.custom-range-container');

    // Apply the background color and dimensions to each circle element
    sliders.forEach((slider) => {
        const fillElement = slider.querySelector('.custom-range-fill');
        const circleElement = slider.querySelector('.circle');
        const percentage = parseInt(fillElement.style.width, 10);
        circleElement.style.backgroundColor = fillElement.style.backgroundColor;
        circleElement.style.width = "270px";
        circleElement.style.height = "270px";
    });
    </script>


    <script>
    // Update the slider track background color based on the data-percentage attribute
    const sliders = document.querySelectorAll('.custom-range');
    sliders.forEach((slider) => {
        slider.style.setProperty('--percentage', `${slider.dataset.percentage}%`);
    });
    </script>


</body>

</html>