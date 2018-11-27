/* Bordered form */
form {

    padding-top: 5%;
    z-index: -2;
    padding-bottom: 5%;

}

/* Full-width inputs */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    margin-bottom: 3%;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
    opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.loginbtn {
    width: auto;
    padding: 10px 18px;
    background-color: CornflowerBlue;
}

/* Center the avatar image inside this container */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}


/* Add padding to containers */
.container {
    position: relative;
    left: 30%;
    padding: 16px;
    width: 40%;
    background-color: rgba(256, 256, 256, 0.85);
}

/* The "Forgot password" text */
span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
    .loginbtn {
        width: 100%;
    }
}

/*For PHP*/
