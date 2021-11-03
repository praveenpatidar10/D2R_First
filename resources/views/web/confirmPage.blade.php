 <style>
body { 
    overflow-y: hidden;
    overflow-x: hidden;
}
.overlay {
  height: 100%;z
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  /*background-color: rgb(0,0,0);*/
  background-color: rgba(217, 208, 208, 0.9);
  /*rgba(0,0,0, 0.9);*/
  overflow-x: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: center;
  margin-top: 30px;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
}

.row {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  grid-gap: 20px;
}


.col-xs-12 {
  grid-column: span 12
}

.col-xs-11 {
  grid-column: span 11;
}

.col-xs-10 {
  grid-column: span 10
}

.col-xs-9 {
  grid-column: span 9
}

.col-xs-8 {
  grid-column: span 8
}

.col-xs-7 {
  grid-column: span 7
}

.col-xs-6 {
  grid-column: span 6
}

.col-xs-5 {
  grid-column: span 5
}

.col-xs-4 {
  grid-column: span 4
}

.col-xs-3 {
  grid-column: span 3
}

.col-xs-2 {
  grid-column: span 2
}

.col-xs-1 {
  grid-column: span 1
}

@media (min-width: 768px) {
  .col-sm-12 {
    grid-column: span 12
  }

  .col-sm-11 {
    grid-column: span 11;
  }

  .col-sm-10 {
    grid-column: span 10
  }

  .col-sm-9 {
    grid-column: span 9
  }

  .col-sm-8 {
    grid-column: span 8
  }

  .col-sm-7 {
    grid-column: span 7
  }

  .col-sm-6 {
    grid-column: span 6
  }

  .col-sm-5 {
    grid-column: span 5
  }

  .col-sm-4 {
    grid-column: span 4
  }

  .col-sm-3 {
    grid-column: span 3
  }

  .col-sm-2 {
    grid-column: span 2
  }

  .col-sm-1 {
    grid-column: span 1
  }
}

@media (min-width: 992px) {
  .col-md-12 {
    grid-column: span 12
  }

  .col-md-11 {
    grid-column: span 11;
  }

  .col-md-10 {
    grid-column: span 10
  }

  .col-md-9 {
    grid-column: span 9
  }

  .col-md-8 {
    grid-column: span 8
  }

  .col-md-7 {
    grid-column: span 7
  }

  .col-md-6 {
    grid-column: span 6
  }

  .col-md-5 {
    grid-column: span 5
  }

  .col-md-4 {
    grid-column: span 4
  }

  .col-md-3 {
    grid-column: span 3
  }

  .col-md-2 {
    grid-column: span 2
  }

  .col-md-1 {
    grid-column: span 1
  }
}

@media (min-width: 1200px) {
  .col-lg-12 {
    grid-column: span 12
  }

  .col-lg-11 {
    grid-column: span 11;
  }

  .col-lg-10 {
    grid-column: span 10
  }

  .col-lg-9 {
    grid-column: span 9
  }

  .col-lg-8 {
    grid-column: span 8
  }

  .col-lg-7 {
    grid-column: span 7
  }

  .col-lg-6 {
    grid-column: span 6
  }

  .col-lg-5 {
    grid-column: span 5
  }

  .col-lg-4 {
    grid-column: span 4
  }

  .col-lg-3 {
    grid-column: span 3
  }

  .col-lg-2 {
    grid-column: span 2
  }

  .col-lg-1 {
    grid-column: span 1
  }
}
</style>
        <div id="myNav" class="overlay" style="width:100%">
  <div class="overlay-content row">
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
          <h4 style="font-size: 40px;font-family: 'Poppins';">What would you like to visit?</h4>
      </div>
    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
        <img onclick="setvisitPreference('DBF');" src="https://fmhc.visionux.in/media/logo-1628865603.png" />
    </div>
    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
        <img  onclick="setvisitPreference('DBFSATSANG')" src="https://fmhc.visionux.in/media/satsang-logo-1630487723.png" />
    </div>
  </div>
</div>