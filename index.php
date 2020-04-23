<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EquSolver API</title>
    <!-- Font-awesome -->
    <link rel="stylesheet" href="assets/css/extra/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/extra/bootstrap.min.css">
    <!-- (Nunito) Font from google -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,400i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <!-- 'Indie Flower' font from google -->
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--[if lt IE 9]>
    <script src="assets/js/extra/html5shiv.min.js"></script>
    <script src="assets/js/extra/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- ############### -->
    <!-- Start Work Area -->
        
        <!-- Start Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">&lt;EquSolver/&gt;</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#how">How to?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#demo">Practical demo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Start Welcome -->
        <div id="home" class="welcome text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="welcome-intro">
                            <h1 class="main-color mt-4 mt-lg-0">EquSolver API</h1>
                            <p class="lead">Solve Your 1st degree equations quickly with the beautiful of EquSolver API.</p>
                            <p class="lead">EquSolver is an open source API based on PHP language. It helps to solve 1st degree equations quickly, easily and efficiently.</p>
                            <div class="links">
                                <a href="#how" class="btn btn-outline-main btn-lg">How to?</a>
                                <a href="https://github.com/yasser-boubani/equsolver" class="btn btn-outline-secondary btn-lg">
                                    View on GitHub
                                    <i class="fab fa-github"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="welcome-img">
                            <img src="assets/files/images/solveit.png" width="100%" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Welcome -->

        <!-- Start How to? -->
        <div id="how" class="how_to">
           <div class="container">
                <h2 class="text-center main-color mb-4">How to?</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="how_to-title d-flex">
                            <i class="fa fa-pen-alt fa-2x mr-2 main-color"></i>
                            <h3>Prepare your equation</h3>
                        </div>
                        <div class="how_to-example">
                            <p>Prepare your equation to send:</p>
                            <code>const EQUATION = "9x+x-15=3x+9-x";</code>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="how_to-title d-flex">
                            <i class="fa fa-paper-plane fa-2x mr-2 main-color"></i>
                            <h3>Send your GET request</h3>
                        </div>
                        <div class="how_to-example">
                            <p>Send the request to: </p>
                            <div class="uri">https://equsolver.000webhostapp.com/solve.php?equ=EQUATION</div>
                            <p>Before you send the GET request make sure you did encode the URI component (to skip any special character issue).</p>
<code>let URI = "https://equsolver.000webhostapp.com/solve.php?equ=EQUATION";
let encodedURI = encodeURIComponent(uri);
// Send the encodedURI in the GET request
</code>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="how_to-title d-flex">
                            <i class="fa fa-hand-holding-water fa-2x mr-2 main-color"></i>
                            <h3>Take the response</h3>
                        </div>
                        <div class="how_to-example">
                            <p>Take the response as a JSON object in this form:</p>
                            <pre>{"equation":"9x+x-15=3x+9-x","msg":"Solved","solve":["9x+x-15 = 3x+9-x","9x+x-3x+1x = +9+15","8x = 24","x = 24 / 8","x = 3"]}</pre>
                            <p>But if you send an invalid equation (9x=9x=15 for instance), the response will be like:</p>
                            <pre>{"equation":"9x=9x=15","msg":"Error","error":"Invalid equation!"}</pre>
                        </div>
                    </div>
                </div>
           </div> 
        </div>
        <!-- End How to? -->

        <!-- Start Practical demo -->
        <div id="demo" class="demo">
            <div class="container">
                <h2 class="text-center main-color mb-4">Practical demo</h2>
                <div class="row">
                    <div class="col-md-7">
                        <div class="demo-explain">
                            <p class="lead">Here is a practical demo to take a view of how could we use the <a href="#">EquSolver API</a>.</p>
                            <p class="lead">Just write your equation and the magic paper will solve it for you :)</p>
                            <p class="lead">The complete source code of the <a href="#home">EquSolver API</a> and that demo are available on <a href="https://github.com/yasser-boubani/equsolver">GitHub</a>.</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="wrapper">
                            <div class="paper">
                                <div class="paper-head">
                                    Solve the equation:
                                    <div class="equ-input">
                                        <input type="text" id="equ" placeholder="Write here">
                                        <button onclick="solve()">Solve</button>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                            <div class="paper-pin"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Practical demo -->

        <!-- Start footer -->
        <footer class="text-light text-center">
            Built with all <i class="fa fa-heart text-love"></i> by <a href="https://www.facebook.com/yasser.boubani">Yasser Boubani</a>.
        </footer>
        <!-- End footer -->

    <!-- End Work Area -->
    <!-- _____________ -->
        
        <!-- ############# -->
        <!-- start scripts -->
        <!-- jQuery -->
        <script src="assets/js/extra/jquery-3.3.1.min.js"></script>
        <!-- popper.js for bootstrap -->
        <script src="assets/js/extra/popper.min.js"></script>
        <!-- Bootstrap v3 -->
        <script src="assets/js/extra/bootstrap.min.js"></script>
        <!-- Main JS File -->
        <script src="assets/js/script.js"></script>
        <!-- end scripts -->
        <!-- ___________ -->
</body>
</html>
