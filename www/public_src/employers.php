<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body {
    display: grid;
    grid-template-rows: [row1-start] 20% [row2-start] 60% [row3-start] 20% [row3-end];
    grid-template-columns: auto;
    grid-gap: 10px;
    margin: 0 auto;
    background-color: rgb(238, 238, 238);
    font-family: Arial, Helvetica, sans-serif;
}


header {
    grid-row: row1-start / row2-start;
    display: grid;
    grid-template-columns: 1fr 3fr;
    grid-template-rows: auto;
    background-color: rgb(0, 120, 160);    
    overflow: hidden;
}


.navbar {
    background-color: rgb(0, 120, 160);    
    overflow: hidden;
    overflow: hidden;
    background-color: #333;
    font-family: Arial;

}

.navbar a {
    display: grid;
    grid-template-columns: 1fr 1fr 3fr;
    grid-template-rows: auto;
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
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
}

.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: red;
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
</style>
</head>
<body>

<header>

    <img src="img/logo.png" height="75" width="75">

    <div class="navbar">
      <a href="#home">Home</a>
      <a href="#news">News</a>
      <div class="dropdown">
        <button class="dropbtn">Dropdown 
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="#">Link 1</a>
          <a href="#">Link 2</a>
          <a href="#">Link 3</a>
        </div>
      </div>
    </div>
</header>

<h3>Dropdown Menu inside a Navigation Bar</h3>
<p>Hover over the "Dropdown" link to see the dropdown menu.</p>

</body>
</html>
