<!DOCTYPE html>
<html>
<head>
    <style>
        :root {
  --main-color: #ABA1FF;
  --main-color-dark: #675FB2;
  --ray-color: #FFD6BB;
  --spark-color: #70B268;
  --back-color: #2f2e4e;
}



.container {
  max-width: 800px;
  margin: auto;
  padding: 20px;
}


/* Restul codului CSS */
#lastray{
  margin: auto;
  border-radius: 100%;
  border: 0px solid;
  border-color: var(--ray-color);
  opacity: 1;
  width: 0px;
  height: 0px;
  transform: translate(-50%, -50%);
  left: 50%;
  top: 50%;
}
#loading-page{
  background: var(--back-color);
  border-radius: 100%;
  top:50%;
  left: 50vw;
  transform: translate(-50%,-50%);
  width: 400vh;
  height: 400vh;
  position: fixed;
  overflow: hidden;
  transition-duration: 1s;
}
#loader{
  margin: auto;
  width: 100%;
  height: 100%;
  max-width: 200px;
  position: absolute;
  max-height: 200px;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  display: flex;
}
.element{
  margin: auto;
  position: absolute;
}
.sphere{
  background: radial-gradient(circle, var(--main-color), var(--main-color-dark));
  width: 50px;
  height: 50px;
  border-radius: 100%;
  animation: pump 4s infinite ease-in-out;
  transform: translate(-50%, -50%);
  left: 50%;
  top: 50%;
  box-shadow: 0px 0px 15px 0px rgba(200, 230, 255, 0.5);
}
.ray{
  margin: auto;
  border-radius: 100%;
  border: 5px solid;
  border-color: var(--ray-color);
  opacity: 1;
  width: 10px;
  height: 10px;
  animation: ray 4s infinite ease-out;
  animation-delay: 2.5s;
  transform: translate(-50%, -50%);
  left: 50%;
  top: 50%;
  box-shadow: 0px 0px 15px 0px rgba(255, 230, 200, 0.5);
}
.spark{
  width: 200px;
  height: 200px;
}
.particles{
  transform: translate(-50%, -50%);
}
.particle{
  background-color: var(--spark-color);
  width:5px;
  height:5px;
  border-radius: 100%;
  opacity: 0;
  animation: particle 1s infinite ease-in;
  left: 0%;
  top: 0%;
}
.spark1{transform: rotate(20deg);}
.spark2{transform: rotate(40deg);}
.spark3{transform: rotate(66deg);}
.spark4{transform: rotate(172deg);}
.spark5{transform: rotate(110deg);}
.spark6{transform: rotate(130deg);}
.spark7{transform: rotate(-100deg);}
.spark8{transform: rotate(-50deg);}
.spark9{transform: rotate(-80deg);}
.spark10{transform: rotate(-173deg);}
.spark11{transform: rotate(-7deg);}
.spark12{transform: rotate(-133deg);}

.particle1{animation-delay: .5s;}
.particle2{animation-delay: 0s;}
.particle3{animation-delay: 2.2s;}
.particle4{animation-delay: .2s;}
.particle5{animation-delay: 2s;}
.particle6{animation-delay: 1.2s;}
.particle7{animation-delay: 2.5s;}
.particle8{animation-delay: 1.5s;}
.particle9{animation-delay: 1s;}
.particle10{animation-delay: 2.5s;}
.particle11{animation-delay: .7s;}
.particle12{animation-delay: 1.7s;}

.loaded{
  width: 0px !important;
  height: 0px !important;
  transition: 1.2s ease-out;
}
.whitebk{
  background:#fff!important;
}
.opzero{
  opacity: 0;
  transition: 1s ease-out;
}
.finalray{
  animation: ray 2s ease-out;
  animation-delay: .3s;
  border: 1px solid;
}
/*ANIMATIONS*/
@keyframes pump {
    0% {width: 50px; height: 50px;}
    83% {width: 88px; height: 88px;}
    85% {width: 90px; height: 90px;}
    100% {width: 50px; height: 50px;}
}
@keyframes ray {
    0% {width: 10px; height: 10px; opacity: 1; border-width: 1px;}
    100% {width: 200px; height: 200px; opacity: 0; border-width: 5px;}
}
@keyframes particle {
    0% {left:0%; top:0%; opacity: 0;}
    70% {opacity: 1;}
    100% {left:50%; top:50%; opacity: 1;}
	
}


        
    </style>
</head>
<body>
    <div id="loading-page">
        <div id="loader">
            <div class="spark1 spark element">
     <div class="particle1 particle element">
     </div>
     </div>
     <div class="spark2 spark element">
     <div class="particle2 particle element">
     </div>
     </div>
     <div class="spark3 spark element">
     <div class="particle3 particle element">
     </div>
     </div>
     <div class="spark4 spark element">
     <div class="particle4 particle element">
     </div>
     </div>
     <div class="spark5 spark element">
     <div class="particle5 particle element">
     </div>
     </div>
     <div class="spark6 spark element">
     <div class="particle6 particle element">
     </div>
     </div>
     <div class="spark7 spark element">
     <div class="particle7 particle element">
     </div>
     </div>
     <div class="spark8 spark element">
     <div class="particle8 particle element">
     </div>
     </div>
     <div class="spark9 spark element">
     <div class="particle9 particle element">
     </div>
     </div>
     <div class="spark10 spark element">
     <div class="particle10 particle element">
     </div>
     </div>
     <div class="spark11 spark element">
     <div class="particle11 particle element">
     </div>
     </div>
     <div class="spark12 spark element">
     <div class="particle12 particle element">
     </div>
     </div>
     </div>
     <div class="ray element">
     </div>
     <div class="sphere element">
     </div>
     </div>
     </div>
     <div class="element" id="lastray">
     </div>

    <script>
       

// Verifică dacă animația a fost deja afișată
if (!sessionStorage.getItem('animationShown')) {
    // Dacă nu a fost afișată, setează timpul de întârziere pentru animație
    setTimeout(function() {
        document.getElementById("loading-page").className += " loaded";
        document.getElementById("loader").className += " loaded";
    }, 3000);
    
    // Marchează animația ca afișată
    sessionStorage.setItem('animationShown', 'true');
} else {
    // Dacă a fost deja afișată, ascunde animația imediat
    document.getElementById("loading-page").className += " loaded";
    document.getElementById("loader").className += " loaded";
}




    </script>
</body>
</html>
