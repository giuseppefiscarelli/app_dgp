 <style>
   .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }
  .card-counter-baby{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 10px 5px;
    background-color: #fff;
    height: 50px;
    border-radius: 5px;
    transition: .3s linear all;
    font-size: 0.8vw;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger, .card-counter-baby.danger{
    background-color: #ef5350;
    color: #FFF;
  }  
  .card-counter.warning, .card-counter-baby.warning{
    background-color: #ff9800;
    color: #FFF;
  }

  .card-counter.success, .card-counter-baby.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info,.card-counter-baby.info{
    background-color: #26c6da;
    color: #FFF;
  }  
  .card-counter-baby.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }
 </style>      
    <div id="loadSpin">
        <div class="d-flex justify-content-center" >
            <p style="position:absolute;"><strong>Caricamento in corso...</strong></p>
            <div class="progress-spinner progress-spinner-active" style="margin-top:30px;">
                <span class="sr-only">Caricamento...</span>
            </div>
        </div>
    </div>


