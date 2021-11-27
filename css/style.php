<?php
/*** set the content type header ***/
/*** Without this header, it wont work ***/
	header("Content-type: text/css");
?>

html, body {
	width: 100%;
	height: 100%;
  }
html {
	display: table;
}

body {
	background: #121212;
	background-size: cover;
	display: table-cell;
	vertical-align: middle;
	font-family: "Exo 2", sans-serif;
	background-color: #312e4a;
	color: #d8d8d8;
}

/*背景暗化*/
body:before {
	content: "";
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: #000;
	opacity: 0.2;
}

  
/*header背景設定*/
.header-dark {
	background:url('http://img1.tcdachun.com/141027/330566-14102G12Q79.jpg') #444;
	background-position: top;
	background-size:cover;
	padding-bottom:80px;
  }
  
/*header RWD*/
@media (min-width:768px) {
.header-dark {
	padding-bottom:120px;
}
}

/*導覽列設定*/
.header-dark .navbar {
	background:transparent;
	padding-top:0;
	padding-bottom:0;
	color:#fff;
	border-radius:0;
	box-shadow:none;
	border:none;
}

/*導覽列RWD*/
@media (min-width:768px) {
.header-dark .navbar {
	padding-top:.75rem;
	padding-bottom:.75rem;
}
}

/*導覽列品牌*/
.header-dark .navbar .navbar-brand {
	font-weight:bold;
	color:inherit;
}

/*導覽列品牌hover*/
.header-dark .navbar .navbar-brand:hover {
	color:#f0f0f0;
}

.header-dark .navbar .navbar-collapse span {
	margin-top:5px;
}

/*導覽列登入*/
.header-dark .navbar .navbar-collapse span .login {
	color:#d9d9d9;
	margin-right:.5rem;
	text-decoration:none;
}

/*導覽列登入hover*/
.header-dark .navbar .navbar-collapse span .login:hover {
	color:#fff;
}

.header-dark .navbar .navbar-toggler {
	border-color:#747474;
}

.header-dark .navbar .navbar-toggler:hover, .header-dark .navbar-toggler:focus {
	background:none;
}

.header-dark .navbar .navbar-toggler {
	color:#eee;
}

.header-dark .navbar .navbar-collapse, .header-dark .navbar .form-inline {
	border-color:#636363;
}

@media (min-width: 992px) {
.header-dark .navbar.navbar .navbar-nav .nav-link {
	padding-left:1.2rem;
	padding-right:1.2rem;
}
}

.header-dark .navbar.navbar-dark .navbar-nav .nav-link {
	color:#d9d9d9;
}

.header-dark .navbar.navbar-dark .navbar-nav .nav-link:focus, .header-dark .navbar.navbar-dark .navbar-nav .nav-link:hover {
	color:#fcfeff !important;
	background-color:transparent;
}

.header-dark .navbar .navbar-nav > li > .dropdown-menu {
	margin-top:-5px;
	box-shadow:0 4px 8px rgba(0,0,0,.1);
	background-color:#fff;
	border-radius:2px;
}

/*dropdown item*/
.header-dark .navbar .dropdown-menu .dropdown-item:focus, .header-dark .navbar .dropdown-menu .dropdown-item {
	line-height:2;
	font-size:14px;
	color:#37434d;
}

/*dropdown item hover*/
.header-dark .navbar .dropdown-menu .dropdown-item:focus, .header-dark .navbar .dropdown-menu .dropdown-item:hover {
	background: #FFECEC;
}


.header-dark .navbar .action-button, .header-dark .navbar .action-button:active {
	background:#208f8f;
	border-radius:20px;
	font-size:inherit;
	color:#fff;
	box-shadow:none;
	border:none;
	text-shadow:none;
	padding:.5rem .8rem;
	transition:background-color 0.25s;
}

.header-dark .navbar .action-button:hover {
	background:#269d9d;
}

.header-dark .navbar .form-inline label {
	color:#ccc;
}

.header-dark .navbar .form-inline .search-field {
display:inline-block;
width:80%;
background:none;
border:none;
border-bottom:1px solid transparent;
border-radius:0;
color:#ccc;
box-shadow:none;
color:inherit;
transition:border-bottom-color 0.3s;
}

.header-dark .navbar .form-inline .search-field:focus {
border-bottom:1px solid #ccc;
}

.header-dark .hero {
margin-top:60px;
}

@media (min-width:768px) {
.header-dark .hero {
	margin-top:20px;
}
}

.header-dark .hero h1 {
color:#fff;
font-family:'Bitter', serif;
font-size:40px;
margin-top:20px;
margin-bottom:80px;
}

@media (min-width:768px) {
.header-dark .hero h1 {
	margin-bottom:50px;
	line-height:1.5;
}
}

.header-dark .hero .embed-responsive iframe {
	background-color: #666;
}

/*初始margin，英文大寫*/
h3, p { 
margin: 0;
text-transform: uppercase;
}

/*h3 p分別設定*/
h3 { 
font-size: 1.2rem;
margin-bottom: 5px;
text-align: right;
color: #fff;
}
p {
font-size: 0.4rem;
font-weight: 400;
letter-spacing: 2px;
}

/*card的外殼*/
.wrapper {
position: relative;
max-width: 1100px;
margin: 0 auto;
padding: 80px 20px;
}

/*中文酒名*/
.roll-up {
overflow: hidden;
position: relative;
}

/*中文酒名*/
.roll-up > span {
display: inline-block;
position: relative;
}

/*中文酒名出現之delay 7個字*/
.roll-up > span:nth-child(1) {
transition-delay: 0.03s;
}
.roll-up > span:nth-child(2) {
transition-delay: 0.06s;
}
.roll-up > span:nth-child(3) {
transition-delay: 0.09s;
}
.roll-up > span:nth-child(4) {
transition-delay: 0.12s;
}
.roll-up > span:nth-child(5) {
transition-delay: 0.15s;
}
.roll-up > span:nth-child(6) {
transition-delay: 0.18s;
}
.roll-up > span:nth-child(7) {
transition-delay: 0.21s;
}

/*中文酒名變換貝賽爾曲線*/
.roll-up > span > span {
display: inline-block;
transition: 0.6s cubic-bezier(0.7, 0.01, 0.37, 1);
transition-delay: inherit;
}

/*中文酒名 設定為改變及改變後的字*/
.roll-up > span > span:nth-child(1) {
position: relative;
}
.roll-up > span > span:nth-child(2) {
position: absolute;
transform: translateY(100%);
left: 0;
color: #16e590;
}

/*英文酒名設定*/
.text-reveal {
position: relative;
overflow: hidden;
}

/*英文酒名變換貝賽爾曲線*/
.text-reveal span {
display: block;
transition: cubic-bezier(0.7, 0.01, 0.37, 1) 0.6s;
}

/*英文酒名變換後的字*/
.text-reveal > span:nth-child(2) {
position: absolute;
top: 0;
left: 0;
color: #fff;
}

/*英文酒名變換後的字*/
.text-reveal > span:nth-child(2) > span {
overflow: hidden;
transform: translateX(-100%);
}
.text-reveal > span:nth-child(2) > span:nth-child(1) {
transition-delay: 0.1s;
}
.text-reveal > span:nth-child(2) > span:nth-child(2) {
transition-delay: 0.2s;
}
.text-reveal > span:nth-child(2) > span:nth-child(3) {
transition-delay: 0.3s;
}
.text-reveal > span:nth-child(2) > span:nth-child(4) {
transition-delay: 0.4s;
}
.text-reveal > span:nth-child(2) > span:nth-child(5) {
transition-delay: 0.5s;
}
.text-reveal > span:nth-child(2) > span:nth-child(6) {
transition-delay: 0.6s;
}
.text-reveal > span:nth-child(2) > span:nth-child(7) {
transition-delay: 0.7s;
}
.text-reveal > span:nth-child(2) > span > span {
transform: translateX(100%);
transition-delay: inherit;
}

/*旋轉酒瓶*/
.play-button {
display: inline-block;
width: 70px;
height: 70px;
transition: 0.5s;
}
.play-button svg {
overflow: visible;
}
.play-button .polygon {
fill: #16e590;
transition: transform 0.5s, fill 0.5s;
transition-timing-function: cubic-bezier(0.7, 0.01, 0.37, 1);
transform-origin: 50% 50%;
}

/*卡片設定*/
.card {
display: inline-flex;
align-items: center;
justify-content: center;
position: relative;
max-width: 250px;
width: 100%;
height: 350px;
padding: 20px;
box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.3);
background-size: cover;
cursor: pointer;
margin: 0 100px 60px 0;
}
.card:before {
content: '';
display: block;
height: 100%;
width: 100%;
position: absolute;
background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.75) 100%);
}
.card .card_content {
z-index: 1;
}
.card .card_content .card_content_Name {
position: absolute;
bottom: 20px;
right: 0;
margin-right: 20px;
text-align: left;
max-width: 175px;
}
.card:hover .play-button {
transform: scale(1.1);
}
.card:hover .play-button .polygon {
transform: translateZ(0px) rotate(90deg);
fill: #67fbbe;
}
.card:hover .roll-up > span > span:nth-child(1) {
transform: translateY(-100%);
}
.card:hover .roll-up > span > span:nth-child(2) {
transform: translateY(0);
}
.card:hover .text-reveal > span:nth-child(2) > span, .card:hover .text-reveal > span:nth-child(2) > span > span {
transform: translateX(0);
}


/*------------------------------------------------------*/

.userInfo-wrap{
	width:100%;
	margin:auto;
	max-width:525px;
	min-height:670px;
    margin-top: 60px;
	position:relative;
	background:url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center;
	box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
}
.userInfo-html{
	width:100%;
	height:100%;
	position:absolute;
	padding:90px 70px 50px 70px;
	background:rgba(50,0,0,.9);
}
.userInfo-html .sign-in-htm,
.userInfo-html .sign-up-htm,
.userInfo-html .reset-Password-htm,
.userInfo-html .forgot-Password-htm,
.userInfo-html .activate-htm{
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:absolute;
}

.userInfo-html .tab,
.userInfo-form .group .label,
.userInfo-form .group .button{
	text-transform:uppercase;
}
.userInfo-html .tab{
	font-size:22px;
	margin-right:15px;
	padding-bottom:5px;
	margin:0 15px 10px 0;
	display:inline-block;
	border-bottom:2px solid transparent;
}

.userInfo-form{
	min-height:345px;
	position:relative;
	perspective:1000px;
	transform-style:preserve-3d;
}

.userInfo-form .notice{
	margin-bottom: 20px;
	text-align: center;
}

.userInfo-form .group{
	margin-bottom:15px;
}
.userInfo-form .group .label,
.userInfo-form .group .input,
.userInfo-form .group .button{
	width:100%;
	color:#fff;
	display:block;
}
.userInfo-form .group .input,
.userInfo-form .group .button{
	border:none;
	padding:15px 20px;
	border-radius:25px;
	background:rgba(255,255,255,.1);
}
.userInfo-form .group input[data-type="password"]{
	text-security:circle;
	-webkit-text-security:circle;
}
.userInfo-form .group .label{
	color:#aaa;
	font-size:12px;
}
.userInfo-form .group .button{
	background:#AE0000;
}

.userInfo-form .top-space{
	margin-top: 40px;
}


.hr{
	height:2px;
	margin:20px 0 20px 0;
	background:rgba(255,255,255,.2);
}
.foot-lnk{
	text-align:center;
}

.foot-lnk a{
	color: white;
}