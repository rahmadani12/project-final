<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Login</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body>

<style>

body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#f8f8f8;
}

.login-page{

    min-height:100vh;

    display:flex;

    overflow:hidden;

}

.left{

    width:60%;

    padding:70px;

    color:white;

    background:linear-gradient(
        135deg,
        #800021,
        #881144,
        #C24366,
        #FF69B4
    );

    display:flex;

    flex-direction:column;

    justify-content:center;

}

.left h1{

    font-size:56px;

    font-weight:bold;

    margin-bottom:20px;

}

.left p{

    font-size:22px;

    line-height:1.8;

}

.feature{

    margin-top:50px;

    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:20px;

}

.feature div{

    background:rgba(255,255,255,.15);

    backdrop-filter:blur(10px);

    padding:20px;

    border-radius:15px;

}

.right{

    width:40%;

    display:flex;

    justify-content:center;

    align-items:center;

    background:#FFDCE8;

}

.card-login{

    width:420px;

    padding:45px;

    border-radius:25px;

    background:rgba(255,255,255,.85);

    backdrop-filter:blur(15px);

    box-shadow:0 20px 40px rgba(0,0,0,.2);

}

.card-login h2{

    color:#800021;

    text-align:center;

    margin-bottom:10px;

    font-size:42px;

}

.card-login p{

    text-align:center;

    margin-bottom:35px;

    color:#555;

}

.card-login input{

    width:100%;

    padding:14px;

    border-radius:10px;

    border:1px solid #ddd;

    margin-top:8px;

    margin-bottom:18px;

}

.btn-login{

    width:100%;

    padding:15px;

    border:none;

    border-radius:12px;

    color:white;

    font-size:18px;

    font-weight:bold;

    cursor:pointer;

    background:linear-gradient(
        90deg,
        #800021,
        #C24366
    );

}

.btn-login:hover{

    opacity:.9;

}

.link{

    margin-top:20px;

    text-align:center;

}

.link a{

    color:#800021;

    font-weight:bold;

    text-decoration:none;

}

</style>

<div class="login-page">

<div class="left">

<h1>🌍 Global Supply Chain Risk Intelligence Platform</h1>

<p>

Monitor global logistics using AI, Weather, Economy,
Currency, Maritime Routes and Risk Intelligence.

</p>

<div class="feature">

<div>
🚢<br>
Shipping Route
</div>

<div>
🌦<br>
Weather Monitoring
</div>

<div>
💰<br>
Currency
</div>

<div>
🤖<br>
AI Risk Analysis
</div>

</div>

</div>

<div class="right">

<div class="card-login">

<h2>Login</h2>

<p>Welcome Back</p>

<form method="POST" action="{{ route('login') }}">
@csrf

<label>Email</label>
<input
type="email"
name="email"
required
>

<label>Password</label>

<input
type="password"
name="password"
required
>

<button class="btn-login">
LOGIN
</button>

<div class="link">

<a href="{{ route('register') }}">
Create Account
</a>

</div>

</form>

</div>

</div>

</div>

</body>

</html>