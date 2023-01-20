<div id = "MainSiderBar" class = "Sidebar">
    <div class="logoContainer"><a href="index.php"><img src="img/logo.png" alt="Logo" class = "logo">DinoStore</a></div>
    <div id = "Bar1" class = "BlackBarH"></div>
    <a href="products.php">Produits</a>
    <a href="orders.php">Commandes</a>
    <a href="clients.php">Clients</a>
    <a href="">Cadeaux de Fidelité</a>
</div>
<div id = "sideBartoggle" class = "toggleBar">
    <button id= "toggleButton" class="openbtn" onclick="toggleBar()">></button>
</div>

<style> 
.toggleBar{
    width: 20px;
    height : 100%;
    left-margin : 0;
    background-color : #554640;
    transition: 0.5s;
}

/* Style the button that is used to open the sidepanel */
.openbtn {
    height: 100%;
    width : 100%;
  font-size: 20px;
  cursor: pointer;
  background: none;
  color: white;
  border: none;
}

.openbtn:hover {
  color: #707078;
} 

/* bar for the sidebar*/
.BlackBarH{
    border : 2px solid #8DA7BE;
}

/* The sidepanel menu */
.Sidebar {
    flex-grow:0;
height: 100%; /* Specify a height */
width: 0px; /* 0 width - change this with JavaScript */
position: fixed; /* Stay in place */
z-index: 1; /* Stay on top */
top: 0;
left: 0;
background-color: #554640; /* Black*/
overflow-x: hidden; /* Disable horizontal scroll */
padding-top: 1%; /* Place content 60px from the top */
transition: 0.5s; /* 0.5 second transition effect to slide in the sidepanel */
}

/* The sidepanel links */
.Sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.Sidebar a:hover {
  color: #f1f1f1;
}

/* logo parmaters */
.sidebar .logo{
    vertical-align: middle;
    width : 50px;
    height: 50px;
}
</style>

<script>
    /*script for the toggle of the bar */
    var toggled = false;
    var sideBarWidth = "20%";

    function toggleBar(){
        if(!toggled){
            document.getElementById("MainSiderBar").style.width = sideBarWidth;
            document.getElementById("sideBartoggle").style.marginLeft = sideBarWidth;
            document.getElementById("toggleButton").innerText  = "<";
        }else{
            document.getElementById("MainSiderBar").style.width = "0";
            document.getElementById("sideBartoggle").style.marginLeft = "0";
            document.getElementById("toggleButton").innerText = ">";
        }
        toggled = !toggled;
    }
</script>