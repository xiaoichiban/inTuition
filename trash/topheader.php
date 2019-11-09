<head>
        <title>TASK MASTER</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }
            @media screen and (max-width:600px) {
                .column {
                    width: 100%;
                }
            }
            body {
                font-family: Old Standard;
                color: black;
                margin: 0;
            }

            /* Style the header */
            .header {
                background-color: #f1f1f1;
                padding: 5px;
                text-align: center;
            }

            .column {
                float: left;
                width: 33.33%;
                padding: 15px;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            .column {
                float: left;
                width: 25%;
                padding: 15px;
            }

            .columnright {
                float: left;
                width: 75%;
                padding: 15px;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Style the top navigation bar */
            .topnav {
                overflow: hidden;
                background-color: #333;
                text-align: center;
                display: flex;
                justify-content: space-around;
                padding-left: 150px;
                padding-right: 150px;
            }

            /* Style the topnav links */
            .topnav a {
                float: left;
                display: block;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                width:150px;
            }

            /* Change color on hover */
            .topnav a:hover {
                background-color: #ddd;
                color: black;
            }

            .dropdown {
                float: left;
                overflow: hidden;
            }

            .dropdown .dropbtn {
                font-size: 16px;    
                border: none;
                outline: none;
                color: white;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit;
                margin: 0;
                width:150px;
            }

            .navbar a:hover, .dropdown:hover .dropbtn {
                background-color: bisque;
                color: black;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                float: none;
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .imagecontainer {
                position:absolute; 
                bottom:0;
            }
        </style>
    </head>