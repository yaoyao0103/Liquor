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
	background:url('background.jpg') black;
	//background: black;
	background-size:cover;
	padding-bottom:80px;
	transition: 0.5s;
	min-height: 100vh;
}

/*header RWD
@media (min-width:768px) {
.header-dark {
	padding-bottom:120px;
}
}*/

/*導覽列設定*/
.header-dark .navbar {
	background:transparent;
	padding-top:.75rem;
	padding-bottom:.75rem;
	color:#fff;
	border-radius:0;
	box-shadow:none;
	border:none;
}


/*導覽列品牌*/
.header-dark .navbar .navbar-brand {
	font-size: 1.5em;
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
	text-align: center;
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
margin: 0 3em 3em 3em;
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

.page_btn_div {
	max-width: 800px;
	margin:0 auto;
}

.page_btn{
	background: none;
	color:white;
	width: 35px;
	margin-left: 0.8px;
	border: none;
	cursor: pointer;
}


.page_btn:hover, .present_page{
	background: white;
	color: #743A3A;
	border-radius: 100%;
	border: none;
	transition: 0.2s;
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
	background:rgba(30,30,30,.9);
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

.userInfo-form .group .button:hover{
	background:#CE0000;
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

#blur.active {
	filter: blur(20px);
	pointer-events: none;
	user-select: none;
}

#popup {
	position: fixed;
	top: 40%;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 1100px;
	padding: 30px;
	box-shadow: 0 5px 30px rgba(0,0,0,.30);
	background: #222;
	border-radius: 20px;
	visibility: hidden;
	opacity: 0;
	transition: 0.5s;
	z-index: 5;
}

#popup.active {
	visibility: visible;
	opacity: 1;
	transition: 0.5s;
}

#popup .popup_img {
	float: left;
	width: 240px;
}

#popup .popup_content {
	float: left;
	width: 500px;
	height: 360px;
	overflow-y: auto;
	margin-left: 20px;
}

#popup_img {
	height: 360px;
}

#popup_cname {
	margin-left: 15px;
	margin-right: 10px;
	margin-top: 3px;
	float: left;
	color: #FFE66F;
	font-size: 20px;
	font-weight: bold;
}

#popup_ename {
	margin-top: 6px;
	color: #FFE66F;
	font-size: 15px;
	font-weight: bold;
	float: left;
}

#popup_ingredients {
	margin-top: 40px;
	color: #E0E0E0;
	font-size: 15px;
}

#popup_detail {
	margin-left: 20px;
	margin-top: 20px;
	color: #E0E0E0;
	font-size: 12px;
}


#popup_tags {
	margin-top: 20px;
	margin-left: 20px;
	color: #E0E0E0;
	font-size: 10px;
}

#popup_detail span, #popup_tags span{
	font-weight: bold; 
	font-size: 15px;
	color: white;
	margin-bottom: 2px;
}

#popup_tags a{
	margin-right: 10px;
	text-decoration: none;
	color: gold;
}

.popup_btn_group {
	float:right;
	margin-top: 20px;
}

.popup_btn {
	position: relative;
	text-align: center;
	background-color: gray;
	text-decoration: none;
	width: 50px;
	border-radius: 5px;
	margin-left: 10px;
	float: left;
}


.popup_btn a{
	color: white;
}

#popup .popup_comment {
	float: left;
	width: 250px;
	margin-left: 30px;
	height: 360px;
}

#popup .all_comment {
	height: 310px;
	width: 250px;
	overflow-y: auto;
}

#popup .comment_input {
	height: 30px;
	margin-top:20px;
}

#comment_btn{
	text-align: center;
	background-color: gray;
	text-decoration: none;
	border-radius: 5px;
	margin-left: 5px;
	color: white;
}

#comment_btn:hover{
	background-color: gray;
	color: white;
}

#comment_text{
	width: 180px;
	background:none;
	border:none;
	border-bottom:1px solid #ccc;
	border-radius:0;
	box-shadow:none;
	transition:border-bottom-color 0.3s;
	color: white;
	outline: none;
}

#comment_text:focus{
	border-bottom:1px solid gold;
}





#comment_header{
	margin: 3px 5px;
	color: #FFE66F;
	font-size: 20px;
	font-weight: bold;
	text-align: center;
}

#popup .comment_header_hr{
	border-top: 1px solid white;
}
#popup .comment_hr{
	border-top: 0.5px dashed gray;
	margin: 10px 0px 10px 0px;
}

#popup .comment_username {
	font-weight: bold;
	color: white;
}

#popup .comment_content {
	font-size: 8px;
}

#btncollapzion {
	margin-left: -50px;
}



a._collapz_parant._close:after, a._collapz_parant._open:after {
    content: "\E5CD";
    font-family: 'Material Icons';
    font-size: 30px;
    position: relative;
    top: 8px;
    font-style: normal;
    color: #fff;
}
a._collapz_parant {
    color: #fff;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: inline-block;
    text-decoration: none;
    float: right;
	margin-top: 10px;
    -webkit-transition: -webkit-transform .1s linear 0ms;
    -moz-transition: -moz-transform .1s linear 0ms;
    transition: transform .1s linear 0ms;
    transform: rotate(44deg);
}
a._collapz_parant._close {
    background-color: white;
}
a._collapz_parant._close:after {
    left: 0;
}

a._collapz_parant._open {
    background-color: #208f8f;
}
ul._child_collapzion {
    position: absolute;
    margin: 0;
    list-style: none;
    padding: 1px;
    top: 0;
    left: 0;
    width: 100%;
    overflow: auto;
    z-index: 10;
    -webkit-transform: translate3d(0, -100%, 0);
    -moz-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
    -webkit-transition: -webkit-transform .3s ease-in-out;
    -moz-transition: -moz-transform .3s ease-in-out;
    transition: transform .3s ease-in-out;
}

ul._child_collapzion li a._collapz_child {
    color: #000;
    border-radius: 50%;
    width: 53px;
    height: 53px;
    display: inline-block;
    background-color: white;
    margin: 6px 14px;
    text-align: center;
}
ul._child_collapzion li {
    text-align: right;
}
ul._child_collapzion li a._collapz_child i {
    margin-top: 15px;
}
ul._child_collapzion li span._title {
    position: relative;
    left: 8px;
    top: -6px;
    padding: 3px;    
}
._col_shadow {
    box-shadow: 0 4px 17px 0 rgba(0, 0, 0, .14), 0 1px 32px 0 rgba(0, 0, 0, .12), 0 2px 9px -1px rgba(0, 0, 0, .2);
}

#likeBtn {
	width: 15px;
	float: left;
	margin-top: 20px;
	margin-left: 30px;
	margin-right: 7px;
}

.heart {
	background-color: #8a93a0;
	height: 13px;
	width: 13px;
	transform: rotate(-45deg) scale(1);
	display: inline-block;
	cursor: pointer;
}


.heart::before {
	content: '';
	position: absolute;
	top: -50%;
	left: 0;
	background-color: inherit;
	border-radius: 50%;
	height: 13px;
	width: 13px;
}

.heart::after {
	content: '';
	position: absolute;
	top: 0;
	right: -50%;
	background-color: inherit;
	border-radius: 50%;
	height: 13px;
	width: 13px;
}

.heratPop{
	animation: pulse 1s linear infinite;
}

@keyframes pulse {
	0% {
		transform: rotate(-45deg) scale(1);
	}

	10% {
		transform: rotate(-45deg) scale(1.1);
	}

	20% {
		transform: rotate(-45deg) scale(0.9);
	}

	30% {
		transform: rotate(-45deg) scale(1.2);
	}

	40% {
		transform: rotate(-45deg) scale(0.9);
	}

	50% {
		transform: rotate(-45deg) scale(1.1);
	}

	60% {
		transform: rotate(-45deg) scale(0.9);
	}

	70% {
		transform: rotate(-45deg) scale(1);
	}
}

#commentLikeBtn {
	width: 8px;
	float: right;
	margin-right: 15px;
}

.commentHeart {
	background-color: #8a93a0;
	height: 8px;
	width: 8px;
	transform: rotate(-45deg) scale(1);
	display: inline-block;
	cursor: pointer;
}


.commentHeart::before {
	content: '';
	position: absolute;
	top: -50%;
	left: 0;
	background-color: inherit;
	border-radius: 50%;
	height: 8px;
	width: 8px;
}

.commentHeart::after {
	content: '';
	position: absolute;
	top: 0;
	right: -50%;
	background-color: inherit;
	border-radius: 50%;
	height: 8px;
	width: 8px;
}

#comment_total_like {
	font-size: 0.3em;
}

#comment_icon, #bookmark_icon {
	float: left;
	margin-left: 21px;
	color: #8a93a0;
	margin-top: 17px;
}

#bookmark_icon {
	margin-top: 16px;
	cursor: pointer;
}

#preloader{
	background: #000 url(../images/loader.gif) no-repeat center center;
	background-size: 30%;
	opacity: 0.6;
	height: 100vh;
	width: 100%;
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	z-index: 100;
}