<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Global Supply Chain Risk Intelligence Platform</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{

            background:#fff;

            overflow-x:hidden;

        }

        a{
            text-decoration:none;
        }

        .container{

            width:90%;

            max-width:1400px;

            margin:auto;

        }

        /*
        ==================================
        NAVBAR
        ==================================
        */

        .hero{

            min-height:100vh;

            padding-top:140px;

            background:linear-gradient(
                135deg,
                #800021 0%,
                #A31E48 40%,
                #C24366 70%,
                #FF69B4 100%
            );

            display:flex;
            align-items:center;
            overflow:hidden;
            position:relative;
        }

        nav .wrapper{

            display:flex;

            justify-content:space-between;

            align-items:center;

        }

        .logo{

            display:flex;

            align-items:center;

            gap:15px;

        }

        .logo-icon{

            width:55px;

            height:55px;

            border-radius:50%;

            background:linear-gradient(
                135deg,
                #800021,
                #C24366
            );

            display:flex;

            align-items:center;

            justify-content:center;

            color:white;

            font-size:24px;

            box-shadow:
            0 15px 35px rgba(128,0,33,.3);

        }

        .logo h2{

            color:white;

            font-size:24px;

            font-weight:800;

            line-height:1.1;

        }

        .logo p{

            color:white;

            opacity:.9;

        }

        .nav-right{

            display:flex;

            gap:18px;

        }

        .btn-register{

            background:#800021;

            color:white;

            padding:15px 38px;

            border-radius:50px;

            font-weight:600;

            transition:.3s;

            box-shadow:
            0 12px 25px rgba(128,0,33,.3);

        }

        .btn-register:hover{

            background:#A31E48;

            transform:translateY(-3px);

        }

        .btn-login{

            border:2px solid #800021;

            color:#800021;

            padding:15px 38px;

            border-radius:50px;

            font-weight:600;

            background:white;

            transition:.3s;

        }

        .btn-login:hover{

            background:#800021;

            color:white;

        }

/*
==================================
HERO
==================================
*/

.hero{

    min-height:100vh;

    background:
    linear-gradient(
        135deg,
        #800021 0%,
        #A31E48 40%,
        #C24366 70%,
        #FF69B4 100%
    );

    position:relative;

    overflow:hidden;

    display:flex;

    align-items:center;

}

.hero::before{

    content:"";

    position:absolute;

    width:900px;

    height:900px;

    border-radius:50%;

    background:rgba(255,255,255,.08);

    right:-250px;

    top:-250px;

}

.hero-wrapper{

    display:grid;

    grid-template-columns:1fr 1fr;

    align-items:center;

    gap:80px;

}

.hero-left{

    color:white;
    animation:slideLeft 1s ease;

}

.badge{

    display:inline-block;

    background:rgba(255,255,255,.15);

    padding:12px 22px;

    border-radius:50px;

    font-weight:600;

    margin-bottom:30px;

    backdrop-filter:blur(10px);

}

.hero-left h1{

    font-size:60px;

    font-weight:800;

    line-height:1.2;

    margin-bottom:25px;

}

.hero-left h1 span{

    color:#ffd4e3;

}

.hero-left p{

    font-size:22px;

    line-height:1.8;

    opacity:.95;

    margin-bottom:45px;

}

.hero-buttons{

    display:flex;

    gap:20px;

}

.btn-main{

    background:white;

    color:#800021;

    padding:18px 38px;

    border-radius:16px;

    font-weight:700;

    transition:.3s;

}

.btn-main:hover{

    transform:translateY(-4px);

}

.btn-outline{

    border:2px solid white;

    color:white;

    padding:18px 38px;

    border-radius:16px;

    font-weight:700;

    transition:.3s;

}

.btn-outline:hover{

    background:white;

    color:#800021;

}

/* RIGHT */

.hero-right{

    position:relative;

    height:650px;

    animation:slideRight 1s ease;


}

@keyframes slideLeft{

    from{

        opacity:0;

        transform:translateX(-80px);

    }

    to{

        opacity:1;

        transform:translateX(0);

    }

}

@keyframes slideRight{

    from{

        opacity:0;

        transform:translateX(80px);

    }

    to{

        opacity:1;

        transform:translateX(0);

    }

}

.circle-bg{

    position:absolute;

    width:550px;

    height:550px;

    background:rgba(255,255,255,.12);

    border-radius:50%;

    right:20px;

    top:40px;

}

.globe{

    position:absolute;

    width:380px;

    left:120px;

    top:120px;

    z-index:5;

}

.ship{

    position:absolute;

    width:210px;

    bottom:30px;

    left:30px;

    z-index:8;

}

.truck{

    position:absolute;

    width:190px;

    bottom:40px;

    right:40px;

    z-index:8;

}

.plane{

    position:absolute;

    width:170px;

    top:80px;

    right:30px;

    z-index:9;

    transform:rotate(-8deg);

}

/*
==================================
FEATURE
==================================
*/

.features{

    padding:140px 0;

    background:#fff7f9;

}

.section-title{

    text-align:center;

    margin-bottom:70px;

}

.section-title span{

    display:inline-block;

    background:#ffe5ee;

    color:#800021;

    padding:10px 25px;

    border-radius:50px;

    font-weight:700;

    margin-bottom:20px;

}

.section-title h2{

    font-size:48px;

    color:#800021;

    margin-bottom:15px;

}

.section-title p{

    font-size:20px;

    color:#666;

    max-width:700px;

    margin:auto;

    line-height:1.8;

}

.feature-grid{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:35px;

}

.feature-card{

    background:white;

    border-radius:25px;

    padding:45px;

    transition:.35s;

    min-height:300px;

    box-shadow:

    0 10px 30px rgba(128,0,33,.08);

}

.feature-card:hover{

    transform:translateY(-12px) scale(1.03);

    box-shadow:

    0 25px 60px rgba(128,0,33,.18);

}

.feature-icon{

    width:90px;

    height:90px;

    border-radius:22px;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:42px;

    background:

    linear-gradient(

    135deg,

    #800021,

    #C24366,

    #FF69B4

    );

    margin-bottom:25px;

}

.feature-card h3{

    font-size:28px;

    color:#800021;

    margin-bottom:15px;

}

.feature-card p{

    color:#666;

    line-height:1.9;

    font-size:17px;

}
    </style>

</head>

<body>

<nav>

    <div class="container wrapper">

        <div class="logo">

            <div class="logo-icon">

                🌐

            </div>

            <div>

                <h2>GLOBAL SUPPLY CHAIN</h2>

                <p>Risk Intelligence Platform</p>

            </div>

        </div>

        <div class="nav-right">

            <a href="{{ route('register') }}"
               class="btn-register">

                👤 Register

            </a>

            <a href="{{ route('login') }}"
               class="btn-login">

                🔐 Login

            </a>

        </div>

    </div>

</nav>

<!-- ==========================================
HERO SECTION
========================================== -->

<section class="hero">

    <div class="container hero-wrapper">

        <!-- LEFT -->

        <div class="hero-left">

            <span class="badge">

                🛡 Smart • Real-time • Intelligent

            </span>

            <h1>

                Global Supply Chain

                <span>Risk Intelligence</span>

                Platform

            </h1>

            <p>

                Monitor global logistics risks using real-time weather,
                economy, news, currency, shipping routes,
                and AI-based risk analysis.

            </p>

            <div class="hero-buttons">

                <a href="{{ route('register') }}" class="btn-main">

                    🚀 Get Started

                </a>

                <a href="#features" class="btn-outline">

                    ℹ Learn More

                </a>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="hero-right">

            <div class="circle-bg"></div>

            <img
                src="https://cdn-icons-png.flaticon.com/512/679/679720.png"
                class="ship">

            <img
                src="https://cdn-icons-png.flaticon.com/512/3082/3082027.png"
                class="truck">

            <img
                src="https://cdn-icons-png.flaticon.com/512/2972/2972185.png"
                class="plane">

            <img
                src="https://cdn-icons-png.flaticon.com/512/854/854878.png"
                class="globe">

        </div>

    </div>

</section>
<!--=========================================
FEATURE SECTION
==========================================-->

<section id="features" class="features">

    <div class="container">

        <div class="section-title">

            <span>WHY CHOOSE US</span>

            <h2>Powerful Features</h2>

            <p>

                Everything you need to monitor global supply chain risks
                in one intelligent platform.

            </p>

        </div>

        <div class="feature-grid">

            <div class="feature-card">

                <div class="feature-icon">

                    🌦

                </div>

                <h3>Real-time Weather</h3>

                <p>

                    Monitor storms, hurricanes, heavy rain and climate
                    changes that may affect global logistics.

                </p>

            </div>

            <div class="feature-card">

                <div class="feature-icon">

                    💹

                </div>

                <h3>Economy Analysis</h3>

                <p>

                    Track inflation, GDP, exchange rates,
                    unemployment and other economic indicators.

                </p>

            </div>

            <div class="feature-card">

                <div class="feature-icon">

                    💱

                </div>

                <h3>Currency</h3>

                <p>

                    Monitor exchange rates in real time to estimate
                    international trading costs.

                </p>

            </div>

            <div class="feature-card">

                <div class="feature-icon">

                    🚢

                </div>

                <h3>Shipping Routes</h3>

                <p>

                    Interactive map showing worldwide shipping routes
                    and important ports.

                </p>

            </div>

            <div class="feature-card">

                <div class="feature-icon">

                    📰

                </div>

                <h3>Global News</h3>

                <p>

                    Collect international news that can influence
                    logistics and supply chain activities.

                </p>

            </div>

            <div class="feature-card">

                <div class="feature-icon">

                    🤖

                </div>

                <h3>AI Risk Score</h3>

                <p>

                    AI automatically calculates the risk level of each
                    country based on multiple indicators.

                </p>

            </div>

        </div>

    </div>

</section>

